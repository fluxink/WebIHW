<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location: /');
    die();
}

require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    foreach ($_POST as $key => $value) {
        $user->$key = $value;
    }
    $errors = $user->validate();
    if (empty($errors)) {
        if ($user->update()) {
            $_SESSION['user'] = $user->getByEmail();
        }
        header('Location: /profile.php');
        
    } else {
        $data['errors'] = $errors;
        http_response_code(422);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
$user = new User();
$user->email = $_SESSION['user']['email'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/template.php';

$content = template('views/profile.php', ['content' => $user->getByEmail()]);

echo template('views/layout.php', ['content' => $content]);
