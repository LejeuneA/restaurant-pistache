<?php

declare(strict_types=1);

function displayFormRadioBtnArticlePublished($published, $typeForm = 'ADD'): void
{
    $checked = strtoupper((string) $typeForm) === 'EDIT' && (bool) $published;

    echo '<div class="checkbox-wrapper-22">'
        . '<label class="switch" for="published_article">'
        . '<input type="checkbox" id="published_article" '
        . 'value="1" name="published_article" '
        . ($checked ? 'checked' : '')
        . '>'
        . '<span class="slider round"></span>'
        . '</label>'
        . '</div>';
}

function displayJSSection($tinyMCE = false): void
{
    if (!$tinyMCE) {
        return;
    }

    echo '<script src="'
        . uiEscape(appUrl('admin/vendors/tinymce/tinymce.min.js'))
        . '" referrerpolicy="origin"></script>';
    echo '<script src="'
        . uiEscape(appUrl('admin/assets/js/conf-tinymce.js'))
        . '"></script>';
}

function displayHeadSection($title = APP_NAME): void
{
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<meta name="description" content="Restaurant Pistache in Liège">';
    echo '<link rel="stylesheet" type="text/css" href="'
        . uiEscape(appUrl('css/styles.css'))
        . '">';
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">';
    echo '<link rel="stylesheet" href="'
        . uiEscape(appUrl('assets/vendor/aos/aos.css'))
        . '">';
    echo '<link rel="icon" type="image/png" href="'
        . uiEscape(appUrl('assets/icons/favicon.png'))
        . '">';
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    echo '<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">';
    echo '<title>' . uiEscape($title) . '</title>';
}

function displayNavigationAdmin(): void
{
    $home = uiEscape(appUrl('index.php'));
    $manager = uiEscape(appUrl('admin/manager.php'));
    $starters = uiEscape(appUrl('admin/manager-starter.php'));
    $mainCourses = uiEscape(appUrl('admin/manager-maincourse.php'));
    $desserts = uiEscape(appUrl('admin/manager-dessert.php'));
    $messages = uiEscape(appUrl('admin/manager-messages.php'));
    $reservations = uiEscape(appUrl('admin/manager-reservation.php'));
    $login = uiEscape(appUrl('admin/login.php'));
    $logout = uiEscape(appUrl('admin/admin-logoff.php'));

    echo '<nav class="navbar-admin"><div class="navbar-container container">';
    echo '<a class="navbar-brand" href="' . $home . '">Pistache</a>';
    echo '<div class="navbar-right"><div class="navbar-menu"><ul class="navbar-nav">';
    echo '<li class="nav-item"><a class="nav-link" href="' . $home . '"><i class="fas fa-home"></i><span> Home</span></a></li>';

    if (isAuthenticated()) {
        echo '<li class="nav-item"><a class="nav-link" href="' . $manager . '"><i class="fa-solid fa-layer-group"></i> Categories</a></li>';
        echo '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" onclick="toggleDropdown(event)"><i class="fa-solid fa-list"></i> Menu</a>';
        echo '<div class="dropdown-menu">';
        echo '<a class="dropdown-item" href="' . $starters . '">Starters</a>';
        echo '<a class="dropdown-item" href="' . $mainCourses . '">Main courses</a>';
        echo '<a class="dropdown-item" href="' . $desserts . '">Desserts</a>';
        echo '</div></li>';
        echo '<li class="nav-item"><a class="nav-link" href="' . $manager . '"><i class="fa-solid fa-square-plus"></i><span> Add</span></a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="' . $messages . '"><i class="fa-solid fa-envelope"></i><span> My messages</span></a></li>';
        echo '</ul>';
        echo '<a href="' . $reservations . '" class="btn-primary --reservation"><i class="fa-solid fa-bell-concierge"></i> Reservations</a>';
        echo '<a href="' . $logout . '" class="btn-primary"><i class="fa-solid fa-user"></i> Log off</a>';
    } else {
        echo '</ul>';
        echo '<a href="' . $login . '" class="btn-primary"><i class="fa-solid fa-user"></i> Login</a>';
    }

    echo '</div></div></div></nav>';

    if (isAuthenticated()) {
        echo '<div id="mySidenav" class="sidenav">';
        echo '<a href="javascript:void(0)" class="closebtn" onclick="closeNav()" aria-label="Close menu">&times;</a>';
        echo '<a class="nav-link" href="' . $home . '">Home</a>';
        echo '<a class="nav-link" href="' . $manager . '">Categories</a>';
        echo '<a class="nav-link" href="' . $starters . '">Starters</a>';
        echo '<a class="nav-link" href="' . $mainCourses . '">Main Courses</a>';
        echo '<a class="nav-link" href="' . $desserts . '">Desserts</a>';
        echo '<a class="nav-link" href="' . $messages . '">My messages</a>';
        echo '<a href="' . $reservations . '" class="btn-primary --reservation">Reservations</a>';
        echo '<a href="' . $logout . '" class="btn-primary">Log off</a>';
        echo '</div>';
        echo '<div class="navbar-hamburger"><button id="hamburger" type="button" onclick="openNav()" aria-label="Open menu"><i class="fas fa-bars"></i></button></div>';
    }
}

