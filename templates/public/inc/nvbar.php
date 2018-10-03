                        <?php
                        $id = "";
                        if(isset($_GET['id']))
                        {
                            $id = $_GET['id'];
                        }
                        $queryCat = "SELECT * FROM cat_list WHERE parent_id = 0 ORDER BY sort,cat_id  ";
                        $resultCat = $mysqli->query($queryCat);
                        $active1 = "";
                        $active3 = "";
                        if($_SERVER['REQUEST_URI'] == "/" )
                        {
                            $active1 = "active";
                        }
                        if($_SERVER['REQUEST_URI'] == "/lien-he")
                        {
                            $active3 = "active";
                        }
                        ?>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item <?=$active1?>">
                                <a class="nav-link" href="/">Trang chủ <span class="sr-only">(current)</span></a>
                            </li>
                            <?php
                            if (mysqli_num_rows($resultCat) > 0) {
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($resultCat)) {
                                    $queryCatCon = "SELECT * FROM cat_list WHERE parent_id = " . $row['cat_id'];
                                    $submenu = $mysqli->query($queryCatCon);
                                    //-------------------------------------------
                                    $active4 = "";
                                    while ($row2 = mysqli_fetch_assoc($submenu))
                                    {
                                        $con = $row2['cat_id'];

                                        if($con == $id)
                                        {
                                            $active4 = "active";
                                        }
                                    }
                                    //----------------------------
                                    $name_seo = to_slug($row['cat_name']);
                                    $urlReduceCat = "/danh-muc/".$name_seo."-".$row['cat_id'];
                                    //-------------------------------
                                    $active2 = "";

                                    if($row['cat_id'] == $id)
                                    {
                                        $active2 = "active";
                                    }

                                    if (mysqli_num_rows($submenu) != 0) {
                                        ?>
                                        <li class="nav-item dropdown <?=$active4?>">
                                            <a class="nav-link dropdown-toggle" href="<?=$urlReduceCat?>" id="navbarDropdown"
                                               role="button"
                                               data-toggle="dropdown" aria-haspopup="true"
                                               aria-expanded="false"><?=$row['cat_name']?>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <?php
                                                    getSubmenu($row['cat_id']);
                                                ?>
                                            </div>
                                        </li>
                                        <?php
                                    }else {
                                        ?>
                                        <li class="nav-item <?=$active2?>">
                                            <a class="nav-link" href="<?=$urlReduceCat?>"><?= $row['cat_name'] ?></a>
                                        </li>
                                        <?php
                                    }
                                }
                            }
                            function getSubmenu($parent_id) {
                                global $mysqli;
                                $query1 = "SELECT * FROM cat_list WHERE parent_id = ".$parent_id;
                                $submenu = $mysqli->query($query1);

                                if (mysqli_num_rows($submenu) > 0) {
                                    while ( $obj = mysqli_fetch_assoc($submenu) ) {
                                        $name_seo = to_slug($obj['cat_name']);
                                        $urlReduceCat = "/danh-muc/".$name_seo."-".$obj['cat_id'];
                                    ?>
                                        <a class="dropdown-item" href="<?=$urlReduceCat?>"><?=$obj['cat_name']?></a>
                             <?php
                                         getSubmenu($obj['cat_id']);

                                    }

                                }
                            }
                            ?>
                            <li class="nav-item <?=$active3?>">
                                <a class="nav-link" href="/lien-he">Liên hệ</a>
                            </li>
                        </ul>
