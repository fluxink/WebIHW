<?php
session_start();


if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    header('Location: /');
} else {
    header('Location: /');
}