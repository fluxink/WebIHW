<div class="center-align">
    <div class="large-space"></div>
    <h3 class="bold page active top">Реєстрація</h3>
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
                    <div class="field border medium label <?php echo !empty($error_email) ? 'invalid' : '' ?>">
                        <input type="email" name="email" value="<?php echo $email ?>" required>
                        <label>Email</label>
                        <?php if (!empty($error_email)) {
                            echo '<span class="error">' . $error_email . '</span>';
                        } ?>
                    </div>
                </div>
                <div class="s2"></div>
                <div class="s2"></div>
                <div class="s8">
                    <div class="field border medium label <?php echo !empty($error_pass) ? 'invalid' : '' ?>">
                        <input type="password" name="password" required>
                        <label>Пароль</label>
                        <?php if (!empty($error_pass)) {
                            echo '<span class="error">' . $error_pass . '</span>';
                        } ?>
                    </div>
                </div>
                <div class="s2"></div>
                <div class="s2"></div>
                <div class="s8">
                    <div class="field border medium label <?php echo !empty($error_pass) ? 'invalid' : '' ?>">
                        <input type="password" name="password_confirm" required>
                        <label>Повторіть пароль</label>
                        <?php if (!empty($error_pass)) {
                            echo '<span class="error">' . $error_pass . '</span>';
                        } ?>
                    </div>
                </div>
                <div class="s2"></div>
                <div class="s12 medium-space"></div>
                <div class="s2"></div>
                <div class="s2 left-align">
                    <button class="no-margin" type="submit">
                        <span>Зареєструватися</span>
                    </button>
                </div>
                <div class="large-space s12"></div>
            </form>
        </div>
    </article>
</div>