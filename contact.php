<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/header.php';
?>
    <!-- ***** Header Area End ***** -->

    <!-- ********** Hero Area Start ********** -->
    <script type="text/javascript">
        document.title = "Liên hệ";
    </script>
    <div class="hero-area height-400 bg-img background-overlay" style="background-image: url(templates/public/assets/img/blog-img/bg4.jpg);"></div>
    <!-- ********** Hero Area End ********** -->
<?php
 if (isset($_POST['submit']))
 {
     $name = $_POST['name'];
     $email = $_POST['email'];
     $message = $_POST['message'];
     $result = $mysqli->query("INSERT INTO `contact`(`name`, `email`, `message`) VALUES ('{$name}','{$email}','{$message}')");
     if($result)
     {
         echo "<script>alert('Thêm liên hệ thành công');</script>";
     }else
     {
         echo "<script>alert('Có lỗi trong quá trình xử lý');</script>";
     }
 }
?>
    <section class="contact-area section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Contact Form Area -->
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="contact-form">
                        <h5>Liên Hệ</h5>
                        <!-- Contact Form -->
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="group">
                                        <input type="text" name="name" id="name" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Nhập vào tên bạn</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="group">
                                        <input type="email" name="email" id="email" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Nhập vào email của bạn</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group">
                                        <textarea name="message" id="message" required></textarea>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Nhập tin nhắn</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="submit" class="btn world-btn">Gửi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Google Maps: If you want to google map, just uncomment below codes -->

    <!--<div class="map-area">
        <div id="googleMap" class="googleMap"></div>
    </div>-->


    <!-- ***** Footer Area Start ***** -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/footer.php';
?>