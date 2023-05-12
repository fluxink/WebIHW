<?php

require_once 'app/core/Model.php';

class Item extends Model {
    public $id;
    public $name;
    public $description;
    public $price;
    public $image;
    public $category_id;
    public $category_name;

    public function __construct($data) {
        parent::__construct();
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
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

    public function getAll() {
        $sql = "SELECT items.*, categories.name AS category_name FROM items INNER JOIN categories ON items.category_id = categories.id";
        $this->db->runQuery($sql);
        return $this->db->getData();
    }

    public function getPage($page, $limit) {
        $offset = ($page - 1) * $limit;
        $sql = "SELECT items.*, categories.name AS category_name FROM items INNER JOIN categories ON items.category_id = categories.id LIMIT $limit OFFSET $offset";
        $this->db->runQuery($sql);
        return $this->db->getData();
    }

    public function getByCategory($category_id) {
        $sql = "SELECT items.*, categories.name AS category_name FROM items INNER JOIN categories ON items.category_id = categories.id WHERE category_id = '$category_id'";
        $this->db->runQuery($sql);
        return $this->db->getData();
    }
}