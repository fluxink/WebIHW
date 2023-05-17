<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/beercss@3.1.3/dist/cdn/beer.min.css" rel="stylesheet">
    <script type="module" src="https://cdn.jsdelivr.net/npm/beercss@3.1.3/dist/cdn/beer.min.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/material-dynamic-colors@0.1.7/dist/cdn/material-dynamic-colors.min.js"></script>
    <script src="/js/home.js"></script>
    <link rel="stylesheet" href="styles/style.css">
    <title>Stick Shop</title>
</head>

<body>
    <!-- Draw nav bar if user on catalog.php page -->
    <?php
    if ((strpos($_SERVER['REQUEST_URI'], 'catalog.php') !== false) || (strpos($_SERVER['REQUEST_URI'], 'item.php') !== false)) {
        $bedroom_id = '';
        $living_room_id = '';
        $kitchen_id = '';
        $bathroom_id = '';
        $kids_room_id = '';
        $office_id = '';
        $other_id = '';
        foreach ($categories as $category_db) {
            switch ($category_db['name']) {
                case 'Спальня':
                    $bedroom_id = $category_db['id'];
                    break;
                case 'Вітальня':
                    $living_room_id = $category_db['id'];
                    break;
                case 'Кухня':
                    $kitchen_id = $category_db['id'];
                    break;
                case 'Ванна кімната':
                    $bathroom_id = $category_db['id'];
                    break;
                case 'Дитяча кімната':
                    $kids_room_id = $category_db['id'];
                    break;
                case 'Офіс':
                    $office_id = $category_db['id'];
                    break;
                case 'Інше':
                    $other_id = $category_db['id'];
                    break;
            }
        }
        ?>
        <nav class="m l left">
            <a class="no-padding" href="/catalog.php">
                <img class="round large" src="assets/logo.png">
            </a>
            <a href="/catalog.php" class="<?php echo empty($category) ? 'active' : ''; ?>">
                <i>apps</i>
                <span>Все</span>
            </a>
            <a href="?category=<?php echo $bedroom_id ?>" class="<?php echo $category == $bedroom_id ? 'active' : ''; ?>">
                <i>bed</i>
                <span>Спальня</span>
            </a>
            <a href="?category=<?php echo $living_room_id ?>" class="<?php echo $category == $living_room_id ? 'active' : ''; ?>">
                <i>chair</i>
                <span>Вітальня</span>
            </a>
            <a href="?category=<?php echo $kitchen_id ?>" class="<?php echo $category == $kitchen_id ? 'active' : ''; ?>">
                <i>kitchen</i>
                <span>Кухня</span>
            </a>
            <a href="?category=<?php echo $bathroom_id ?>" class="<?php echo $category == $bathroom_id ? 'active' : ''; ?>">
                <i>bathtub</i>
                <span>Ванна кімната</span>
            </a>
            <a href="?category=<?php echo $kids_room_id ?>" class="<?php echo $category == $kids_room_id ? 'active' : ''; ?>">
                <i>crib</i>
                <span>Дитяча кімната</span>
            </a>
            <a href="?category=<?php echo $office_id ?>" class="<?php echo $category == $office_id ? 'active' : ''; ?>">
                <i>apartment</i>
                <span>Офіс</span>
            </a>
            <a href="?category=<?php echo $other_id ?>" class="<?php echo $category == $other_id ? 'active' : ''; ?>">
                <i>more_horiz</i>
                <span>Інше</span>
            </a>
        </nav>
    <?php
    }
    ?>

    <header class="fixed" style="z-index: 110;">
        <nav class="">
            <a class=" left-align" href="/"><img class="round large" src="assets/logo.png"></a>
            <div class=""><a href="/">
                    <h4 class="bold">Stick Shop</h4>
                </a></div>
            <div class="max"></div>
            
            <?php
            if (isset($_SESSION['user'])) {
                echo '<a class=" right-align" href="/profile.php">
                        <i class="extra primary-text">account_circle</i>
                      </a>';
                echo '<a class="" href="logout.php">
                        <button>
                            Вийти
                        </button>
                      </a>';
            } else {
                echo '<a class="" href="login.php">
                        <button>
                            Вхід
                        </button>
                      </a>';
            }
            ?>
        </nav>
    </header>
    <main class="responsive max">
        <?php if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == '/') : ?>
            <article class="no-elevate round no-padding large page bottom active slideshow">
                <div class="home-z absolute middle center center-align white-text shadow padding">
                    <h2 class="center-align">Зануртеся у світ меблів та дизайну</h2>
                    <div class="space"></div>
                    <nav class="center-align"><a class="round extra button fill" href="/catalog.php">Get started</a></nav>
                </div>
                <img class="responsive" src="/assets/home1.jpg">
                <img class="responsive" src="/assets/home2.jpg">
                <img class="responsive" src="/assets/home3.jpg">
                <img class="responsive" src="/assets/home4.jpg">
            </article>
        <?php endif; ?>
        <main class="responsive active">

            <? echo $content; ?>
            <div class="large-space"></div>
            <div class="large-space"></div>
            <!-- Draw footer if not on admin panel -->
            <?php
            if (strpos($_SERVER['REQUEST_URI'], 'admin') === false && strpos($_SERVER['REQUEST_URI'], 'object') === false) {
            ?>
                <div class="divider"></div>
                <div class="grid">
                    <div class="s12 l6">
                        <p>
                            Stick Shop - магазин меблів, який пропонує широкий асортимент якісних меблів для дому та офісу. Наша місія - допомогти нашим клієнтам створити комфортний і затишний простір.
                        </p>
                        <div class="space"></div>
                        <p>
                            Адреса: вул. Меблева, б. 10, Суми <br>
                            Телефон: +38 (099) 123-45-67 <br>
                            Електронна пошта: info@stickshop.ua <br>
                        </p>
                        <div class="space"></div>

                    </div>
                    <div class="l1"></div>
                    <div class="s12 l5">
                        <div class="grid">
                            <div class="s3">
                                <p class="bold">Соц. мережі</p>
                                <p><a class="link">Facebook</a></p>
                                <p><a class="link">Twitter</a></p>
                                <p><a class="link">Instagram</a></p>
                            </div>
                            <div class="s4">
                                <p class="bold">Про нас</p>
                                <p class="bold">Доставка та оплата</p>
                                <a class="bold" href="/catalog.php">Каталог</a>
                            </div>
                            <div class="row top-align">
                                <img class="round small no-padding" src="assets/logo.png" style="image-rendering: crisp-edges;">
                                <p>
                                    Pavel Volkov <br>
                                    © 2023 Stick Shop <br>
                                    Всі права захищені
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </main>
    </main>
</body>

</html>