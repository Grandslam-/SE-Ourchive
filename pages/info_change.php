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
                    <li><a href="info_pass.php">Change Password</a></li>
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
                    include("include/source/alert_code.php");
                ?>

                <div class="row">
                    <div class="large-12 columns">
                        <?php
                        $sql_img = "select * from user_img where user_id = '".$_SESSION['user']."' ";
                        $result_img = mysql_query($sql_img);
                        $row_img = mysql_fetch_array($result_img);
                        ?>
                        <div><strong>Image</strong></div>
                        <hr />
                        <form class="custom" enctype="multipart/form-data" method="post" action="include/source/action_info.php">
                            <div>
                                <input type="hidden" name="user_id" value="<?php echo $row_img['user_id']; ?>" />
                                <input type="file" class="small" name="image_field" />
                                <input type="submit" class="small button" name="image_submit" />
                            </div>
                            <form enctype="multipart/form-data" method="post" action="action_info.php">
                    </div>
                </div>


                <form class="custom" method="post" action="include/source/action_info.php">
                    <div class="row">
                        <div class="large-12 columns">
                            <strong>Profile</strong>
                            <hr />
                        </div>
                    </div>

                    <?php
                    $sql = "select * from user_profile where user_id = '" . $_SESSION["user"] . "'; ";

                    $result = mysql_query($sql);

                    $row = mysql_fetch_array($result);
                    ?>

                    <div class="row">
                        <div class="large-3 columns">
                            <label class="inline" for="first">First Name:</label>
                        </div>
                        <div class="large-5 columns">
                            <input type="text" id="first" name="fname" value="<?php echo $row["fname"]; ?>" />
                        </div>
                        <div class="large-4 columns"></div>
                    </div>

                    <div class="row">
                        <div class="large-3 columns">
                            <label class="inline" for="middle">Middle Initial:</label>
                        </div>
                        <div class="large-5 columns">
                            <input type="text" id="middle" name="minitial" value="<?php echo $row["middle_initial"]; ?>" />
                        </div>
                        <div class="large-4 columns"></div>
                    </div>

                    <div class="row">
                        <div class="large-3 columns">
                            <label class="inline" for="last">Last Name:</label>
                        </div>
                        <div class="large-5 columns">
                            <input type="text" id="last" name="lname" value="<?php echo $row["lname"]; ?>" />
                        </div>
                        <div class="large-4 columns"></div>
                    </div>

                    <div class="row">
                        <div class="large-3 columns">
                            <label class="inline" for="address">Address:</label>
                        </div>
                        <div class="large-5 columns">
                            <input type="text" id="address" name="address" value="<?php echo $row["address"]; ?>" />
                        </div>
                        <div class="large-4 columns"></div>
                    </div>

                    <div class="row">
                        <div class="large-3 columns">
                            <label class="inline" for="gender">Gender:</label>
                        </div>
                        <div class="large-5 columns">
                            <select id="gender" class="medium" name="gender" >
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="large-4 columns"></div>
                    </div>

                    <div class="row">
                        <div class="large-3 columns">
                            <label class="inline" for="birthdate">Birthdate:</label>
                        </div>
                        <div class="large-5 columns">
                            <input type="date" id="birthdate" name="birthday" />
                        </div>
                        <div class="large-4 columns"></div>
                    </div>

                    <div class="row">
                        <div class="large-3 columns">
                            <label for="box">Bio:</label>
                        </div>
                        <div class="large-8 columns">
                            <textarea id="box" name="bio"><?php echo $row["bio"]; ?></textarea>
                        </div>
                        <div class="large-1 columns"></div>
                    </div>

                    <div class="row">
                        <div class="large-12 columns text-center">
                            <input type="submit" class="medium button" name="submit_info"/>
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
            ('__proto__' in {} ? '../js/vendor/zepto' : '../js/vendor/jquery') +
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
