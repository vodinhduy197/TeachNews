<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/library.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/util/ConstantUtil.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/util/Utf8ToLatinUtil.php';
?>
<script type="text/javascript">
    document.title = "Quản lý tin tức";
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
        <!--Phân trang-->
        <?php
        $id_user ="";
        $queryTotalOfRow = "";
        if($_SESSION['userInfo']['type']=="mod") {
            $id_user = $_SESSION['userInfo']['user_id'];
            //query tổng số dòng, TOL = Total Of Row
            $queryTotalOfRow = "SELECT COUNT(*) AS TOR FROM news WHERE created_by = {$id_user}";
        }
        elseif($_SESSION['userInfo']['type']=="mod" && isset($_GET['search']))
        {
            $id_user = $_SESSION['userInfo']['user_id'];
            //query tổng số dòng, TOL = Total Of Row
            if(isset($_GET['timkiem']))
            {
                $search = $_GET['timkiem'];
                $queryTotalOfRow = "SELECT COUNT(*) AS TOR FROM news WHERE created_by = {$id_user} AND news_name like '%{$search}%'";
            }
        }
        else if(isset($_GET['search']))
        {
            if(isset($_GET['timkiem'])) {
                $search = $_GET['timkiem'];
                $queryTotalOfRow = "SELECT COUNT(*) AS TOR FROM news WHERE news_name like '%{$search}%'";
            }
        }
        else
        {
            $queryTotalOfRow = "SELECT COUNT(*) AS TOR FROM news ";
        }
        $resultTotalOfRow = $mysqli->query($queryTotalOfRow);
        $current_page = 1;
        $arTmp = mysqli_fetch_assoc($resultTotalOfRow);
        $totalOfRow = $arTmp['TOR'];
        //Biến tổng số dòng
        $row_count = ROW_COUNT;

            if(isset($_GET['number']))
            {
                $row_count = $_GET['number'];
                $resultUpdateRow=$mysqli->query("UPDATE `row` SET `row`=$row_count WHERE `id_row` = 1");
            }

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
        <!--Kết thúc phân trang-->


        <!---->

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
        //-----------------Xóa nhiều
        if(isset($_POST['btn_del'])) {
            if (isset($_POST['check'])) {
                $a = $_POST['check'];
                foreach ($a as $key=>$val)
                {
                    $resultUn = $mysqli->query("SELECT * FROM news WHERE news_id = {$val}");
                    $objUn = $resultUn->fetch_object();
                    $pictureOld = $objUn->picture;

                    $urlDel = $_SERVER['DOCUMENT_ROOT'].'/files/'.$pictureOld;
                    unlink($urlDel);

                }

                $query = "DELETE FROM news WHERE news_id IN(".implode(',',$_POST['check']).")";
                $result = $mysqli->query($query);
                if($result){
                    header('location: /admin/news/?msg=1');
                }else{
                    header('location: /admin/news/?msg=0');
                }
            }
        }
        ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="col-md-12">
                                <!-- Advanced Tables -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Danh sách tin
                                    </div>
                                    <form action="/admin/news/" method="get">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="timkiem" class="form-control border-input" placeholder="Tìm kiếm theo tên tin tức" value="">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <button type="submit" name="search" class="btn btn-info"><i class="fa fa-search"></i>Tìm kiếm</button>
                                                    <a type="button" name="cancel"  class="btn btn-exit" href="/admin/news/" ><i class="fa fa-times-circle"></i>Hủy tìm kiếm</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <input type="number" name="number" value="<?=$row_count?>" >
                                            <button type="submit" >Hiển thị</button>
                                        </div>
                                    </form>
                                    <form method="post">
                                        <div class="col-md-12" style="padding: 25px">
                                            <a class="btn-fill btn-wd" href="add.php"><i class="fa fa-plus-circle"></i>Thêm</a>
                                            <button class="btn-link" name="btn_del" onclick="return confirm('Bạn có chắc chắn xóa những tin này!!!')"><i class="fa fa-trash-o"></i>Xóa</button>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td width="5%"><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                        <th width="5%">ID Tin</th>
                                                        <th width="30%">Tên Tin</th>
                                                        <th width="10%">Danh mục</th>
                                                        <th width="10%">Hình ảnh</th>
                                                        <th width="10%">Người đăng</th>
                                                        <th width="10%">Trạng thái</th>
                                                        <th width="20%">Chức năng</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $id_user ="";
                                                    $resultNews = "";
                                                    $status = "";
                                                    $id = "";
                                                    //Chức năng tìm kiếm
                                                    $search ="";
                                                    if($_SESSION['userInfo']['type']=="mod") {
                                                        //In ra các danh sách tin tức theo giá trị tìm kiếm và của người đăng tin
                                                        if (isset($_GET['search'])) {
                                                            if(isset($_GET['timkiem'])) {
                                                                $search = $_GET['timkiem'];
                                                                $id_user = $_SESSION['userInfo']['user_id'];
                                                                $resultNews = $mysqli->query("SELECT * FROM news 
                                                                                                        INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
                                                                                                        INNER JOIN user ON news.created_by = user.user_id
                                                                                                        WHERE user_id = {$id_user} and news_name like '%{$search}%'
                                                                                                        ORDER BY news_id DESC
                                                                                                        LIMIT {$offset},{$row_count}");
                                                            }
                                                        }
                                                        //In ra các danh sách tin tức  của người đăng tin
                                                        else{
                                                            $id_user = $_SESSION['userInfo']['user_id'];
                                                            $resultNews = $mysqli->query("SELECT * FROM news 
                                                                                                        INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
                                                                                                        INNER JOIN user ON news.created_by = user.user_id
                                                                                                        WHERE user_id = {$id_user}
                                                                                                        ORDER BY news_id DESC
                                                                                                        LIMIT {$offset},{$row_count}");
                                                        }
                                                    }//In ra các danh sách tin tức theo giá trị tìm kiếm và của người đăng tin(admin)
                                                    else
                                                    {
                                                        if (isset($_GET['search'])) {
                                                            if(isset($_GET['timkiem'])) {
                                                                $search = $_GET['timkiem'];
                                                                $id_user = $_SESSION['userInfo']['user_id'];
                                                                $resultNews = $mysqli->query("SELECT * FROM news 
                                                                                                        INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
                                                                                                        INNER JOIN user ON news.created_by = user.user_id
                                                                                                        WHERE news_name like '%{$search}%'
                                                                                                        ORDER BY news_id DESC
                                                                                                        LIMIT {$offset},{$row_count}");
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $resultNews = $mysqli->query("SELECT * FROM news 
                                                                                                        INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
                                                                                                        INNER JOIN user ON news.created_by = user.user_id
                                                                                                        ORDER BY news_id DESC
                                                                                                        LIMIT {$offset},{$row_count}");
                                                        }
                                                    }
                                                    //---------------------------------------

                                                    while ($objNews = $resultNews->fetch_object()) {
                                                        $id = $objNews->news_id;
                                                        $name_seoNews = to_slug($objNews->news_name);
                                                        $urlReduceNews ='/chi-tiet/'.$name_seoNews.'-'.$id.'.html';
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td><input type="checkbox" name="check[]" value="<?=$objNews->news_id?>"></td>
                                                            <td><?=$objNews->news_id?></td>
                                                            <!----------------Tên tin---------------->
                                                            <td>
                                                                <a href="<?=$urlReduceNews?>">
                                                                    <?=$objNews->news_name?>
                                                                </a>
                                                            </td>
                                                            <!---------------Danh mục tin--------------->
                                                            <td>
                                                                <?=$objNews->cat_name?>
                                                            </td>
                                                            <!--------------Hình ảnh của tin--------------->
                                                            <td>
                                                                <img src="/files/<?=$objNews->picture?>" width="120px" alt="">
                                                            </td>
                                                            <!--------------Người đăng tin--------------->
                                                            <td>
                                                                <?=$objNews->fullname?>
                                                            </td>
                                                            <!-----------------Trạng thái của tin------------->
                                                            <td class="center" align="center">
                                                                 <span id="active-<?=$objNews->news_id?>" >
                                                                     <a href="javascript:void(0)" onclick="active(<?=$objNews->is_slide?>,<?=$objNews->news_id?>)">
                                                                         <?php
                                                                         if($objNews->is_slide == 1)
                                                                         {
                                                                             echo "<img src='/templates/admin/files/status/ac.png' alt=''/>";
                                                                         }
                                                                         else if($objNews->is_slide == 0)
                                                                         {
                                                                             echo "<img src='/templates/admin/files/status/de.png' alt=''/>";
                                                                         }
                                                                         ?>

                                                                     </a>
                                                                </span>
                                                            </td>
                                                            <!------------------Chức năng--------------->
                                                            <td align="center">
                                                                <a href="/admin/news/edit.php?id=<?=$objNews->news_id?>" class="btn btn-primary"><i
                                                                            class="fa fa-pencil"></i>Sửa</a>
                                                                <a href="/admin/news/del.php?id=<?=$objNews->news_id?>"
                                                                   onclick="return confirm('Bạn có chắc chắn muốn xóa')"
                                                                   class="btn btn-danger"><i
                                                                            class="fa fa-trash"></i>Xóa</a>
                                                            </td>

                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                    </form>
                                    <div align="center">
                                        <?php
                                        require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/paganition.php';
                                        $config = [
                                            'total' => $totalOfRow,
                                            'limit' => $row_count,
                                            'full' => false, //bỏ qua nếu không muốn hiển thị full page
                                            //'querystring' => 'trang' //bỏ qua nếu GET của bạn là page
                                        ];
                                        $page = new Pagination($config);
                                        //hiển thị code
                                        echo $page->getPagination();
                                        ?>
                                    </div>
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

<!--Sử dụng ajax để active hoặc nonactive-->
<script type="text/javascript">
    //-Script xử lý checkbox chọn tất cả-->
    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    //hàm xử lý ajax
    function active(status,id_news){
        $.ajax({
            url: '/templates/admin/assets/ajax/XuLyNews.php',
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
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php';
?>

