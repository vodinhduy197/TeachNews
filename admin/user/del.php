<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/library.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/util/CheckType_User.php';
?>
<?php
$id = 0;

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    if($id == 1||$id =="")
    {
        header("location:/admin/user/?msg=0");
    }
    else
    {
        $queryUser = "SELECT * FROM user WHERE user_id = {$id}";
        $resultUser = $mysqli->query($queryUser);
        $arUser = mysqli_fetch_assoc($resultUser);
        $imageOld = $arUser['avatar'];
        // xóa ảnh trong thư mục
        $urlDel = $_SERVER['DOCUMENT_ROOT'].'/templates/admin/files/avatar/'.$imageOld;
        unlink($urlDel);
        $queryUserDel = $mysqli->query("DELETE FROM user WHERE user_id = {$id}");

        if($queryUserDel)
        {
            header("location:/admin/user/?msg=1");
        }
        else
        {
            header("location:/admin/user/?msg=0");
        }
    }
}
?>