<?php

require_once 'app/models/User.php';

$_POST = json_decode(file_get_contents('php://input'), true);

if ((isset($_POST['email']) && isset($_POST['password'])) || (isset($_GET['email']) && isset($_GET['password']))) {
    $user = new User();
    $user->email = $_POST['email'] ?? $_GET['email'];
    $user->password = $_POST['password'] ?? $_GET['password'];
    if ($user->login()) {
        header('Location: /');
    } else {
        $data['errors'] = 'Некоректні дані';
        http_response_code(422);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
