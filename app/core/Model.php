<?php

require 'app/core/Database.php';

abstract class Model {
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }
}