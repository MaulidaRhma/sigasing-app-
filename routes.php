<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case '':
        case 'lokasiread':
            file_exists('pages/admin/lokasiread.php') ? include 'pages/admin/lokasiread.php' : include "pages/404.php";
            break;
        default:
            include "pages/404.php";
    }
} else {
    include "pages/home.php";
}