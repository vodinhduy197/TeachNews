<div class="col-12 col-md-8 col-lg-4">
    <div class="post-sidebar-area">
        <!-- Widget Area -->
        <div class="sidebar-widget-area">
            <h5 class="title">About World</h5>
            <div class="widget-content">
                <p>The mango is perfect in that it is always yellow and if it’s not, I don’t want to hear about it. The mango’s only flaw, and it’s a minor one, is the effort it sometimes takes to undress the mango, carve it up in a way that makes sense, and find its way to the mouth.</p>
            </div>
        </div>
        <!-- Widget Area -->
        <div class="sidebar-widget-area">
            <h5 class="title">Top Tin Tức</h5>
            <div class="widget-content">
                <!-- Single Blog Post -->
                <?php
                    $resultTopNews = $mysqli->query("SELECT * FROM news 
                                                            WHERE is_slide = 1 
                                                            ORDER BY count_view DESC LIMIT 5");
                    while ($arTopNews = mysqli_fetch_assoc($resultTopNews)) {
                        $name_seo = to_slug($arTopNews['news_name']);
                        $urlReduce ='/chi-tiet/'.$name_seo.'-'.$arTopNews['news_id'].'.html';
                        ?>
                        <div class="single-blog-post post-style-2 d-flex align-items-center widget-post">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <img src="/files/<?=$arTopNews['picture']?>" alt="">
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="<?=$urlReduce?>" class="headline">
                                    <h5 class="mb-0"><?=$arTopNews['news_name']?></h5>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
        <!-- Widget Area -->
        <div class="sidebar-widget-area">
            <h5 class="title">Kết Nối</h5>
            <div class="widget-content">
                <div class="social-area d-flex justify-content-between">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                    <a href="#"><i class="fa fa-vimeo"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-google"></i></a>
                </div>
            </div>
        </div>
        <!-- Widget Area -->
        <div class="sidebar-widget-area ">
            <h5 class="title">Chủ Đề Hôm Nay</h5>
            <div class="widget-content">
                <!-- Single Blog Post -->
                <?php
                $resultPickNews = $mysqli->query("SELECT * FROM news 
                                                            WHERE is_slide = 1 
                                                            ORDER BY RAND() DESC LIMIT 1");
                $arPickNews = mysqli_fetch_assoc($resultPickNews);
                $name_seo = to_slug($arPickNews['news_name']);
                $urlReduce ='/chi-tiet/'.$name_seo.'-'.$arPickNews['news_id'].'.html';
                ?>
                <div class="single-blog-post todays-pick">
                    <!-- Post Thumbnail -->
                    <div class="post-thumbnail">
                        <img src="/files/<?=$arPickNews['picture']?>" alt="">
                    </div>
                    <!-- Post Content -->
                    <div class="post-content px-0 pb-0">
                        <a href="<?=$urlReduce?>" class="headline">
                            <h5><?=$arPickNews['news_name']?></h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>