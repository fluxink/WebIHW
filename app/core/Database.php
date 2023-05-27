<?php

require $_SERVER["DOCUMENT_ROOT"] . '/config.php';

class Database extends mysqli {
    private $connections;
    public $last;
    private static $instance;

    public function __construct() {
        $this->connections = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        mysqli_set_charset($this->connections, 'utf8');
        if ($this->connections->connect_error) {
            die("Connection failed: " . $this->connections->connect_error);
        }
    }

    public static function getInstance(): Database {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function runQuery($sql) {
        $this->last = $this->connections->query($sql);
        if (!$this->last) {
            die("Query failed: " . $this->connections->error);
        }
        return $this->last;
    }

    public function getData() {
        return $this->last->fetch_assoc();
    }

    public function deleteData($table, $condition, $limit=false) {
        $limit = $limit ? "LIMIT $limit" : '';
        $sql = "DELETE FROM $table WHERE $condition $limit";
        return $this->runQuery($sql);
    }

    public function updateData($table, $data, $condition) {
        $sql = "UPDATE $table SET $data WHERE $condition";
        return $this->runQuery($sql);
    }

    public function insertData($table, $data, $fields) {
        $sql = "INSERT INTO $table ($fields) VALUES ($data)";
        return $this->runQuery($sql);
    }

    public function numRows() {
        return $this->last->num_rows;
    }

    public function __destruct() {
        $this->connections->close();
    }

    public function getLink() {
        return $this->connections;
    }
}