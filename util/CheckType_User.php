<?php
if(isset($_SESSION['userInfo']))
{
    if($_SESSION['userInfo']['type']!="admin")
    {
        header("location: /admin/");
    }
}
?>