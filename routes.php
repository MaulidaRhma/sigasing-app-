<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case '':
        case 'home':
            file_exists('page/home.php') ? include 'page/home.php' : include "pages/404.php";
            break;
        default:
            include "pages/404.php";
    }
} else {
    include "pages/home.php";
}