<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/library.php';
?>
<script type="text/javascript">
    document.title = "Sửa danh mục";
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
            $id = 0;
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
            if(isset($_POST['submit']))
            {
                $cat_name = $_POST['cat_name'];
                $cat_list = $_POST['cat_list'];
                $resultCatEdit = $mysqli->query("UPDATE cat_list
                                                        SET cat_name = '{$cat_name}', parent_id = {$cat_list}
                                                        WHERE cat_id = {$id}");
                if($resultCatEdit)
                {
                    echo "<script>alert('Sửa thành công');</script>";
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
                                    <form action="" method="post" id="frmEdit">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Tên danh mục</label>
                                                    <?php
                                                        $resultCat1 = $mysqli->query("SELECT * FROM cat_list WHERE cat_id = {$id}");
                                                        $objCat1 = $resultCat1->fetch_object();
                                                   /* echo "<pre>";
                                                    print_r($objCat1->parent_id);
                                                    echo "<br/>";*/
                                                    ?>
                                                    <input type="text" name="cat_name" class="form-control border-input" placeholder="Tên danh mục" value="<?=$objCat1->cat_name?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Danh mục tin tức</label>
                                                    <select name="cat_list" class="form-control border-input">
                                                        <option value="0">Không</option>

                                                        <?php
                                                        $resultCat2 = $mysqli->query("SELECT * FROM cat_list WHERE parent_id = 0");
                                                        //trả về một đối tượng
                                                        $selected = "";
                                                        while($objCat2 = $resultCat2->fetch_object()) {
                                                            if($objCat1->parent_id == $objCat2->cat_id)
                                                            {
                                                            ?>
                                                                <option value="<?=$objCat2->cat_id?>" <?=$selected?> selected="selected"><?=$objCat2->cat_name?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                            <option value="<?=$objCat2->cat_id?>" <?=$selected?> ><?=$objCat2->cat_name?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button name="submit" type="submit" class="btn btn-info btn-fill btn-wd" onclick="return confirm('Bạn có chắc chắn chỉnh sửa?')"><i class="fa fa-pencil"></i>Chỉnh sửa</button>
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

