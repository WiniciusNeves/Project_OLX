<?php
include(__DIR__ . '../views/config.php');

session_start();
session_destroy();

if (isset($_SESSION['id'], $_SESSION['email'])) {
    $id = $_SESSION['id'];
    $email = $_SESSION['email'];

    if ($id == null) {
        header("Location: ./register.php");
    } else {
        error_log("verifica.php");
    }
} else {
    header("Location: ./index.php");
    exit();

}
