<!DOCTYPE html>
<?php

session_start();

include "open_db.php";

if(isset($_POST["delete"])){

	$sql = "select img_path from user_img where user_id = '". $_POST["user_id"] ."' ";
	$result = mysql_query($sql);
	
	if(!$result)
		die(mysql_error());

	$row = mysql_fetch_array($result);
	
	if($row['img_path'] != ""){
	
		$mydir =  "../img/user/" . $_POST["user_id"];
		Echo $mydir;
		$d = dir($mydir); 
		while($entry = $d->read()) { 
		if ($entry!= "." && $entry!= "..") { 
			
			unlink($mydir . $entry); 
		 
		} 
		}
		$d->close(); 
		rmdir($mydir);
		
	}
	
	$sql = "delete from user_accounts where user_id = '". $_POST["user_id"] ."' ";
	
	$result = mysql_query($sql);

	
	if (!$result)
		die("Error in deleting account: " + mysql_error());
	
	header("location: ../files.php");

}

else if(isset($_POST["change"])){

	//Will this work?
	$_SESSION['user_id'] = $_POST["user_id"];
	//setcookie("user_id",$post, 60 * 60 * 24 * 60 + time() ,"/");
	header("location: admin/files_change.php");

}

////////////////////////////////////////////////////////////////////////////////////
// FILE EDIT
////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST["edit"])){

	$_SESSION["user_id"] = $_POST["user_id"];
	
	header("location: admin/files_edit.php");

}

////////////////////////////////////////////////////////////////////////////////////
// FILE CHANGE PASSWORD
////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST["change_pass"])){

//THIS NEEDS AUTO-GENERATION

	unset($_SESSION['user_id']);
	
	$user_id = $_POST["user_id"];
	$pass = md5($_POST["new_pass"]);
	$new_pass = md5($_POST["re_new_pass"]);
	
	if($pass != $new_pass){
		$_SESSION['warning'] = "Passwords are not equal. Please try again.";
	}
	else{
	$sql = "update user_accounts set password = '$pass' where user_id = '$user_id' ";
	mysql_query($sql,$con);
	}
	
	header("location: ../files.php");

}

////////////////////////////////////////////////////////////////////////////////////
// ADMIN CHANGE PASSWORD change_pass.php
////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST["admin_change"])){

	$user = $_POST["user_id"];
	$pass = md5($_POST["pass"]);
	$new_pass = md5($_POST["new_pass"]);
	$re_new = md5($_POST["re_new_pass"]);
	
	$sql = " select * from user_accounts where user_id = '".$user."' ";
	
	$result = mysql_query($sql);
	
	$row = mysql_fetch_array($result);
	echo $user;
	echo $pass . " " . $row['password'];
	
	if($pass != $row["password"]){
        $_SESSION["warning"] = "old";
		$_SESSION['warning_content'] = "Old password is wrong";
		header("location: ../../info_pass.php");
	}
	
	else if($new_pass != $re_new){
        $_SESSION["warning"] = "new";
		$_SESSION['warning_content'] = "Password is not the same";
		header("location: ../../info_pass.php");
	}
	
	else{
	
		$sql = "update user_accounts set password = '$new_pass' where user_id = '$user' ";
		
		mysql_query($sql, $con);
        $_SESSION["notification"] = "notify";
		$_SESSION["notification_content"] = "New password set.";
		header("location: ../../info_pass.php");
	
	}
}

if(isset($_POST['name_b'])){

$id = $_POST['user_id'];
$_SESSION['user_id'] = $id;

header("location:../your_info.php");

}

mysql_close($con);

	


?>