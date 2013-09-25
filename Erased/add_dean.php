<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<?php
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

<div class="row">
    <div class="large-12 columns panel hdr">
        <div class="row">
            <div class="large-12 columns text-center">
                <h1>Ourchive</h1>
            </div>
        </div>
        <div class="row">
        </div>
    </div>
</div>

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
            <div class="large-12 columns">Add a Dean</div>
        </div>

        <div class="row">
            <div class="large-12 columns content_hdr_">

                <br />

                <form class="custom">

                <div class="row">
                    <div class="large-3 columns">
                        <label for="user" class="left inline">Username:</label>
                    </div>

                    <div class="large-5 columns">
                        <input id="user" type="text" autofocus="" />
                    </div>

                    <div class="large-4 columns"></div>
                </div>

                <div class="row">
                    <div class="large-3 columns">
                        <label for="pass" class="left inline">Password:</label>
                    </div>

                    <div class="large-5 columns">
                        <input id="pass" type="text" />
                    </div>

                    <div class="large-4 columns"></div>
                </div>



                <div class="row">
                    <div class="large-3 columns">
                        <label for="test" class="left inline">College:</label>
                    </div>

                    <div class="large-5 columns">
                        <select id="test" class="">
                            <?php

                            $sql = "select * from user_coll where user_id = 'None' or user_id = ' ' ";
                            $get = mysql_query($sql);

                            while($set = mysql_fetch_array($get)){
                                ?>
                                <option>
                                <?php
                                echo $set['coll_name'];
                                ?>
                                </option>
                                <?php
                            }

                            ?>
                        </select>
                    </div>

                    <div class="large-4 columns"></div>
                </div>

                <div class="row">
                    <div class="large-3 columns">
                        <label for="first" class="left inline">First Name:</label>
                    </div>

                    <div class="large-5 columns">
                        <input id="first" type="text" />
                    </div>

                    <div class="large-4 columns"></div>
                </div>

                <div class="row">
                    <div class="large-3 columns">
                        <label for="last" class="left inline">Last Name:</label>
                    </div>

                    <div class="large-5 columns">
                        <input id="last" type="text" />
                    </div>

                    <div class="large-4 columns"></div>
                </div>

                <div class="row">
                    <div class="large-3 columns">
                        <label for="mid" class="left inline">Middle Initial:</label>
                    </div>

                    <div class="large-5 columns">
                        <input id="mid" type="text" />
                    </div>

                    <div class="large-4 columns"></div>
                </div>

                <div class="row">
                    <div class="large-3 columns">&nbsp;</div>

                    <div class="large-5 text-center columns">
                        <input type="submit" class="button" />
                    </div>

                    <div class="large-4 columns"></div>
                </div>

                </form>

            </div>
        </div>

    </div>

</div>

<div class="row">
    <div class="large-12 columns text-right">
        <hr />
        <h6><small>Copyright Ourchive Team 2012-2013.</small></h6>
    </div>
</div>

<script>
    document.write('<script src=' +
        ('__proto__' in {} ? '../js/vendor/zepto' : '../js/vendor/jquery') +
        '.js><\/script>')
</script>

<script src="../js/foundation.min.js"></script>

<script>
    $(document).foundation();
</script>
</body>
</html>
