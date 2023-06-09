<?php
function drawPagination($url, $page, $limit, $num_pages, $category = false, $pages_to_show = 5)
{
    $url = preg_replace('/[&?]page=\d+/', '', $url);
    $url = preg_replace('/[&?]limit=\d+/', '', $url);
    if (strpos($url, '?') === false) {
        $url .= '?';
    } else {
        $url .= '&';
    }
    echo '<div class="s12">';
    if ($page > 1) {
        echo '<a href="' . $url . 'page=1' . '&limit=' . $limit . '">
                    <button class="small no-margin responsive square fill">
                        <i>first_page</i>
                    </button>
                  </a>';
        echo '<a href="' . $url . 'page=' . ($page - 1) . '&limit=' . $limit . '">
                    <button class="small no-margin responsive square fill">
                        <i>navigate_before</i>
                    </button>
                  </a>';
    }
    $start_page = max(1, $page - floor($pages_to_show / 2));
    $end_page = min($num_pages, $start_page + $pages_to_show - 1);
    for ($i = $start_page; $i <= $end_page; $i++) {
        if ($i == $page) {
            echo '<a class="active"> 
                        <button class="small no-margin responsive square secondary">' . $i . '</button>
                      </a>';
        } else {
            echo '<a href="' . $url . 'page=' . $i . '&limit=' . $limit . '">
                        <button class="small no-margin responsive square">' . $i . '</button>
                      </a>';
        }
    }
    if ($page < $num_pages) {
        echo '<a href="' . $url . 'page=' . ($page + 1) . '&limit=' . $limit . '">
                    <button class="small no-margin responsive square fill">
                        <i>navigate_next</i>
                    </button>
                  </a>';
        echo '<a href="' . $url . 'page=' . $num_pages . '&limit=' . $limit . '"> 
                    <button class="small no-margin responsive square fill">
                        <i>last_page</i>
                    </button>
                  </a>';
    }
    echo '</div>';
}
