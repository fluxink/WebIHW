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
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
    <link rel="stylesheet" href="<? echo 'http://127.0.0.1' . '/styles/style.css' ?>">
    <title>Admin panel</title>
</head>
<script language="JavaScript">
    function toggle(source) {
        checkboxes = document.getElementsByName('select');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>

<body>
    <?php
    if (isset($_GET['message'])) {
        echo '<div class="container-fluid"><div class="alert">' . htmlspecialchars($_GET['message']) . '</div>';
    }
    ?>
    <nav class="container-fluid">
        <ul>
            <li><a href="#"><strong>Stick Shop</strong></a></li>
        </ul>
        <ul>
            <li><strong>Admin panel</strong></li>
        </ul>
        <ul>
            <li>
                <a href="profile.php">
                    <svg width="1.5rem" height="1.5rem" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.12 12.78C12.05 12.77 11.96 12.77 11.88 12.78C10.12 12.72 8.71997 11.28 8.71997 9.50998C8.71997 7.69998 10.18 6.22998 12 6.22998C13.81 6.22998 15.28 7.69998 15.28 9.50998C15.27 11.28 13.88 12.72 12.12 12.78Z" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M18.74 19.3801C16.96 21.0101 14.6 22.0001 12 22.0001C9.40001 22.0001 7.04001 21.0101 5.26001 19.3801C5.36001 18.4401 5.96001 17.5201 7.03001 16.8001C9.77001 14.9801 14.25 14.9801 16.97 16.8001C18.04 17.5201 18.64 18.4401 18.74 19.3801Z" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </li>
            <li>
                <?php
                if (isset($_SESSION['user'])) {
                    echo '<a href="logout.php">Вийти</a>';
                } else {
                    echo '<button data-target="modal-login" onclick="toggleModal(event)">
                                Вхід
                            </button>';
                }
                ?>
            </li>
        </ul>
    </nav>
    <div class="container-flex">
        <aside style="max-width: fit-content;">
            <article>
                <ul>
                    <li><a href="admin-panel.php?users">Користувачі</a></li>
                    <li><a href="admin-panel.php?products">Товари</a></li>
                    <li><a href="admin-panel.php?categories">Категорії</a></li>
                </ul>
            </article>

        </aside>
        <main class="container">
            <article>

                <?php
                if (isset($_GET['users'])) {
                    require $_SERVER["DOCUMENT_ROOT"] . '/app/models/User.php';
                    $user = new User();
                    $users = $user->getAll();
                    drawTable($users, 'user');
                } else if (isset($_GET['products'])) {
                    require $_SERVER["DOCUMENT_ROOT"] . '/app/models/Item.php';
                    $item = new Item();
                    $page = isset($_GET['p']) ? $_GET['p'] : 1;
                    $limit = isset($_GET['l']) ? $_GET['l'] : 10;
                    $items = $item->getPage($page, $limit);
                    drawTable($items, 'item', true, $page, $limit, $item->getNumPages($limit));
                } else if (isset($_GET['categories'])) {
                    require $_SERVER["DOCUMENT_ROOT"] . '/app/models/Category.php';
                    $category = new Category();
                    $categories = $category->getAll();
                    drawTable($categories, 'category');
                } else {
                    echo '<h1>Виберіть таблицю</h1>';
                }

                function drawTable($data, $data_type, $pages = false, $current_page = 1, $limit = 5, $num_pages = 1)
                {
                    echo '<figure>';
                    echo '<table role="grid">';
                    echo '<thead>';
                    echo '<tr>';
                    foreach ($data->fetch_fields() as $key) {
                        echo '<th>' . $key->name . '</th>';
                    }
                    echo '<th><input type="checkbox" onclick="toggle(this)"></th>';
                    echo '<th>Дії</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    foreach ($data as $row) {
                        echo '<tr>';
                        foreach ($row as $key => $value) {
                            echo '<td>' . $value . '</td>';
                        }
                        echo '<td><input type="checkbox" name="select" value="' . $row['id'] . '"></td>';
                        echo '<td><a href="object.php?' . $data_type . '&action=update&id=' . $row['id'] . '">Редагувати</a>|
                        <a href="object-action.php?' . $data_type . '&action=delete&id=' . $row['id'] . '">Видалити</a></td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                    echo '</figure>';
                    if ($pages) {
                        echo '<footer>';
                        echo '<div class="pagination">';
                        echo '<a href="admin-panel.php?products&p=' . ($current_page - 1) . '&l=' . $limit . '">&laquo;</a>';
                        for ($i = 1; $i <= $num_pages; $i++) {
                            if ($i == $current_page) {
                                echo '<a class="active" href="admin-panel.php?products&p=' . $i . '&l=' . $limit . '">' . $i . '</a>';
                                continue;
                            }
                            echo '<a href="admin-panel.php?products&p=' . $i . '&l=' . $limit . '">' . $i . '</a>';
                        }
                        echo '<a href="admin-panel.php?products&p=' . ($current_page + 1) . '&l=' . $limit . '">&raquo;</a>';
                        echo '</div>';
                        echo '</footer>';
                    }
                }
                ?>
            </article>
        </main>
        <article>
            <ul>
                <li>
                    <a href="">Видалити</a>
                </li>
                <li>
                    <a href="object.php?item&action=create">Додати</a>
                </li>
                <li>
                    <a href="object.php?item&action=update">Редагувати</a>
                </li>
            </ul>
            <ul>
                <li>Кількість елементів</li>
                <li><a href="
                    <?php
                    $url = $_SERVER['REQUEST_URI'];
                    // Replace or add param
                    $url = preg_replace('/&l=[0-9]+/', '', $url);
                    $url = $url . '&l=5';
                    echo $url;
                    ?>
                    ">5</a></li>
                <li><a href="
                    <?php
                    $url = $_SERVER['REQUEST_URI'];
                    $url = preg_replace('/&l=[0-9]+/', '', $url);
                    $url = $url . '&l=10';
                    echo $url;
                    ?>
                    ">10</a></li>
            </ul>
        </article>
    </div>
</body>

</html>