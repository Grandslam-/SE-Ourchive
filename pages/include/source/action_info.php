<?php

session_start();
include "class.upload.php";
include "open_db.php";

if(isset($_POST['submit_info'])){

$fname = $_POST["fname"];
$minitial = $_POST["minitial"];
$lname = $_POST["lname"];

$address = $_POST["address"];
$gender = $_POST["gender"];
$birthday = $_POST["birthday"];
$position = $_POST["position"];

$bio = $_POST["bio"];

// Second middle initial dot

$fname = filter_var($fname, FILTER_SANITIZE_EMAIL);
$minitial = filter_var($minitial, FILTER_SANITIZE_EMAIL);
$lname = filter_var($lname, FILTER_SANITIZE_EMAIL);

$address = filter_var($address, FILTER_SANITIZE_SPECIAL_CHARS);
$gender = filter_var($gender, FILTER_SANITIZE_EMAIL);
$birthday = filter_var($birthday, FILTER_SANITIZE_SPECIAL_CHARS);
$position = filter_var($position, FILTER_SANITIZE_EMAIL);

$bio =  filter_var($bio, FILTER_SANITIZE_SPECIAL_CHARS);

//Put a dot next to the initial.
$minitial = strtoupper($minitial);
$minitial .= ".";

$sql = "update user_profile set fname = '$fname', middle_initial = '$minitial', lname = '$lname', address = '$address', gender = '$gender', birthday = '$birthday', position = '$position', bio = '$bio' where user_id = '" . $_SESSION['user'] . "'";
		
mysql_query($sql);
$_SESSION["notification"] = "all";
$_SESSION["notification_content"] = "Profile changed.";
header("location:../../info_change.php");

}

else if(isset($_POST['image_submit'])){

	$sql = "select user_img.*, user_coll.coll_id from user_img LEFT JOIN user_coll 
	on(user_img.user_id = user_coll.user_id) where user_img.user_id = '". $_POST['user_id'] ."'";
	
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$handle = new upload($_FILES['image_field']);
	if ($handle -> uploaded){
	
		$handle -> file_new_name_body = "image";
		$handle -> allowed = 'image/*';
		$handle -> file_overwrite = true;
		$handle -> image_resize	= true;
		$handle -> image_convert = 'jpg';
		$handle -> image_x = 150;
		$handle -> image_y = 150;
		$handle -> process("../../../img/user/" . $row['coll_name'] . "/" . $row['user_id'] ."");
		if ($handle -> processed){
		
			echo $row['coll_id'];
			$sql = "update user_img set img_path = 'img/user/" . $row['coll_name'] . "/" . $row['user_id'] ."/' where user_id = '".$_SESSION['user']."' ";
			mysql_query($sql);
			$handle -> clean();
            $_SESSION["notification"] = "all";
            $_SESSION["notification_content"] = "Image uploaded.";
			header("location:../../info_change.php");
			
		}
		
		else{
			echo 'error: ' . $handle -> error;
            $_SESSION["warning"] = "error";
			$_SESSION['warning_content'] = $handle -> error;
			header("location: ../../info_change.php");
		}
	
	}

}



?>