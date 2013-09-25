<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

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

<?php include("pages/include/source/header.php"); ?>

<?Php
include "include/source/menu_bar.php";
?>
</div>

<div class="row">

    <div class="large-3 columns">
        <div class="row content_hdr">
            <div class="large-12 columns">
                <i class="general foundicon-idea"></i>Action <br />

            </div>
        </div>
        <div class="row content_hdr_">
            <div class="large-12 columns">
                <a href="include/pointer/pointer_logout.php">Logout</a>
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
            <div class="large-12 columns">Edit Announcement</div>
        </div>
        <div class="row content_hdr_">
            <form method="post" action="include/source/action_announcement.php">
            <div class="large-12 columns">
                <?php
                    session_start();
                    include "include/source/open_db.php";
                    $sql = "select * from announcement";

                    $result = mysql_query($sql);

                    $row = mysql_fetch_array($result);
                    if(isset($_SESSION["warning"])){
                ?>
                <div class="row">
                    <div class="large-12 columns">
                        <div data-alert class="alert-box alert">
                            <?php echo $_SESSION["warning_content"]; ?>
                            <a href="" class="close">&times;</a>
                        </div>
                    </div>
                </div>
                <?php
                        unset($_SESSION["warning"]);
                        unset($_SESSION["warning_content"]);
                    }
                ?>

                <div class="row">
                    <div class="large-2 columns">
                        <label class="inline" for="title">Title</label>
                    </div>
                    <div class="large-6 columns ">
                        <input id="title" type="text" placeholder="<?php echo $row["title"]; ?>" name="title" />
                    </div>
                    <div class="large-4 columns"></div>
                </div>
                <div class="row">
                    <div class="large-2 columns">
                        <label class="inline" for="content">Content</label>
                    </div>
                    <div class="large-9 columns">
                        <textarea id="content" placeholder="<?php echo $row["content"]; ?>" name="content" /></textarea>
                    </div>
                    <div class="large-1 columns"></div>
                </div>


                <input type="submit" class="small button" name="submit_announce" value="Save" />
            </div>
            </form>
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
