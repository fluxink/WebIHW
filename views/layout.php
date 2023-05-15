<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/beercss@3.1.3/dist/cdn/beer.min.css" rel="stylesheet">
    <script type="module" src="https://cdn.jsdelivr.net/npm/beercss@3.1.3/dist/cdn/beer.min.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/material-dynamic-colors@0.1.7/dist/cdn/material-dynamic-colors.min.js"></script>
    <link rel="stylesheet" href="styles/style.css">
    <title>Stick Shop</title>
</head>

<body>
    <!-- Draw nav bar if user on catalog.php page -->
    <?php
    if (strpos($_SERVER['REQUEST_URI'], 'catalog.php') !== false) {
    ?>
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
    <?php
    }
    ?>

    <header class="fixed">
        <nav class="">
            <a class=" left-align" href="/"><img class="round extra" src="assets/logo.png"></a>
            <div class=""><a href="/"><h4>Stick Shop</h4></a></div>
            <div class="max"></div>
            <a class=" right-align" href="/profile.php">
                <i class="extra primary-text">account_circle</i>
            </a>
            <?php
            if (isset($_SESSION['user'])) {
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
            <article class="no-elevate round no-padding large page bottom active"><img class="responsive" src="https://lh3.googleusercontent.com/7GLFdt-EPWPY2k7WvjHd-LDFITELyr8fAe3vEh80sG26wjcDLt7bnzg70U7Tq2O7j0MOjD1g8sj4J8mFEcEPJv2ml3wwJ9wAEucr-kgPCWVCCGwGADw=w2400-rj">
                <div class="absolute middle center center-align black-text">
                    <h1 class="center-align">Material Design</h1>
                    <h6>Material 3 is the latest version of Google’s open-source design system. Design and build beautiful, usable products with Material 3.</h6>
                    <nav class="center-align"><button class="round extra">Get started</button></nav>
                </div>
            </article>
        <?php endif; ?>
        <main class="responsive active">

            <? echo $content; ?>
            <div class="large-space"></div>
            <div class="large-space"></div>
            <div class="divider"></div>
            <div class="large-space"></div>
            <div class="grid">
                <div class="s12 l6"><svg class="medium" viewBox="0 0 24 24">
                        <path d="M21,12C21,9.97 20.33,8.09 19,6.38V17.63C20.33,15.97 21,14.09 21,12M17.63,19H6.38C7.06,19.55 7.95,20 9.05,20.41C10.14,20.8 11.13,21 12,21C12.88,21 13.86,20.8 14.95,20.41C16.05,20 16.94,19.55 17.63,19M11,17L7,9V17H11M17,9L13,17H17V9M12,14.53L15.75,7H8.25L12,14.53M17.63,5C15.97,3.67 14.09,3 12,3C9.91,3 8.03,3.67 6.38,5H17.63M5,17.63V6.38C3.67,8.09 3,9.97 3,12C3,14.09 3.67,15.97 5,17.63M23,12C23,15.03 21.94,17.63 19.78,19.78C17.63,21.94 15.03,23 12,23C8.97,23 6.38,21.94 4.22,19.78C2.06,17.63 1,15.03 1,12C1,8.97 2.06,6.38 4.22,4.22C6.38,2.06 8.97,1 12,1C15.03,1 17.63,2.06 19.78,4.22C21.94,6.38 23,8.97 23,12Z"></path>
                    </svg>
                    <p>Material Design is an adaptable system of guidelines, components, and tools that support the best practices of user interface design. Backed by open-source code, Material Design streamlines collaboration between designers and developers, and helps teams quickly build beautiful products.</p>
                </div>
                <div class="s12 l6">
                    <div class="grid large-line">
                        <div class="s4">
                            <p class="bold">Social</p>
                            <p><a class="link">GitHub</a></p>
                            <p><a class="link">Twitter</a></p>
                            <p><a class="link">Youtube</a></p>
                            <p><a class="link">Blog RSS</a></p>
                        </div>
                        <div class="s4">
                            <p class="bold">Libraries</p>
                            <p><a class="link">Android</a></p>
                            <p><a class="link">Compose</a></p>
                            <p><a class="link">Flutter</a></p>
                            <p><a class="link">Web</a></p>
                        </div>
                        <div class="s4">
                            <p class="bold">Archived versions</p>
                            <p><a class="link">Material Design 1</a></p>
                            <p><a class="link">Material Design 2</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="large-space"></div>
            <div class="row large-space wrap"><svg width="71" height="23">
                    <path d="M0 8.773C0 3.937 4.083 0 8.938 0c2.684 0 4.595 1.047 6.034 2.415l-1.695 1.693c-1.032-.962-2.429-1.712-4.339-1.712-3.545 0-6.317 2.847-6.317 6.377s2.772 6.381 6.317 6.381c2.297 0 3.607-.921 4.446-1.756.687-.686 1.137-1.67 1.307-3.02H8.938V7.982h8.097c.085.43.129.946.129 1.5 0 1.797-.494 4.025-2.084 5.608-1.547 1.603-3.524 2.462-6.142 2.462C4.083 17.55 0 13.61 0 8.773zm23.693 6.303c-1.719 0-3.198-1.413-3.198-3.425 0-2.032 1.479-3.423 3.198-3.423 1.718 0 3.201 1.391 3.201 3.423 0 2.012-1.483 3.425-3.201 3.425m0-9.076C20.557 6 18 8.375 18 11.65c0 3.257 2.557 5.652 5.693 5.652 3.137 0 5.692-2.395 5.692-5.651C29.385 8.375 26.83 6 23.693 6m13.003 9.076c-1.719 0-3.2-1.413-3.2-3.425 0-2.032 1.481-3.423 3.2-3.423 1.718 0 3.2 1.391 3.2 3.423 0 2.012-1.482 3.425-3.2 3.425m0-9.076C33.559 6 31 8.375 31 11.65c0 3.257 2.559 5.652 5.696 5.652 3.135 0 5.692-2.395 5.692-5.651C42.388 8.375 39.831 6 36.696 6m11.952 9.076c-1.716 0-3.156-1.432-3.156-3.403 0-1.991 1.44-3.445 3.156-3.445 1.697 0 3.031 1.454 3.031 3.445 0 1.971-1.334 3.403-3.031 3.403zm2.858-8.732v.918h-.085C50.861 6.601 49.789 6 48.434 6 45.6 6 43 8.485 43 11.673c0 3.168 2.6 5.63 5.434 5.63 1.355 0 2.427-.6 2.987-1.287h.085v.816c0 2.162-1.161 3.316-3.028 3.316-1.526 0-2.471-1.092-2.857-2.01l-2.171.9c.624 1.498 2.278 3.336 5.028 3.336 2.922 0 5.391-1.713 5.391-5.885V6.344h-2.363zM56 16.608h2.49V0H56zm9.434-8.425c.987 0 1.825.494 2.104 1.199l-5.069 2.096c-.065-2.182 1.697-3.295 2.965-3.295m.192 6.891c-1.267 0-2.169-.578-2.748-1.71l7.582-3.125-.259-.643C69.729 8.333 68.29 6 65.347 6 62.427 6 60 8.292 60 11.65c0 3.167 2.404 5.65 5.626 5.65 2.599 0 4.103-1.583 4.727-2.504l-1.934-1.284c-.643.942-1.525 1.562-2.793 1.562" fill-rule="evenodd"></path>
                </svg>
                <a class="large-text">Privacy Policy</a>
                <a class="large-text">Terms pf Service</a>
                <a class="large-text">Join research studies</a>
                <a class="large-text">Feedback</a>
            </div>
        </main>
    </main>


    <!-- <script type="module" src="js/common.js"></script> -->
    <!-- <button class="contrast switcher theme-switcher" aria-label="Turn on dark mode"><i>Turn on dark mode</i></button> -->
    <!-- Modal -->
    <dialog id="modal-login">
        <article class="modal">
            <a href="#close" aria-label="Close" class="close" data-target="modal-login" onClick="toggleModal(event)">
            </a>
            <h3>Вхід</h3>
            <form action="login.php" method="post">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password" placeholder="Пароль" required>
                <button type="submit">Увійти</button>
            </form>
            <p>Не маєте акаунт? <a href="#" data-target="modal-registration" onclick="toggleModal(event)">Зареєструватися</a></p>
        </article>
    </dialog>

    <dialog id="modal-registration">
        <article class="modal">
            <a href="#close" aria-label="Close" class="close" data-target="modal-registration" onClick="toggleModal(event)">
            </a>
            <h3>Реєстрація</h3>
            <form action="register.php" method="post" id="register-form">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password" placeholder="Пароль" required>
                <label for="password">Повторіть пароль</label>
                <input type="password" name="password" id="password" placeholder="Повторіть пароль" required>
                <button type="submit">Зареєструватися</button>
            </form>
            <p>Вже маєте акаунт? <a href="#" data-target="modal-registration" onclick="toggleModal(event)">Увійти</a></p>
        </article>
    </dialog>
    <!-- <script src="js/form-valid.js"></script> -->
</body>

</html>