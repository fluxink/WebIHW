<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location: /login.php');
    die();
}

if (!isset($_GET['id'])) {
    header('Location: /catalog.php');
    die();
}

require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/Item.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/utils/template.php';

$item = new Item();

if ($item->getById($_GET['id'])) {
    $content = template('views/item-page.php', ['item' => $item]);
} else {
    http_response_code(404);
    die();
}

echo template('views/layout.php', ['content' => $content, 'category' => $item->category_id]);