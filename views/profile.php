<div class="center-align">
    <div class="large-space"></div>
    <h3 class="bold page top active">Особисті дані</h3>
    <div class="large-space"></div>
    <article class="no-padding">
        <div class="grid no-space left-align">
            <div class="s3">
                <img class="responsive" src="/assets/profile.png" alt="">
            </div>
            <form class="s9 grid" action="profile.php" method="post">
                <div class="s4">
                    <div>Email</div>
                    <?php
                        if (isset($_GET['edit'])) {
                            echo '<div class="field border medium no-margin">';
                            echo '<input type="email" name="email" value="' . $content['email'] . '" required>';
                            echo '</div>';
                        } else {
                            echo '<h6>' . $content['email'] . '</h6>';
                        }
                    ?>
                </div>
                <div class="s4">
                    <div>Ім'я</div>
                    <?php
                        if (isset($_GET['edit'])) {
                            echo '<div class="field border medium no-margin">';
                            echo '<input type="text" name="first_name" value="' . htmlspecialchars($content['first_name'] ?? '') . '">';
                            echo '</div>';
                        } else {
                            echo '<h6>' . htmlspecialchars($content['first_name'] ?? '') . '</h6>';
                        }
                    ?>
                </div>
                <div class="s4">
                    <div>Прізвище</div>
                    <?php
                        if (isset($_GET['edit'])) {
                            echo '<div class="field border medium no-margin">';
                            echo '<input type="text" name="last_name" value="' . htmlspecialchars($content['last_name'] ?? '') . '">';
                            echo '</div>';
                        } else {
                            echo '<h6>' . htmlspecialchars($content['last_name'] ?? '') . '</h6>';
                        }
                    ?>
                </div>
                <div class="large-space s12"></div>
                <div class="s3">
                    <div>Телефон</div>
                    <?php
                        if (isset($_GET['edit'])) {
                            echo '<div class="field border medium no-margin">';
                            echo '<input type="text" name="phone" value="' . $content['phone'] . '">';
                            echo '</div>';
                        } else {
                            echo '<h6>' . $content['phone'] . '</h6>';
                        }
                    ?>
                </div>
                <div class="s3">
                    <div>Адреса</div>
                    <?php
                        if (isset($_GET['edit'])) {
                            echo '<div class="field border medium no-margin">';
                            echo '<input type="text" name="address" value="' . htmlspecialchars($content['address'] ?? '') . '">';
                            echo '</div>';
                        } else {
                            echo '<h6>' . htmlspecialchars($content['address'] ?? '') . '</h6>';
                        }
                    ?>
                </div>
                <div class="s3">
                    <div>Поштовий індекс</div>
                    <?php
                        if (isset($_GET['edit'])) {
                            echo '<div class="field border medium no-margin">';
                            echo '<input type="text" name="zip" value="' . htmlspecialchars($content['zip'] ?? '') . '">';
                            echo '</div>';
                        } else {
                            echo '<h6>' . htmlspecialchars($content['zip'] ?? '') . '</h6>';
                        }
                    ?>
                </div>
                <div class="s3">
                    <div>Місто</div>
                    <?php
                        if (isset($_GET['edit'])) {
                            echo '<div class="field border medium no-margin">';
                            echo '<input type="text" name="city" value="' . htmlspecialchars($content['city'] ?? '') . '">';
                            echo '</div>';
                        } else {
                            echo '<h6>' . htmlspecialchars($content['city'] ?? '') . '</h6>';
                        }
                    ?>
                </div>
                <div class="large-space s12"></div>
                <div class="s12">
                    <?php
                        if (isset($_GET['edit'])) {
                            echo '<button type="submit" name="save">
                                        <i>save</i>
                                        <span>Зберегти</span>
                                  </button>';
                        } else { 
                            echo '<a class="button" href="/profile.php?edit">
                                        <i>edit</i>
                                        <span>Редагувати</span>
                                  </a>';
                        }
                        if ($content['role'] == 'admin') {
                            echo '<a class="button" href="/admin.php">
                                        <i>admin_panel_settings</i>
                                        <span>Адмін панель</span>
                                  </a>';
                        }
                    ?>
                </div>
                <div class="medium-space s12"></div>
            </form>
    </article>
</div>