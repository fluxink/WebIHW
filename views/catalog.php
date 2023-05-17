<div class="center-align">
    <div class="grid large-space">
        <?php
        foreach ($items as $item) {
            echo '<div class="s12 m6 l4">';
            echo '<article class="no-padding">';
            echo '<a href="/item.php?id=' . $item['id'] . '">';
            $image = $item['image'] ? $item['image'] : 'no-image.png';
            echo '<img class="responsive" src="/assets/images/' . $image . '" alt="">';
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