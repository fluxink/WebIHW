<?php

if (isset($_SESSION['user'])) {
    header('Location: /');
    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'app/models/User.php';
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User();
    $user->email = $email;
    $user->password = $password;

    if ($user->login()) {
        $_SESSION['user'] = $user->getByEmail();
        header('Location: /');
        die();
    } else {
        $error = 'Невірний логін або пароль';
    }
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/template.php';

$content = template('views/login.php', ['error' => $error ?? '', 'email' => $email ?? '', 'password' => $password ?? '']);

echo template('views/layout.php', ['content' => $content]);
