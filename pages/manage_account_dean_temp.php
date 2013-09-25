<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en" xmlns="http://www.w3.org/1999/html"> <!--<![endif]-->

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
                <i class="general foundicon-idea"></i>Action
            </div>
        </div>
        <div class="row content_hdr_">
            <div class="large-12 columns">
                <ul class="side-nav menu">
                    <li><a href="#" data-reveal-id="addModal">Add College</a></li>
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
            <div class="large-12 columns">Search Accounts</div>
        </div>
        <div class="row content_hdr_">
            <div class="large-12 columns">
                <table>
                    <thead>
                    <tr>
                        <td class="text-left">Name</td>

                        <td class="text-center">College</td>

                        <td class="text-center">Action</td>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    /* TRUE CODE for DEAN
                    $sql = "SELECT * FROM user_profile LEFT JOIN user_coll on(user_profile.user_id = user_coll.user_id) WHERE
                    user_profile.user_id != '". $_SESSION["user"] ."' AND user_coll.coll_id = '". $_SESSION["coll_id"] ."' ";
                    */

                    $sql = "SELECT * FROM user_profile LEFT JOIN user_coll on(user_profile.user_id = user_coll.user_id)
                            LEFT JOIN user_accounts on(user_profile.user_id = user_accounts.user_id)
                            LEFT JOIN user_type on(user_accounts.type_no = user_type.type_no) WHERE
                            user_profile.user_id != '". $_SESSION["user"] ."' AND user_accounts.type_no < '". $_SESSION["type"] ."'
                            order by user_profile.fname asc";

                    $result = mysql_query($sql);

                    if(mysql_num_rows($result) == 0){
                        ?>
                    <tr>
                        <td colspan="3" class="text-center">There are no people in the list...</td>
                    </tr>
                        <?php
                    }

                    else{
                        $hello = 0;
                        while($row = mysql_fetch_array($result)){

                            ?>
                        <tr>



                                <?php

                                echo "<input type=\"hidden\" value=" . $row['user_id'] . " name=\"user_id\" />";

                                    ?>
                                    <td>
                                        <form action="info.php" method="post">

                                            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>" />
                                            <input type="hidden" name="college" value="<?php echo $row['coll_name']; ?>" />

                                            <input type="submit" name="view_person" class="invi_button" value="<?php echo $row['fname']. " " . $row['middle_initial'] . " " . $row['lname'] ; ?>" />

                                        </form>
                                    </td>
                                    <?php

                                ?>



                                <td class="text-center">
                                   <?php echo $row["name_type"]; ?>
                                </td>

                            <td class="text-center">

                                <a href="#" data-dropdown="drop1" class="small button dropdown">Option</a>


                                <ul id="drop1" class="f-dropdown">

                                    <?php

                                    ?>
                                <li><a href="#" id="add" >Change Password</a></li>
                                <li><a href="#" data-reveal-id="deleteModal">Delete User</a></li>
                                </ul>
                            </td>
                        </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
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
<script src="../js/foundation/foundation.dropdown.js"></script>

<script>
    $(document).foundation();
    $(document).ready(function() {

    <?php
    ?>
        $("#add").each(function(index, value){
            if(index == 1){
                alert(index);
                $(this).text("wew");
            }
        });



    });
</script>
</body>
</html>
