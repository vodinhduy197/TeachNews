<style>
    .hidden {display: none}
</style>
<div class="world-latest-articles">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="title">
                <h5>Tin Mới Nhất</h5>
            </div>
            <?php
            /*$resultLatestNews = $mysqli->query("SELECT * FROM news
                                                                  INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
                                                                  INNER JOIN user ON news.created_by = user.user_id
                                                                  WHERE is_slide = 1
                                                                  ORDER BY date_create DESC
                                                                    LIMIT 5");
            while($arLatestNews = mysqli_fetch_assoc($resultLatestNews)) {
                $dateTmp = date_create($arLatestNews['date_create']);
                $date_create = date_format($dateTmp,"d-m-Y H:i:s");
                $name_seo = to_slug($arLatestNews['news_name']);
                $urlReduce ='/chi-tiet/'.$name_seo.'-'.$arLatestNews['news_id'].'.html';*/
                ?>
                <!-- Single Blog Post -->
                <div id="content">
                    <?php
                        require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/scrolling_pagination.php';
                    ?>
                </div>
                <div id="loadding" class="hidden" align="center">
                    <img src="/files/Spin-1s-35px.gif">
                </div>
                <?php
            //}
            ?>
        </div>
        <script src="/templates/public/assets/js/jquery/jquery-2.2.4.min.js"></script>
        <script language="javascript" src="/templates/public/assets/ajax/ajax.js" ></script>

            <!-- Single Blog Post -->

        <div class="col-12 col-lg-4">
            <div class="title">
                <h5>Most Popular Videos</h5>
            </div>

            <!-- Single Blog Post -->
            <div class="single-blog-post wow fadeInUpBig" data-wow-delay="0.2s">
                <!-- Post Thumbnail -->
                <div class="post-thumbnail">
                    <img src="/templates/public/assets/img/blog-img/b7.jpg" alt="">
                    <!-- Catagory -->
                    <div class="post-cta"><a href="#">travel</a></div>
                    <!-- Video Button -->
                    <a href="https://www.youtube.com/watch?v=IhnqEwFSJRg" class="video-btn"><i class="fa fa-play"></i></a>
                </div>
                <!-- Post Content -->
                <div class="post-content">
                    <a href="#" class="headline">
                        <h5>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h5>
                    </a>
                    <p>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in...</p>
                    <!-- Post Meta -->
                    <div class="post-meta">
                        <p><a href="#" class="post-author">Katy Liu</a> on <a href="#" class="post-date">Sep 29, 2017 at 9:48 am</a></p>
                    </div>
                </div>
            </div>

            <!-- Single Blog Post -->
            <div class="single-blog-post wow fadeInUpBig" data-wow-delay="0.4s">
                <!-- Post Thumbnail -->
                <div class="post-thumbnail">
                    <img src="/templates/public/assets/img/blog-img/b8.jpg" alt="">
                    <!-- Catagory -->
                    <div class="post-cta"><a href="#">travel</a></div>
                    <!-- Video Button -->
                    <a href="https://www.youtube.com/watch?v=IhnqEwFSJRg" class="video-btn"><i class="fa fa-play"></i></a>
                </div>
                <!-- Post Content -->
                <div class="post-content">
                    <a href="#" class="headline">
                        <h5>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in Physics?</h5>
                    </a>
                    <p>How Did van Gogh’s Turbulent Mind Depict One of the Most Complex Concepts in...</p>
                    <!-- Post Meta -->
                    <div class="post-meta">
                        <p><a href="#" class="post-author">Katy Liu</a> on <a href="#" class="post-date">Sep 29, 2017 at 9:48 am</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>