<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/library.php';
?>
<script type="text/javascript">
    document.title = "Quản lý";
</script>
<div class="wrapper">
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php';
    ?>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <?php
                require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
                ?>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <?php
                            $type = "";
                            $display = "";
                            $id ="";
                            if(isset($_SESSION['userInfo']))
                            {
                                $type = $_SESSION['userInfo']['type'];
                                $id = $_SESSION['userInfo']['user_id'];
                            }
                            if($type != "admin")
                            {
                                $display = "none";
                            }
                            ?>
                                <div class="col-md-3" style="display: <?=$display?>">
                                    <div class="card p-30">
                                        <div class="media bg-info text-white">
                                            <a href="/admin/cat/" class="btn-default">
                                                <div class="media-left meida media-middle">
                                                    <span><i class="fa fa-list fa-2x f-s-40 color-primary"></i></span>
                                                </div>
                                                <div class="media-body media-text-right">
                                                    <?php
                                                    $resultCat =  $mysqli->query("SELECT COUNT(cat_id) AS count FROM cat_list");
                                                    $objCat = $resultCat->fetch_object();
                                                    ?>
                                                    <h2><?=$objCat->count?></h2>
                                                    <p class="m-b-0">Danh mục</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media bg-success text-white">
                                        <a href="/admin/news/" class="btn-default">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-newspaper-o fa-2x f-s-40 color-success"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <?php
                                                $resultNews = "";
                                                if($type == 'mod')
                                                {
                                                    $resultNews =  $mysqli->query("SELECT COUNT(news_id) AS count FROM news WHERE created_by = {$id}");
                                                }
                                                else
                                                {
                                                    $resultNews =  $mysqli->query("SELECT COUNT(news_id) AS count FROM news");
                                                }

                                                $objNews = $resultNews->fetch_object();
                                                ?>
                                                <h2><?=$objNews->count?></h2>
                                                <p class="m-b-0">Tin tức</p>
                                            </div>
                                        </a>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="display: <?=$display?>">
                                    <div class="card p-30">
                                        <div class="media bg-danger text-white">
                                            <a href="/admin/user" class="btn-default">
                                                <div class="media-left meida media-middle">
                                                    <span><i class="fa fa-user fa-2x f-s-40 color-warning"></i></span>
                                                </div>
                                                <div class="media-body media-text-right">
                                                    <?php
                                                    $resultUser =  $mysqli->query("SELECT COUNT(user_id) AS count FROM user");
                                                    $objUser = $resultUser->fetch_object();
                                                    ?>
                                                    <h2><?=$objUser->count?></h2>
                                                    <p class="m-b-0">Người dùng</p>
                                                </div>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media bg-warning text-dark">
                                            <a href="/admin/comment" class="btn-default">
                                                <div class="media-left meida media-middle">
                                                    <span><i class="fa fa-comment fa-2x f-s-40 color-danger"></i></span>
                                                </div>
                                                <div class="media-body media-text-right">
                                                    <?php
                                                    $resultCom = "";
                                                    if($type == 'mod')
                                                    {
                                                        $resultCom =  $mysqli->query("SELECT COUNT(com_id) AS count FROM comment
                                                                                            INNER JOIN news ON comment.news_id = news.news_id
                                                                                            WHERE created_by = {$id}");
                                                    }
                                                    else
                                                    {
                                                         $resultCom =  $mysqli->query("SELECT COUNT(com_id) AS count FROM comment");
                                                    }

                                                    $objCom = $resultCom->fetch_object();
                                                    ?>
                                                    <h2><?=$objCom->count?></h2>
                                                    <p class="m-b-0">Bình luận</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 " style="display: <?=$display?>">
                                    <div class="card p-30">
                                        <div class="media bg-warning text-dark">
                                            <a href="/admin/contact" class="btn-default">
                                                <div class="media-left meida media-middle ">
                                                    <span><i class="fa fa-phone-square fa-2x f-s-40 color-danger"></i></span>
                                                </div>
                                                <div class="media-body media-text-right">
                                                    <?php
                                                    $resultCon =  $mysqli->query("SELECT COUNT(con_id) AS count FROM contact");
                                                    $objCon = $resultCon->fetch_object();
                                                    ?>
                                                    <h2><?=$objCon->count?></h2>
                                                    <p class="m-b-0">Liên hệ</p>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php';
        ?>

