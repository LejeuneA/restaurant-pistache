<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Shared admin helpers
|--------------------------------------------------------------------------
*/

function rpAdminPullFlash(): ?string
{
    if (!isset($_SESSION['message'])) {
        return null;
    }

    $message = (string) $_SESSION['message'];
    unset($_SESSION['message']);

    return $message;
}

function rpAdminSetFlash(string $message, string $type = 'success'): void
{
    $_SESSION['message'] = getMessage($message, $type);
}

function rpAdminCsrfIsValid(): bool
{
    $submittedToken = (string) ($_POST['csrf_token'] ?? '');
    $sessionToken = (string) ($_SESSION['csrf_token'] ?? '');

    return $submittedToken !== ''
        && $sessionToken !== ''
        && hash_equals($sessionToken, $submittedToken);
}

function rpAdminDishConfig(string $type): array
{
    $configs = [
        'starter' => [
            'table' => 'starters',
            'id_key' => 'idStarter',
            'category_id' => 1,
            'label' => 'starter',
            'label_plural' => 'starters',
            'title' => 'Starter',
            'prefix' => 'starter',
            'manager_page' => 'manager-starter.php',
            'add_page' => 'add-starter.php',
            'edit_page' => 'edit-starter.php',
            'single_page' => 'single-starter.php',
            'display_table_function' => 'displayStartersAsTable',
            'display_single_function' => 'displayStarterByID',
            'js_name' => 'Starter',
        ],
        'maincourse' => [
            'table' => 'maincourses',
            'id_key' => 'idMainCourse',
            'category_id' => 2,
            'label' => 'main course',
            'label_plural' => 'main courses',
            'title' => 'Main course',
            'prefix' => 'maincourse',
            'manager_page' => 'manager-maincourse.php',
            'add_page' => 'add-maincourse.php',
            'edit_page' => 'edit-maincourse.php',
            'single_page' => 'single-maincourse.php',
            'display_table_function' => 'displayMainCoursesAsTable',
            'display_single_function' => 'displayMainCourseByID',
            'js_name' => 'MainCourse',
        ],
        'dessert' => [
            'table' => 'desserts',
            'id_key' => 'idDessert',
            'category_id' => 3,
            'label' => 'dessert',
            'label_plural' => 'desserts',
            'title' => 'Dessert',
            'prefix' => 'dessert',
            'manager_page' => 'manager-dessert.php',
            'add_page' => 'add-dessert.php',
            'edit_page' => 'edit-dessert.php',
            'single_page' => 'single-dessert.php',
            'display_table_function' => 'displayDessertsAsTable',
            'display_single_function' => 'displayDessertByID',
            'js_name' => 'Dessert',
        ],
    ];

    if (!isset($configs[$type])) {
        throw new InvalidArgumentException('Unknown dish type.');
    }

    return $configs[$type];
}

function rpAdminDecodeText($value): string
{
    return html_entity_decode(
        (string) $value,
        ENT_QUOTES | ENT_HTML5,
        'UTF-8'
    );
}

function rpAdminEncodeRichText(string $content): string
{
    return htmlentities(
        trim($content),
        ENT_QUOTES | ENT_HTML5,
        'UTF-8'
    );
}

function rpAdminFetchCategories(PDO $conn): array
{
    try {
        $statement = $conn->query(
            'SELECT idCategory, nameOfCategory '
            . 'FROM category ORDER BY idCategory ASC'
        );

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log(
            'Category retrieval failed: '
            . $exception->getMessage()
        );

        return [];
    }
}

function rpAdminFetchDishes(PDO $conn, array $config): array
{
    try {
        $statement = $conn->query(
            'SELECT * FROM `' . $config['table'] . '` '
            . 'ORDER BY `' . $config['id_key'] . '` DESC'
        );

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log(
            'Dish list retrieval failed: '
            . $exception->getMessage()
        );

        return [];
    }
}

function rpAdminFetchDish(
    PDO $conn,
    array $config,
    int $id,
    bool $activeOnly = false
): ?array {
    try {
        $sql = 'SELECT * FROM `' . $config['table'] . '` '
            . 'WHERE `' . $config['id_key'] . '` = :id';

        if ($activeOnly) {
            $sql .= ' AND active = 1';
        }

        $sql .= ' LIMIT 1';

        $statement = $conn->prepare($sql);
        $statement->execute(['id' => $id]);
        $dish = $statement->fetch(PDO::FETCH_ASSOC);

        return is_array($dish) ? $dish : null;
    } catch (PDOException $exception) {
        error_log(
            'Dish retrieval failed: '
            . $exception->getMessage()
        );

        return null;
    }
}

