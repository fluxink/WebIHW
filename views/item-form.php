<article class="">
    <h3 class="center-align">Товар</h3>
    <div class="medium-space"></div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="field label border">
            <input type="number" name="id" value="<?php echo empty($data['id']) ?  '' : $data['id']; ?>" readonly>
            <label class="active">ID</label>
        </div>
        <div class="field label border">
            <input type="text" name="name" value="<?php echo empty($data['name']) ? '' : $data['name']; ?>" required>
            <label class="active">Назва</label>
        </div>
        <div class="field textarea label border">
            <textarea name="description" required><?php echo empty($data['description']) ? '' : $data['description']; ?></textarea>
            <label class="active">Опис</label>
        </div>
        <div class="field label border">
            <input type="number" name="price" value="<?php echo empty($data['price']) ? '' : $data['price']; ?>" required>
            <label class="active">Ціна</label>
        </div>
        <?php if (!empty($data['image'])) {
            echo '<article class="grid">';
            echo '<img class="responsive m3" src="/assets/images/' . $data['image'] . '" alt="Зображення товару">';
            echo '</article>';
        }
        ?>
        <?php if (isset($_GET['message'])) {
            echo '<div class="toast red white-text top active">
            <i>error</i>
            <span>' .$_GET['message'] . '</span>
          </div>';
        }
        ?>
        <div class="field label suffix border">
            <input type="text">
            <input type="file" name="image" id="image" accept="image/*">
            <label><?php echo empty($data['image']) ? 'Зображення' : $data['image']; ?></label>
            <i>attach_file</i>
        </div>
        <div class="field label suffix border">
            <select name="category">
                <?php
                foreach ($categories as $category) {
                    echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                }
                ?>
            </select>
            <label class="active">Категорія</label>
            <i>arrow_drop_down</i>
        </div>
        <button class="no-margin" type="submit">
            Зберегти
        </button>
    </form>
</article>