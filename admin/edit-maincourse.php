<?php

declare(strict_types=1);

require_once __DIR__ . '/settings.php';
require_once __DIR__ . '/app/functions/fct-admin-crud.php';

requireLogin();

$config = rpAdminDishConfig('maincourse');
$message = rpAdminPullFlash();
$tinyMCE = true;
$categories = [];

$dishId = filter_input(
    INPUT_GET,
    $config['id_key'],
    FILTER_VALIDATE_INT,
    [
        'options' => [
            'min_range' => 1,
        ],
    ]
);

if ($dishId === false || $dishId === null) {
    rpAdminSetFlash(
        'The selected main course is invalid.',
        'error'
    );

    header(
        'Location: '
        . appUrl(
            'admin/'
            . $config['manager_page']
        )
    );
    exit();
}

if (!$conn instanceof PDO) {
    rpAdminSetFlash(
        'The database connection is unavailable.',
        'error'
    );

    header(
        'Location: '
        . appUrl(
            'admin/'
            . $config['manager_page']
        )
    );
    exit();
}

$dish = rpAdminFetchDish(
    $conn,
    $config,
    (int) $dishId
);

if ($dish === null) {
    rpAdminSetFlash(
        'The requested main course was not found.',
        'error'
    );

    header(
        'Location: '
        . appUrl(
            'admin/'
            . $config['manager_page']
        )
    );
    exit();
}

$categories = rpAdminFetchCategories($conn);

$formData = [
    'image_url' => (string) (
        $dish['image_url'] ?? ''
    ),
    'title' => rpAdminDecodeText(
        $dish['title'] ?? ''
    ),
    'price' => (string) (
        $dish['price'] ?? ''
    ),
    'description' => rpAdminDecodeText(
        $dish['description'] ?? ''
    ),
    'content' => rpAdminDecodeText(
        $dish['content'] ?? ''
    ),
    'published_article' => (int) (
        $dish['active'] ?? 0
    ),
    'idCategory' => (int) (
        $dish['idCategory']
        ?? $config['category_id']
    ),
];

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && ($_POST['update_form'] ?? '') === '1'
) {
    [$submittedData, $validationError] =
        rpAdminValidateDishInput(
            $_POST,
            $config
        );

    $submittedData['image_url'] =
        $formData['image_url'];

    $formData = array_merge(
        $formData,
        $submittedData
    );

    if (!rpAdminCsrfIsValid()) {
        $message = getMessage(
            'Your session has expired. Please try again.',
            'error'
        );
    } elseif (!isAdmin()) {
        $message = getMessage(
            'Demo account: editing main courses is disabled.',
            'error'
        );
    } elseif ($validationError !== null) {
        $message = getMessage(
            $validationError,
            'error'
        );
    } else {
        $upload = rpAdminHandleImageUpload(
            'image_upload',
            (string) $config['prefix']
        );

        if ($upload['error'] !== null) {
            $message = getMessage(
                (string) $upload['error'],
                'error'
            );
        } else {
            $oldImagePath =
                (string) $dish['image_url'];

            if ($upload['relative_path'] !== '') {
                $formData['image_url'] =
                    (string) $upload[
                        'relative_path'
                    ];
            }

            $updated = rpAdminUpdateDish(
                $conn,
                $config,
                (int) $dishId,
                $formData
            );

            if ($updated) {
                if (
                    $upload['relative_path'] !== ''
                    && $oldImagePath
                        !== $formData['image_url']
                ) {
                    rpAdminRemoveManagedImage(
                        $oldImagePath
                    );
                }

                rpAdminSetFlash(
                    'The main course has been updated.',
                    'success'
                );

                $_SESSION['csrf_token'] =
                    bin2hex(random_bytes(32));

                header(
                    'Location: '
                    . appUrl(
                        'admin/'
                        . $config['edit_page']
                    )
                    . '?'
                    . rawurlencode(
                        (string) $config['id_key']
                    )
                    . '='
                    . (int) $dishId
                );
                exit();
            }

            if (
                is_string($upload['absolute_path'])
                && is_file(
                    $upload['absolute_path']
                )
            ) {
                @unlink(
                    $upload['absolute_path']
                );
            }

            $message = getMessage(
                'The main course could not be updated.',
                'error'
            );
        }
    }
}

$imagePreviewUrl = safeRestaurantImageUrl(
    $formData['image_url']
);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php displayHeadSection('Editing a main course'); ?>
</head>

