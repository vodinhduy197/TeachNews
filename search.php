<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/header.php';
?>
    <!-- ***** Header Area End ***** -->
<?php
    $search = "";
    if(isset($_GET['search']))
    {
        $search = $_GET['search'];
    }
    $querySearchNews = "SELECT COUNT(*) AS TSD FROM news 
                      WHERE news_name like '%{$search}%'";
    $resultSearchNews = $mysqli->query("$querySearchNews");
    $rs = mysqli_fetch_assoc($resultSearchNews);
    $TSD = $rs['TSD'];
?>

    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-400 bg-img background-overlay" style="background-image: url(files/TechNews-1535555106.png)"></div>
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
                                <li class="title"><?php echo "Có <span style='color: red'>{$TSD}</span> kết quả tìm kiếm";?></li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="world-tab" role="tabpanel"
                                         aria-labelledby="tab">
                                        <!-- Single Blog Post -->
                                    <?php
                                    $queryNewsAllCat = "SELECT * FROM news 
                                                          INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
                                                          INNER JOIN user ON news.created_by = user.user_id
                                                          WHERE news.news_name like '%{$search}%' AND is_slide = 1
                                                          ORDER BY date_create DESC
                                                          LIMIT 8";
                                    $resultNewsAll = $mysqli->query($queryNewsAllCat);
                                    while($arNewsAll_cat = mysqli_fetch_assoc($resultNewsAll)) {
                                        $cat = $arNewsAll_cat['cat_name'];
                                        $picture = $arNewsAll_cat['picture'];
                                        $newsName = $arNewsAll_cat['news_name'];
                                        $news_preview = $arNewsAll_cat['news_preview'];
                                        $created_by = $arNewsAll_cat['fullname'];
                                        $dateTmp = date_create($arNewsAll_cat['date_create']);
                                        $date_create = date_format($dateTmp, "d-m-Y H:i:s");
                                        //---------------------------
                                        //---------------------------
                                        $name_seoNewsAll_cat = to_slug($arNewsAll_cat['news_name']);
                                        $urlReduceNewsAll_cat ='/chi-tiet/'.$name_seoNewsAll_cat.'-'.$arNewsAll_cat['news_id'].'.html';
                                        ?>
                                        <div class="single-blog-post post-style-4 d-flex align-items-center">
                                            <!-- Post Thumbnail -->
                                            <div class="post-thumbnail">
                                                <img src="/files/<?=$picture?>" alt="">
                                            </div>
                                            <!-- Post Content -->
                                            <div class="post-content">
                                                <a href="<?=$urlReduceNewsAll_cat?>" class="headline">
                                                    <h5><?=$newsName?></h5>
                                                </a>
                                                <p><?=$news_preview?></p>
                                                <!-- Post Meta -->
                                                <div class="post-meta">
                                                    <p><a href="#" class="post-author"><?=$created_by?></a>
                                                        <a href="#" class="post-date"><?=$date_create?></a></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========== Sidebar Area ========== -->
                <?php
                require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/sidebar.php';
                ?>
            </div>

            <!-- Load More btn -->
            <div class="row">
                <div class="col-12">
                    <div class="load-more-btn mt-50 text-center">
                        <a href="#" class="btn world-btn">Load More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ***** Footer Area Start ***** -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/footer.php';
?>