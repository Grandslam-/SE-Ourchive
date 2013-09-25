<?php

session_start();

$user = $_POST["user"];
$pass = md5($_POST["pass"]);

include "open_db.php";
include "db.php";

$db = new db();
$db -> search_full("select * from user_accounts LEFT JOIN user_coll on(user_accounts.coll_id = user_coll.coll_id) where user_accounts.user_id='$user' and password='$pass'");

$_SESSION["type"] = $db -> getSelection("type_no");
var_dump($_SESSION["type"]);
$_SESSION['coll_id'] = $db -> getSelection("coll_id");

$count = $db -> getNumRow();

$db2 = new db();
$db2 -> search_full("select * from user_profile where user_id = '$user' ");
$result = mysql_fetch_array(mysql_query($sql));

/*if(preg_match ("/[^0-9-]/",$user) && $user != 'admin'){

    $_SESSION["warning"] = "user";
	$_SESSION["warning_content"] = "User ID must have no letters";
    header("location:../../../index.php");
	
}*/

if($count == 1){

	session_start();
	// store session data
	$_SESSION['user'] = $user;
	$_SESSION['name'] = $result['fname'];
    header("location:../../home.php");

}
else{

    $_SESSION["warning"] = "all";
	$_SESSION["warning_content"] = "Account not found. Please try again.";
    header("location:../../../index.php");
	
}

mysql_close($con);

?>