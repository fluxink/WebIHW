<?php

require $_SERVER["DOCUMENT_ROOT"] . '/app/core/Database.php';

abstract class Model {
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }
}