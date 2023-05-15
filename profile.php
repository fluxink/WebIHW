<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user'])) {
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

$content = template('views/profile.php', ['content' => $_SESSION['user']]);

echo template('views/layout.php', ['content' => $content]);
