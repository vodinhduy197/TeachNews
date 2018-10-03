<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/library.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/util/CheckType_User.php';
?>
<script type="text/javascript">
    document.title = "Thêm người dùng";
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
            if(isset($_POST['submit']))
            {
                $username = strip_tags($_POST['username']);//xóa các thẻ hmtl trong textbox
                $password = md5($_POST['password']);
                $fullname = $_POST['fullname'];
                $type = $_POST['role'];

                $queryCheck = "SELECT COUNT(username) AS total FROM user WHERE username = '{$username}'";
                $resultCheck = $mysqli->query($queryCheck);
                $arCheck = mysqli_fetch_assoc($resultCheck);

                if ($arCheck['total'] != 0) {
                    echo "<script>alert('Username đã tồn tại!!!');</script>";
                } else {
                    $queryAddUser = "INSERT INTO user(username, password, fullname, `type`) 
                                                                  VALUES ('{$username}', '{$password}', '{$fullname}', '{$type}')";
                    $resultAddUser = $mysqli->query($queryAddUser);
                    if ($resultAddUser) {
                        echo "<script>alert('Thêm thành công!!!');</script>";
                    } else {
                        echo "<script>alert('Có lỗi trong quá trình xử lý!!!');</script>";
                    }
                }


            }
        ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        Thêm người dùng
                                    </div>
                                    <div class="panel-body">
                                        <form role="form" action="" method="post">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input class="form-control" type="text" name="username" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input class="form-control" type="password" name="password" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Họ và tên</label>
                                                <input class="form-control" type="text" name="fullname" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Chức vụ</label>
                                                <select class="form-control" name="role">
                                                    <option value="mod">Mod</option>
                                                </select>
                                            </div>
                                            <input type="submit" name="submit" value="Thêm" class="btn btn-info">
                                        </form>
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

