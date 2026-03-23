<?php 
include('inc/connect.php');

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id_i = (int) $_GET['id'];
if (!isset($_GET['id'])) {
    die("Invalid request");
}

$id = (int) $_GET['id'];

Database::getInstance()->deleteUser($id);

header("Location: viewAllDate.php");
exit;
?>