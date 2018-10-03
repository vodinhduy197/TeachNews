<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="navbar-header">
    <button type="button" class="navbar-toggle navbar-left">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar bar1"></span>
        <span class="icon-bar bar2"></span>
        <span class="icon-bar bar3"></span>
    </button>
    <a class="navbar-brand" href="/admin" style="color: #ff8874" >Trang quản trị</a>
</div>

<!--//--------------------------------------------->
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-right">
        <li>
            <a href="/auth/logout.php">
                <p>Đăng xuất</p>
                <i class="fa fa-sign-out"></i>
            </a>
        </li>
    </ul>
</div>
<div align="right">
    <?php sw_get_current_weekday(); ?> | <span id="clock"></span>
</div>

<?php
function sw_get_current_weekday() {
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $weekday = date("l");
    $weekday = strtolower($weekday);
    switch($weekday) {
        case 'monday':
            $weekday = 'Thứ hai';
            break;
        case 'tuesday':
            $weekday = 'Thứ ba';
            break;
        case 'wednesday':
            $weekday = 'Thứ tư';
            break;
        case 'thursday':
            $weekday = 'Thứ năm';
            break;
        case 'friday':
            $weekday = 'Thứ sáu';
            break;
        case 'saturday':
            $weekday = 'Thứ bảy';
            break;
        default:
            $weekday = 'Chủ nhật';
            break;
    }
    // echo $weekday.', '.date('d/m/Y H:i:s');
    echo $weekday.', Ngày '.date('d/m/Y');
}
?>
<script>
    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);

        /* Đặt phần tử của bạn tại đây */
        document.getElementById('clock').innerHTML =
            h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }
    document.querySelector('body').addEventListener("load", startTime());

</script>
