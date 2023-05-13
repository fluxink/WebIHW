<!DOCTYPE html>
<html lang="uk" data-theme="auto">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <title>Stick Shop</title>
</head>

<body class="container-fluid">
    <script src="js/modal.js"></script>
    <nav class="container-fluid">
        <ul>
            <li>
                <details role="list">
                    <summary aria-haspopup="listbox" role="button">Menu</summary>
                    <ul role="listbox">
                        <li><a>Action</a></li>
                        <li><a>Another action</a></li>
                        <li><a>Something else here</a></li>
                    </ul>
                </details>
            </li>
            <li><a href="#"><strong>Stick Shop</strong></a></li>
        </ul>
        <ul class="container">
            <li class="container-fluid">
                <input type="search" id="search" name="search" placeholder="Search">
            </li>
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
    <main class="container">
        <? echo $content; ?>
    </main>
    <footer class="container">
        <hr>
        <div class="grid">
            <div class="container">
                <h4>Ми в соціальних мережах</h4>
                <ul>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Twitter</a></li>
                </ul>
            </div>
            <div class="container">
                <h4>Підтримка</h4>
                <ul>
                    <li><a href="#">Повернення товару</a></li>
                    <li><a href="#">Доставка</a></li>
                    <li><a href="#">Оплата</a></li>
                </ul>
            </div>
            <div class="container">
                <h4>Інформація</h4>
                <ul>
                    <li><a href="#">Про нас</a></li>
                    <li><a href="#">Контакти</a></li>
                    <li><a href="#">Партнерам</a></li>
                </ul>
            </div>
        </div>

    </footer>
    <script type="module" src="js/common.js"></script>
    <button class="contrast switcher theme-switcher" aria-label="Turn on dark mode"><i>Turn on dark mode</i></button>
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
    <script src="js/form-valid.js"></script>
</body>

</html>