function rpAdminNormalizePrice($value): ?string
{
    $price = trim((string) $value);
    $price = str_replace(['€', ' ', "\xc2\xa0"], '', $price);
    $price = str_replace(',', '.', $price);

    if (
        !preg_match(
            '/^(?:\d{1,3})(?:\.\d{1,2})?$/',
            $price
        )
    ) {
        return null;
    }

    $number = (float) $price;

    if ($number < 0 || $number > 999.99) {
        return null;
    }

    return number_format($number, 2, '.', '');
}

function rpAdminValidateDishInput(
    array $source,
    array $config
): array {
    $title = trim(rpAdminDecodeText($source['title'] ?? ''));
    $description = trim(
        rpAdminDecodeText($source['description'] ?? '')
    );
    $price = rpAdminNormalizePrice($source['price'] ?? '');
    $content = trim((string) ($source['content'] ?? ''));
    $idCategory = filter_var(
        $source['idCategory'] ?? null,
        FILTER_VALIDATE_INT,
        [
            'options' => [
                'min_range' => 1,
                'max_range' => 3,
            ],
        ]
    );

    $data = [
        'title' => $title,
        'description' => $description,
        'price' => $price ?? trim((string) ($source['price'] ?? '')),
        'content' => $content,
        'published_article' =>
            isset($source['published_article']) ? 1 : 0,
        'idCategory' => $idCategory ?: (int) $config['category_id'],
    ];

    if ($title === '') {
        return [$data, 'Please enter a title.'];
    }

    if (mb_strlen($title) > 150) {
        return [$data, 'The title cannot exceed 150 characters.'];
    }

    if (mb_strlen($description) > 250) {
        return [$data, 'The description cannot exceed 250 characters.'];
    }

    if ($price === null) {
        return [
            $data,
            'Please enter a valid price between 0 and 999.99.',
        ];
    }

    if ($idCategory === false || $idCategory === null) {
        return [$data, 'Please select a valid category.'];
    }

    if (mb_strlen($content) > 50000) {
        return [$data, 'The content is too long.'];
    }

    $data['price'] = $price;

    return [$data, null];
}

function rpAdminHandleImageUpload(
    string $fieldName,
    string $prefix
): array {
    if (
        !isset($_FILES[$fieldName])
        || (
            $_FILES[$fieldName]['error']
            ?? UPLOAD_ERR_NO_FILE
        ) === UPLOAD_ERR_NO_FILE
    ) {
        return [
            'relative_path' => '',
            'absolute_path' => null,
            'error' => null,
        ];
    }

    $file = $_FILES[$fieldName];

    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        return [
            'relative_path' => '',
            'absolute_path' => null,
            'error' => 'The image could not be uploaded.',
        ];
    }

    if ((int) ($file['size'] ?? 0) > 5 * 1024 * 1024) {
        return [
            'relative_path' => '',
            'absolute_path' => null,
            'error' => 'The image cannot exceed 5 MB.',
        ];
    }

    $temporaryPath = (string) ($file['tmp_name'] ?? '');

    if ($temporaryPath === '' || !is_uploaded_file($temporaryPath)) {
        return [
            'relative_path' => '',
            'absolute_path' => null,
            'error' => 'The uploaded image is invalid.',
        ];
    }

    $fileInfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $fileInfo->file($temporaryPath);

    $allowedMimeTypes = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif',
    ];

    if (!isset($allowedMimeTypes[$mimeType])) {
        return [
            'relative_path' => '',
            'absolute_path' => null,
            'error' => 'Use a JPG, PNG, WebP or GIF image.',
        ];
    }

    $uploadDirectory = dirname(__DIR__, 2) . '/uploads';

    if (
        !is_dir($uploadDirectory)
        && !mkdir($uploadDirectory, 0755, true)
    ) {
        return [
            'relative_path' => '',
            'absolute_path' => null,
            'error' => 'The upload folder is unavailable.',
        ];
    }

    $fileName = $prefix
        . '-'
        . bin2hex(random_bytes(12))
        . '.'
        . $allowedMimeTypes[$mimeType];

    $absolutePath = $uploadDirectory
        . DIRECTORY_SEPARATOR
        . $fileName;

    if (!move_uploaded_file($temporaryPath, $absolutePath)) {
        return [
            'relative_path' => '',
            'absolute_path' => null,
            'error' => 'The image could not be saved.',
        ];
    }

    return [
        'relative_path' => 'uploads/' . $fileName,
        'absolute_path' => $absolutePath,
        'error' => null,
    ];
}

