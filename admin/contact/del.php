<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/library.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/util/CheckType_User.php';
?>
<?php
$id = 0;
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $queryCon = $mysqli->query("DELETE FROM contact WHERE con_id = $id");

    if($queryCon)
    {
        header("location:/admin/contact/?msg=1");
    }
    else
    {
        header("location:/admin/contact/?msg=0");
    }
}
?>