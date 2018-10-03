<?php
ob_start();
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/util/DatabaseConnection.php';

if(isset($_SESSION['userInfo'])){
    unset($_SESSION['userInfo']);
    header("location:/auth/");
    die();
}
header("location:/");

ob_end_flush();
?>