<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/util/CheckType_User.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/util/DatabaseConnection.php';
$value = "";
if(isset($_GET['value']))
{
    $value = $_GET['value'];
}
$id = "";
if(isset($_GET['id']))
{
    $id = $_GET['id'];
}

    $resultCatPosition = $mysqli->query("UPDATE cat_list
                                                        SET sort = '{$value}'
                                                        WHERE cat_id = {$id}");
    if($resultCatPosition)
    {
        header("location: /admin/cat/?msg=2");
    }
    else
    {
        header("location: /admin/cat/?msg=3");
    }
?>

