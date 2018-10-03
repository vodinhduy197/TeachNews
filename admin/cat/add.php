<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/library.php';
?>
<script type="text/javascript">
    document.title = "Thêm danh mục";
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
                $cat_name = $_POST['cat_name'];
                $cat_list = $_POST['cat_list'];
                $resultCatInsert = $mysqli->query("INSERT INTO cat_list(cat_name, parent_id)
                                                          VALUES ('$cat_name',$cat_list)");
                if($resultCatInsert)
                {
                    echo "<script>alert('Thêm thành công');</script>";
                }else
                {
                    echo "<script>alert('Có lỗi trong quá trình xử lý');</script>";
                }
            }
        ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Danh sách danh mục</h4>
                                <div class="content">
                                    <form action="" method="post" id="frmAdd">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Tên danh mục</label>
                                                    <input type="text" name="cat_name" class="form-control border-input" placeholder="Tên danh mục" value="" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Danh mục cha</label>
                                                    <select name="cat_list" class="form-control border-input">
                                                        <option value="0">Không</option>
                                                        <?php
                                                        $resultCat = $mysqli->query("SELECT * FROM cat_list WHERE parent_id = 0");
                                                        //trả về một đối tượng
                                                        while($objCat = $resultCat->fetch_object()) {
                                                            ?>
                                                            <option value="<?=$objCat->cat_id?>"><?=$objCat->cat_name?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button name="submit" type="submit" class="btn btn-info btn-fill " ><i class="fa fa-plus-circle"></i>Thêm</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
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

