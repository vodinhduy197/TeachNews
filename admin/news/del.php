<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/library.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/util/CheckType_User.php';
?>
<?php
$id = 0;
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $queryNews = "SELECT * FROM news WHERE news_id = {$id}";
    $resultNews = $mysqli->query($queryNews);
    $arNews = mysqli_fetch_assoc($resultNews);
    $imageOld = $arNews['picture'];
    // xóa ảnh trong thư mục
    $urlDel = $_SERVER['DOCUMENT_ROOT'].'/files/'.$imageOld;
    unlink($urlDel);
    $queryNewsDel = $mysqli->query("DELETE FROM news WHERE news_id = $id");
    $queryCmtDel = $mysqli->query("DELETE FROM comment WHERE news_id = $id");
    if($queryNewsDel)
    {
        header("location:/admin/news/?msg=1");
    }
    else
    {
        header("location:/admin/news/?msg=0");
    }
}
?>