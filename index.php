<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/util/text_limit.php';
?>
    <!-- ***** Header Area End ***** -->
<script type="text/javascript">
    document.title = "Tech News";
</script>
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area">

        <!-- Hero Slides Area -->
        <div class="hero-slides owl-carousel">
            <!-- Single Slide -->
            <!-- Hiển thị  Slide-->
            <?php
                $resultNewsSlide = $mysqli->query("SELECT * FROM news WHERE is_slide = 1 ORDER BY news_id DESC LIMIT 4");
                while($arNewsSlide = mysqli_fetch_assoc($resultNewsSlide)) {
                    ?>
                    <div class="single-hero-slide bg-img background-overlay"
                         style="background-image: url(files/<?=$arNewsSlide['picture']?>);">
                    </div>
                    <!-- Single Slide -->
                    <?php
                }
            ?>
            <!-- Hiển thị  Slide-->
        </div>

        <!-- Hero Post Slide -->
        <div class="hero-post-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero-post-slide">
                            <!-- Single Slide -->
                            <!-- Hiển thị  Tên tin tức trên Slide-->
                            <?php
                                $i = 1;
                                $resultNewsSlide2 = $mysqli->query("SELECT * FROM news WHERE is_slide = 1 ORDER BY news_id DESC  LIMIT 4");
                                while($arNewsSlide2 = mysqli_fetch_assoc($resultNewsSlide2)) {
                                    $name_seo = to_slug($arNewsSlide2['news_name']);
                                    $urlReduce ='/chi-tiet/'.$name_seo.'-'.$arNewsSlide2['news_id'].'.html';
                                    ?>
                                    <div class="single-slide d-flex align-items-center">
                                        <div class="post-number">
                                            <p><?=$i?></p>
                                        </div>
                                        <div class="post-title">
                                            <a href="<?=$urlReduce?>">
                                                <?php echo $arNewsSlide2['news_name'];?>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                }
                            ?>
                            <!-- Hiển thị  Tên tin tức trên Slide-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ********** Hero Area End ********** -->

    <div class="main-content-wrapper section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <!-- ============= Post Content Area Start ============= -->
                <div class="col-12 col-lg-8">
                    <div class="post-content-area mb-50">
                        <!-- Catagory Area -->
                        <div class="world-catagory-area">
                            <!-- Hiển thị  danh mục-->
                            <?php
                            $queryCat = "SELECT * FROM cat_list WHERE parent_id = 0 ORDER BY cat_id ASC";
                            $resultCat = $mysqli->query($queryCat);
                            ?>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="title">Đừng Bỏ Lỡ</li>

                                <li class="nav-item">
                                    <a class="nav-link active" id="tab" data-toggle="tab" href="#world-tab" role="tab" aria-controls="world-tab" aria-selected="true">Tất cả</a>
                                </li>
                                <?php
                                if (mysqli_num_rows($resultCat) > 0) {
                                    while ($row = mysqli_fetch_assoc($resultCat)) {
                                        $queryCatCha = "SELECT * FROM cat_list WHERE parent_id = " . $row['cat_id'];
                                        $submenu = $mysqli->query($queryCatCha);
                                        if (mysqli_num_rows($submenu) == 0) {
                                            ?>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab<?=$row['cat_id']?>" data-toggle="tab" href="#world-tab-<?=$row['cat_id']?>"
                                                   role="tab"
                                                   aria-controls="world-tab-<?=$row['cat_id']?>" aria-selected="false"><?=$row['cat_name']?></a>
                                            </li>
                                            <?php
                                        }
                                        else
                                        {
                                         ?>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" id="tab<?=$i?>" data-toggle="tab" aria-controls="world-tab-<?=$i?>">
                                                    <?=$row['cat_name']?>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <?php
                                                    $queryCatCon = "SELECT * FROM cat_list WHERE parent_id != 0";
                                                    $submenu2 = $mysqli->query($queryCatCha);
                                                    while($obj2 = mysqli_fetch_assoc($submenu2)) {
                                                        ?>
                                                        <a class="nav-link" id="tab<?=$obj2['cat_id']?>" data-toggle="tab"
                                                           href="#world-tab-<?=$obj2['cat_id']?>" role="tab" aria-controls="world-tab-<?=$obj2['cat_id']?>"
                                                           aria-selected="false"><?=$obj2['cat_name']?></a>
                                                        <?php
                                                    }
                                                        ?>
                                                </div>
                                            </li>
                                        <?php
                                        }
                                    }
                                }
                                ?>
                                <!-- Hiển thị  danh mục-->
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="world-tab" role="tabpanel" aria-labelledby="tab">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="world-catagory-slider owl-carousel wow fadeInUpBig" data-wow-delay="0.1s">
                                                <!-- Hiển thị tin tức ở tất cả các danh mục dạng slide (Đừng bỏ lỡ)-->
                                                <?php
                                                $queryNewsAll = "SELECT * FROM news 
                                                                  INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
                                                                  INNER JOIN user ON news.created_by = user.user_id
                                                                  WHERE is_slide = 1
                                                                  ORDER BY date_create DESC
                                                                    LIMIT 3";
                                                $resultNewsAll = $mysqli->query($queryNewsAll);
                                                while($arNewsAll = mysqli_fetch_assoc($resultNewsAll)) {
                                                    $cat = $arNewsAll['cat_name'];
                                                    $picture = $arNewsAll['picture'];
                                                    $newsName = $arNewsAll['news_name'];
                                                    $news_preview = $arNewsAll['news_preview'];
                                                    $created_by = $arNewsAll['fullname'];
                                                    $dateTmp = date_create($arNewsAll['date_create']);
                                                    $date_create = date_format($dateTmp,"d-m-Y H:i:s");

                                                    $name_seoCat = to_slug($arNewsAll['cat_name']);
                                                    $urlReduceCat = "/danh-muc/".$name_seoCat."-".$arNewsAll['cat_id'];
                                                    //---------------------------
                                                    $name_seoNews = to_slug($arNewsAll['news_name']);
                                                    $urlReduceNews ='/chi-tiet/'.$name_seoNews.'-'.$arNewsAll['news_id'].'.html';
                                                    //--------------Giới hạn tin---------------------
                                                    $NameReduce = ShortenText($newsName);
                                                    ?>
                                                    <!-- Single Blog Post -->
                                                    <div class="single-blog-post">
                                                        <!-- Post Thumbnail -->
                                                        <div class="post-thumbnail">
                                                            <img src="/files/<?=$picture?>"
                                                                 alt="">
                                                            <!-- Catagory -->
                                                            <div class="post-cta"><a href="<?=$urlReduceCat?>"><?=$cat?></a></div>
                                                        </div>
                                                        <!-- Post Content -->
                                                        <div class="post-content">
                                                            <a href="<?=$urlReduceNews?>" class="headline">
                                                                <h5><?=$NameReduce?></h5>
                                                            </a>
                                                            <p><?=$news_preview?></p>
                                                            <!-- Post Meta -->
                                                            <div class="post-meta">
                                                                <p>
                                                                    <a href="#" class="post-author"><?=$created_by?></a>
                                                                    <a href="#" class="post-date"><?=$date_create?></a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <!-- Single Blog Post -->
                                                <!-- Hiển thị tin tức ở tất cả các danh mục dạng slide (Đừng bỏ lỡ)-->
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <!-- Single Blog Post -->
                                            <!-- Hiển thị tin tức ở tất cả các danh mục(Đừng bỏ lỡ)-->
                                            <?php
                                            $queryNewsAll1 = "SELECT * FROM news 
                                                                  INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
                                                                  INNER JOIN user ON news.created_by = user.user_id
                                                                  WHERE is_slide = 1
                                                                  ORDER BY date_create DESC
                                                                    LIMIT 4";
                                            $resultNewsAll1 = $mysqli->query($queryNewsAll1);
                                            while($arNewsAll = mysqli_fetch_assoc($resultNewsAll1)) {
                                                $picture = $arNewsAll['picture'];
                                                $newsName = $arNewsAll['news_name'];
                                                $created_by = $arNewsAll['fullname'];
                                                $dateTmp = date_create($arNewsAll['date_create']);
                                                $date_create = date_format($dateTmp, "d-m-Y H:i:s");
                                                //---------------------------
                                                $name_seoNews = to_slug($arNewsAll['news_name']);
                                                $urlReduceNews ='/chi-tiet/'.$name_seoNews.'-'.$arNewsAll['news_id'].'.html';
                                                $NameReduce = ShortenText($newsName);
                                                ?>
                                                <div class="single-blog-post post-style-2 d-flex align-items-center wow fadeInUpBig"
                                                     data-wow-delay="0.2s">
                                                    <!-- Post Thumbnail -->
                                                    <div class="post-thumbnail">
                                                        <img src="/files/<?=$picture?>" alt="">
                                                    </div>
                                                    <!-- Post Content -->
                                                    <div class="post-content">
                                                        <a href="<?=$urlReduceNews?>" class="headline">
                                                            <h5><?=$NameReduce?></h5>
                                                        </a>
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
                                            <!-- Single Blog Post -->
                                            <!-- Hiển thị tin tức ở tất cả các danh mục(Đừng bỏ lỡ)-->
                                        </div>
                                    </div>
                                </div>

                                <!-- Hiển thị tin tức ở từng danh mục(Đừng bỏ lỡ)-->
                                <?php
                                    $resultNewsCat = $mysqli->query("SELECT * FROM cat_list");
                                    while($arNewsCat = mysqli_fetch_assoc($resultNewsCat)) {
                                ?>
                                        <div class="tab-pane fade" id="world-tab-<?=$arNewsCat['cat_id']?>" role="tabpanel"
                                             aria-labelledby="tab<?=$arNewsCat['cat_id']?>">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <!-- Single Blog Post -->
                                                    <?php
                                                    $queryNewsAllCat = "SELECT * FROM news 
                                                          INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
                                                          INNER JOIN user ON news.created_by = user.user_id
                                                          WHERE news.cat_id = {$arNewsCat['cat_id']} AND is_slide = 1
                                                          ORDER BY date_create DESC";
                                                    $resultNewsAll2 = $mysqli->query($queryNewsAllCat);
                                                    $arNewsAll_cat = mysqli_fetch_assoc($resultNewsAll2);
                                                        $cat = $arNewsAll_cat['cat_name'];
                                                        $picture = $arNewsAll_cat['picture'];
                                                        $newsName = $arNewsAll_cat['news_name'];
                                                        $news_preview = $arNewsAll_cat['news_preview'];
                                                        $created_by = $arNewsAll_cat['fullname'];
                                                        $dateTmp = date_create($arNewsAll_cat['date_create']);
                                                        $date_create = date_format($dateTmp,"d-m-Y H:i:s");
                                                    //---------------------------
                                                    $name_seoNewsAll_cat = to_slug($arNewsAll_cat['news_name']);
                                                    $urlReduceNewsAll_cat ='/chi-tiet/'.$name_seoNewsAll_cat.'-'.$arNewsAll_cat['news_id'].'.html';
                                                    //----------------------------------------------------------------
                                                    $name_seoCat = to_slug($arNewsAll_cat['cat_name']);
                                                    $urlReduceCat = "/danh-muc/".$name_seoCat."-".$arNewsAll_cat['cat_id'];
                                                    //---------------------
                                                    $NameReduce = ShortenText($newsName);
                                                        ?>
                                                    <div class="single-blog-post">
                                                        <!-- Post Thumbnail -->
                                                        <div class="post-thumbnail">
                                                            <img src="/files/<?=$picture?>"
                                                                 alt="">
                                                            <!-- Catagory -->
                                                            <div class="post-cta"><a href="<?=$urlReduceCat?>"><?=$cat?></a></div>
                                                        </div>
                                                        <!-- Post Content -->
                                                        <div class="post-content">
                                                            <a href="<?=$urlReduceNewsAll_cat?>" class="headline">
                                                                <h5><?=$NameReduce?></h5>
                                                            </a>
                                                            <p><?=$news_preview?></p>
                                                            <!-- Post Meta -->
                                                            <div class="post-meta">
                                                                <p><a href="#" class="post-author"><?=$created_by?></a>
                                                                    <a href="#" class="post-date"><?=$date_create?></a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <!-- Single Blog Post -->
                                                    <?php
                                                    $queryNewsAllCat2 = "SELECT * FROM news 
                                                                  INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
                                                                  INNER JOIN user ON news.created_by = user.user_id
                                                                  WHERE news.cat_id = {$arNewsCat['cat_id']} AND is_slide = 1
                                                                  ORDER BY date_create DESC
                                                                    LIMIT 4";
                                                    $resultNewsAllCat2 = $mysqli->query($queryNewsAllCat2);
                                                    while($arNewsAll_cat2 = mysqli_fetch_assoc($resultNewsAllCat2)) {
                                                        $dateTmp = date_create($arNewsAll_cat2['date_create']);
                                                        $newsName = $arNewsAll_cat2['news_name'];
                                                        $date_create = date_format($dateTmp,"d-m-Y H:i:s");
                                                        //---------------------------
                                                        $name_seoNewsAll_cat2 = to_slug($arNewsAll_cat2['news_name']);
                                                        $urlReduceNewsAll_cat2 ='/chi-tiet/'.$name_seoNewsAll_cat2.'-'.$arNewsAll_cat2['news_id'].'.html';
                                                        $NameReduce = ShortenText($newsName);
                                                        ?>
                                                    <div class="single-blog-post post-style-2 d-flex align-items-center">
                                                        <!-- Post Thumbnail -->
                                                        <div class="post-thumbnail">
                                                            <img src="/files/<?=$arNewsAll_cat2['picture']?>"
                                                                 alt="">
                                                        </div>
                                                        <!-- Post Content -->
                                                        <div class="post-content">
                                                            <a href="<?=$urlReduceNewsAll_cat2?>" class="headline">
                                                                <h5><?=$NameReduce?></h5>
                                                            </a>
                                                            <!-- Post Meta -->
                                                            <div class="post-meta">
                                                                <p><a href="#" class="post-author"><?=$arNewsAll_cat2['fullname']?></a>
                                                                    <a href="#" class="post-date"><?=$date_create?></a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Single Blog Post -->
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                ?>
                                <!-- Hiển thị tin tức ở từng danh mục(Đừng bỏ lỡ)-->
                            </div>
                        </div>

                        <!-- Catagory Area -->
                        <div class="world-catagory-area mt-50">
                            <!-- Hiển thị danh mục(Xu hướng)-->
                            <?php
                            $queryCat = "SELECT * FROM cat_list WHERE parent_id = 0 ORDER BY cat_id ASC";
                            $resultCat = $mysqli->query($queryCat);
                            ?>
                            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                <li class="title">Xu Hướng</li>

                                <li class="nav-item">
                                    <a class="nav-link active" id="tab10" data-toggle="tab" href="#world-tab-10" role="tab" aria-controls="world-tab-10" aria-selected="true">Tất cả</a>
                                </li>
                                <?php
                                if (mysqli_num_rows($resultCat) > 0) {
                                    while ($row = mysqli_fetch_assoc($resultCat)) {
                                        $queryCatCha = "SELECT * FROM cat_list WHERE parent_id = " . $row['cat_id'];
                                        $submenu = $mysqli->query($queryCatCha);
                                        $name_seo = to_slug($row['cat_name']);
                                        $urlReduceCat = "/danh-muc/".$name_seo."-".$row['cat_id'];
                                        if (mysqli_num_rows($submenu) == 0) {
                                            ?>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab<?=$row['cat_id']+10?>" data-toggle="tab" href="#world-tab-<?=$row['cat_id']+10?>"
                                                   role="tab"
                                                   aria-controls="world-tab-<?=$row['cat_id']+10?>" aria-selected="false"><?=$row['cat_name']?></a>
                                            </li>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="<?=$urlReduceCat?>" role="button" aria-haspopup="true" aria-expanded="false" id="tab<?=$i?>" data-toggle="tab" aria-controls="world-tab-<?=$i?>">
                                                    <?=$row['cat_name']?>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <?php
                                                    $queryCatCon = "SELECT * FROM cat_list WHERE parent_id != 0";
                                                    $submenu2 = $mysqli->query($queryCatCha);
                                                    while($obj2 = mysqli_fetch_assoc($submenu2)) {
                                                        ?>
                                                        <a class="nav-link" id="tab<?=$obj2['cat_id']+10?>" data-toggle="tab"
                                                           href="#world-tab-<?=$obj2['cat_id']+10?>" role="tab" aria-controls="world-tab-<?=$obj2['cat_id']+10?>"
                                                           aria-selected="false"><?=$obj2['cat_name']?></a>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                                <!-- Hiển thị danh mục(Xu hướng)-->
                            </ul>

                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade show active" id="world-tab-10" role="tabpanel" aria-labelledby="tab10">
                                    <div class="row">
                                        <!-- Hiển thị tin tức ở tất cả danh mục(Xu hướng)-->
                                        <?php
                                        $queryNewsAll3 = "SELECT * FROM news 
                                                                  INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
                                                                  INNER JOIN user ON news.created_by = user.user_id
                                                                  WHERE is_slide = 1
                                                                  ORDER BY rand() DESC
                                                                    LIMIT 2";
                                        $resultNewsAll3 = $mysqli->query($queryNewsAll3);
                                        while($arNewsAll3 = mysqli_fetch_assoc($resultNewsAll3)) {
                                            $picture = $arNewsAll3['picture'];
                                            $cat = $arNewsAll3['cat_name'];
                                            $newsName = $arNewsAll3['news_name'];
                                            $news_preview = $arNewsAll3['news_preview'];
                                            $created_by = $arNewsAll3['fullname'];
                                            $dateTmp = date_create($arNewsAll3['date_create']);
                                            $date_create = date_format($dateTmp, "d-m-Y H:i:s");
                                            //---------------------------
                                            $name_seo = to_slug($arNewsAll3['cat_name']);
                                            $urlReduceCat = "/danh-muc/".$name_seo."-".$arNewsAll3['cat_id'];
                                            //---------------------------
                                            $name_seoNewsAll3 = to_slug($arNewsAll3['news_name']);
                                            $urlReduceNewsAll3 ='/chi-tiet/'.$name_seoNewsAll3.'-'.$arNewsAll3['news_id'].'.html';
                                            $NameReduce = ShortenText($newsName);
                                            ?>
                                            <div class="col-12 col-md-6">
                                                <!-- Single Blog Post -->
                                                <div class="single-blog-post wow fadeInUpBig" data-wow-delay="0.2s">
                                                    <!-- Post Thumbnail -->
                                                    <div class="post-thumbnail">
                                                        <img src="/files/<?= $picture ?>" alt="">
                                                        <!-- Catagory -->
                                                        <div class="post-cta"><a href="<?=$urlReduceCat?>"><?= $cat ?></a></div>
                                                    </div>
                                                    <!-- Post Content -->
                                                    <div class="post-content">
                                                        <a href="<?=$urlReduceNewsAll3?>" class="headline">
                                                            <h5><?= $NameReduce ?></h5>
                                                        </a>
                                                        <p><?= $news_preview ?></p>
                                                        <!-- Post Meta -->
                                                        <div class="post-meta">
                                                            <p><a href="#" class="post-author"><?= $created_by ?></a>
                                                                <a href="#" class="post-date"><?= $date_create ?></a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <!-- Hiển thị tin tức ở tất cả danh mục(Xu hướng)-->

                                        <div class="col-12">
                                            <div class="world-catagory-slider2 owl-carousel wow fadeInUpBig" data-wow-delay="0.4s">
                                                <!-- ========= Single Catagory Slide ========= -->
                                                <!-- Hiển thị tin tức ở tất cả danh mục dạng slide(Xu hướng)-->
                                                <?php
                                                    for($i = 1;$i <=3; $i++) {
                                                        ?>
                                                        <div class="single-cata-slide">
                                                            <div class="row">
                                                                <?php
                                                                $queryNewsAll4 = "SELECT * FROM news 
                                                                  INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
                                                                  INNER JOIN user ON news.created_by = user.user_id
                                                                  WHERE is_slide = 1
                                                                  ORDER BY rand() DESC
                                                                    LIMIT 4";
                                                                $resultNewsAll4 = $mysqli->query($queryNewsAll4);
                                                                while ($arNewsAll4 = mysqli_fetch_assoc($resultNewsAll4)) {
                                                                    $picture = $arNewsAll4['picture'];
                                                                    $newsName = $arNewsAll4['news_name'];
                                                                    $created_by = $arNewsAll4['fullname'];
                                                                    $dateTmp = date_create($arNewsAll4['date_create']);
                                                                    $date_create = date_format($dateTmp, "d-m-Y H:i:s");
                                                                    //---------------------------
                                                                    $name_seoNewsAll4 = to_slug($arNewsAll4['news_name']);
                                                                    $urlReduceNewsAll4 ='/chi-tiet/'.$name_seoNewsAll4.'-'.$arNewsAll4['news_id'].'.html';
                                                                    $NameReduce = ShortenText($newsName);
                                                                    ?>
                                                                    <div class="col-12 col-md-6">
                                                                        <!-- Single Blog Post -->
                                                                        <div class="single-blog-post post-style-2 d-flex align-items-center mb-1">
                                                                            <!-- Post Thumbnail -->
                                                                            <div class="post-thumbnail">
                                                                                <img src="/files/<?= $picture ?>"
                                                                                     alt="">
                                                                            </div>
                                                                            <!-- Post Content -->
                                                                            <div class="post-content">
                                                                                <a href="<?=$urlReduceNewsAll4?>" class="headline">
                                                                                    <h5><?= $NameReduce ?></h5>
                                                                                </a>
                                                                                <!-- Post Meta -->
                                                                                <div class="post-meta">
                                                                                    <p><a href="#"
                                                                                          class="post-author"><?= $created_by ?></a>
                                                                                        <a href="#"
                                                                                           class="post-date"><?= $date_create ?></a>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                ?>
                                                <!-- Hiển thị tin tức ở tất cả danh mục dạng slide(Xu hướng)-->
                                                <!-- ========= Single Catagory Slide ========= -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hiển thị tin tức ở từng danh mục(Xu hướng)-->
                                <?php
                                $resultNewsCat2 = $mysqli->query("SELECT * FROM cat_list");
                                while($arNewsCat2 = mysqli_fetch_assoc($resultNewsCat2)) {
                                ?>
                                <div class="tab-pane fade" id="world-tab-<?= $arNewsCat2['cat_id'] + 10 ?>"
                                     role="tabpanel"
                                     aria-labelledby="tab<?= $arNewsCat2['cat_id'] + 10 ?>">
                                    <div class="row">
                                        <?php
                                        $queryNewsAllCat = "SELECT * FROM news 
                                                          INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
                                                          INNER JOIN user ON news.created_by = user.user_id
                                                          WHERE news.cat_id = {$arNewsCat2['cat_id']} AND is_slide = 1
                                                          ORDER BY rand() DESC
                                                          LIMIT 2";
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
                                            $name_seo = to_slug($arNewsAll_cat['cat_name']);
                                            $urlReduceCat = "/danh-muc/".$name_seo."-".$arNewsAll_cat['cat_id'];
                                            //---------------------------
                                            $name_seoNewsAll_cat = to_slug($arNewsAll_cat['news_name']);
                                            $urlReduceNewsAll_cat ='/chi-tiet/'.$name_seoNewsAll_cat.'-'.$arNewsAll_cat['news_id'].'.html';
                                            $NameReduce = ShortenText($newsName);
                                            ?>
                                            <div class="col-12 col-md-6">
                                                <!-- Single Blog Post -->
                                                <div class="single-blog-post">
                                                    <!-- Post Thumbnail -->
                                                    <div class="post-thumbnail">
                                                        <img src="/files/<?= $picture ?>" alt="">
                                                        <!-- Catagory -->
                                                        <div class="post-cta"><a href="<?=$urlReduceCat?>"><?= $cat ?></a></div>
                                                    </div>
                                                    <!-- Post Content -->
                                                    <div class="post-content">
                                                        <a href="<?=$urlReduceNewsAll_cat?>" class="headline">
                                                            <h5><?= $NameReduce ?></h5>
                                                        </a>
                                                        <p><?= $news_preview ?></p>
                                                        <!-- Post Meta -->
                                                        <div class="post-meta">
                                                            <p><a href="#" class="post-author"><?= $created_by ?></a>
                                                                <a href="#" class="post-date"><?= $date_create ?></a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                        <?php
                                            $queryNewsAll5 = "SELECT * FROM news 
                                                              INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
                                                              INNER JOIN user ON news.created_by = user.user_id
                                                              WHERE news.cat_id = {$arNewsCat2['cat_id']} AND is_slide = 1
                                                              ORDER BY rand() DESC
                                                                LIMIT 4";
                                            $resultNewsCat3 = $mysqli->query($queryNewsAll5);
                                            while ($arNews_cat = mysqli_fetch_assoc($resultNewsCat3)) {
                                                $picture = $arNews_cat['picture'];
                                                $newsName = $arNews_cat['news_name'];
                                                $created_by = $arNews_cat['fullname'];
                                                $dateTmp = date_create($arNews_cat['date_create']);
                                                $date_create = date_format($dateTmp, "d-m-Y H:i:s");
                                                //---------------------------
                                                $name_seoNews_cat = to_slug($arNews_cat['news_name']);
                                                $urlReduceNews_cat ='/chi-tiet/'.$name_seoNews_cat.'-'.$arNews_cat['news_id'].'.html';
                                                $NameReduce = ShortenText($newsName);
                                                ?>
                                                <div class="col-12 col-md-6">
                                                    <!-- Single Blog Post -->
                                                    <div class="single-blog-post post-style-2 d-flex align-items-center mb-1">
                                                        <!-- Post Thumbnail -->
                                                        <div class="post-thumbnail">
                                                            <img src="/files/<?= $picture ?>" alt="">
                                                        </div>
                                                        <!-- Post Content -->
                                                        <div class="post-content">
                                                            <a href="<?=$urlReduceNews_cat?>" class="headline">
                                                                <h5><?= $NameReduce ?></h5>
                                                            </a>
                                                            <!-- Post Meta -->
                                                            <div class="post-meta">
                                                                <p><a href="#"
                                                                      class="post-author"><?= $created_by ?></a>
                                                                    <a href="#"
                                                                       class="post-date"><?= $date_create ?></a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                    <?php
                                }
                                ?>
                                <!-- Hiển thị tin tức ở từng danh mục(Xu hướng)-->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========== Sidebar Area ========== -->
                <?php
                require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/sidebar.php';
                ?>
            </div>

            <div class="row justify-content-center">
                <!-- ========== Single Blog Post ========== -->
                <?php
                require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/single-blog-post.php'
                ?>
                <!-- ========== Single Blog Post ========== -->
            </div>

            <?php
            require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/LatestNews.php'
            ?>

            <!-- Load More btn -->

        </div>
    </div>
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/footer.php';
?>
