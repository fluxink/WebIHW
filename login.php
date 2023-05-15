<?php

if (isset($_SESSION['user'])) {
    header('Location: /');
    die();
}
function template()
{
    extract(func_get_arg(1));

    ob_start();

    if (file_exists(func_get_arg(0))) {
        require func_get_arg(0);
    } else {
        echo 'Template not found!';
    }

    return ob_get_clean();
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

$content = template('views/login.php', ['error' => $error ?? '', 'email' => $email ?? '', 'password' => $password ?? '']);

echo template('views/layout.php', ['content' => $content]);
