<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/util/DatabaseConnection.php';
$status = $_POST['astatus'];
$id = $_POST['aid_news'];

if($status == 1){
    ?>
    <a href="javascript:void(0)" onclick="active(0,<?=$id?>)">
        <img src="/templates/admin/files/status/de.png" alt=""/>
    </a>
    <?php
    $query = "UPDATE news SET is_slide = 0 WHERE news_id = {$id}";
}
else if($status == 0){
    ?>
    <a href="javascript:void(0)"  onclick="active(1,<?=$id?>)">
        <img src="/templates/admin/files/status/ac.png" alt=""/>
    </a>
    <?php
    $query = "UPDATE news SET is_slide = 1 WHERE news_id = {$id}";
}
$result = $mysqli->query($query);
?>