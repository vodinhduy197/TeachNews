<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/library.php';
?>
<script type="text/javascript">
    document.title = "Quản lý người dùng";
</script>
<div class="wrapper" xmlns="http://www.w3.org/1999/html">
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/util/CheckType_User.php';
    ?>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <?php
                require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
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
            else if($msg == 0)
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
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Danh sách người dùng
                                </div>

                                <div class="panel-body">
                                    <div class="col-md-12" style="padding: 25px">
                                        <a class="btn-fill btn-wd" href="add.php"><i class="fa fa-plus-circle"></i>Thêm</a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th width="5%">ID</th>
                                                <th width="20%">Username</th>
                                                <th width="20%">Fullname</th>
                                                <th width="15%">Ảnh đại diện</th>
                                                <th width="10%">Chức vụ</th>
                                                <th width="10%">Quyền truy cập</th>
                                                <th width="20%">Chức năng</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                    $resultUser = $mysqli->query("SELECT * FROM user");
                                                while ($objUser = $resultUser->fetch_object()) {
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td><?=$objUser->user_id?></td>
                                                        <td>
                                                            <?=$objUser->username?>
                                                        </td>
                                                        <td><?=$objUser->fullname?></td>
                                                        <?php
                                                            if($objUser->avatar != "") {
                                                                ?>
                                                                <td ><img src="/templates/admin/files/avatar/<?=$objUser->avatar?>" width="150px"></td>
                                                                <?php
                                                            }
                                                            else {
                                                                ?>
                                                                <td>Không có hình ảnh</td>
                                                                <?php
                                                            }
                                                        ?>
                                                        <td><?=$objUser->type?></td>
                                                        <td align="center">
                                                            <span id="active-<?=$objUser->user_id?>" >
                                                                <?php
                                                                if($objUser->type != "admin" && $objUser->username != "admin") {
                                                                    ?>
                                                                    <a href="javascript:void(0)"
                                                                       onclick="active(<?= $objUser->active ?>,<?= $objUser->user_id ?>)">
                                                                     <?php
                                                                     if ($objUser->active == 1) {
                                                                         echo "<img src='/templates/admin/files/status/ac.png' alt=''/>";
                                                                     } else if ($objUser->active == 0) {
                                                                         echo "<img src='/templates/admin/files/status/de.png' alt=''/>";
                                                                     }
                                                                     ?>
                                                                 </a>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </span>
                                                        </td>
                                                        <?php
                                                            if($objUser->type == "admin" && $objUser->username == "admin" || $objUser->type == "admin") {
                                                                ?>
                                                        <td align="center">
                                                            <a href="edit.php?id=<?=$objUser->user_id?>" class="btn btn-primary"><i class="fa fa-pencil"></i>Sửa</a>
                                                        </td>
                                                                <?php
                                                            }else {
                                                                ?>
                                                                <td align="center">
                                                                    <a href="edit.php?id=<?=$objUser->user_id?>"
                                                                       class="btn btn-primary"><i class="fa fa-pencil"></i>Sửa</a>
                                                                    <a href="del.php?id=<?=$objUser->user_id?>"
                                                                       onclick="return confirm('Bạn có chắc chắn muốn xóa')"
                                                                       class="btn btn-danger"><i class="fa fa-trash"></i>Xóa</a>
                                                                </td>
                                                                <?php
                                                            }
                                                        ?>
                                                    </tr>
                                                    <?php
                                                }
                                            ?>
                                            </tbody>
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
        <script type="text/javascript">
            function active(status,id_user){
                $.ajax({
                    url: '/templates/admin/assets/ajax/XuLyUser.php',
                    type: 'POST',
                    cache: false,
                    data:
                        {
                            astatus: status,
                            aid_user: id_user
                        },
                    success: function(data){
                        $('#active-'+id_user).html(data);
                    },
                    error: function (){
                        alert('Có lỗi xảy ra');
                    }
                });
                return false;
            }
        </script>
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php';
        ?>

