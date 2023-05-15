<?php
session_start();

require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/template.php';

$content = template('views/home.php', []);

echo template('views/layout.php', ['content' => $content]);