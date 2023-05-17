<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location: /login.php');
    die();
}

require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/Item.php';

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 6;
$category = isset($_GET['category']) ? $_GET['category'] : false;

$item = new Item();

if ($category) {
    $items = $item->getByCategory($category, $page, $limit);
    $num_pages = $item->getNumPages($limit, $category);
} else {
    $items = $item->getPage($page, $limit);
    $num_pages = $item->getNumPages($limit);
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/template.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Category.php';

$category_obj = new Category();

$content = template('views/catalog.php', ['items' => $items, 'num_pages'=>$num_pages, 'page' => $page, 'limit' => $limit, 'category' => $category]);

echo template('views/layout.php', ['content' => $content, 'category' => $category, 'categories' => $category_obj->getAll()]);
