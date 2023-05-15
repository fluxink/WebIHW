<nav class="m l left">
    <a href="/catalog.php">
        <img class="circle" src="assets/logo.png">
    </a>
    <a href="?category=1" class="<?php echo $category == 1 ? 'active' : ''; ?>">
        <i>bed</i>
        <span>Спальня</span>
    </a>
    <a href="?category=2" class="<?php echo $category == 2 ? 'active' : ''; ?>">
        <i>chair</i>
        <span>Вітальня</span>
    </a>
    <a href="?category=3" class="<?php echo $category == 3 ? 'active' : ''; ?>">
        <i>kitchen</i>
        <span>Кухня</span>
    </a>
    <a href="?category=4" class="<?php echo $category == 4 ? 'active' : ''; ?>">
        <i>bathtub</i>
        <span>Ванна кімната</span>
    </a>
    <a href="?category=5" class="<?php echo $category == 5 ? 'active' : ''; ?>">
        <i>crib</i>
        <span>Дитяча кімната</span>
    </a>
    <a href="?category=6" class="<?php echo $category == 6 ? 'active' : ''; ?>">
        <i>apartment</i>
        <span>Офіс</span>
    </a>
    <a href="?category=7" class="<?php echo $category == 7 ? 'active' : ''; ?>">
        <i>more_horiz</i>
        <span>Інше</span>
    </a>
</nav>
<div class="center-align">
    <div class="grid large-space">
        <?php
        foreach ($items as $item) {
            echo '<div class="s12 m6 l4">';
            echo '<article class="no-padding">';
            echo '<a href="/item.php?id=' . $item['id'] . '">';
            // $image = $item['image'] ? $item['image'] : 'no-image.png';
            $image = 'no-image.png';
            echo '<img class="responsive" src="/assets/' . $image . '" alt="">';
            echo '<div class="absolute bottom left right padding bottom-shadow white-text">';
            echo '<div class="padding left-align">';
            echo '<h5>' . $item['name'] . '</h5>';
            echo '<p>' . $item['description'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</article>';
            echo '</div>';
        }
        include_once $_SERVER["DOCUMENT_ROOT"] . '/utils/pagination.php';
        drawPagination($_SERVER['REQUEST_URI'], $page, $limit, $num_pages);
        ?>
    </div>
</div>