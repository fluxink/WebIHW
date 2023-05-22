<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/app/core/Model.php';

#[AllowDynamicProperties]
class Category extends Model {
    public $id;
    public $name;
    public $icon;

    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $sql = "SELECT * FROM categories";
        $this->db->runQuery($sql);
        while ($row = $this->db->getData()) {
            $categories[] = $row;
        }
        return $categories ?? [];
    }

    public function save() {
        $fields = 'name, icon';
        $data = "'$this->name', '$this->icon'";
        $this->db->insertData('categories', $data, $fields);
    }

    public function update() {
        $data = "name = '$this->name', icon = '$this->icon'";
        $this->db->updateData('categories', $data, "id = '$this->id'");
    }

    public function delete() {
        $this->db->deleteData('categories', "id = '$this->id'");
    }

    public function getById($id) {
        $id = mysqli_real_escape_string($this->db->getLink(), $id);
        $sql = "SELECT * FROM categories WHERE id = '$id'";
        $this->db->runQuery($sql);
        if ($this->db->numRows() == 0) {
            return false;
        }
        foreach ($this->db->getData() as $key => $value) {
            $this->$key = $value;
        }
        return true;
    }

    public function isHaveItems() {
        $sql = "SELECT * FROM items WHERE category_id = '$this->id'";
        $this->db->runQuery($sql);
        return $this->db->numRows() > 0;
    }
}

function extractCategoryFromPost($post) {
    $category = new Category();
    $category->id = $post['id'] ?? '';
    $category->name = $post['name'] ?? '';
    $category->icon = $post['icon'] ?? '';
    return $category;
}