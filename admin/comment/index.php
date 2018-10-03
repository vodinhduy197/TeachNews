<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/library.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConstantUtil.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/util/Utf8ToLatinUtil.php';
?>
<script type="text/javascript">
    document.title = "Quản lý bình luận";
</script>
<div class="wrapper" xmlns="http://www.w3.org/1999/html">
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php';
    ?>
    <?php
        $queryTotalOfRow = "SELECT COUNT(*) AS TOR FROM comment ";
    $resultTotalOfRow = $mysqli->query($queryTotalOfRow);
    $current_page = 1;
    $arTmp = mysqli_fetch_assoc($resultTotalOfRow);
    $totalOfRow = $arTmp['TOR'];
    //Biến tổng số dòng
    $row_count = ROW_COUNT;
    //tổng số trang
    $totalOfPage = ceil($totalOfRow / $row_count);
    //lấy trang hiện tại
    if(isset($_GET['page']))
    {
        $current_page = $_GET['page'];
    }
    //tính offset
    $offset = ($current_page - 1)*$row_count;
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
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Quản lý bình luận</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panedanh mục tinl-default">


                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="10%">ID</th>
                                            <th width="25%">Tên tin</th>
                                            <th width="10%">Người bình luận</th>
                                            <th width="30%">Nội dung</th>
                                            <th width="10%">Ngày bình luận</th>
                                            <th width="15%">Quản lý bình luận</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $resultCmt = "";
                                        if($_SESSION['userInfo']['type']=='mod')
                                        {
                                            $id_user = $_SESSION['userInfo']['user_id'];
                                            $resultCmt = $mysqli->query("SELECT *,comment.date_create as date_create2 FROM comment
                                                                                  INNER JOIN news ON news.news_id = comment.news_id
                                                                                  WHERE created_by = $id_user");
                                        }
                                        else
                                        {
                                            $resultCmt = $mysqli->query("SELECT *,comment.date_create as date_create2 FROM comment
                                                                                  INNER JOIN news ON news.news_id = comment.news_id");
                                        }

                                        while ($arCmt = mysqli_fetch_assoc($resultCmt)) {
                                        $dateTmp = date_create($arCmt['date_create2']);
                                        $date_create = date_format($dateTmp, "d-m-Y");
                                            $name_seoNews = to_slug($arCmt['news_name']);
                                            $urlReduceNews ='/chi-tiet/'.$name_seoNews.'-'.$arCmt['news_id'].'.html';
                                        ?>
                                            <tr class="odd gradeX">

                                                <td><?= $arCmt['com_id'] ?></td>
                                                <td ><a href="<?=$urlReduceNews?>" ><?= $arCmt['news_name'] ?></a></td>
                                                <td><?= $arCmt['name'] ?></td>
                                                <td><?= $arCmt['com_content'] ?></td>
                                                <td><?= $date_create ?></td>

                                                <td class="center" align="center">
                                                     <span id="active-<?= $arCmt['com_id'] ?>">
                                                         <a href="javascript:void(0)"
                                                            onclick="active(<?= $arCmt['active'] ?>,<?= $arCmt['com_id'] ?>)">
                                                             <?php
                                                             if ($arCmt['active'] == 1) {
                                                                 echo "<img src='/templates/admin/files/status/ac.png' alt=''/>";
                                                             } else if ($arCmt['active'] == 0) {
                                                                 echo "<img src='/templates/admin/files/status/de.png' alt=''/>";
                                                             }
                                                             ?>

                                                         </a>
                                                    </span>
                                                </td>


                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <?php
                                    $page = 1;
                                    $property1 = "";
                                    $property2 = "";

                                    if(isset($_GET['page']))
                                    {
                                        $page = $_GET['page'];
                                    }

                                    //Kiểm tra trang bằng với trang hiện tại hoặc trang là trang đầu tiên
                                    if($page == 1)
                                    {
                                        $property1 = "disabled";
                                    }
                                    if($page == $totalOfPage)
                                    {
                                        $property2 = "disabled";
                                    }
                                    //Nếu lui lại 1 trang mà = 0 thì chuyển hướng
                                    /* if($page == 0)
                                     {
                                         header("location:index.php?page=1");
                                     }
                                     //Nếu tiến lên 1 trang mà > tổng số trang thì chuyển hướng
                                     if($page > $totalOfPage)
                                     {
                                         header("location:index.php?page=$totalOfPage");
                                     }*/
                                    ?>
                                    <div align="center">
                                        <ul class="pagination">
                                            <?php
                                            if($current_page == 1)
                                            {
                                                ?>
                                                <li class="<?=$property1?>"><span>«</span></li>
                                                <?php
                                            }else {
                                                ?>
                                                <li class="<?= $property1 ?>"><a
                                                            href="/admin/comment/?page=<?=$current_page-1?>">«</a></li>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            $active ="";
                                            for($i = 1; $i <= $totalOfPage; $i++) {
                                                if($i == $current_page)
                                                {
                                                    ?>
                                                    <li class="active">
                                                        <span href="/admin/comment/?page=<?= $i ?>"><?= $i ?></span>
                                                    </li>
                                                    <?php
                                                }
                                                else {
                                                    ?>
                                                    <li>
                                                        <a href="/admin/comment/?page=<?= $i ?>"><?= $i ?></a>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <?php
                                            if($current_page == $totalOfPage)
                                            {
                                                ?>
                                                <li class="<?=$property2?>"><span>»</span></li>
                                                <?php
                                            }else {
                                                ?>
                                                <li class="<?= $property2 ?>"><a
                                                            href="/admin/comment/?page=<?=$current_page+1?>">»</a></li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!--End Advanced Tables -->
                    </div>
                </div>
                <!-- /. ROW  -->
                <script type="text/javascript">
                    function active(status,id_news){
                        $.ajax({
                            url: '/templates/admin/assets/ajax/XuLyComment.php',
                            type: 'POST',
                            cache: false,
                            data:
                                {
                                    astatus: status,
                                    aid_news: id_news
                                },
                            success: function(data){
                                $('#active-'+id_news).html(data);
                            },
                            error: function (){
                                alert('Có lỗi xảy ra');
                            }
                        });
                        return false;
                    }
                </script>
            </div>
        </div>
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php';
        ?>

