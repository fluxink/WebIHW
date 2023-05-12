<?php

require_once 'app/models/User.php';

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
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
