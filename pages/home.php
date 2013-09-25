<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<?php

    session_start();
    include "include/source/open_db.php";
    include "include/source/db.php";

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
                    <li><a href="edit_announce.php">Edit Announcements</a></li>
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

    <div class="large-8 large-offset-1 columns">
        <div class="row content_hdr">
            <div class="large-12 columns">Home</div>
        </div>
        <div class="row content_hdr_">
            <div class="large-12 columns">
                <?php

                    $sql = "select * from announcement ";


                    $result = mysql_query($sql);

                    $row = mysql_fetch_array($result);
                ?>
                <h3><?php echo $row["title"]; ?></h3>

                <small><?php echo $row["date"] ?></small> <br /><br />
                <p><?php echo $row["content"] ?></p>

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