function displayNavigation(): void
{
    $home = uiEscape(appUrl('index.php'));
    $menu = uiEscape(appUrl('public/menu.php'));
    $contact = uiEscape(appUrl('public/contact.php'));
    $reservation = uiEscape(appUrl('public/reservation.php'));
    $login = uiEscape(appUrl('admin/login.php'));

    echo '<div class="header-top"><div class="header-top-container container">';
    echo '<div class="header-top-items"><div class="header-top-item"><i class="fas fa-phone"></i><span>+32 493 38 77 29</span></div></div>';
    echo '<div class="header-top-items"><div class="header-top-item"><i class="fas fa-paper-plane"></i><span>contact@pistache.be</span></div></div>';
    echo '<div class="header-top-items"><div class="header-top-item"><i class="fas fa-location-dot"></i><span>343 Rue Saint-Gilles, 4000 Liège</span></div></div>';
    echo '</div></div>';

    echo '<nav class="navbar"><div class="navbar-container container">';
    echo '<a class="navbar-brand" href="' . $home . '">Pistache</a>';
    echo '<div class="navbar-right"><div class="navbar-menu"><ul class="navbar-nav">';
    echo '<li class="nav-item"><a class="nav-link" href="' . $home . '">Home</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="' . $home . '#about">About</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="' . $menu . '">Menu</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="' . $contact . '">Contact</a></li>';
    echo '</ul>';
    echo '<a href="' . $reservation . '" class="btn-primary --reservation">Book a table</a>';
    echo '<a href="' . $login . '" class="btn-primary">Login</a>';
    echo '</div></div></div>';
    echo '<div class="navbar-hamburger"><button id="hamburger" type="button" onclick="openNav()" aria-label="Open menu"><i class="fas fa-bars"></i></button></div>';
    echo '</nav>';

    echo '<div id="mySidenav" class="sidenav">';
    echo '<a href="javascript:void(0)" class="closebtn" onclick="closeNav()" aria-label="Close menu">&times;</a>';
    echo '<a class="nav-link" href="' . $home . '">Home</a>';
    echo '<a class="nav-link" href="' . $home . '#about">About</a>';
    echo '<a class="nav-link" href="' . $menu . '">Menu</a>';
    echo '<a class="nav-link" href="' . $contact . '">Contact</a>';
    echo '<a href="' . $reservation . '" class="btn-primary">Book a table</a>';
    echo '</div>';
}

function displayNavigationArticle(): void
{
    displayNavigation();
}

function displayFooter(): void
{
    $home = uiEscape(appUrl('index.php'));
    $asset = static fn (string $name): string => uiEscape(appUrl('assets/images/' . $name));

    echo '<div class="upper-footer-container"><div class="upper-footer container">';
    echo '<div class="footer-left"><a class="footer-brand" href="' . $home . '">Pistache</a>';
    echo '<div class="footer-open-hours"><h3>Open Hours</h3><ul>';
    echo '<li>Monday<span>9:00 - 24:00</span></li><li>Tuesday<span>9:00 - 24:00</span></li><li>Wednesday<span>9:00 - 24:00</span></li><li>Thursday<span>9:00 - 24:00</span></li><li>Friday<span>9:00 - 02:00</span></li><li>Saturday<span>9:00 - 02:00</span></li><li>Sunday<span>9:00 - 02:00</span></li>';
    echo '</ul></div></div>';
    echo '<div class="footer-right"><div class="footer-instagram"><h3>Instagram</h3><div class="footer-instagram-container">';
    echo '<div class="footer-instagram-items"><img src="' . $asset('insta-1.jpg') . '" alt="Pistache Instagram"><img src="' . $asset('insta-2.jpg') . '" alt="Pistache Instagram"><img src="' . $asset('insta-3.jpg') . '" alt="Pistache Instagram"></div>';
    echo '<div class="footer-instagram-items"><img src="' . $asset('insta-4.jpg') . '" alt="Pistache Instagram"><img src="' . $asset('insta-5.jpg') . '" alt="Pistache Instagram"><img src="' . $asset('insta-6.jpg') . '" alt="Pistache Instagram"></div>';
    echo '</div></div>';
    echo '<div class="footer-follow-us"><h3>Follow Us</h3><div class="footer-social-icons"><p>Stay connected and follow us on social media for the latest updates, special offers, and a glimpse behind the scenes at Restaurant Pistache.</p>';
    echo '<div class="social-icons"><a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a><a href="https://twitter.com/" target="_blank" rel="noopener noreferrer" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a><a href="https://instagram.com/" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a></div>';
    echo '<p>343 Rue Saint-Gilles, 4000 Liège - Belgique</p></div></div></div></div></div>';
    echo '<div class="bottom-footer-container"><div class="bottom-footer container"><div>© ' . date('Y') . ' Copyright all rights reserved</div><div>Design and development by <a href="https://github.com/lejeunea" class="github text-decoration-none" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-github"></i></a> <a href="https://github.com/lejeunea" class="text-decoration-none" target="_blank" rel="noopener noreferrer">Açelya Lejeune</a>.</div></div></div>';
}

