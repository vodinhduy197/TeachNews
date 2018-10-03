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
    $query = "UPDATE comment SET active = 0 WHERE com_id = {$id}";
}
else if($status == 0){
    ?>
    <a href="javascript:void(0)"  onclick="active(1,<?=$id?>)">
        <img src="/templates/admin/files/status/ac.png" alt=""/>
    </a>
    <?php
    $query = "UPDATE comment SET active = 1 WHERE com_id = {$id}";
}
$result = $mysqli->query($query);
?>