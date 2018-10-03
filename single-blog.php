<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/header.php';
?>
    <!-- ***** Header Area End ***** -->
<?php
    $id = "";
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
    }
    $resultDetailNews = $mysqli->query("SELECT * FROM news 
                                              INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
                                              INNER JOIN user ON news.created_by = user.user_id
                                              WHERE is_slide = 1 AND news_id = {$id}");
    $arNews = mysqli_fetch_assoc($resultDetailNews);
    $dateTmp = date_create($arNews['date_create']);
    $date_create = date_format($dateTmp,"d-m-Y H:i:s");
    $name_seo = to_slug($arNews['cat_name']);
    $urlReduceCat = "/danh-muc/".$name_seo."-".$arNews['cat_id'];
    //Cập nhật lại tin xem nhiều nhất
    $resultCount = $mysqli->query("UPDATE news 
                                        SET count_view = {$arNews['count_view']}+1
                                        WHERE news_id = {$id}");
?>
    <script type="text/javascript">
        document.title = "<?=$arNews['news_name']?>";
    </script>
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-600 bg-img background-overlay" style="background-image: url(/files/<?=$arNews['picture']?>);">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="single-blog-title text-center">
                        <!-- Catagory -->
                        <div class="post-cta"><a href="<?=$urlReduceCat?>"><?=$arNews['cat_name']?></a></div>
                        <h3><?=$arNews['news_name']?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ********** Hero Area End ********** -->

    <div class="main-content-wrapper section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <!-- ============= Post Content Area ============= -->
                <div class="col-12 col-lg-8">
                    <div class="single-blog-content mb-100">
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <p><a href="#" class="post-author"><?=$arNews['fullname']?></a>
                                <a href="#" class="post-date"><?=$date_create?></a></p>
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <blockquote class="mb-30">
                                <h6><?=$arNews['news_preview']?></h6>
                            </blockquote>
                            <h6><?=$arNews['news_detail']?></h6>
                            <div class="post-meta second-part">
                                <p><a href="#" class="post-author"><?=$arNews['fullname']?></a>
                                    <a href="#" class="post-date"><?=$date_create?></a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========== Sidebar Area ========== -->
                <?php
                require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/sidebar.php';
                ?>
            </div>

            <!-- ============== Related Post ============== -->
            <div class="row">
                <?php
                require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/single-blog-post.php'
                ?>
            </div>

            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="post-a-comment-area mt-70">
                        <h5>Bình luận</h5>
                        <!-- Contact Form -->
                        <form action="javascript:void(0)" method="post" id="frmCmt" onsubmit="getCmt()">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="group">
                                        <input type="text" name="name" id="name" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Nhập tên của bạn</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group">
                                        <textarea name="message" id="message" required></textarea>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Nhập bình luận</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" id="submit" class="btn world-btn">Đăng</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-8" >
                    <!-- Comment Area Start -->
                    <?php
                        $resultCmtParent = $mysqli->query("SELECT *, comment.date_create as date_create_cmt FROM comment 
                                                                  INNER JOIN news ON news.news_id = comment.news_id
                                                                  WHERE comment.news_id = {$id} AND parent_id = 0
                                                                    AND active = 1
                                                                    ORDER BY comment.date_create DESC");
                        while ( $cmtPa = mysqli_fetch_assoc($resultCmtParent)) {
                            $nameCmtPa = $cmtPa['name'];
                            $messagePa = $cmtPa['com_content'];
                            $dateTmpPa = date_create($cmtPa['date_create_cmt']);
                            $date_createPa = date_format($dateTmpPa, "d-m-Y H:i:s");
                            ?>
                            <div class="comment_area clearfix mt-70 " >
                                <ol class="parent">
                                    <!-- Single Comment Area -->
                                    <li class="single_comment_area" >
                                        <!-- Comment Content -->
                                        <div class="comment-content media" style="background-color: #F2F3F5">
                                            <!-- Comment Meta -->
                                            <div class="media-left">
                                                <img src="/files/avatar.jpg" width="96" height="96" >
                                            </div>

                                            <div class="media-body" style="margin-left: 10px">
                                                    <a href="#" class="post-author"><span style="color: blue;"><?= $nameCmtPa ?></span></a><br/>
                                                    <a href="#" class="post-date"><?= $date_createPa ?></a>
                                                <p ><?= $messagePa ?></p>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0)" onclick="getFormReply(<?=$cmtPa['com_id']?>)"
                                                   class="comment-reply btn world-btn">Trả lời</a>
                                            </div
                                        </div>
                                    </li>
                                </ol>
                                <!--Form reply-->
                                <div class="post-a-comment-area mt-70 col-11 reply-form-<?=$cmtPa['com_id']?>" style="margin-left: 50px; display: none;">
                                    <!-- Contact Form -->
                                    <form action="javascript:void(0)" method="post" id="frmReply" onsubmit="getCmtReply(<?=$cmtPa['com_id']?>)">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="group">
                                                    <input type="text" name="name" id="name2" required>
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label>Nhập tên của bạn</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group">
                                                    <textarea name="message" id="message2" required></textarea>
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label>Nhập bình luận</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" id="submit" class="btn world-btn">Đăng</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--Form reply-->
                                <?php
                                $queryCmtChild = "SELECT *, comment.date_create as date_create_cmt FROM `comment`
                                                  INNER JOIN news ON news.news_id = comment.news_id
                                                  WHERE parent_id = {$cmtPa['com_id']} AND active = 1";
                                $resultCmtChild = $mysqli->query($queryCmtChild);
                                while($cmtCh = mysqli_fetch_assoc($resultCmtChild)) {
                                    $nameCmtChild = $cmtCh['name'];
                                    $message = $cmtCh['com_content'];
                                    $dateTmpCh = date_create($cmtCh['date_create_cmt']);
                                    $date_createCh = date_format($dateTmpCh, "d-m-Y H:i:s");
                                    ?>
                                    <ol class="children">

                                        <li class="single_comment_area">
                                            <!-- Comment Content -->
                                            <div class="comment-content media" style="background-color: #F2F3F5">
                                                <!-- Comment Meta -->
                                                <div class="media-left">
                                                    <img src="/files/avatar.jpg" width="96" height="96" >
                                                </div>

                                                <div class="media-body" style="margin-left: 10px">
                                                    <a href="#" class="post-author"><span style="color: blue;"><?= $nameCmtChild ?></span></a><br/>
                                                    <a href="#" class="post-date"><?= $date_createCh ?></a>
                                                    <p ><?= $message ?></p>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                    <!--Form Reply-->
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function getCmt(){
                n = $("#name").val();
                m = $("#message").val();
                id = <?=$id?>;
                $.ajax({
                    url: '/templates/public/assets/ajax/getComment.php',
                    type: 'POST',
                    cache: false,
                    data: {
                        name: n,
                        message: m,
                        idNews: id
                    },
                    async:true,
                    success: function(data){
                        $('.parent li div:eq(0)').before(data);
                        //$(".parent li div:eq(0)").html(kq);
                    },
                    error: function (){
                        alert('Có lỗi xảy ra');
                    }
                })
            $('#frmCmt').trigger("reset");
                return false;
            }
        //Ẩn hiện form reply
        function getFormReply(id){
            $(".reply-form-"+id).slideToggle();
        }
        //lấy dữ liệu từ form reply
        function getCmtReply(id_cmt){
            n = $("#name2").val();
            m = $("#message2").val();
            idnews = <?=$id?>;
            idcmt = id_cmt;
            $.ajax({
                url: '/templates/public/assets/ajax/resultReply.php',
                type: 'POST',
                cache: false,
                data: {
                    name: n,
                    message: m,
                    idNews: idnews,
                    idcmt: idcmt
                },
                async:true,
                success: function(data){
                    $(".children li div:eq(0)").before(data);
                },
                error: function (){
                    alert('Có lỗi xảy ra');
                }
            })
            $('#frmReply').trigger("reset");
            return false;
        }

    </script>
    <!-- ***** Footer Area Start ***** -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/footer.php';
?>