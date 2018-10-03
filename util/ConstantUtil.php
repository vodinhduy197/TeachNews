<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/util/DatabaseConnection.php';
    $result = $mysqli->query("SELECT row from row WHERE id_row = 1");
    $obj = $result->fetch_object();
    define('ROW_COUNT', $obj->row);
?>