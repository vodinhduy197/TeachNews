<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/library.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/util/text_limit.php';
?>
<script type="text/javascript">
    document.title = "Quản lý danh mục";
</script>
<div class="wrapper" xmlns="http://www.w3.org/1999/html">
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php';
    ?>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <?php
                require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
                require_once $_SERVER['DOCUMENT_ROOT'].'/util/CheckType_User.php';
                ?>
            </div>
        </nav>
        <?php
            $msg = "";
            if(isset($_GET['msg']))
            {
                $msg = $_GET['msg'];
                if($msg == 1)
                {
                    ?>
                    <script>
                        alert("Xóa thành công");
                    </script>
                    <?php
                }
                elseif ($msg == 2)
                {
                    ?>
                    <script>
                        alert("Cập nhật thành công");
                    </script>
                    <?php
                }
                elseif ($msg == 3)
                {
                    ?>
                    <script>
                        alert("Có lỗi trong quá trình xử lý");
                    </script>
                    <?php
                }
            }

        ?>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="panel panel-default">
                            <!-start advance table->
                            <div class="panel-heading">
                                Danh sách danh mục
                            </div>
                            <div class="col-md-12" style="padding-bottom: 25px">
                                <a class="btn-fill btn-wd" href="add.php"><i class="fa fa-plus-circle"></i>Thêm</a>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="20%">ID Danh mục</th>
                                            <th width="30%">Tên Danh mục</th>
                                            <th width="30%">Vị trí hiển thị</th>
                                            <th width="20%">Chức năng</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                            $cat_id = "";
                                            $results = $mysqli->query("SELECT * FROM cat_list WHERE parent_id = 0 ORDER BY cat_id ASC");
                                            while($obj = $results->fetch_object()) {
                                                $cat_id = $obj->cat_id;
                                                $cat_name = $obj->cat_name;
                                                $parent_id = $obj->parent_id;
                                                //--------------------------------------------------------//
                                                $resultCount = $mysqli->query("SELECT COUNT(news_id) AS count FROM news WHERE cat_id = {$cat_id}");
                                                $objCount = $resultCount->fetch_object();
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><?=$cat_id?></td>
                                                    <td>
                                                        <!--thực hiện đệ quy ở đây-->
                                                        <?=$cat_name?><span class="count_news"><?=$objCount->count?> bài viết</span> <!--menu cha-->
                                                        <ul style="list-style:none">
                                                            <?php
                                                            $queryCatCon ="SELECT * FROM cat_list WHERE parent_id = {$cat_id}";
                                                            $resultCatCon = $mysqli->query($queryCatCon);
                                                            while ($objCon = $resultCatCon->fetch_object()) {
                                                                $cat_id1 = $objCon->cat_id;
                                                                $resultCount1 = $mysqli->query("SELECT COUNT(news_id) AS count FROM news WHERE cat_id = {$cat_id1}");
                                                                $objCount1 = $resultCount1->fetch_object();
                                                                ?>
                                                                <li>
                                                                    <span style="color: #ffacb4"><?=$objCon->cat_name?></span>
                                                                    <span class="count_news"><?=$objCount1->count?> bài viết</span> <!--menu con-->
                                                                    <a href="del.php?id=<?=$objCon->cat_id?>"
                                                                       onclick="return confirm('Bạn có chắc chắn muốn xóa???\nTất cả các tin tức có trong danh mục này sẽ xóa theo!!!')"
                                                                       class="fa fa-trash-o"></a>
                                                                    <a href="edit.php?id=<?=$objCon->cat_id?>"
                                                                       class="fa fa-pencil"></a>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>

                                                        </ul>
                                                    </td>
                                                    <td align="center">
                                                        <form action="" method="post">
                                                            <select name="position-<?=$cat_id?>">
                                                                <?php
                                                                for ($i = 0; $i <= mysqli_num_rows($results); $i++) {

                                                                    if ($obj->sort == $i) {
                                                                        if($i == 0)
                                                                        {
                                                                            ?>
                                                                            <option value="<?= $i ?>" selected="selected">Chọn vị trí</option>
                                                                            <?php
                                                                        }
                                                                        else{
                                                                            ?>
                                                                            <option value="<?= $i ?>" selected="selected"><?= $i ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    else {
                                                                        $kq = "";
                                                                        if($i==0) {
                                                                            $kq = "Chọn vị trí";
                                                                        }else
                                                                        {
                                                                            $kq = $i;
                                                                        }
                                                                            ?>
                                                                            <option value="<?= $i ?>"><?= $kq ?></option>
                                                                            <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                            <?php
                                                            $value = "";
                                                            if(isset($_POST['sort']))
                                                            {
                                                                if(isset($_POST['position-'.$cat_id]))
                                                                {
                                                                    $value = $_POST['position-'.$cat_id];
                                                                    header("location:position.php?value=$value&id=$cat_id");
                                                                }
                                                            }
                                                            ?>
                                                            <button  name="sort"  onclick="return confirm('Bạn có chắc thay đổi vị trí danh mục không??')" class="btn btn-primary"><i class="fa fa-pencil"></i>Thay đổi</button>
                                                        </form>

                                                    </td>
                                                    <td align="center">
                                                        <a href="edit.php?id=<?=$cat_id?>" class="btn btn-primary"><i class="fa fa-pencil"></i>Sửa</a>
                                                        <a href="del.php?id=<?=$cat_id?>" onclick="return confirm('Bạn có chắc chắn muốn xóa???\nTất cả các tin tức có trong danh mục này sẽ xóa theo!!!')"
                                                           class="btn btn-danger "><i class="fa fa-trash-o"></i>Xóa</a>
                                                    </td>

                                                </tr>

                                                <?php
                                            }
                                        ?>
                                        </tbody>
                                        <style>
                                            .count_news{
                                                color: #fff !important;
                                                background: #20A783;
                                                border-radius: 10px;
                                                padding: 0 5px;
                                                margin-left: 10px;
                                            }
                                        </style>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--End Advanced Tables -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <?php
        require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php';
        ?>