function rpAdminRemoveManagedImage(string $relativePath): void
{
    $relativePath = str_replace('\\', '/', trim($relativePath));

    if (
        !preg_match(
            '#^uploads/[A-Za-z0-9._-]+$#',
            $relativePath
        )
    ) {
        return;
    }

    $absolutePath = dirname(__DIR__, 2)
        . '/'
        . $relativePath;

    if (is_file($absolutePath)) {
        @unlink($absolutePath);
    }
}

function rpAdminInsertDish(
    PDO $conn,
    array $config,
    array $data
): bool {
    try {
        $statement = $conn->prepare(
            'INSERT INTO `' . $config['table'] . '` '
            . '(image_url, title, price, description, content, active, idCategory) '
            . 'VALUES (:image_url, :title, :price, :description, :content, :active, :idCategory)'
        );

        return $statement->execute([
            'image_url' => $data['image_url'],
            'title' => $data['title'],
            'price' => $data['price'],
            'description' => $data['description'],
            'content' => rpAdminEncodeRichText($data['content']),
            'active' => (int) $data['published_article'],
            'idCategory' => (int) $data['idCategory'],
        ]);
    } catch (PDOException $exception) {
        error_log(
            'Dish insertion failed: '
            . $exception->getMessage()
        );

        return false;
    }
}

function rpAdminUpdateDish(
    PDO $conn,
    array $config,
    int $id,
    array $data
): bool {
    try {
        $statement = $conn->prepare(
            'UPDATE `' . $config['table'] . '` SET '
            . 'image_url = :image_url, '
            . 'title = :title, '
            . 'price = :price, '
            . 'description = :description, '
            . 'content = :content, '
            . 'active = :active, '
            . 'idCategory = :idCategory '
            . 'WHERE `' . $config['id_key'] . '` = :id'
        );

        return $statement->execute([
            'image_url' => $data['image_url'],
            'title' => $data['title'],
            'price' => $data['price'],
            'description' => $data['description'],
            'content' => rpAdminEncodeRichText($data['content']),
            'active' => (int) $data['published_article'],
            'idCategory' => (int) $data['idCategory'],
            'id' => $id,
        ]);
    } catch (PDOException $exception) {
        error_log(
            'Dish update failed: '
            . $exception->getMessage()
        );

        return false;
    }
}

function rpAdminDeleteDish(
    PDO $conn,
    array $config,
    int $id
): bool {
    $dish = rpAdminFetchDish($conn, $config, $id);

    if ($dish === null) {
        return false;
    }

    try {
        $statement = $conn->prepare(
            'DELETE FROM `' . $config['table'] . '` '
            . 'WHERE `' . $config['id_key'] . '` = :id'
        );

        $deleted = $statement->execute(['id' => $id]);

        if ($deleted) {
            rpAdminRemoveManagedImage(
                (string) ($dish['image_url'] ?? '')
            );
        }

        return $deleted;
    } catch (PDOException $exception) {
        error_log(
            'Dish deletion failed: '
            . $exception->getMessage()
        );

        return false;
    }
}

/*
|--------------------------------------------------------------------------
| Reservations
|--------------------------------------------------------------------------
*/

function rpAdminFetchReservations(PDO $conn): array
{
    try {
        $statement = $conn->query(
            'SELECT * FROM reservations '
            . 'ORDER BY idReservation DESC'
        );

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log(
            'Reservation list retrieval failed: '
            . $exception->getMessage()
        );

        return [];
    }
}

function rpAdminFetchReservation(
    PDO $conn,
    int $id
): ?array {
    try {
        $statement = $conn->prepare(
            'SELECT * FROM reservations '
            . 'WHERE idReservation = :id LIMIT 1'
        );
        $statement->execute(['id' => $id]);
        $reservation = $statement->fetch(PDO::FETCH_ASSOC);

        return is_array($reservation) ? $reservation : null;
    } catch (PDOException $exception) {
        error_log(
            'Reservation retrieval failed: '
            . $exception->getMessage()
        );

        return null;
    }
}

