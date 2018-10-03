<?php
    ob_start();
    require_once $_SERVER['DOCUMENT_ROOT'].'/util/DatabaseConnection.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/util/Utf8ToLatinUtil.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>TechNews</title>

    <!-- Favicon  -->
    <link rel="icon" href="/templates/public/assets/img/core-img/favicon.ico">

    <!-- Style CSS -->
    <link rel="stylesheet" href="/templates/public/assets/style.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">

</head>

<body>
<!-- Preloader Start -->
<div id="preloader">
    <div class="preload-content">
        <div id="world-load"></div>
    </div>
</div>
<!-- Preloader End -->

<!-- ***** Header Area Start ***** -->
<header class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg">
                    <!-- Logo -->
                    <a class="navbar-brand" href="/"><img src="/templates/public/assets/img/core-img/logo.png" alt="Logo"></a>
                    <!-- Navbar Toggler -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#worldNav" aria-controls="worldNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <!-- Navbar -->
                    <div class="collapse navbar-collapse" id="worldNav">
                        <?php
                            require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/nvbar.php';
                        ?>
                        <?php
                            if(isset($_POST['abc']))
                            {
                                header("location:/tim-kiem/?search={$_POST['search_input']}");
                            }
                        ?>
                        <!-- Search Form  -->
                        <div id="search-wrapper">
                            <form action="" method="post">
                                <input type="text" name="search_input" id="search" placeholder="Tìm kiếm">
                                <div id="close-icon"></div>
                                <input class="d-none" type="submit" name="abc" value="">
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>