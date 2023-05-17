<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/app/core/Model.php';

#[AllowDynamicProperties]
class Item extends Model {
    public $id;
    public $name;
    public $description;
    public $price;
    public $image;
    public $category_id;
    public $category_name;

    public function __construct() {
        parent::__construct();
    }

    public function emptyValues() {
        $this->id = '';
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->image = '';
        $this->category_id = '';
        $this->category_name = '';
    }

    protected function setValuesFromLast() {
        $item = $this->db->getData();
        $this->id = $item['id'];
        $this->name = $item['name'];
        $this->description = $item['description'];
        $this->price = $item['price'];
        $this->image = $item['image'];
        $this->category_id = $item['category_id'];
        $this->category_name = $item['category_name'];
    }


    public function validate() {
        $errors = [];
        if (empty($this->name)) {
            $errors['name'] = 'Введіть назву товару';
        }
        if (empty($this->description)) {
            $errors['description'] = 'Введіть опис товару';
        }
        if (empty($this->price)) {
            $errors['price'] = 'Введіть ціну товару';
        }
        if (empty($this->category_id)) {
            $errors['category_id'] = 'Виберіть категорію товару';
        }
        return $errors;
    }

    public function save() {
        $fields = 'name, description, price, image, category_id';
        $data = "'$this->name', '$this->description', '$this->price', '$this->image', '$this->category_id'";
        $this->db->insertData('items', $data, $fields);
    }

    public function update() {
        $data = "name = '$this->name', description = '$this->description', price = '$this->price', image = '$this->image', category_id = '$this->category_id'";
        $this->db->updateData('items', $data, "id = '$this->id'");
    }

    public function delete() {
        $this->db->deleteData('items', "id = '$this->id'");
    }

    public function deleteMany($ids) {
        $ids = implode(',', $ids);
        $this->db->deleteData('items', "id IN ($ids)");
    }

    public function getAll() {
        $sql = "SELECT items.*, categories.name AS category_name FROM items INNER JOIN categories ON items.category_id = categories.id";
        $this->db->runQuery($sql);
        return $this->db->getData();
    }

    public function getPage($page, $limit) {
        $offset = ($page - 1) * $limit;
        $sql = "SELECT items.*, categories.name AS category_name FROM items INNER JOIN categories ON items.category_id = categories.id LIMIT $limit OFFSET $offset";
        $this->db->runQuery($sql);
        while ($item = $this->db->getData()) {
            $items[] = $item;
        }
        return $items ?? [];
    }

    public function getNumPages($limit, $category=false) {
        if ($category) {
            $sql = "SELECT COUNT(*) FROM items WHERE category_id = '$category'";
        } else {
            $sql = "SELECT COUNT(*) FROM items";
        }
        $this->db->runQuery($sql);
        $num_items = $this->db->getData()['COUNT(*)'];
        return ceil($num_items / $limit);
    }

    public function getByCategory($category_id, $page=false, $limit=false) {
        if ($page && $limit) {
            $offset = ($page - 1) * $limit;
            $sql = "SELECT items.*, categories.name AS category_name FROM items INNER JOIN categories ON items.category_id = categories.id WHERE category_id = '$category_id' LIMIT $limit OFFSET $offset";
        } else {
            $sql = "SELECT items.*, categories.name AS category_name FROM items INNER JOIN categories ON items.category_id = categories.id WHERE category_id = '$category_id'";
        }
        $this->db->runQuery($sql);
        while ($item = $this->db->getData()) {
            $items[] = $item;
        }
        return $items ?? [];
    }

    public function getById($id) {
        $id = mysqli_real_escape_string($this->db->getLink(), $id);
        $sql = "SELECT items.*, categories.name AS category_name FROM items INNER JOIN categories ON items.category_id = categories.id WHERE items.id = '$id'";
        $this->db->runQuery($sql);
        $this->setValuesFromLast();
        if ($this->db->numRows() == 0) {
            return false;
        }
        return true;
    }
}

function extractItemFromPost($post) {
    $item = new Item();
    $item->id = $post['id'] ?? null;
    $item->name = $post['name'];
    $item->description = $post['description'];
    $item->price = $post['price'];
    $item->image = $post['image'] ?? null;
    $item->category_id = $post['category'];
    return $item;
}
