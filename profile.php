<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /');
    die();
}

echo '<pre>';
var_dump($_SESSION['user']);
echo '</pre>';
