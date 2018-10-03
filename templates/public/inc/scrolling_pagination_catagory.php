<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/util/DatabaseConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/util/Utf8ToLatinUtil.php';
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    sleep(3);
}

// Lấy trang hiện tại
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

//Lấy id danh mục
$id = isset($_GET['id']) ? (int)$_GET['id']:1;

// Kiểm tra trang hiện tại có bé hơn 1 hay không
if ($page < 1) {
    $page = 1;
}

// Số record trên một trang
$limit = 4;

// Tìm start
$start = ($limit * $page) - $limit;

$query = "SELECT * FROM news 
          INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
          INNER JOIN user ON news.created_by = user.user_id
          WHERE is_slide = 1 AND news.cat_id = {$id}
          ORDER BY date_create DESC
            LIMIT $start,".($limit+1);
$resultLatestNews_catagory = $mysqli->query($query);

$result = array();
while ($row = mysqli_fetch_array($resultLatestNews_catagory))
{
    // Thêm vào result
    array_push($result, $row);
}

// Hiển thị dữ liệu
$total = count($result);

// Bỏ đi kết quả cuối cùng vì kết quả này dùng để check phân trang thôi
// Tuy nhiên chỉ bỏ ở trường hợp ($total > $limit) nếu không ở trang cuối cùng sẽ mất một row
if ($total > $limit){
    for ($i = 0; $i < $total - 1; $i++)
    {
        $dateTmp = date_create($result[$i]['date_create']);
        $date_create = date_format($dateTmp,"d-m-Y H:i:s");
        $name_seo = to_slug($result[$i]['news_name']);
        $urlReduce ='/chi-tiet/'.$name_seo.'-'.$result[$i]['news_id'].'.html';
?>
        <div class="single-blog-post post-style-4 d-flex align-items-center"
             data-wow-delay="0.2s">
            <!-- Post Thumbnail -->
            <div class="post-thumbnail">
                <img src="/files/<?=$result[$i]['picture']?>" alt="">
            </div>
            <!-- Post Content -->
            <div class="post-content">
                <a href="<?=$urlReduce?>" class="headline">
                    <h5><?=$result[$i]['news_name']?></h5>
                </a>
                <p><?=$result[$i]['news_preview']?></p>
                <!-- Post Meta -->
                <div class="post-meta">
                    <p><a href="#" class="post-author"><?=$result[$i]['fullname']?></a>
                        <a href="#" class="post-date"><?=$date_create?></a></p>
                </div>
            </div>
        </div>
<?php
    }
}
else{
    for ($i = 0; $i < $total; $i++)
    {
        $dateTmp = date_create($result[$i]['date_create']);
        $date_create = date_format($dateTmp,"d-m-Y H:i:s");
        $name_seo = to_slug($result[$i]['news_name']);
        $urlReduce ='/chi-tiet/'.$name_seo.'-'.$result[$i]['news_id'].'.html';
        ?>
        <div class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig"
             data-wow-delay="0.2s">
            <!-- Post Thumbnail -->
            <div class="post-thumbnail">
                <img src="/files/<?=$result[$i]['picture']?>" alt="">
            </div>
            <!-- Post Content -->
            <div class="post-content">
                <a href="<?=$urlReduce?>" class="headline">
                    <h5><?=$result[$i]['news_name']?></h5>
                </a>
                <p><?=$result[$i]['news_preview']?></p>
                <!-- Post Meta -->
                <div class="post-meta">
                    <p><a href="#" class="post-author"><?=$result[$i]['fullname']?></a>
                        <a href="#" class="post-date"><?=$date_create?></a></p>
                </div>
            </div>
        </div>
        <?php
    }
}

// Nếu hết dữ liệu thì stop không phan trang nữa
// Ta chỉ cần kiểm tra xem tổng số record có nhiều hơn limit hay không
// vì trong câu truy vấn mình select với limit = limit + 1
if ($total <= $limit){
    echo '<script language="javascript">stopped = true; </script>';
}
if($total < $limit)
{
    echo "Hết tin!!!";
}
?>