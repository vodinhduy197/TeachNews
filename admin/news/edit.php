<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/library.php';
?>
<script type="text/javascript">
    document.title = "Chỉnh sửa tin tức";
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

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Sửa tin tức
                                </div>
                                <?php
                                $id = "";
                                if(isset($_GET['id']))
                                {
                                    $id = $_GET['id'];
                                }
                                $resultNews = $mysqli->query("SELECT * FROM news WHERE news_id = {$id}");
                                $arNews = mysqli_fetch_assoc($resultNews);
                                $queryUpdateNews = "";
                                if(isset($_POST['submit'])) {
                                    $newsName = $_POST['name'];
                                    $catId = $_POST['cat'];
                                    $detail = $_POST['detail'];
                                    $description = $_POST['news_preview'];

                                    //--------------Kiểm tra xem có xóa ảnh của tin không-----------
                                    if (isset($_POST['check'])) {
                                        //Xóa ảnh cũ
                                        $urlDel = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $arNews['picture'];
                                        unlink($urlDel);
                                        //Nếu có ảnh mới thì upload file
                                        $fileName = $_FILES['picture']['name'];
                                        //-----------upload file------------------
                                        if ($fileName != '') {
                                            $arFileName = explode('.', $fileName);
                                            $duoiFile = end($arFileName);
                                            $fileName = "TechNews-" . time() . '.' . $duoiFile;

                                            $tmp_Name = $_FILES['picture']['tmp_name'];
                                            $pathUpload = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $fileName;
                                            move_uploaded_file($tmp_Name, $pathUpload);
                                            //---------Thực hiện câu lệnh update----------------
                                            $queryUpdateNews = "UPDATE news
                                                                SET news_name = '{$newsName}', 
                                                                    cat_id = {$catId},
                                                                    picture = '{$fileName}',
                                                                    news_preview = '{$description}',
                                                                    news_detail = '{$detail}'
                                                                WHERE news_id = {$id}";

                                        } else {
                                            echo "<script>alert('Bạn chưa chọn ảnh tin tức');</script>";
                                        }
                                    } else {
                                        $fileName = $_FILES['picture']['name'];
                                        //upload file
                                        if ($fileName != '') {
                                            $arFileName = explode('.', $fileName);
                                            $duoiFile = end($arFileName);
                                            $fileName = "TechNews-" . time() . '.' . $duoiFile;

                                            $tmp_Name = $_FILES['picture']['tmp_name'];
                                            $pathUpload = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $fileName;
                                            move_uploaded_file($tmp_Name, $pathUpload);
                                            //---------Thực hiện câu lệnh update----------------
                                            $queryUpdateNews = "UPDATE news
                                                                SET news_name = '{$newsName}', 
                                                                    cat_id = {$catId},
                                                                    picture = '{$fileName}',
                                                                    news_preview = '{$description}',
                                                                    news_detail = '{$detail}'
                                                                WHERE news_id = {$id}";
                                        } else {

                                            //------------------------------------------------
                                            $queryUpdateNews = "UPDATE news
                                                                SET news_name = '{$newsName}', 
                                                                    cat_id = {$catId},
                                                                    picture = '{$arNews['picture']}',
                                                                    news_preview = '{$description}',
                                                                    news_detail = '{$detail}'
                                                                WHERE news_id = {$id}";
                                        }
                                    }
                                    $resultUpdateNews = $mysqli->query($queryUpdateNews);
                                    //-----------------Kiểm tra câu lệnh truy vấn-----------------
                                    /*echo "----------------";
                                    var_dump($resultUpdateNews);
                                    die();*/
                                    if ($resultUpdateNews) {
                                        echo "<script>
                                                    if(confirm('Chỉnh sửa thành công Chuyển huóng về trang quản lý tin tức') == true)
                                                        window.location='/admin/news';
                                                </script>";
                                       // header("location:/admin/news");
                                    } else {
                                        echo "<script>alert('Có lỗi trong quá trình xử lý');</script>";
                                    }
                                }
                                ?>
                                <div class="panel-body">
                                    <form role="form" action="" enctype="multipart/form-data" method="post" id="frmEdit">
                                        <!----------------------Tên tin------------------------------->
                                        <div class="form-group">
                                            <label>Tên tin</label>
                                            <input class="form-control" type="text" name="name" value="<?=$arNews['news_name']?>" required>
                                            <p class="help-block">
                                                <i style="color:red"></i>
                                            </p>
                                        </div>
                                        <!--------------------danh mục---------------------->
                                        <div class="form-group">
                                            <label>Danh mục</label>
                                            <select class="form-control" name="cat">
                                                <?php
                                                $resultCat = $mysqli->query("SELECT * FROM cat_list");
                                                while ($objCat = $resultCat->fetch_object()) {
                                                    if($arNews['cat_id'] == $objCat->cat_id) {
                                                        ?>
                                                        <option value="<?= $objCat->cat_id ?>" name="cat" selected="selected"><?= $objCat->cat_name ?></option>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                        <option value="<?= $objCat->cat_id ?>" name="cat"><?= $objCat->cat_name ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <p class="help-block"></p>
                                        </div>
                                        <!--------------------ảnh cũ--------------------->
                                        <div class="form-group">
                                            <img src="/files/<?=$arNews['picture']?>" alt="Ảnh cũ" width="200px">
                                            <input type="checkbox" name="check" value=""><span>Xóa ảnh cũ</span>
                                        </div>
                                        <!--------------------Chọn ảnh mới---------------------->
                                        <div class="form-group">
                                            <label>Hình ảnh</label>
                                            <input type="file" name="picture" >
                                            <p class="help-block"></p>
                                        </div>
                                        <!--------------------Mô tả---------------------->
                                        <div class="form-group">
                                            <label>Mô tả</label>
                                            <textarea class="form-control" rows="3" name="news_preview"  required><?=$arNews['news_preview']?></textarea>
                                        </div>
                                        <!--------------------Chi tiết---------------------->
                                        <div class="form-group">
                                            <label>Chi tiết</label>
                                            <textarea class="form-control" rows="7" name="detail"  required><?=$arNews['news_detail']?></textarea>
                                        </div>
                                        <input type="submit" name="submit" value="Chỉnh sửa" class="btn btn-info btn-fill">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            CKEDITOR.replace( 'detail',
                {
                    filebrowserBrowseUrl : '/library/ckfinder/ckfinder.html',
                    filebrowserImageBrowseUrl : '/library/ckfinder/ckfinder.html?type=Images',
                    filebrowserFlashBrowseUrl : '/library/ckfinder/ckfinder.html?type=Flash',
                    filebrowserUploadUrl : '/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                    filebrowserImageUploadUrl : '/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                    filebrowserFlashUploadUrl : '/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

                });
        </script>
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php';
        ?>

