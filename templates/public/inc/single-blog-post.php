<?php
$queryNewsAll6 = "SELECT * FROM news 
                                      INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
                                      INNER JOIN user ON news.created_by = user.user_id
                                      WHERE is_slide = 1 AND news.cat_id = 1
                                      ORDER BY rand() DESC
                                        LIMIT 3";
$resultNewsCat4 = $mysqli->query($queryNewsAll6);
while ($arNews_cat = mysqli_fetch_assoc($resultNewsCat4)) {
    $cat = $arNews_cat['cat_name'];
    $picture = $arNews_cat['picture'];
    $newsName = $arNews_cat['news_name'];
    $created_by = $arNews_cat['fullname'];
    $dateTmp = date_create($arNews_cat['date_create']);
    $date_create = date_format($dateTmp, "d-m-Y H:i:s");
    //---------------------------
    $name_seo = to_slug($arNews_cat['cat_name']);
    $urlReduceCat = "/danh-muc/".$name_seo."-".$arNews_cat['cat_id'];
    //----------------------------
    $name_seoNews_cat = to_slug($arNews_cat['news_name']);
    $urlReduceNews_cat ='/chi-tiet/'.$name_seoNews_cat.'-'.$arNews_cat['news_id'].'.html';
    ?>
    <div class="col-12 col-md-6 col-lg-4">
        <div class="single-blog-post post-style-3 mt-50 wow fadeInUpBig" data-wow-delay="0.2s" >
            <!-- Post Thumbnail -->
            <div class="post-thumbnail" >
                <img src="/files/<?=$picture?>" alt="" width="350px" height="218px">
                <!-- Post Content -->
                <div class="post-content d-flex align-items-center justify-content-between">
                    <!-- Catagory -->
                    <div class="post-tag"><a href="<?=$urlReduceCat?>"><?=$cat?></a></div>
                    <!-- Headline -->
                    <a href="<?=$urlReduceNews_cat?>" class="headline">
                        <h5><?=$newsName?></h5>
                    </a>
                    <!-- Post Meta -->
                    <div class="post-meta">
                        <p><a href="#" class="post-author"><?=$created_by?></a>
                            <a href="#" class="post-date"><?=$date_create?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>