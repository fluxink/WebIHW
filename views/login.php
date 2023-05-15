<div class="center-align">
    <div class="large-space"></div>
    <h3 class="bold page active top">Авторизація</h3>
    <div class="large-space"></div>
    <article class="no-padding">
        <div class="grid no-space">
            <div class="s3">
                <img class="responsive" src="/assets/profile.png" alt="">
            </div>
            <form class="s9 grid no-space" action="" method="post">
                <div class="large-space s12"></div>
                <div class="s2"></div>
                <div class="s8">
                    <div class="field border medium label <?php echo !empty($error) ? 'invalid' : '' ?>">
                        <input type="email" name="email" value="<?php echo $email ?>">
                        <label>Email</label>
                    </div>
                </div>
                <div class="s2"></div>
                <div class="s2"></div>
                <div class="s8">
                    <div class="field border medium label <?php echo !empty($error) ? 'invalid' : '' ?>">
                        <input type="password" name="password" value="<?php echo $password ?>">
                        <label>Пароль</label>
                    </div>
                </div>
                <div class="s2"></div>
                <div class="s4"></div>
                <?php
                if (!empty($error)) {
                    echo '<div class="s4 error"><p>' . $error . '</p></div>';
                } else {
                    echo '<div class="s4 medium-space"></div>';
                }
                ?>
                <div class="s4"></div>
                <div class="s2"></div>
                <div class="s2 left-align">
                    <button class="no-margin" type="submit">
                        <span>Увійти</span>
                    </button>
                </div>
                <div class="s8 left-align middle-align">
                    <p>
                        Немаєте аккаунта?
                        <a class="link" href="/registration.php">
                            Зареєструватися
                        </a>
                    </p>
                </div>
                <div class="large-space s12"></div>
            </form>
        </div>
    </article>
</div>