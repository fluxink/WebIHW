<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    die();
} else {
    if ($_SESSION['user']['role'] != 'admin') {
        header('Location: catalog.php');
        die();
    }
}

if (isset($_GET['panel'])) {
    $panel = $_GET['panel'];
} else {
    $panel = 'dashboard';
}

switch ($panel) {
    case 'dashboard':
        require 'app/views/admin-panel/dashboard.php';
        break;
    case 'items':
        require 'app/models/Item.php';
        $item = new Item();
        $page = isset($_GET['p']) ? $_GET['p'] : 1;
        $limit = isset($_GET['l']) ? $_GET['l'] : 5;
        $items = $item->getPage($page, $limit);
        require 'app/views/admin-panel/items.php';
        break;
    case 'categories':
        require 'app/models/Category.php';
        $category = new Category();
        $categories = $category->getAll();
        require 'app/views/admin-panel/categories.php';
        break;
    case 'users':
        require 'app/models/User.php';
        $user = new User();
        $users = $user->getAll();
        require 'app/views/admin-panel/users.php';
        break;
    default:
        require 'app/views/admin-panel/dashboard.php';
        break;
}

