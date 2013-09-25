<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<?php

session_start();

include "include/source/open_db.php";
?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Welcome to Ourchive</title>

    <link rel="stylesheet" href="../css/normalize.css" />
    <link rel="stylesheet" href="../css/foundation.css" />
    <link rel="stylesheet" href="../css/app.css" />
    <link rel="stylesheet" href="../css/icon/accessibility_foundicons.css">
    <link rel="stylesheet" href="../css/icon/social_foundicons.css">
    <link rel="stylesheet" href="../css/icon/general_enclosed_foundicons.css">

    <script src="../js/vendor/custom.modernizr.js"></script>

</head>
<body>

<?php include("include/source/header.php"); ?>

<?php
    include "include/source/menu_bar.php";
?>

<div class="row">
    <div class="large-3 columns">
        <div class="row content_hdr">
            <div class="large-12 columns">
                <i class="general foundicon-idea"></i>Action<br />

            </div>
        </div>
        <div class="row content_hdr_">
            <div class="large-12 columns">
                <ul class="side-nav menu">
                    <?php
                        if(!isset($_POST["view_person"])){
                    ?>
                    <li><a href="info_change.php">Change Information</a></li>
                    <li><a href="info_pass.php">Change Password</a></li>
                    <?php
                        }
                    ?>
                    <li><a href="include/pointer/pointer_logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <br />
        <div class="row content_hdr">
            <div class="large-12 columns">Calendar</div>
        </div>
        <div class="row content_hdr_">
            <div class="large-12 columns">

            </div>
        </div>
    </div>

    <div class="large-8 columns">
        <div class="row content_hdr">
            <div class="large-12 columns">Information</div>
        </div>
        <div class="row content_hdr_">
            <div class="large-12 columns">
                <div class="row">
                    <div class="large-3 columns">
                        <?php

                            if(isset($_POST["view_person"])){
                                $user = $_POST["user_id"];
                            }
                            else
                                $user = $_SESSION['user'];
                            $sql_img = "select * from user_img where user_id = '$user' ";
                            $result_img = mysql_query($sql_img);
                            $row_img = mysql_fetch_array($result_img);

                            if ($row_img['img_path'] == ""){

                                ?>
                                    No Image
                                <?php
                            }

                            else{
                                ?>
                                <img src=<?php echo "../" . $row_img['img_path'] . "image.jpg"; ?>  />
                                <?php
                            }
                        ?>
                    </div>
                    <div class="large-9 columns">
                        <?php

                            $sql = "select * from user_profile where user_id = '$user' ";

                            $result = mysql_query($sql);

                            // For the position

                            $sql = "select * from user_accounts left join user_type on(user_accounts.type_no = user_type.type_no) left join user_coll on(user_accounts.coll_id = user_coll.coll_id)  where user_accounts.user_id = '$user' ";

                            $pos = mysql_query($sql);
                            $pos_row = mysql_fetch_array($pos);


                            $row = mysql_fetch_array($result);

                        ?>
                        <h4><small><?php echo $row['fname'] . " " . $row['middle_initial'] . " " . $row['lname']; ?></small></h4>
                        <h4><small><?php echo $pos_row['name_type']; ?></small></h4>
                        <h4><small><?php echo $pos_row['coll_name']; ?></small></h4>
                    </div>
                </div>

                <hr />

                <div class="row info_content">
                    <div class="large-3 columns">
                        <div>Address:</div>
                    </div>
                    <div class="large-9 columns">
                        <div><?php echo $row["address"]; ?></div>
                    </div>
                </div>
                <div class="row info_content">
                    <div class="large-3 columns">
                        Gender:
                    </div>
                    <div class="large-9 columns">
                        <div><?php echo $row["gender"]; ?></div>
                    </div>
                </div>
                <div class="row info_content">
                    <div class="large-3 columns">
                        Birthdate:
                    </div>
                    <div class="large-9 columns">
                        <div><?php echo $row["birthday"]; ?></div>
                    </div>
                </div>
                <div class="row info_content">
                    <div class="large-3 columns">
                        Bio:
                    </div>
                    <div class="large-9 columns">
                        <div><?php echo $row["bio"]; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("include/source/footer.php"); ?>

<script>
    document.write('<script src=' +
            ('__proto__' in {} ? 'js/vendor/zepto' : 'js/vendor/jquery') +
            '.js><\/script>')
</script>

<script src="../js/vendor/jquery.js"></script>
<script src="../js/foundation.min.js"></script>
<script src="../js/vendor/jquery.stickyfooter.js"></script>

<script>
    $(document).foundation();
</script>
</body>
</html>