function getMessage($message, $type = 'success'): string
{
    $allowedTypes = ['success', 'error', 'info', 'warning'];
    if (!in_array($type, $allowedTypes, true)) {
        $type = 'info';
    }

    return '<div class="msg-' . uiEscape($type) . '">'
        . uiEscape($message)
        . '</div>';
}

function displayDishByID(array $dish, string $idKey): void
{
    $title = (string) ($dish['title'] ?? 'Dish');
    $description = (string) ($dish['description'] ?? '');
    $price = (float) ($dish['price'] ?? 0);
    $image = safeRestaurantImageUrl($dish['image_url'] ?? '');
    $content = sanitizeRichText($dish['content'] ?? '');

    echo '<section class="product-container container"><div class="product-info-container">';
    echo '<div class="product-img">';
    if ($image !== '') {
        echo '<img src="' . uiEscape($image) . '" alt="' . uiEscape($title) . '">';
    }
    echo '</div><div class="product-info"><div><h2>' . uiEscape($title) . '</h2><p>' . uiEscape($description) . '</p></div>';
    echo '<div class="product-price"><p>' . number_format($price, 2, '.', '') . ' €</p></div>';
    echo '<div class="product-description"><div>' . $content . '</div></div>';
    echo '</div></div></section>';
}

function displayStarterByID($starter): void
{
    displayDishByID((array) $starter, 'idStarter');
}

function displayMainCourseByID($mainCourse): void
{
    displayDishByID((array) $mainCourse, 'idMainCourse');
}

function displayDessertByID($dessert): void
{
    displayDishByID((array) $dessert, 'idDessert');
}

function displayReservationsAsTable($reservations): void
{
    echo '<table><thead><tr><th>ID</th><th>Customer Name</th><th>Email</th><th>Phone</th><th>Date</th><th>Time</th><th>Number of People</th><th>Created at</th><th>Status</th><th>Actions</th></tr></thead><tbody>';
    foreach ((array) $reservations as $reservation) {
        $id = (int) ($reservation['idReservation'] ?? 0);
        echo '<tr><td data-cell="id">' . $id . '</td>';
        echo '<td data-cell="customer name">' . uiEscape($reservation['name'] ?? '') . '</td>';
        echo '<td data-cell="email">' . uiEscape($reservation['email'] ?? '') . '</td>';
        echo '<td data-cell="phone">' . uiEscape($reservation['phone'] ?? '') . '</td>';
        echo '<td data-cell="date">' . uiEscape($reservation['book_date'] ?? '') . '</td>';
        echo '<td data-cell="time">' . uiEscape($reservation['book_time'] ?? '') . '</td>';
        echo '<td data-cell="number of people">' . (int) ($reservation['person'] ?? 0) . '</td>';
        echo '<td data-cell="created at">' . uiEscape($reservation['created_at'] ?? '') . '</td>';
        echo '<td data-cell="status">' . (!empty($reservation['active']) ? 'Active' : 'Inactive') . '</td>';
        echo '<td><button class="btn-secondary" onclick="modifyReservation(' . $id . ')">Modify</button><button class="btn-primary" onclick="deleteReservation(' . $id . ')">Delete</button></td></tr>';
    }
    echo '</tbody></table>';
}

function displayMessagesAsTable($messages): void
{
    echo '<table><thead><tr><th>Last Name</th><th>First Name</th><th>Email</th><th>Phone</th><th>Message</th><th>Actions</th></tr></thead><tbody>';
    foreach ((array) $messages as $message) {
        $id = (int) ($message['idContact'] ?? 0);
        echo '<tr><td data-cell="last name">' . uiEscape($message['lastname'] ?? '') . '</td>';
        echo '<td data-cell="first name">' . uiEscape($message['firstname'] ?? '') . '</td>';
        echo '<td data-cell="email">' . uiEscape($message['email'] ?? '') . '</td>';
        echo '<td data-cell="phone">' . uiEscape($message['phone'] ?? '') . '</td>';
        echo '<td data-cell="message">' . nl2br(uiEscape($message['message'] ?? '')) . '</td>';
        echo '<td><button class="btn-primary" onclick="deleteMessage(' . $id . ')">Delete</button></td></tr>';
    }
    echo '</tbody></table>';
}

