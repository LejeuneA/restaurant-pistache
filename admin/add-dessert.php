<?php

declare(strict_types=1);

require_once __DIR__ . '/settings.php';
require_once __DIR__ . '/app/functions/fct-admin-crud.php';

requireLogin();

$config = rpAdminDishConfig('dessert');
$message = rpAdminPullFlash();
$tinyMCE = true;
$categories = [];

$formData = [
    'image_url' => '',
    'title' => '',
    'price' => '',
    'description' => '',
    'content' => '',
    'published_article' => 0,
    'idCategory' => (int) $config['category_id'],
];

if ($conn instanceof PDO) {
    $categories = rpAdminFetchCategories($conn);
} elseif ($message === null) {
    $message = getMessage(
        'The database connection is unavailable.',
        'error'
    );
}

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && ($_POST['form'] ?? '') === 'add'
) {
    [$formData, $validationError] =
        rpAdminValidateDishInput(
            $_POST,
            $config
        );

    if (!rpAdminCsrfIsValid()) {
        $message = getMessage(
            'Your session has expired. Please try again.',
            'error'
        );
    } elseif (!isAdmin()) {
        $message = getMessage(
            'Demo account: adding desserts is disabled.',
            'error'
        );
    } elseif (!$conn instanceof PDO) {
        $message = getMessage(
            'The database connection is unavailable.',
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
            $formData['image_url'] =
                (string) $upload['relative_path'];

            if (
                rpAdminInsertDish(
                    $conn,
                    $config,
                    $formData
                )
            ) {
                rpAdminSetFlash(
                    'Dessert successfully added.',
                    'success'
                );

                $_SESSION['csrf_token'] =
                    bin2hex(random_bytes(32));

                header(
                    'Location: '
                    . appUrl(
                        'admin/'
                        . $config['add_page']
                    )
                );
                exit();
            }

            if (
                is_string($upload['absolute_path'])
                && is_file($upload['absolute_path'])
            ) {
                @unlink($upload['absolute_path']);
            }

            $message = getMessage(
                'The dessert could not be added.',
                'error'
            );
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php displayHeadSection('Add a dessert'); ?>
</head>

<body>

    <header>
        <?php displayNavigationAdmin(); ?>
    </header>

    <main class="edit-content">

        <div class="edit-title">
            <h1>Add a dessert</h1>

            <?php if (isGuest()): ?>
                <div class="message">
                    <?= getMessage(
                        'Demo account: you can fill in this form, but the dessert will not be added.',
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
                id="add-dessert-form"
                action="<?= escapeHtml(
                    appUrl(
                        'admin/'
                        . $config['add_page']
                    )
                ) ?>"
                method="post"
                enctype="multipart/form-data"
            >
                <input
                    type="hidden"
                    name="form"
                    value="add"
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

                            <div class="checkbox-wrapper-22">
                                <label
                                    class="switch"
                                    for="published_article"
                                >
                                    <input
                                        type="checkbox"
                                        id="published_article"
                                        name="published_article"
                                        value="1"
                                        <?= (
                                            (int) $formData[
                                                'published_article'
                                            ] === 1
                                        )
                                            ? 'checked'
                                            : '' ?>
                                    >
                                    <span class="slider round"></span>
                                </label>
                            </div>
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
                                placeholder="12.00"
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
                                Upload image
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
                                <img
                                    id="image_preview"
                                    class="image_preview"
                                    src=""
                                    alt=""
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
                    <i class="fa-solid fa-square-plus"></i>
                    Add
                </button>

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
