<?php
if (isset($_SESSION['user'])) {
    header('Location: /');
    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'app/models/User.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    $user = new User();

    if ($password != $password_confirm) {
        $error_pass = 'Паролі не співпадають';
    } elseif (strlen($password) < 6) {
        $error_pass = 'Пароль має бути не менше 6 символів';
    } else {
        $user->email = $email;
        $user->password = $password;

        if ($user->register()) {
            $_SESSION['user'] = $user->getByEmail();
            header('Location: /');
            die();
        } else {
            $error_email = 'Користувач з таким email вже існує';
        }
    }
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/template.php';

$content = template('views/registration.php', ['error_pass' => $error_pass ?? '', 'email' => $email ?? '', 'error_email' => $error_email ?? '']);

echo template('views/layout.php', ['content' => $content]);
