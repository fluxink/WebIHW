<article>
    <h3 class="center-align">Категорія</h3>
    <div class="medium-space"></div>
    <form action="" method="post">
        <div class="field label border">
            <input type="number" name="id" value="<?php echo empty($data['id']) ?  '' : $data['id']; ?>" readonly>
            <label class="active">ID</label>
        </div>
        <div class="field label border">
            <input type="text" name="name" value="<?php echo empty($data['name']) ? '' : $data['name']; ?>" required>
            <label class="active">Назва</label>
        </div>
        <div class="field label border">
            <input type="text" name="icon" value="<?php echo empty($data['icon']) ? '' : $data['icon']; ?>" required>
            <label class="active">Значок</label>
        </div>
        <button class="no-margin" type="submit">
            Зберегти
        </button>
    </form>
</article>