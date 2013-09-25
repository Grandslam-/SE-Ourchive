<!DOCTYPE html>

<?php

    include "pages/include/source/check_user.php";

?>

<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />

    <title>Welcome to Ourchive</title>

    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/icon/accessibility_foundicons.css">
    <link rel="stylesheet" href="css/icon/social_foundicons.css">
    <link rel="stylesheet" href="css/icon/general_enclosed_foundicons.css">
    <link rel="stylesheet" href="css/app.css" />

    <script src="js/vendor/custom.modernizr.js"></script>

</head>
<body>

<?php include("pages/include/source/header.php"); ?>

<div class="row">

    <div class="large-7 columns panel content">
        <h2><small>Welcome to Ourchive</small></h2>
        <p>
            The goal of this website is to:
        </p>

        <ul class="square lefter text-justify">
            <li>To achieve objectives that will allow and help standardize faculty ranks in USEP.</li>
            <li>To rationalize the salary rate appropriate to a faculty rank. To have an instrument for generating faculty profile.</li>
            <li>To serve as a basis for policy decisions for accelerated faculty development.</li>
            <li>To motivate a faculty to upgrade his/her rank and compensation by improving his/her academic qualifications, achievement and performance.</li>
        </ul>
    </div>

    <div class="large-4 large-offset-1 columns panel content">
        <p><i class="social foundicon-torso"></i><strong>Account</strong></p>

        <form action="pages/include/source/authenticate.php" method="post">
            <?php
                if(isset($_SESSION['warning'])){
                if($_SESSION["warning"] == "all"){
            ?>
                    <div data-alert class="alert-box alert">
                        <?php echo $_SESSION["warning_content"]; ?>
                    </div>
            <?php
                }
                if($_SESSION['warning'] == "user"){
            ?>
                    <span data-tooltip class="has-tip tip-top" title="Input your user ID">User ID</span>
                    <input type="text" placeholder="Username" name="user" class="user error" />
                    <small class="error"><?php echo $_SESSION["warning_content"]; ?></small>
            <?php
                }
                else{
            ?>
                    <span data-tooltip class="has-tip tip-top" title="Input your user ID">User ID</span>
                    <input type="text" placeholder="User ID" name="user" class="user" />
            <?php
                }unset($_SESSION["warning"]);}
                //THIS IS THE LINE WHERE IF THE SESSION HAS NO DATA
                else{
            ?>
                <span data-tooltip class="has-tip tip-right" title="Input your user ID">User ID</span>
                <input type="text" placeholder="User ID" name="user" class="user" />
            <?php
                }
            ?>

            <span data-tooltip class="has-tip tip-right" title="Input your password">Password</span>
                <input type="password" placeholder="Password" name="pass" class="pass" />

            <div class="text-right">
                <input type="submit" class="button" name="acc_submit" value="Login" />
            </div>
        </form>
    </div>

</div>

<?php include("pages/include/source/footer.php"); ?>

<script>
    document.write('<script src=' +
            ('__proto__' in {} ? 'js/vendor/zepto' : 'js/vendor/jquery') +
            '.js><\/script>')
</script>

<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script src="js/vendor/jquery.stickyfooter.js"></script>

<script>
    $(document).foundation();
</script>

</body>
</html>
