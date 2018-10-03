<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/util/DatabaseConnection.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
    $name = $_POST['name'];
    $message = $_POST['message'];
    $idNews = $_POST['idNews'];

    $result = $mysqli->query("INSERT INTO `comment`(`name`, `com_content`,`date_create` , `news_id`) VALUES ('$name','$message',now(),$idNews)");

    /*$resultCmt = $mysqli->query("SELECT * FROM comment
                                        INNER JOIN news ON news.news_id = comment.news_id 
                                        WHERE active = 1 AND comment.news_id = {$idNews}");
    $cmt = mysqli_fetch_assoc($resultCmt);
    $dateTmp = date_create($cmt['date_create']);
    $date_create = date_format($dateTmp, "d-m-Y H:i:s");*/

    $date = date("d-m-Y H:i:s");
    //$dateTmp2 = date_create();
?>
<div class="comment-content media" style="background-color: #F2F3F5">
    <!-- Comment Meta -->
    <div class="media-left">
        <img src="/files/avatar.jpg" width="96" height="96" >
    </div>

    <div class="media-body" style="margin-left: 10px">
        <a href="#" class="post-author"><span style="color: blue;"><?= $name ?></span></a><br/>
        <a href="#" class="post-date"><?= $date ?></a>
        <p ><?= $message ?></p>
    </div>
    <div>
        <a href="javascript:void(0)" onclick="//getFormReply(<?//=$cmtPa['com_id']?>)"
           class="comment-reply btn world-btn">Trả lời</a>
    </div>
</div>

<!---->

