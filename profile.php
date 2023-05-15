<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location: /');
    die();
}

require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/User.php';

$user = new User();
$user->email = $_SESSION['user']['email'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/template.php';

$content = template('views/profile.php', ['content' => $user->getByEmail()]);

echo template('views/layout.php', ['content' => $content]);
