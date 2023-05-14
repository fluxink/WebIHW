<form action="object-action.php" method="post" enctype="multipart/form-data">
    <?php
    switch ($content['type']) {
        case 'item':
            echo '
            <input type="hidden" name="action" value="' . $content['action_type'] . '">
            <input type="hidden" name="item" value="">
            <label for="id">ID</label>
            <input type="text" name="id" value="' . $content['values']->id . '" readonly>
            <label for="name">Назва</label>
            <input type="text" name="name" id="name" placeholder="Назва" value="' . $content['values']->name . '" required>
            <label for="description">Опис</label>
            <textarea name="description" id="description" placeholder="Опис" required>' . $content['values']->description . '</textarea>
            <label for="price">Ціна</label>
            <input type="number" name="price" id="price" placeholder="Ціна" value="' . $content['values']->price . '" required>
            <label for="image">Зображення</label>
            <img src="/assets/images/' . $content['values']->image . '" alt="' . $content['values']->name . '" width="100px">
            <input type="file" name="image" id="image" accept="image/*" placeholder="Зображення" value="' . $content['values']->image . '">
            <label for="category_id">Категорія</label>
            <select name="category_id" id="category_id" required>
            ';
            foreach ($content['categories'] as $category) {
                echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
            }
            echo '
            </select>
            <button type="submit">Зберегти</button>
            ';
            break;
        case 'category':
            echo '
            <input type="hidden" name="action" value="' . $content['action_type'] . '">
            <input type="hidden" name="category" value="">
            <label for="id">ID</label>
            <input type="text" name="id" value="' . $content['values']->id . '" readonly>
            <label for="name">Назва</label>
            <input type="text" name="name" id="name" placeholder="Назва" value="' . $content['values']->name . '" required>
            <button type="submit">Зберегти</button>
            ';
            break;
    }
    ?>
</form>