function displayDishManagerTable(array $dishes, string $idKey, string $jsName): void
{
    echo '<table><thead><tr><th>ID</th><th>Title</th><th>Price</th><th>Description</th><th>Status</th><th>Actions</th></tr></thead><tbody>';
    foreach ($dishes as $dish) {
        $id = (int) ($dish[$idKey] ?? 0);
        echo '<tr><td data-cell="id">' . $id . '</td>';
        echo '<td data-cell="title">' . uiEscape(html_entity_decode((string) ($dish['title'] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8')) . '</td>';
        echo '<td data-cell="price">' . uiEscape($dish['price'] ?? '') . '</td>';
        echo '<td data-cell="description">' . uiEscape(html_entity_decode((string) ($dish['description'] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8')) . '</td>';
        echo '<td data-cell="status">' . (!empty($dish['active']) ? 'Active' : 'Inactive') . '</td>';
        echo '<td><button class="btn-secondary" onclick="modify' . $jsName . '(' . $id . ')">Modify</button><button class="btn-secondary" onclick="display' . $jsName . '(' . $id . ')">Display</button><button class="btn-primary" onclick="delete' . $jsName . '(' . $id . ')">Delete</button></td></tr>';
    }
    echo '</tbody></table>';
}

function displayStartersAsTable($starters): void
{
    displayDishManagerTable((array) $starters, 'idStarter', 'Starter');
}

function displayMainCoursesAsTable($mainCourses): void
{
    displayDishManagerTable((array) $mainCourses, 'idMainCourse', 'MainCourse');
}

function displayDessertsAsTable($desserts): void
{
    displayDishManagerTable((array) $desserts, 'idDessert', 'Dessert');
}

function renderDishMenu($execute, $results, string $idKey, string $singlePage, string $emptyMessage, int $limit = 160): string
{
    if (!$execute || !is_array($results) || empty($results)) {
        return '<p>' . uiEscape($emptyMessage) . '</p>';
    }

    $html = '';
    $delay = 0;
    $displayed = 0;

    foreach ($results as $dish) {
        if ($displayed >= $limit) {
            break;
        }

        if ($displayed % 2 === 0) {
            $html .= '<div class="menu-row" data-aos="fade-up" data-aos-delay="' . $delay . '">';
            $delay += 200;
        }

        $id = (int) ($dish[$idKey] ?? 0);
        $title = html_entity_decode((string) ($dish['title'] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $description = html_entity_decode((string) ($dish['description'] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $price = (float) ($dish['price'] ?? 0);
        $image = safeRestaurantImageUrl($dish['image_url'] ?? '');
        $url = appUrl('admin/' . $singlePage . '?' . $idKey . '=' . $id);

        $html .= '<div class="menu-item"><a class="menu-item-image" href="' . uiEscape($url) . '">';
        if ($image !== '') {
            $html .= '<img class="menu-item-image" src="' . uiEscape($image) . '" alt="' . uiEscape($title) . '">';
        }
        $html .= '</a><div class="menu-item-info"><a href="' . uiEscape($url) . '" class="menu-item-title-link"><h3 class="menu-item-title">' . uiEscape($title) . '</h3></a>';
        $html .= '<span class="menu-item-price">€' . number_format($price, 2) . '</span><p>' . uiEscape($description) . '</p></div></div>';

        $displayed++;
        if ($displayed % 2 === 0) {
            $html .= '</div>';
        }
    }

    if ($displayed % 2 !== 0) {
        $html .= '</div>';
    }

    return $html;
}

function displayStarters($execute, $resultStarters, $limit = 160): string
{
    return renderDishMenu($execute, $resultStarters, 'idStarter', 'single-starter.php', 'No starter available at the moment.', (int) $limit);
}

function displayMainCourses($execute, $resultMainCourses, $limit = 160): string
{
    return renderDishMenu($execute, $resultMainCourses, 'idMainCourse', 'single-maincourse.php', 'No main course available at the moment.', (int) $limit);
}

function displayDesserts($execute, $resultDesserts, $limit = 160): string
{
    return renderDishMenu($execute, $resultDesserts, 'idDessert', 'single-dessert.php', 'No dessert available at the moment.', (int) $limit);
}
