<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location: /');
    die();
} else if ($_SESSION['user']['role'] != 'admin') {
    header('Location: catalog.php');
    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    require_once $_SERVER["DOCUMENT_ROOT"] . '/utils/template.php';
    $data = [];

    if (isset($_GET['items'])) {
        if (isset($_GET['id'])) {
            require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/Item.php';
            $item = new Item();
            if ($item->getById($_GET['id'])) {
                $data = (array) $item;
            }
        }
        require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/Category.php';
        $category = new Category();
        $categories = $category->getAll();
        $form = template('views/item-form.php', ['data' => $data, 'categories' => $categories]);
    } else if (isset($_GET['category'])) {
        if (isset($_GET['id'])) {
            require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/Category.php';
            $category = new Category();
            if ($category->getById($_GET['id'])) {
                $data = (array) $category;
            }
        }
        $form = template('views/category-form.php', ['data' => $data]);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = '';
    if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/Item.php';
        $item = new Item();
        $json = json_decode(file_get_contents('php://input'), true);
        if ($json['action'] == 'delete') {
            $delted_ids = '';
            foreach ($json['ids'] as $id) {
                if ($item->getById($id)) {
                    $item->delete();
                    $delted_ids .= "$id,";
                }
                $message = "Товар №($delted_ids) успішно видалено";
            }
        } else {
            $message = 'Невідома дія';
        }
        header("Content-Type: application/json");
    } else if (isset($_GET['items'])) {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/Item.php';
        $item = new Item();
        if (!empty($_POST['id'])) {
            if ($item->getById($_POST['id'])) {
                $old_image = $item->image;
                $item = extractItemFromPost($_POST);
                $item = saveImage($item);
                if (empty($item->image)) {
                    $item->image = $old_image;
                }
                if (!empty($message)) {
                    header("Location: /object.php?items&id=$item->id&message=$message");
                    die();
                }
                $item->update();
                $message = 'Товар успішно відредаговано';
            } else {
                $message = 'Помилка при редагуванні товару';
            }
        } else {
            $item = extractItemFromPost($_POST);
            $item = saveImage($item);
            if (empty($item->image)) {
                $item->image = 'no-image.png';
            }
            $item->save();
            $message = 'Товар успішно додано';
        }
    } else if (isset($_GET['category'])) {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/Category.php';
        $category = new Category();
        if (isset($_POST['id'])) {
            if ($category->getById($_POST['id'])) {
                $category->name = $_POST['name'];
                $category->update();
                $message = 'Категорію успішно відредаговано';
            } else {
                $message = 'Помилка при редагуванні категорії';
            }
        } else {
            extractCategoryFromPost($_POST)->save();
            $message = 'Категорію успішно додано';
        }
    }
    header("Location: /admin.php?" . parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY) . "&message=$message");
    die();
}

function saveImage(Item $item) {
    if (isset($_FILES['image'])) {
        $image = $_FILES['image'];
        $image_name = $image['name'];
        $image_tmp_name = $image['tmp_name'];
        $image_size = $image['size'];
        $image_error = $image['error'];
        $image_ext = explode('.', $image_name);
        $image_actual_ext = strtolower(end($image_ext));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($image_actual_ext, $allowed)) {
            if ($image_error === 0) {
                if ($image_size < 1000000) {
                    $image_name_new = uniqid('', true) . '.' . $image_actual_ext;
                    $image_destination = $_SERVER["DOCUMENT_ROOT"] . '/assets/images/' . $image_name_new;
                    move_uploaded_file($image_tmp_name, $image_destination);
                    $item->image = $image_name_new;
                } else {
                    echo 'Файл занадто великий!';
                    die();
                }
            } else {
                echo 'Виникла помилка при завантаженні файлу!';
                die();
            }
        } else {
            echo 'Неприпустимий тип файлу!';
            die();
        }
    }
    return $item;
}

echo template('views/layout.php', ['content' => $form ?? '']);
