<?php
include('./views/config.php');
session_start();
if (isset($_GET['id']) && isset($_SESSION['id']) ) {
    header('Location: ../index.php?id=' . $_SESSION['id']);
    exit;
}

