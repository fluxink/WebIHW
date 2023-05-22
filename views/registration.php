<div class="center-align">
    <div class="large-space"></div>
    <h3 class="bold page active top">Реєстрація</h3>
    <div class="large-space"></div>
    <div class="large-padding" style="background-image: url(/assets/profile.png); background-size: cover; background-position: center;">
        <article class="blur">
            <div class="">
                <form class="" action="" method="post">
                    <div class="row center-align">
                        <div class="field border medium label <?php echo !empty($error_email) ? 'invalid' : '' ?>">
                            <input type="email" name="email" value="<?php echo $email ?>" required>
                            <label>Email</label>
                            <?php if (!empty($error_email)) {
                                echo '<span class="error">' . $error_email . '</span>';
                            } ?>
                        </div>
                    </div>
                    <div class="row center-align">
                        <div class="field border medium label <?php echo !empty($error_pass) ? 'invalid' : '' ?>">
                            <input type="password" name="password" required>
                            <label>Пароль</label>
                            <?php if (!empty($error_pass)) {
                                echo '<span class="error">' . $error_pass . '</span>';
                            } ?>
                        </div>
                    </div>
                    <div class="row center-align">
                        <div class="field border medium label <?php echo !empty($error_pass) ? 'invalid' : '' ?>">
                            <input type="password" name="password_confirm" required>
                            <label>Повторіть пароль</label>
                            <?php if (!empty($error_pass)) {
                                echo '<span class="error">' . $error_pass . '</span>';
                            } ?>
                        </div>
                    </div>
                    <div class="medium-space"></div>
                    <div class="">
                        <button class="no-margin" type="submit">
                            <span>Зареєструватися</span>
                        </button>
                    </div>
                    <div class="large-space"></div>
                </form>
            </div>
        </article>
    </div>
</div>