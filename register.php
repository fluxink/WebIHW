<?php

require_once 'app/models/User.php';

$_POST = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    foreach ($_POST as $key => $value) {
        $user->$key = $value;
    }
    $errors = $user->validate();
    if (empty($errors)) {
        $user->register();
        $url = '/login.php' . '?email=' . $user->email . '&password=' . $user->password;
        header('Location: ' . $url);
    } else {
        $data['errors'] = $errors;
        http_response_code(422);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