function rpAdminValidateReservationInput(
    array $source,
    bool $allowPastDate = false
): array {
    $name = trim(rpAdminDecodeText($source['name'] ?? ''));
    $email = trim((string) ($source['email'] ?? ''));
    $phone = trim((string) ($source['phone'] ?? ''));
    $bookDate = trim((string) ($source['book_date'] ?? ''));
    $bookTime = trim((string) ($source['book_time'] ?? ''));
    $person = filter_var(
        $source['person'] ?? null,
        FILTER_VALIDATE_INT,
        [
            'options' => [
                'min_range' => 1,
                'max_range' => 20,
            ],
        ]
    );

    $data = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'book_date' => $bookDate,
        'book_time' => $bookTime,
        'person' => $person ?: trim(
            (string) ($source['person'] ?? '')
        ),
        'active' => isset($source['active'])
            || isset($source['published_article'])
                ? 1
                : 0,
    ];

    if ($name === '' || mb_strlen($name) > 100) {
        return [$data, 'Please enter a valid customer name.'];
    }

    if (
        !filter_var($email, FILTER_VALIDATE_EMAIL)
        || mb_strlen($email) > 150
    ) {
        return [$data, 'Please enter a valid email address.'];
    }

    if (
        $phone === ''
        || mb_strlen($phone) > 30
        || !preg_match('/^[0-9+().\s-]+$/', $phone)
    ) {
        return [$data, 'Please enter a valid phone number.'];
    }

    $date = DateTimeImmutable::createFromFormat(
        '!Y-m-d',
        $bookDate
    );
    $dateErrors = DateTimeImmutable::getLastErrors();

    if (
        !$date
        || (
            is_array($dateErrors)
            && (
                $dateErrors['warning_count'] > 0
                || $dateErrors['error_count'] > 0
            )
        )
        || $date->format('Y-m-d') !== $bookDate
    ) {
        return [$data, 'Please enter a valid booking date.'];
    }

    if (
        !$allowPastDate
        && $bookDate < date('Y-m-d')
    ) {
        return [$data, 'The booking date cannot be in the past.'];
    }

    $time = DateTimeImmutable::createFromFormat(
        '!H:i',
        substr($bookTime, 0, 5)
    );
    $timeErrors = DateTimeImmutable::getLastErrors();

    if (
        !$time
        || (
            is_array($timeErrors)
            && (
                $timeErrors['warning_count'] > 0
                || $timeErrors['error_count'] > 0
            )
        )
    ) {
        return [$data, 'Please enter a valid booking time.'];
    }

    if ($person === false || $person === null) {
        return [
            $data,
            'The number of guests must be between 1 and 20.',
        ];
    }

    $data['book_time'] = $time->format('H:i:s');
    $data['person'] = $person;

    return [$data, null];
}

function rpAdminInsertReservation(
    PDO $conn,
    array $data
): bool {
    try {
        $statement = $conn->prepare(
            'INSERT INTO reservations '
            . '(name, email, phone, book_date, book_time, person, created_at, active) '
            . 'VALUES (:name, :email, :phone, :book_date, :book_time, :person, NOW(), :active)'
        );

        return $statement->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'book_date' => $data['book_date'],
            'book_time' => $data['book_time'],
            'person' => (int) $data['person'],
            'active' => (int) $data['active'],
        ]);
    } catch (PDOException $exception) {
        error_log(
            'Reservation insertion failed: '
            . $exception->getMessage()
        );

        return false;
    }
}

function rpAdminUpdateReservation(
    PDO $conn,
    int $id,
    array $data
): bool {
    try {
        $statement = $conn->prepare(
            'UPDATE reservations SET '
            . 'name = :name, '
            . 'email = :email, '
            . 'phone = :phone, '
            . 'book_date = :book_date, '
            . 'book_time = :book_time, '
            . 'person = :person, '
            . 'active = :active '
            . 'WHERE idReservation = :id'
        );

        return $statement->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'book_date' => $data['book_date'],
            'book_time' => $data['book_time'],
            'person' => (int) $data['person'],
            'active' => (int) $data['active'],
            'id' => $id,
        ]);
    } catch (PDOException $exception) {
        error_log(
            'Reservation update failed: '
            . $exception->getMessage()
        );

        return false;
    }
}

function rpAdminDeleteReservation(
    PDO $conn,
    int $id
): bool {
    try {
        $statement = $conn->prepare(
            'DELETE FROM reservations '
            . 'WHERE idReservation = :id'
        );

        return $statement->execute(['id' => $id]);
    } catch (PDOException $exception) {
        error_log(
            'Reservation deletion failed: '
            . $exception->getMessage()
        );

        return false;
    }
}

/*
|--------------------------------------------------------------------------
| Messages
|--------------------------------------------------------------------------
*/

function rpAdminFetchMessages(PDO $conn): array
{
    try {
        $statement = $conn->query(
            'SELECT * FROM contact ORDER BY idContact DESC'
        );

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log(
            'Message list retrieval failed: '
            . $exception->getMessage()
        );

        return [];
    }
}

function rpAdminDeleteMessage(
    PDO $conn,
    int $id
): bool {
    try {
        $statement = $conn->prepare(
            'DELETE FROM contact WHERE idContact = :id'
        );

        return $statement->execute(['id' => $id]);
    } catch (PDOException $exception) {
        error_log(
            'Message deletion failed: '
            . $exception->getMessage()
        );

        return false;
    }
}
