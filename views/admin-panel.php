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
<html lang="uk-ua">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/beercss@3.1.3/dist/cdn/beer.min.css" rel="stylesheet">
    <script type="module" src="https://cdn.jsdelivr.net/npm/beercss@3.1.3/dist/cdn/beer.min.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/material-dynamic-colors@0.1.7/dist/cdn/material-dynamic-colors.min.js"></script>
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
    <header>
        <nav>
            <a href="#"><h5 class="">Stick Shop</h5></a>
            <h5 class="max center-align">Admin panel</h5>
            <a href="/profile.php">
                <i class="extra primary-text">account_circle</i>
            </a>
            <?php
            if (isset($_SESSION['user'])) {
                echo '<a href="logout.php">
                        <button>
                            Вийти
                        </button>
                      </a>';
            } else {
                echo '<button data-target="modal-login" onclick="toggleModal(event)">
                                    Вхід
                                </button>';
            }
            ?>
        </nav>
    </header>
    <div class="container-flex">
        <aside style="max-width: fit-content;">
            <article>
                <ul>
                    <li><a href="admin-panel.php?users">Користувачі</a></li>
                    <li><a href="admin-panel.php?item">Товари</a></li>
                    <li><a href="admin-panel.php?categories">Категорії</a></li>
                </ul>
            </article>
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
        </aside>
        <main class="container">
            <article class="objects-table">

                <?php
                if (isset($_GET['users'])) {
                    require $_SERVER["DOCUMENT_ROOT"] . '/app/models/User.php';
                    $user = new User();
                    $users = $user->getAll();
                    drawTable($users, 'user');
                } else if (isset($_GET['item'])) {
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
                    echo '<table class="border">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>
                            <label class="checkbox">
                                <input type="checkbox" onclick="toggle(this)">
                                <span></span>
                                <div class="tooltip">Вибрати все</div>
                            </label>
                          </th>';
                    foreach ($data->fetch_fields() as $key) {
                        echo '<th>' . $key->name . '</th>';
                    }
                    echo '<th>Дії</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    foreach ($data as $row) {
                        echo '<tr>';
                        echo '<td>
                                <label class="checkbox">
                                    <input type="checkbox" name="select" value="' . $row['id'] . '">
                                    <span></span>
                                </label>
                              </td>';
                        foreach ($row as $key => $value) {
                            echo '<td>' . $value . '</td>';
                        }
                        echo '<td><nav class="right-aling">
                            <a href="object.php?' . $data_type . '&action=update&id=' . $row['id'] . '">
                                <i>edit</i>
                                <div class="tooltip">Редагувати</div>
                            </a>
                            <a href="object-action.php?' . $data_type . '&action=delete&id=' . $row['id'] . '">
                                <i>delete</i>
                                <div class="tooltip">Видалити</div>
                            </a>
                            </nav></td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                    echo '</figure>';
                    if ($pages) {
                        $pages_to_show = 5;
                        $url = $_SERVER['REQUEST_URI'];
                        $url = preg_replace('/&p=\d+/', '', $url);
                        echo '<div class="pagination">';
                        if ($current_page > 1) {
                            echo '<a href="' . $url . '&p=1">First</a>';
                            echo '<a href="' . $url . '&p=' . ($current_page - 1) . '">Prev</a>';
                        }
                        $start_page = max(1, $current_page - floor($pages_to_show / 2));
                        $end_page = min($num_pages, $start_page + $pages_to_show - 1);
                        for ($i = $start_page; $i <= $end_page; $i++) {
                            if ($i == $current_page) {
                                echo '<a class="active">' . $i . '</a>';
                            } else {
                                echo '<a href="' . $url . '&p=' . $i . '">' . $i . '</a>';
                            }
                        }
                        if ($current_page < $num_pages) {
                            echo '<a href="' . $url . '&p=' . ($current_page + 1) . '">Next</a>';
                            echo '<a href="' . $url . '&p=' . $num_pages . '">Last</a>';
                        }
                        echo '</div>';
                    }
                }
                ?>
            </article>
        </main>

    </div>
</body>

</html>