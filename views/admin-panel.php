<?php if (!empty($message)) {
    echo '<div class="toast blue white-text top active" id="toast" onclick="toggleToast(this)">
            <i>info</i>
            <span>' . $message . '</span>
          </div>';
}
$url = $_SERVER['REQUEST_URI'];
$url = parse_url($url, PHP_URL_QUERY);
// Remove message parameter that can contain any value and encoding
if (isset($_GET['message']))
    $url = preg_replace('/&message=[^&]+/', '', $url);
$url = $_SERVER['PHP_SELF'] . '?' . $url;
?>
<div class="center-align">

    <div class="tabs">
        <a href="admin.php?users" class="<?php echo isset($_GET['users']) ? 'active' : ''; ?>">
            <i>people</i>
            <span>Користувачі</span>
        </a>
        <a href="admin.php?items" class="<?php echo isset($_GET['items']) ? 'active' : ''; ?>">
            <i>shopping_cart</i>
            <span>Товари</span>
        </a>
        <a href="admin.php?category" class="<?php echo isset($_GET['category']) ? 'active' : ''; ?>">
            <i>category</i>
            <span>Категорії</span>
        </a>
    </div>

    <article class="">
        <nav>
            <?php if (isset($_GET['items'])) { ?>
            <button class="square">
                <i>density_medium</i>
                <div class="dropdown no-wrap">
                    <a href="<?php
                                $url = preg_replace('/&limit=[0-9]+/', '', $url);
                                echo $url . '&limit=5';
                                ?>">5</a>
                    <a href="<?php
                                $url = preg_replace('/&limit=[0-9]+/', '', $url);
                                echo $url . '&limit=10';
                                ?>">10</a>
                    <a href="<?php
                                $url = preg_replace('/&limit=[0-9]+/', '', $url);
                                echo $url . '&limit=20';
                                ?>">20</a>
                </div>
                <div class="tooltip right">Кількість елементів</div>
            </button>
            <?php } ?>
            <div class="max"></div>
            <?php if (isset($_GET['items']) || isset($_GET['category'])) { ?>
                <button class="square" id="delete">
                    <i>delete</i>
                    <div class="tooltip">Видалити</div>
                </button>
                <a class="button square" href="object.php?<?php echo $table_name; ?>">
                    <i>add</i>
                    <div class="tooltip">Додати</div>
                </a>
            <?php } ?>
        </nav>
        <div class="medium-space"></div>
        <?php
        if ($table_name) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/table.php';
            if (empty($data)) {
                header("Location: " . preg_replace('/&page=[0-9]+/', '', $_SERVER['REQUEST_URI']));
                die();
            }
            drawTable($data, $table_name);
            if ($num_pages > 1) {
                require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/pagination.php';
                echo '<div class="medium-space"></div>';
                drawPagination($url, $page, $limit, $num_pages);
            }
        } else {
        ?>
            <div class="large-space"></div>
            <h3 class="bold page active top">Виберіть таблицю</h3>
            <div class="large-space"></div>
        <?php } ?>
        <div class="medium-space"></div>
    </article>
</div>
<script src="js/select-utils.js"></script>