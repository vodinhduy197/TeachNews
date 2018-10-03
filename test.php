<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/util/DatabaseConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/util/text_limit.php';
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15/09/2018
 * Time: 10:54 PM
 */
$queryNewsAll = "SELECT * FROM news 
                                                                  INNER JOIN cat_list ON news.cat_id = cat_list.cat_id
                                                                  INNER JOIN user ON news.created_by = user.user_id
                                                                  WHERE is_slide = 1
                                                                  ORDER BY date_create DESC
                                                                    LIMIT 3";
$resultNewsAll = $mysqli->query($queryNewsAll);
$newsName = "";
$arNewsAll = mysqli_fetch_assoc($resultNewsAll);
    $cat = $arNewsAll['cat_name'];
    $picture = $arNewsAll['picture'];
    $newsName = $arNewsAll['news_name'];
    $news_preview = $arNewsAll['news_preview'];
    $created_by = $arNewsAll['fullname'];
    $dateTmp = date_create($arNewsAll['date_create']);
    $date_create = date_format($dateTmp,"d-m-Y H:i:s");
    //---------------------------
    //$name_seoNews = to_slug($arNewsAll['news_name']);
    //$urlReduceNews ='/chi-tiet/'.$name_seoNews.'-'.$arNewsAll['news_id'].'.html';
    //--------------Giới hạn tin---------------------
    $NameReduce = text_limit($newsName,12)."...";
   // echo $newsName."<br/>";
  // echo text_limit($newsName,12)."...";


function ShortenText($text) { // Function name ShortenText
    $chars_limit = 90; // Character length
    $chars_text = strlen($text);
    $text = $text." ";
    $text = substr($text,0,$chars_limit);
    $text = substr($text,0,strrpos($text,' '));
    if ($chars_text > $chars_limit)
    { $text = $text."..."; } // Ellipsis
    return $text;
}
echo ShortenText($newsName);



