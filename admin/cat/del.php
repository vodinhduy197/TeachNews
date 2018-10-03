<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/library.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/util/CheckType_User.php';
?>
<?php
    $id = 0;
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $queryCatDel = $mysqli->query("DELETE FROM cat_list WHERE cat_id = $id");
        $queryNewsDel = $mysqli->query("DELETE FROM news WHERE cat_id = $id");
        if($queryCatDel)
        {
            header("location:/admin/cat/?msg=1");
        }
        else
        {
            header("location:/admin/cat/?msg=0");
        }
    }
?>
