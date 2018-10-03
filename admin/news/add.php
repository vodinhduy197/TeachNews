<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/library.php';
?>
<script type="text/javascript">
    document.title = "Thêm tin tức";
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
                                    Thêm tin
                                </div>
                                <?php
                                //upload=>upload file lên server
                                //khong upload file =>picture =''
                                $id_user = "";
                                if(isset($_SESSION['userInfo']))
                                {
                                    $id_user = $_SESSION['userInfo']['user_id'];
                                }
                                if(isset($_POST['submit']))
                                {
                                    $newsName = $_POST['name'];
                                    $catId = $_POST['cat'];
                                    $detail = $_POST['detail'];
                                    $description = $_POST['preview_text'];

                                    /*echo"<pre>";
                                        print_r($_FILES['hinhanh']);
                                    die();*/
                                    $fileName = $_FILES['picture']['name'];
                                    //upload file
                                    if($fileName != '')
                                    {
                                        $arFileName = explode('.',$fileName);
                                        $duoiFile = end($arFileName);
                                        $fileName = "TechNews-".time().'.'.$duoiFile;

                                        $tmp_Name = $_FILES['picture']['tmp_name'];
                                        $pathUpload = $_SERVER['DOCUMENT_ROOT'].'/files/'.$fileName;
                                        move_uploaded_file($tmp_Name, $pathUpload);
                                    }
                                    $queryAddNews = "INSERT INTO news(news_name, news_preview, news_detail, picture, cat_id, created_by)
                                                          VALUES ('{$newsName}', '{$description}', '{$detail}', '{$fileName}', {$catId}, {$id_user})";
                                    $resultAddNews = $mysqli->query($queryAddNews);
                                    if($resultAddNews)
                                    {
                                        echo "<script>alert('Thêm thành công');</script>";
                                    }else
                                    {
                                        echo "<script>alert('Có lỗi trong quá trình xử lý');</script>";
                                    }
                                }
                                ?>
                                <div class="panel-body">
                                    <form role="form" action="/admin/news/add.php" enctype="multipart/form-data" method="post" id="frmAdd">
                                        <div class="form-group">
                                            <label>Tên tin</label>
                                            <input class="form-control" type="text" name="name" value="" required>
                                            <p class="help-block">
                                                <i style="color:red"></i>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Danh mục</label>
                                            <select class="form-control" name="cat">
                                                <?php
                                                $resultCat = $mysqli->query("SELECT * FROM cat_list");
                                                while ($objCat = $resultCat->fetch_object()) {
                                                    ?>
                                                    <option value="<?=$objCat->cat_id?>"><?=$objCat->cat_name?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <p class="help-block"></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Hình ảnh</label>
                                            <input type="file" name="picture" value="" id="profile-img" required>
                                            <img src="" width="100px"  id="profile-img-tag"/>
                                            <p class="help-block"></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả</label>
                                            <textarea class="form-control" rows="3" name="preview_text" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Chi tiết</label>
                                            <textarea class="form-control" rows="7" name="detail" required></textarea>
                                        </div>
                                        <input type="submit" name="submit" value="Thêm" class="btn btn-info btn-fill">
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

