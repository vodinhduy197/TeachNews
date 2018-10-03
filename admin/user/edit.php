<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/library.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/util/CheckType_User.php';
?>
<script type="text/javascript">
    document.title = "Chỉnh sửa người dùng";
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
                ?>
            </div>
        </nav>
        <?php
            $id = "";
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
            $resultUser = $mysqli->query("SELECT * FROM user WHERE user_id = {$id}");
            $objUser = $resultUser->fetch_object();
            $avatarOld = $objUser->avatar;
            if(isset($_POST['submit']))
            {
                $password = $_POST['password'];
                $fullname = $_POST['fullname'];
                $type = $_POST['type'];

                $fileName = $_FILES['avatar']['name'];
                /*print_r($fileName);
                die();*/
            //upload file

                    if ($fileName != '') {
                        if($password != "") {

                            $arFileName = explode('.', $fileName);
                            $duoiFile = end($arFileName);
                            $fileName = "Avatar-" . time() . '.' . $duoiFile;
                            /*print_r($fileName);
                                            die();*/
                            $tmp_Name = $_FILES['avatar']['tmp_name'];
                            $pathUpload = $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/files/avatar/' . $fileName;
                            move_uploaded_file($tmp_Name, $pathUpload);
                            //----------Xóa ảnh cũ-------------------------
                            $urlDel = $_SERVER['DOCUMENT_ROOT'] . "/templates/admin/files/avatar/" . $avatarOld;
                            unlink($urlDel);
                            //---------Thực hiện câu lệnh update----------------
                            $queryUpdateUser = "UPDATE user
                                        SET `password` = md5('{$password}'), 
                                            `fullname` = '{$fullname}',
                                            `avatar` = '{$fileName}',
                                            `type` = '{$type}'                                                       
                                        WHERE user_id = {$id}";
                            $resultUpdateUser = $mysqli->query($queryUpdateUser);
                            //-----------------Kiểm tra câu lệnh truy vấn-----------------
                            if ($resultUpdateUser) {
                                echo "<script>alert('Chỉnh sửa thành công');</script>";
                            } else {
                                echo "<script>alert('Có lỗi trong quá trình xử lý');</script>";
                            }
                        }
                        else
                        {
                            $arFileName = explode('.', $fileName);
                            $duoiFile = end($arFileName);
                            $fileName = "Avatar-" . time() . '.' . $duoiFile;

                            $tmp_Name = $_FILES['avatar']['tmp_name'];
                            $pathUpload = $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/files/avatar/' . $fileName;
                            move_uploaded_file($tmp_Name, $pathUpload);
                            //----------Xóa ảnh cũ-------------------------
                            $urlDel = $_SERVER['DOCUMENT_ROOT'] . "/templates/admin/files/avatar/" . $avatarOld;
                            unlink($urlDel);
                            //---------Thực hiện câu lệnh update----------------
                            $queryUpdateUser = "UPDATE user
                                        SET  
                                            `fullname` = '{$fullname}',
                                            `avatar` = '{$fileName}',
                                            `type` = '{$type}'                                                       
                                        WHERE user_id = {$id}";
                            $resultUpdateUser = $mysqli->query($queryUpdateUser);
                            //-----------------Kiểm tra câu lệnh truy vấn-----------------
                            if ($resultUpdateUser) {
                                echo "<script>alert('Chỉnh sửa thành công');</script>";
                            } else {
                                echo "<script>alert('Có lỗi trong quá trình xử lý');</script>";
                            }
                        }
                    } else {
                        if($password != "") {
                            $queryUpdateUser = "UPDATE user
                                        SET `password` = md5('{$password}'), 
                                            `fullname` = '{$fullname}',
                                            `avatar` = '{$avatarOld}',
                                            `type` = '{$type}'                                                       
                                        WHERE user_id = {$id}";
                            $resultUpdateUser = $mysqli->query($queryUpdateUser);
                            //-----------------Kiểm tra câu lệnh truy vấn-----------------
                            if ($resultUpdateUser) {
                                echo "<script>alert('Chỉnh sửa thành công');</script>";
                            } else {
                                echo "<script>alert('Có lỗi trong quá trình xử lý');</script>";
                            }
                        }
                        else
                        {
                            $queryUpdateUser = "UPDATE user
                                        SET 
                                            `fullname` = '{$fullname}',
                                            `avatar` = '{$avatarOld}',
                                            `type` = '{$type}'                                                       
                                        WHERE user_id = {$id}";
                            $resultUpdateUser = $mysqli->query($queryUpdateUser);
                            //-----------------Kiểm tra câu lệnh truy vấn-----------------
                            if ($resultUpdateUser) {
                                echo "<script>alert('Chỉnh sửa thành công');</script>";
                            } else {
                                echo "<script>alert('Có lỗi trong quá trình xử lý');</script>";
                            }
                        }
                    }

            }


        ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Sửa thông tin</h4>
                            </div>
                            <div class="content">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>username</label>
                                                <input type="text" name="username" class="form-control border-input" readonly="" value="<?=$objUser->username?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control border-input" placeholder="Password" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Họ tên</label>
                                                <input type="text" name="fullname" class="form-control border-input" placeholder="Họ tên" value="<?=$objUser->fullname?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Ảnh đại diện</label>
                                            <div class="form-group">
                                                <img src="/templates/admin/files/avatar/<?=$objUser->avatar?>" width="120px" alt="Ảnh đại diện">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Loại quyền</label>
                                                <select name="type" class="form-control border-input">
                                                    <?php
                                                        if($objUser->username == "admin")
                                                        {
                                                    ?>
                                                            <option value="admin">admin</option>
                                                    <?php
                                                        }else{
                                                    ?>
                                                            <option selected="selected" value="mod">mod</option>
                                                            <option value="admin">admin</option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Hình ảnh</label>
                                                <input type="file" name="avatar" class="form-control" id="profile-img"><br>
                                                <img src="" width="100px" id="profile-img-tag">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <input name="submit" type="submit" class="btn btn-info btn-fill btn-wd" value="Chỉnh sửa">
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#profile-img-tag').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#profile-img").change(function(){
                readURL(this);
            });
        </script>
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php';
        ?>

