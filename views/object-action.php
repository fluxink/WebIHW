<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location: /');
    die();
} else {
    if ($_SESSION['user']['role'] != 'admin') {
        header('Location: catalog.php');
        die();
    }
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['item'])) {
            $item_type = 'item';
        } else if (isset($_GET['category'])) {
            $item_type = 'category';
        }
        $action_type = isset($_GET['action']) ? $_GET['action'] : '';
        $data = $_GET;
        break;
    case 'POST':
        if (isset($_POST['item'])) {
            $item_type = 'item';
        } else if (isset($_POST['category'])) {
            $item_type = 'category';
        }
        $action_type = isset($_POST['action']) ? $_POST['action'] : '';
        $data = $_POST;
        break;
    default:
        die('Error!');
}
// ob_start();
switch ($item_type) {
    case 'item':
        require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/Item.php';
        $item = new Item();
        foreach ($data as $key => $value) {
            $item->$key = $value;
        }

        # Save image if set
        if (isset($_FILES['image'])) {
            $image = $_FILES['image'];
            $image_name = $image['name'];
            $image_tmp_name = $image['tmp_name'];
            $image_size = $image['size'];
            $image_error = $image['error'];
            $image_type = $image['type'];
            $image_ext = explode('.', $image_name);
            $image_actual_ext = strtolower(end($image_ext));
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($image_actual_ext, $allowed)) {
                if ($image_error === 0) {
                    if ($image_size < 1000000) {
                        $image_name_new = uniqid('', true) . '_' . $image_actual_ext;
                        $image_destination = $_SERVER["DOCUMENT_ROOT"] . '/assets/images/' . $image_name_new;
                        move_uploaded_file($image_tmp_name, $image_destination);
                        $item->image = $image_name_new;
                    } else {
                        echo 'Файл занадто великий!';
                    }
                } else {
                    echo 'Виникла помилка при завантаженні файлу!';
                }
            } else {
                echo 'Неприпустимий тип файлу!';
            }
        }
        
        $errors = $item->validate();
        if ($action_type == 'create' && empty($errors)) {
            $item->save();
            $message = 'Товар успішно додано';
        } else if ($action_type == 'update' && empty($errors)) {
            $item->update();
            $message = 'Товар успішно оновлено';
        } else if ($action_type == 'delete') {
            if (isset($data['id'])){
                $item->delete();
            } else if (isset($data['ids'])) {
                $item->deleteMany($data['ids']);
            }
            $message = 'Товар успішно видалено';
        } else if (empty($errors)) {
            $message = 'Невідома дія';
        } else if (!empty($errors)) {
            echo '<div class="alert">';
            foreach ($errors as $error) {
                echo '<p>' . $error . '</p>';
            }
            echo '</div>';
            die();
        }
        header('Location: /views/admin-panel.php?products&message=' . $message);
        break;
    case 'category':
        require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/Category.php';
        $category = new Category();
        foreach ($data as $key => $value) {
            $category->$key = $value;
        }
        if ($action_type == 'create') {
            $category->save();
            $message = 'Категорію успішно додано';
        } else if ($action_type == 'update') {
            $category->update();
            $message = 'Категорію успішно оновлено';
        } else if ($action_type == 'delete') {
            $category->delete();
            $message = 'Категорію успішно видалено';
        } else {
            $message = 'Невідома дія';
        }
        header('Location: /views/admin-panel.php?categories&message=' . $message);
        break;
}
// ob_end_flush();
