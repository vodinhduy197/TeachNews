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
?>
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-400 bg-img background-overlay" style="background-image: url(/files/TechNews-1535555106.png)"></div>
    <!-- ********** Hero Area End ********** -->

    <div class="main-content-wrapper section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <!-- ============= Post Content Area Start ============= -->
                <div class="col-12 col-lg-8">
                    <div class="post-content-area mb-100">
                        <!-- Catagory Area -->
                        <div class="world-catagory-area">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <?php
                                    $resultCat = $mysqli->query("SELECT * FROM cat_list WHERE cat_id = {$id}");
                                    $arCat = mysqli_fetch_assoc($resultCat);
                                ?>
                                <li class="title"><?=$arCat['cat_name']?></li>
                            </ul>
                            <script type="text/javascript">
                                document.title = "<?=$arCat['cat_name']?>";
                            </script>
                            <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="world-tab" role="tabpanel"
                                         aria-labelledby="tab">
                                        <!-- Single Blog Post -->
                                    <?php
                                    ?>
                                        <!-- Single Blog Post -->
                                        <div id="content">
                                            <?php
                                            require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/scrolling_pagination_catagory.php';
                                            ?>
                                        </div>
                                        <div id="loadding" class="hidden" align="center">
                                            <img src="/files/Spin-1s-35px.gif">
                                        </div>
                                        <?php
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .hidden {display: none}
                </style>
                <script src="/templates/public/assets/js/jquery/jquery-2.2.4.min.js"></script>

                <script>
                    // Biến dùng kiểm tra nếu đang gửi ajax thì ko thực hiện gửi thêm
                    var is_busy = false;

                    // Biến lưu trữ trang hiện tại
                    var page = 1;

                    // Biến lưu trữ rạng thái phân trang
                    var stopped = false;

                    var id = <?=$id?>;

                    $(document).ready(function()
                    {
                        // Khi kéo scroll thì xử lý
                        $(window).scroll(function()
                        {
                            // Element append nội dung
                            $element = $('#content');

                            // ELement hiển thị chữ loadding
                            $loadding = $('#loadding');

                            // Nếu màn hình đang ở dưới cuối thẻ thì thực hiện ajax
                            if($(window).scrollTop() + $(window).height() >= $element.height())
                            {
                                // Nếu đang gửi ajax thì ngưng
                                if (is_busy == true){
                                    return false;
                                }

                                // Nếu hết dữ liệu thì ngưng
                                if (stopped == true){
                                    return false;
                                }

                                // Thiết lập đang gửi ajax
                                is_busy = true;

                                // Tăng số trang lên 1
                                page++;

                                // Hiển thị loadding
                                $loadding.removeClass('hidden');

                                // Gửi Ajax
                                $.ajax(
                                    {
                                        type        : 'get',
                                        dataType    : 'text',
                                        url         : '/templates/public/inc/scrolling_pagination_catagory.php',
                                        data        : {page : page, id : id},
                                        success     : function (result)
                                        {
                                            $element.append(result);
                                        }
                                    })
                                    .always(function()
                                    {
                                        // Sau khi thực hiện xong ajax thì ẩn hidden và cho trạng thái gửi ajax = false
                                        $loadding.addClass('hidden');
                                        is_busy = false;
                                    });
                                return false;
                            }
                        });
                    });
                </script>
                <!-- ========== Sidebar Area ========== -->
                <?php
                require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/sidebar.php';
                ?>
            </div>

            <!-- Load More btn -->

        </div>
    </div>

    <!-- ***** Footer Area Start ***** -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/footer.php';
?>