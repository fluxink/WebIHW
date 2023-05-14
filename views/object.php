<?php
    if (!isset($_SESSION)) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
    <link rel="stylesheet" href="<? echo 'http://127.0.0.1' . '/styles/style.css'?>">
    <title>Admin panel</title>
</head>
<body>
    <?php
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

        if (isset($_GET['item']) && isset($_GET['action'])) {
            require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/Item.php';
            require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/Category.php';
            if (isset($_GET['id'])) {
                $item = new Item();
                $category = new Category();
                if (!$item->getById($_GET['id'])) {
                    echo 'Item not found!';
                    exit();
                }
                $content = ['type'=>'item', 'action_type'=>$_GET['action'], 'values'=>$item, 'categories'=>$category->getAll()];
                echo template('object-form.php', ['content' => $content]);
            } else if ($_GET['action'] == 'create') {
                $item = new Item();
                $category = new Category();
                $item->emptyValues();
                $content = ['type'=>'item', 'action_type'=>$_GET['action'], 'values'=>$item, 'categories'=>$category->getAll()];
                echo template('object-form.php', ['content' => $content]);
            } else if ($_GET['action'] == 'update' && !isset($_GET['id'])) {
                echo 'Error you must specify id!';
            } else {
                echo 'Error!';
            }
        } else if (isset($_GET['category']) && isset($_GET['action'])) {
            require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/Category.php';
            if (isset($_GET['id'])) {
                $category = new Category();
                if (!$category->getById($_GET['id'])) {
                    echo 'Category not found!';
                    exit();
                }
                $content = ['type'=>'category', 'action_type'=>$_GET['action'], 'values'=>$category];
                echo template('object-form.php', ['content' => $content]);
            } else if ($_GET['action'] == 'create') {
                $category = new Category();
                $category->id = '';
                $category->name = '';
                $content = ['type'=>'category', 'action_type'=>$_GET['action'], 'values'=>$category];
                echo template('object-form.php', ['content' => $content]);
            } else {
                echo 'Error!';
            }
        } else {
            echo 'Error!';
        }
    ?>
</body>
</html>