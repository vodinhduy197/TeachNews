<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/library.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/util/CheckType_User.php';
?>
<script type="text/javascript">
    document.title = "Quản lý liên hệ";
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
        if(isset($_POST['btn_del'])) {
            if (isset($_POST['check'])) {
                $query = "DELETE FROM contact WHERE con_id IN(".implode(',',$_POST['check']).")";
                $result = $mysqli->query($query);
                if($result){
                    header('location: /admin/contact/?msg=1');
                }else{
                    header('location: /admin/contact/?msg=0');
                }
            }
        }
        ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="panel panel-default">
                                <!---start advance table--->
                                <div class="panel-heading">
                                    Danh sách danh mục
                                </div>
                                <form method="post" action="/admin/contact/">
                                <div class="panel-body">
                                    <div class="col-md-12" style="padding: 25px">
                                            <button name="btn_del" onclick="return confirm('Bạn có chắc chắn muốn xóa')" class="btn-link" ><i class="fa fa-trash"></i>Xóa</button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="5%"><input type="checkbox" name="checkAll" id="checkAll"></th>
                                                    <th width="5%">ID</th>
                                                    <th width="20%">Tên</th>
                                                    <th width="20%">Email</th>
                                                    <th width="35%">Nội dung</th>
                                                    <th width="15%">Chức năng</th>
                                                </tr>
                                            </thead>
                                                <tbody>
                                                <?php
                                                    $resultCon = $mysqli->query("SELECT * FROM contact");

                                                    while ($objCon = $resultCon->fetch_object()) {
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td><input type="checkbox" name="check[]" value="<?=$objCon->con_id?>"></td>
                                                            <!--id-->
                                                            <td><?=$objCon->con_id?></td>
                                                            <!--tên người liên hệ-->
                                                            <td>
                                                                <?=$objCon->name?>
                                                            </td>
                                                            <!--email người liên hệ-->
                                                            <td>
                                                                <?=$objCon->email?>
                                                            </td>
                                                            <!--Nội dung tin nhắn-->
                                                            <td>
                                                                <?=$objCon->message?>
                                                            </td>
                                                            <!--Chức năng-->
                                                            <td align="center">
                                                                <a href="del.php?id=<?=$objCon->con_id?>"
                                                                   onclick="return confirm('Bạn có chắc chắn muốn xóa')"
                                                                   class="btn btn-danger "><i class="fa fa-trash-o"></i>Xóa
                                                                </a>
                                                            </td>

                                                        </tr>
                                                        <?php
                                                    }
                                                ?>
                                                </tbody>
                                        </table>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <script type="text/javascript">
            //-Script xử lý checkbox chọn tất cả-->
              $("#checkAll").click(function(){
                $('input:checkbox').not(this).prop('checked', this.checked);
                });
        </script>
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php';
        ?>

