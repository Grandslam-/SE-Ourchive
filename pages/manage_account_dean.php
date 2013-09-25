<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en" xmlns="http://www.w3.org/1999/html"> <!--<![endif]-->

<?php
include "include/source/open_db.php";
session_start();

//Permit access called

$access = 3;
$dir = "";

include ("include/source/permit_access.php");

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

<?php

include("include/source/alert_code.php");

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

                $sql = "select count(*) as count from user_coll where coll_id = 1 OR coll_id = 2 order by user_coll.coll_name asc";

                $get = mysql_query($sql);
                $total = mysql_fetch_array($get);

                $sql = "select * from user_coll
                    LEFT JOIN user_accounts on(user_coll.coll_id = user_accounts.coll_id) where user_accounts.coll_id > 0
                    GROUP BY user_accounts.coll_id order by user_coll.coll_name asc ";

                $get = mysql_query($sql);
                $row = mysql_num_rows($get);

                if(($total["count"] - $row) != 0){
                    ?>

                    <li><a href="#" data-reveal-id="addModal_staff" id="createDean">Create Faculty</a></li>

                <?php
                }
                else{ echo $row ;
                    ?>

                    <li>Create Faculty</li>

                <?php
                }
                ?>

                <?php

                $sql = "select * from user_accounts where type_no = 4";
                $get = mysql_query($sql);
                $row = mysql_num_rows($get);

                if($row == 0){
                    echo "<li> Uncategorized ( 0 )</li>";
                }
                else{

                    ?>

                    <li><a href="#" >Uncategorized ( <?php echo $row; ?> )</a>  </li>

                <?php

                }

                ?>

                <li><hr /></li>
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
        <div class="large-12 columns">Manage Accounts</div>
    </div>
    <div class="row content_hdr_">
        <div class="large-12 columns">
            <table width="100%">
                <thead>
                <tr>
                    <td class="text-left">Name</td>
                    <td class="text-center">Type</td>
                    <td class="text-center">Action</td>
                </tr>
                </thead>
                <tbody>

                <?php

                $per_page = 5;
                $limit_page_num = 10;

                //How many records?
                $sql = "select count(*) from user_accounts where type_no = 1 OR type_no = 2 AND coll_id = " . $_SESSION['type'];

                $pages_query = mysql_query($sql);
                //How many pages that can display these records?
                // Removed the -1 from the equation
                $pages = ceil( (mysql_result($pages_query, 0)) / $per_page );

                //The current page
                $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
                //When getting records in the database, get the first one
                $start = ($page - 1) * $per_page;
                $limit = ($page - 1) * $per_page;

                $sql = "select * from user_accounts
                    LEFT JOIN user_type on(user_type.type_no = user_accounts.type_no) LEFT JOIN user_profile
                    on(user_accounts.user_id = user_profile.user_id) where (user_type.type_no = 1 OR user_type.type_no = 2 )
                    AND user_accounts.type_no != '".$_SESSION["type"]."' order by user_profile.fname LIMIT $limit, $per_page";

                $result = mysql_query($sql);

                if(mysql_num_rows($result) == 0){
                    ?>
                    <tr>
                        <td>There are no people in the list...</td>
                    </tr>
                <?php
                }

                else{
                    while($row = mysql_fetch_array($result)){
                        ?>
                        <tr>

                            <td>

                                <form action="info.php" method="post">
                                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>" />

                                    <input type="submit" name="view_person" class="invi_button" value="<?php echo $row['fname']. " " . $row['middle_initial'] . " " . $row['lname'] ; ?>" />

                                </form>

                            </td>

                            <?php

                            echo "<input type=\"hidden\" value=" . $row['user_id'] . " name=\"user_id\" />";
                            if($row["coll_id"] == ""){
                                ?>
                                <td>
                                    <?php echo "None" ?>
                                </td>
                            <?php
                            }
                            else{
                                ?>
                                <td class="text-center">
                                    <?php echo $row["name_type"]; ?>
                                </td>
                            <?php

                            }
                            ?>



                            <td class="text-center">

                                <form method="post" action="">
                                    <?php
                                    if($row["user_id"] == "" || $row["user_id"] == "None"){
                                        ?>
                                        <input type="submit" class="option button" name="remove_dean" value="R" title="No dean assigned" disabled/>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <a href="" class="option button" title="Remove Dean" data-reveal-id="removeModal_<?php echo $row[0]; ?>" >R</a>
                                    <?php
                                    }
                                    ?>
                                    <a href="" class="option button" title="Delete College" data-reveal-id="deleteModal_<?php echo $row[0]; ?>" >D</a>

                                    <a href="" class="option button" title="Edit College" data-reveal-id="editModal_<?php echo $row[0]; ?>" >E</a>
                                </form>

                            </td>
                        </tr>


                    <?php
                    }
                }
                ?>

                </tbody>
            </table>
            <div>
                <?php
                include "include/source/pagination.php";
                ?>
            </div>
        </div>
    </div>
</div>
</div>

<footer>

<div class="row">
    <div class="large-12 columns text-right">
        <hr />
        <h6><small>Copyright Ourchive Team 2012-2013.</small></h6>
    </div>
</div>

</footer>

