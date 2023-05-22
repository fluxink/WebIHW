<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location: /');
    die();
} else if ($_SESSION['user']['role'] != 'admin') {
    header('Location: catalog.php');
    die();
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;

if (isset($_GET['items'])) {
    require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/Item.php';
    $table_name = 'items';
    $item = new Item();
    $data = $item->getPage($page, $limit, 'id');
    $num_pages = $item->getNumPages($limit);
} elseif (isset($_GET['users'])) {
    require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/User.php';
    $table_name = 'users';
    $user = new User();
    $data = $user->getAll();
} elseif (isset($_GET['category'])) {
    require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/Category.php';
    $table_name = 'category';
    $category = new Category();
    $data = $category->getAll();
} else {
    $table_name = '';
    $data = [];
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/template.php';

$content = template(
    'views/admin-panel.php',
    [
        'message' => $_GET['message'] ?? '',
        'data' => $data,
        'table_name' => $table_name,
        'page' => $page,
        'limit' => $limit,
        'num_pages' => $num_pages ?? 1
    ]
);

echo template('views/layout.php', ['content' => $content]);
