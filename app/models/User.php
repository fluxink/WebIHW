<?php

if (!isset($_SESSION)) {
    session_start();
}


require_once $_SERVER["DOCUMENT_ROOT"] . '/app/core/Model.php';

class User extends Model
{
    public $email;
    public $password;
    public $role;
    public $first_name = null;
    public $last_name = null;
    public $address = null;
    public $city = null;
    public $zip = null;
    public $phone = null;
    public $errors = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function validate()
    {
        if (empty($this->email)) {
            $this->errors['email'] = 'Email обов\'язковий';
        } else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email введений некоректно';
        }
        if (!empty($this->first_name)) {
            if (strlen($this->first_name) < 2) {
                $this->errors['first_name'] = 'Ім\'я повинно містити не менше 2 символів';
            }
        }
        if (!empty($this->last_name)) {
            if (strlen($this->last_name) < 2) {
                $this->errors['last_name'] = 'Прізвище повинно містити не менше 2 символів';
            }
        }
        if (!empty($this->zip)) {
            if (!preg_match("/^[0-9]*$/", $this->zip)) {
                $this->errors['zip'] = 'Поштовий індекс повинен містити тільки цифри';
            }
        }
        if (!empty($this->phone)) {
            if (!preg_match("/^[0-9]*$/", $this->phone)) {
                $this->errors['phone'] = 'Телефон повинен містити тільки цифри';
            } else if (strlen($this->phone) == 10) {
                $this->errors['phone'] = 'Телефон повинен містити 10 цифр';
            }
        }
        if (!empty($this->city)) {
            if (!preg_match("/^[a-zA-Z ]*$/", $this->city)) {
                $this->errors['city'] = 'Місто повинно містити тільки літери та пробіли';
            }
        }
        return $this->errors;
    }

    public function isExist()
    {
        $sql = "SELECT * FROM users WHERE email = '$this->email'";
        $this->db->runQuery($sql);
        if ($this->db->numRows() > 0) {
            return true;
        }
        return false;
    }

    public function save()
    {
        $fields = 'email, password, role, first_name, last_name, phone, address, city, zip';
        $data = "'$this->email', '$this->password', '$this->role', '$this->first_name', '$this->last_name', '$this->phone', '$this->address', '$this->city', '$this->zip'";
        $this->db->insertData('users', $data, $fields);
    }

    public function register()
    {
        if ($this->isExist()) {
            return false;
        }
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->role = 'user';
        $this->save();
        return true;
    }

    public function login()
    {
        $sql = "SELECT * FROM users WHERE email = '$this->email'";
        $this->db->runQuery($sql);
        $user = $this->db->getData();
        if ($this->db->numRows() > 0) {
            if (password_verify($this->password, $user['password'])) {
                $_SESSION['user'] = $user;
                return true;
            }
        }
        return false;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }

    public function update()
    {
        $data = "first_name = '$this->first_name', last_name = '$this->last_name', phone = '$this->phone', address = '$this->address', city = '$this->city', zip = '$this->zip'";
        $this->db->updateData('users', $data, "email = '$this->email'");
        if ($this->db->numRows() > 0) {
            return true;
        }
        return false;
    }

    public function getAll()
    {
        $sql = "SELECT id, email, first_name, last_name, phone, address, city, zip, role FROM users";
        $this->db->runQuery($sql);
        while ($row = $this->db->getData()) {
            $users[] = $row;
        }
        return $users ?? [];
    }

    public function getByEmail()
    {
        $sql = "SELECT * FROM users WHERE email = '$this->email'";
        $this->db->runQuery($sql);
        return $this->db->getData();
    }
}
