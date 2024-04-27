<?php
include('./views/config.php');
session_start();

if (!isset($_SESSION['id']) || !isset($_SESSION['nome'])) {
    header('Location: ./views/login.php');
    exit;
}