<body>

    <header>
        <?php displayNavigationAdmin(); ?>
    </header>

    <main class="edit-content">

        <div class="edit-title">
            <h1>Editing a main course</h1>

            <?php if (isGuest()): ?>
                <div class="message">
                    <?= getMessage(
                        'Demo account: you can view and fill in this form, but changes will not be saved.',
                        'info'
                    ) ?>
                </div>
            <?php endif; ?>

            <div class="message">
                <?= $message ?? '' ?>
            </div>
        </div>

        <div class="edit-form container">

            <form
                action="<?= escapeHtml(
                    appUrl(
                        'admin/'
                        . $config['edit_page']
                    )
                    . '?'
                    . $config['id_key']
                    . '='
                    . (int) $dishId
                ) ?>"
                method="post"
                enctype="multipart/form-data"
            >
                <input
                    type="hidden"
                    name="update_form"
                    value="1"
                >

                <input
                    type="hidden"
                    name="csrf_token"
                    value="<?= escapeHtml(
                        $_SESSION['csrf_token']
                    ) ?>"
                >

                <div class="form-top">

                    <div class="form-left">

                        <div class="checkbox-ctrl">
                            <label
                                for="published_article"
                                class="published_article"
                            >
                                Product status
                                <span>(publication)</span>
                            </label>

                            <?php
                            displayFormRadioBtnArticlePublished(
                                $formData[
                                    'published_article'
                                ],
                                'EDIT'
                            );
                            ?>
                        </div>

                        <div class="form-ctrl">
                            <label
                                for="idCategory"
                                class="form-ctrl"
                            >
                                Category
                            </label>

                            <select
                                id="idCategory"
                                name="idCategory"
                                class="form-ctrl"
                                required
                            >
                                <option value="">
                                    Select a category
                                </option>

                                <?php foreach (
                                    $categories
                                    as $category
                                ): ?>
                                    <?php
                                    $categoryId = (int) (
                                        $category[
                                            'idCategory'
                                        ] ?? 0
                                    );
                                    ?>

                                    <option
                                        value="<?= $categoryId ?>"
                                        <?= (
                                            $categoryId
                                            === (int) $formData[
                                                'idCategory'
                                            ]
                                        )
                                            ? 'selected'
                                            : '' ?>
                                    >
                                        <?= escapeHtml(
                                            rpAdminDecodeText(
                                                $category[
                                                    'nameOfCategory'
                                                ] ?? ''
                                            )
                                        ) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-ctrl">
                            <label
                                for="title"
                                class="form-ctrl"
                            >
                                Title
                            </label>

                            <input
                                type="text"
                                class="form-ctrl"
                                id="title"
                                name="title"
                                value="<?= escapeHtml(
                                    $formData['title']
                                ) ?>"
                                maxlength="150"
                                required
                            >
                        </div>

                        <div class="form-ctrl">
                            <label
                                for="description"
                                class="form-ctrl"
                            >
                                Description
                            </label>

                            <input
                                type="text"
                                class="form-ctrl"
                                id="description"
                                name="description"
                                value="<?= escapeHtml(
                                    $formData['description']
                                ) ?>"
                                maxlength="250"
                            >
                        </div>

                        <div class="form-ctrl">
                            <label
                                for="price"
                                class="form-ctrl"
                            >
                                Price
                            </label>

                            <input
                                type="text"
                                inputmode="decimal"
                                class="form-ctrl"
                                id="price"
                                name="price"
                                value="<?= escapeHtml(
                                    $formData['price']
                                ) ?>"
                                maxlength="7"
                                required
                            >
                        </div>

                    </div>

                    <div class="form-right">

                        <div class="form-ctrl">
                            <label
                                for="image_upload"
                                class="form-ctrl"
                            >
                                Upload a new image
                            </label>

                            <input
                                type="file"
                                class="form-ctrl"
                                id="image_upload"
                                name="image_upload"
                                accept="image/jpeg,image/png,image/webp,image/gif"
                                onchange="previewImage(this)"
                            >
                        </div>

                        <div class="form-ctrl">
                            <label
                                for="image_preview"
                                class="form-ctrl"
                            >
                                Image preview
                            </label>

                            <div>
                                <input
                                    type="text"
                                    class="form-ctrl image_url"
                                    id="image_url"
                                    value="<?= escapeHtml(
                                        $formData['image_url']
                                    ) ?>"
                                    readonly
                                >

                                <img
                                    id="image_preview"
                                    class="image_preview"
                                    src="<?= escapeHtml(
                                        $imagePreviewUrl
                                    ) ?>"
                                    alt="<?= escapeHtml(
                                        $formData['title']
                                    ) ?>"
                                >
                            </div>
                        </div>

                    </div>

                </div>

                <div class="form-bottom">
                    <div class="form-ctrl">
                        <label
                            for="content"
                            class="form-ctrl"
                        >
                            Content
                        </label>

                        <textarea
                            class="content"
                            id="content"
                            name="content"
                            rows="5"
                        ><?= escapeHtml(
                            $formData['content']
                        ) ?></textarea>
                    </div>
                </div>

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Save
                </button>

                <a
                    class="btn-primary"
                    href="<?= escapeHtml(
                        appUrl(
                            'admin/'
                            . $config['single_page']
                        )
                        . '?'
                        . $config['id_key']
                        . '='
                        . (int) $dishId
                    ) ?>"
                >
                    Display
                </a>

            </form>

        </div>

    </main>

    <footer>
        <?php displayFooter(); ?>
    </footer>

    <?php displayJSSection($tinyMCE); ?>

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"
        integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    ></script>

    <script src="<?= escapeHtml(
        appUrl('js/main.js')
    ) ?>"></script>

</body>

</html>
