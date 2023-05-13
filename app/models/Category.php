<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/app/core/Model.php';

class Category extends Model {
    public $id;
    public $name;

    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $sql = "SELECT * FROM categories";

        return $this->db->runQuery($sql);
    }

    public function save() {
        $fields = 'name';
        $data = "'$this->name'";
        $this->db->insertData('categories', $data, $fields);
    }

    public function update() {
        $data = "name = '$this->name'";
        $this->db->updateData('categories', $data, "id = '$this->id'");
    }

    public function delete() {
        $this->db->deleteData('categories', "id = '$this->id'");
    }

    public function getById($id) {
        $sql = "SELECT * FROM categories WHERE id = '$id'";
        $this->db->runQuery($sql);
        return $this->db->getData();
    }
}