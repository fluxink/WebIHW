<div class="center-align">
    <div class="large-space"></div>
    <h3 class="bold page active top">Авторизація</h3>
    <div class="large-space"></div>
    <div class="large-padding" style="background-image: url(/assets/profile.png); background-size: cover; background-position: center;">
        <article class="blur">
            <div class="">
                <form class="" action="" method="post">
                    <div class="row center-align">
                        <div class="field border medium label <?php echo !empty($error) ? 'invalid' : '' ?>">
                            <input type="email" name="email" value="<?php echo $email ?>">
                            <label>Email</label>
                        </div>
                    </div>
                    <div class="row center-align">
                        <div class="field border medium label <?php echo !empty($error) ? 'invalid' : '' ?>">
                            <input type="password" name="password" value="<?php echo $password ?>">
                            <label>Пароль</label>
                        </div>
                    </div>
                    <div class="large-row no-wrap center-align">
                    <?php
                    if (!empty($error)) {
                        echo '<div class="error tiny-padding round margin"><p>' . $error . '</p></div>';
                    } else {
                        echo '<div class="medium-space"></div>';
                    }
                    ?>
                    </div>
                    <div class="">
                        <button class="no-margin" type="submit">
                            <span>Увійти</span>
                        </button>
                    </div>
                    <div class="">
                        <p>
                            Немаєте аккаунта?
                            <a class="link" href="/registration.php">
                                Зареєструватися
                            </a>
                        </p>
                    </div>
                    <div class="large-space"></div>
                </form>
            </div>
        </article>
    </div>
</div>