<div class="sidebar" data-background-color="white" data-active-color="danger">
    <div class="sidebar-wrapper">
        <div class="logo">
            <?php
                $fullName = "";
                $type = "";
                $avatar = "";
                $display = "";
                if(isset($_SESSION['userInfo']))
                {
                    $fullName = $_SESSION['userInfo']['fullname'];
                    $type = $_SESSION['userInfo']['type'];
                    $avatar = $_SESSION['userInfo']['avatar'];
                    $id = $_SESSION['userInfo']['user_id'];
                }
                if($type != "admin")
                {
                    $display = "none";
                }
                if($avatar != "") {
                    ?>
                    <a href="/admin/"><img src="/templates/admin/files/avatar/<?=$avatar?>" alt="" class="img-thumbnail"></a>
                    <?php
                }else
                {
            ?>
            <?php
                }
            ?>
            <a href="/admin/" class="simple-text"><?=$fullName?>(<?=$type?>)</a>
        </div>
        <?php
            $url = $_SERVER['REQUEST_URI'];
            $arTmp = explode("/",$url);
            $endUrl = end($arTmp);
        ?>
        <ul class="nav">
            <li <?php if($url=="/admin/") echo "class='active'";?>>
                <a href="/admin/">
                    <i class= "fa fa-tachometer fa-2x" ></i>
                    <p>Thống kê</p>
                </a>
            </li>
            <li <?php if($url=="/admin/cat/" || $url=="/admin/cat/{$endUrl}") echo "class='active'";?> style="display: <?=$display?>">
                <a href="/admin/cat/">
                    <i class= "fa fa-list fa-2x" ></i>
                    <p>Quản lý danh mục</p>
                </a>
            </li>
            <li <?php if($url=="/admin/news/" || $url=="/admin/news/{$endUrl}") echo "class='active'";?>>
                <a href="/admin/news/">
                    <i class= "fa fa-newspaper-o fa-2x" ></i>
                    <p>Quản lý tin tức</p>
                </a>
            </li>
            <li <?php if($url=="/admin/user/" || $url=="/admin/user/{$endUrl}") echo "class='active'";?> style="display: <?=$display?>">
                <a href="/admin/user/">
                    <i class="fa fa-users fa-2x"></i>
                    <p>Quản lý người dùng</p>
                </a>
            </li>
            <li <?php if($url=="/admin/comment/" || $url=="/admin/comment/{$endUrl}") echo "class='active'";?>>
                <a href="/admin/comment/">
                    <i class="fa fa-comments fa-2x"></i>
                    <p>Quản lý bình luận</p>
                </a>
            </li>
            <li <?php if($url=="/admin/contact/" || $url=="/admin/contact/{$endUrl}") echo "class='active'";?> style="display: <?=$display?>">
                <a href="/admin/contact/">
                    <i class="fa fa-phone-square fa-2x"></i>
                    <p>Quản lý liên hệ</p>
                </a>
            </li>
            <li <?php if($url=="/admin/account/" || $url=="/admin/account/{$endUrl}") echo "class='active'";?>>
                <?php
                    $resultUser = $mysqli->query("SELECT * FROM user WHERE user_id = {$id}");
                    $objUser = $resultUser->fetch_object();
                    if($objUser->user_id == $id)
                    {
                ?>
                        <a href="/admin/account/edit.php?id=<?=$id?>">
                            <i class="fa fa-cog fa-2x"></i>
                            <p>Thiết lập tài khoản</p>
                        </a>
                <?php
                    }
                ?>
            </li>
        </ul>
    </div>
</div>