<div id="addModal_staff" class="reveal-modal small">

    <h3>Create a Staff</h3>
    <em><p>All fields must be filled.</p></em>

    <hr />

    <div class="row">

        <div class="large-8 columns">

            <form class="custom" method="post" action="include/source/mychive_script.php">

                <h4>Account</h4>

                <label  for="user">Username:</label>
                <input id="user" type="text" name="add_user" maxlength="15" />
                <label for="pass">Password:</label>
                <input id="pass" type="password" name="add_pass" maxlength="15" />

                <h4 id="h_staff">College</h4>

                <label for="staff">Staff:</label>
                <select id="staff" name="staff_pick" class="text-center">

                    <option>Pick One</option>
                    <option value="CCE">CCE</option>
                    <option value="Employee">Employee</option>

                </select>

                <h4>Name</h4>

                <label for="first">First Name:</label>
                <input id="first" type="text" name="add_first" maxlength="50" />
                <label for="last">Last Name:</label>
                <input id="last" type="text" name="add_last" maxlength="50" />
                <label for="middle">Middle Initial:</label>
                <input id="middle" type="text" name="add_middle" maxlength="1"/>

                <input type="hidden" name="college" />
                <input type="hidden" id="coll_id" name="college_id" />

        </div>

    </div>

    <hr />
    <div class="row">
        <div class="large-12 columns">
            <input id="create_staff" type="submit" class="button" name="create_dean" value='Create' />
        </div>
    </div>

    </form>



    <a class="close-reveal-modal">&#215;</a>
</div>



<?php

$sql = "select * FROM user_coll LEFT JOIN user_accounts on(user_coll.coll_id = user_accounts.coll_id) where user_coll.coll_id != '".$_SESSION["coll_id"]."'
                    Group by user_coll.coll_name order by user_coll.coll_name LIMIT $limit, $per_page";
$get = mysql_query($sql);
while($row = mysql_fetch_array($get)){

    $edit_id = $row[0];
    $edit_output = $row["coll_name"];
    //The Dean's id
    $remove_dean = $row[3];
    ?>

    <div id="deleteModal_<?php echo $edit_id; ?>" class="reveal-modal small">
        <h3>Confirmation</h3>
        <hr />

        <div class="row">
            <div class="large-12 columns text-center">

                <p>Are you sure you want to delete the <strong><?php echo $edit_output; ?></strong>?</p>
                <form class="custom" method="post" action="include/source/mychive_script.php">

                    <input type="hidden" name="delete_id_college" value="<?php echo $edit_id; ?>" />
                    <input class="secondary button" type="submit" name="delete_move_college" value="Delete the College but not the staff" />
                    <br />
                    Or
                    <br />
                    <br />
                    <input class="button alert" type="submit" name="delete_college" value="Delete the College and the staff" />

                </form>

            </div>
        </div>
        <a class="close-reveal-modal">&#215;</a>
    </div>

    <div id="editModal_<?php echo $edit_id; ?>" class="reveal-modal small">
        <h3>Edit <i><?php echo $edit_output; ?></i></h3>
        <hr />

        <form class="custom" method="post" action="include/source/mychive_script.php">

            <input type="hidden" name="edit_id_college" value="<?php echo $edit_id; ?>" />
            <select name="edit_college_list" class="small">
                <option value="College of"> College of </option>
                <option value="Institute of"> Institute of </option>
            </select>

            <input id="input_college" type="text" name='edit_input_college' placeholder="Put name of college here" size=35 maxlength=50 />

            <input id="create_college" class="button small" type="submit" name="edit_college_button" value="Rename" />

        </form>
        <a class="close-reveal-modal">&#215;</a>
    </div>

    <div id="removeModal_<?php echo $edit_id; ?>" class="reveal-modal small">
        <h3>Remove Dean?</h3>
        <hr />

        <div class="row">
            <div class="large-12 columns text-center">

                <p>Are you sure you want to remove this dean?</p>
                <form class="custom" method="post" action="include/source/mychive_script.php">

                    <input type="hidden" name="remove_id" value="<?php echo $remove_dean; ?>" />
                    <input class="alert button" type="submit" name="remove_dean" value="Remove" />

                </form>

            </div>
        </div>
        <a class="close-reveal-modal">&#215;</a>
    </div>

<?php

}

?>





<script>
    document.write('<script src=' +
        ('__proto__' in {} ? '../js/vendor/zepto' : '../js/vendor/jquery') +
        '.js><\/script>')
</script>

<script src="../js/vendor/jquery.js"></script>
<script src="../js/foundation.min.js"></script>
<script src="../js/vendor/jquery.stickyfooter.js"></script>
<script src="../js/foundation/foundation.dropdown.js"></script>

<script>
    $(document).foundation();
    $(document).ready(function() {
        /*$("#add_dean").click(function(e) {
         e.preventDefault();
         var target = $(this).attr('href');
         var target_name = $(this).text();
         $("#coll_id").val(target);
         $("#deanModal").trigger('click');
         });*/

        $("#create_staff").click(function(e) {

            var truth = false;

            if($("#user").val() == ""){
                $("#user").addClass("error");
                truth = true;
            }
            else
                $("#user").removeClass("error");

            if($("#pass").val() == ""){
                $("#pass").addClass("error");
                truth = true;
            }
            else
                $("#pass").removeClass("error");

            if($("#staff").val() == "Pick One"){
                $("#h_staff").addClass("label alert");
                truth = true;
            }
            else
                $("#h_staff").removeClass("label alert");

            if($("#first").val() == ""){
                $("#first").addClass("error");
                truth = true;
            }
            else
                $("#first").removeClass("error");

            if($("#last").val() == ""){
                $("#last").addClass("error");
                truth = true;
            }
            else
                $("#last").removeClass("error");

            if($("#middle").val() == ""){
                $("#middle").addClass("error");
                truth = true;
            }
            else
                $("#middle").removeClass("error");

            if(truth == true)
                return false;


        });


    });
</script>
</body>
</html>
