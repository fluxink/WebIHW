<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location: /login.php');
    die();
}

require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/Item.php';

$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$limit = !empty($_GET['limit']) ? $_GET['limit'] : 6;
$category = !empty($_GET['category']) ? $_GET['category'] : false;
$sort = !empty($_GET['sort']) ? $_GET['sort'] : 'id';
$asc = isset($_GET['asc']) ? $_GET['asc'] : true;

$item = new Item();

try {
    if ($category) {
        $items = $item->getPage($page, $limit, $sort, $asc, $category);
        $num_pages = $item->getNumPages($limit, $category);
    } else {
        $items = $item->getPage($page, $limit, $sort, $asc);
        $num_pages = $item->getNumPages($limit);
    }
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}


require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/template.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Category.php';

$category_obj = new Category();

$content = template('views/catalog.php', ['items' => $items, 'num_pages'=>$num_pages, 'page' => $page, 'limit' => $limit, 'category' => $category]);

echo template('views/layout.php', ['content' => $content, 'category' => $category, 'categories' => $category_obj->getAll()]);
