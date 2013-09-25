<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<?php
include "include/source/open_db.php";
session_start();
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
                    <li><a href="info_change.php">Change Information</a></li>
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
            <div class="large-12 columns">Edit Account</div>
        </div>
        <div class="row content_hdr_">
            <div class="large-12 columns">
                <?php
                $show_hidden = 0;
                $error = "";
                $error_number = 0;
                if(isset($_SESSION["notification"])){
                    $alert_type = "success";
                    $content = $_SESSION["notification_content"];
                    unset($_SESSION["notification"]);
                    unset($_SESSION["notification_content"]);
                    $show_hidden = 1;
                }
                else if(isset($_SESSION["warning"])){
                    if($_SESSION["warning"] == "old")
                        $error_number = 1;
                    else if($_SESSION["warning"] == "new")
                        $error_number = 2;

                    $alert_type = "alert";
                    $error = $_SESSION["warning_content"];
                    unset($_SESSION["warning"]);
                    unset($_SESSION["warning_content"]);
                }

                if($show_hidden == 1){
                    ?>

                    <div class="row">
                        <div class="large-12 columns text-center">
                            <div class="<?php echo $alert_type; ?> alert-box">
                                <?php echo $content; ?>
                                <a href="#" class="close">&times;</a>
                            </div>
                        </div>
                    </div>

                    <?php
                    $show_hidden = 0;
                }
                ?>

                <form method="post" action="include/source/file_authenticate.php">
                    <div class="row">
                        <div class="large-12 columns">
                            <strong>Change Password</strong>
                            <hr />
                        </div>
                    </div>

                    <input type='hidden' name='user_id' value="<?php echo $_SESSION["user"]; ?>" />

                    <div class="row">
                        <div class="large-4 columns">
                            <label class="inline" for="first">Old password:</label>
                        </div>
                        <div class="large-5 columns">
                            <?php
                                $old = "";
                                if($error_number == 1)
                                    $old = "error";
                            ?>
                            <input class="<?php echo $old; ?>" type="text" id="first" name="pass" />
                            <?php
                                if($error_number == 1){
                            ?>
                                <small class="error"><?php echo $error; ?></small>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="large-2 columns"></div>
                    </div>

                    <div class="row">
                        <div class="large-4 columns">
                            <label class="inline" for="middle">New password:</label>
                        </div>
                        <div class="large-5 columns">
                            <?php
                                $new = "";
                                if($error_number == 2)
                                    $new = "error";
                            ?>
                            <input class="<?php echo $new; ?>" type="text" id="middle" name="new_pass" />
                            <?php
                                if($error_number == 2){
                            ?>
                            <small class="error"><?php echo $error; ?></small>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="large-2 columns"></div>
                    </div>

                    <div class="row">
                        <div class="large-4 columns">
                            <label class="inline" for="last">Re-type new password:</label>
                        </div>
                        <div class="large-5 columns">
                            <input class="<?php echo $new; ?>" type="text" id="last" name="re_new_pass" />
                        </div>
                        <div class="large-3 columns"></div>
                    </div>

                    <div class="row">
                        <div class="large-12 columns text-center">
                            <input type="submit" class="medium button" name="admin_change"/>
                        </div>
                    </div>
                </form>
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
