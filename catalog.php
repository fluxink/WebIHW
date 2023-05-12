<?php

require 'app/models/Item.php';

$page = isset($_GET['p']) ? $_GET['p'] : 1;
$limit = 5;

$item = new Item();

$items = $item->getPage($page, $limit);

echo '<table border="1">';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Name</th>';
echo '<th>Description</th>';
echo '<th>Price</th>';
echo '<th>Image</th>';
echo '<th>Category</th>';
echo '</tr>';

foreach ($items as $item) {
    echo '<tr>';
    echo '<td>' . $item['id'] . '</td>';
    echo '<td>' . $item['name'] . '</td>';
    echo '<td>' . $item['description'] . '</td>';
    echo '<td>' . $item['price'] . '</td>';
    echo '<td>' . $item['image'] . '</td>';
    echo '<td>' . $item['category_name'] . '</td>';
    echo '</tr>';
}
