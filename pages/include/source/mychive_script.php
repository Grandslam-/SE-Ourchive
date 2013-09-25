<?php

session_start();

include "open_db.php";

if(isset($_POST['create_college'])){
	$coll = $_POST['college'] . " " . $_POST['input_college'];
	
	//PREG_MATCH STILL NEEDS TO BE DEBUGGED! Can't detect if it's number or letter!
	if(!preg_match ("/[^0-9]/", $coll)){
		$_SESSION['warning'] = "Colleges have no number in their names. Please provide another name.";
        $_SESSION["warning_content"] = "Colleges have no number in their names. Please provide another name.";
		header("location: ../../manage_account.php");
	}
	
	else{
	
		$sql = "select * FROM user_coll";
		$result = mysql_query($sql);
	
			$sql = "insert into user_coll
					(coll_name)
					values
					('$coll')";
			$result = mysql_query($sql);
			
			if(!$result){
                echo $coll . "Test " . mysql_error();
				$_SESSION['warning'] = "Identical College Name.";
                $_SESSION["warning_content"] = "Identical College Name.";
				header("location: ../../manage_account.php");
			}
			else{
				$_SESSION['notification'] = "The " . $coll . " has been added.";
                $_SESSION['notification_content'] = "The " . $coll . " has been added.";
				header("location: ../../manage_account.php");
			}
		
	}
	
}

//Adding the DEAN
else if(isset($_POST['create_dean'])){
	
	//Colleges
	$coll_name = $_POST['college_pick'];
    echo $coll_name . "Test";
	
	//Account
	$user  = $_POST['add_user'];
	$pass  = md5($_POST['add_pass']);
	$first = ucwords($_POST['add_first']);
	$last  = ucwords($_POST['add_last']);
	$mid   = ucwords($_POST['add_middle']);
	$mid  .= ".";
	
	$sql = "select user_id from user_accounts where user_id = '" .$user. "' ";

	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	
	if($count != 0){

        $_SESSION['warning'] = "Similar Username found. Please try again.";
        $_SESSION["warning_content"] = "Similar Username found. Please try again.";
        header("location: ../../manage_account.php");

	}

	else if(is_numeric($mid)){

		$_SESSION['warning'] = "Middle Initial should be a letter!";
        $_SESSION["warning_content"] = "Middle Initial should be a letter!";
		header("location: ../../manage_account.php");

	}
	
	else{

        //echo $user . " " . $coll_name;

        $sql = "select coll_id FROM user_coll WHERE coll_name = '$coll_name'";

        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        $id = $row["coll_id"];
	
		$sql = "INSERT into user_accounts
				(user_id,type_no,password,coll_id)
				VALUES
				('$user',3,'$pass','$id')";
				
		$result = mysql_query($sql);
		
		if(!($result))
			die("Error in sql1: " . mysql_error());
			
		$sql = "INSERT into user_profile
				(user_id,fname,lname,middle_initial)
				VALUES
				('$user','$first','$last','$mid')";
				
		$result = mysql_query($sql);
		
		if(!($result))
			die("Error in sql2: " . mysql_error());
		
		/*

		$sql = "insert into user_img
			(user_id)
			values
			('$user')
			";
			
		$result = mysql_query($sql);

		if(!($result))
			die("Error in sql3: " . mysql_error());
		*/
		
		$_SESSION['notification'] = "Dean for $coll_name added.";
        $_SESSION["notification_content"] = "Dean for $coll_name added.";
		header("location: ../../manage_account.php");
	
	}
	

}

else if(isset($_POST["delete"])){

	$sql = "select * FROM user_profile where user_id = '". $_POST['user_id'] ."' ";

	$row = mysql_fetch_array(mysql_query($sql));

	$_SESSION['notification'] = "Dean " . $row['lname'] . ", " . $row['fname'] . " has been removed";

	if($_POST['user_id'] == Null){
		$_SESSION['warning'] = "There is no one to remove.";
	}
	else{
		$sql = "select img_path from user_img where user_id = '". $_POST["user_id"] ."' ";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		
		if($row['img_path'] != ""){
		
			$mydir =  "../../../img/user/" . $_POST["user_id"] . "/";
			var_dump($mydir);
			$d = dir($mydir);
            var_dump(dir($mydir));
			while($entry = $d->read()) { 
			if ($entry!= "." && $entry!= "..") { 
				
				unlink($mydir . $entry); 
			 
			} 
			}
			$d->close(); 
			rmdir($mydir);
			
		}

        $sql = "update user_coll set user_id = '' where user_id = '". $_POST["user_id"] ."'";

        mysql_query($sql,$con);
		
		$sql = "delete from user_accounts where user_id = '". $_POST["user_id"] ."'";
		
		mysql_query($sql, $con);
		
		
		
		//$sql = "delete from user_img where user_id = '". $_POST["user_id"] ."' ";
		
		//mysql_query($sql, $con);
	
	}
	
	//header("location: ../../manage_account.php");

}

else if(isset($_POST["edit"])){
	if($_POST['user_id'] == ""){
		$_SESSION['warning'] = "There is no one to edit.";
		header("location: files.php");
	}
	else{
		$_SESSION["user_id"] = $_POST["user_id"];
		header("location: page/admin/files_edit.php");
	}
	
}

else if(isset($_POST["change"])){
	if($_POST['user_id'] == ""){
		$_SESSION['warning'] = "There is no one to change password.";
		header("location: files.php");
	}
	else{
		$_SESSION['user_id'] = $_POST["user_id"];
		header("location: page/admin/files_change.php");
	}
}

else if(isset($_POST['assign'])){
	header("location: page/admin/files_add.php");
}

else if(isset($_POST['view_college'])){
	
	if($_POST['user_id'] == "None" || $_POST['user_id'] == Null ){
		$_SESSION['warning'] = "No dean in the " .$_POST['college']. ". ";
		header("location: files.php");
	}
	else{
		$_SESSION['user_id'] = $_POST['user_id'];
		header("location: your_info.php");
	}
	
}

// Deleting the College
// INCOMPLETE
else if(isset($_POST['delete_college'])){

	$coll_id = $_POST['delete_id_college'];

    $sql = "select * FROM user_accounts LEFT JOIN user_img on(user_accounts.user_id = user_img.user_id) where user_accounts.coll_id = $coll_id ";
    $get = mysql_query($sql);

    while($row = mysql_fetch_array($get)){

        if(is_null($row["img_path"]))
            echo "This is null";
        else{
            $dir = "../../../" . $row["img_path"];

            include "delete_code.php";
        }

    }

	$sql = "delete from user_coll where coll_id = $coll_id";
	mysql_query($sql);

    $_SESSION['notification'] = "College removed";
    $_SESSION["notification_content"] = "College removed";
	
	header("location: ../../manage_account.php");

}

// When deleting a collage, the members must be transferred to the uncategorized category.
// INCOMPLETE
else if(isset($_POST['delete_move_college'])){

    $coll_id = $_POST['delete_id_college'];

    $sql = "UPDATE user_accounts SET type_no = 4, coll_id = 0 where user_accounts.coll_id = $coll_id ";
    $get = mysql_query($sql);

    while($row = mysql_fetch_array($get)){

        if(is_null($row["img_path"]))
            echo "This is null";
        else{
            $dir = "../../../" . $row["img_path"];

            include "delete_code.php";
        }

    }

    $sql = "delete from user_coll where coll_id = $coll_id";
    mysql_query($sql);

    $_SESSION['notification'] = "College removed but staff remains";
    $_SESSION["notification_content"] = "College removed but staff remains";

    header("location: ../../manage_account.php");

}

//Removing the Dean
// INCOMPLETE
else if(isset($_POST["remove_dean"])){

    $id = $_POST["remove_id"];

    $sql = "select * FROM user_accounts LEFT JOIN user_img on(user_accounts.user_id = user_img.user_id) where user_accounts.user_id = '$id' ";
    $get = mysql_query($sql);
    $row = mysql_fetch_array($get);

    if(is_null($row["img_path"]))
        echo "This is null";
    else{
        $dir = "../../../" . $row["img_path"];

        include "delete_code.php";
    }

    $sql = "delete FROM user_accounts WHERE user_id = '$id'";
    mysql_query($sql);

    $_SESSION['notification'] = "Dean removed";
    $_SESSION["notification_content"] = "Dean removed";

    header ("location: ../../manage_account.php");

}

else if(isset($_POST["edit_college_button"])){

    $id = $_POST["edit_id_college"];
    $prefix = $_POST["edit_college_list"];
    $suffix = $_POST["edit_input_college"];
    $whole = $prefix . " " . $suffix;

    $sql = "UPDATE user_coll set coll_name = '$whole' WHERE coll_id = '$id'";
    mysql_query($sql);

    $_SESSION['notification'] = "College Renamed";
    $_SESSION["notification_content"] = "College Renamed";

    header ("location: ../../manage_account.php");

}




/*//////////////////////////////////

	FOR THE DEAN

*///////////////////////////////////


if(isset($_POST['create_staff'])){

	$user  = $_POST['user'];
	$pass  = md5($_POST['pass']);
	$first = ucwords($_POST['first']);
	$last  = ucwords($_POST['last']);
	$mid   = ucwords($_POST['middle']);
	$mid  .= ".";

	$sql = "select user_id from user_accounts where user_id = '" . $user . "' ";

	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	
	if(preg_match ("/[^0-9-]/",$user)){

		$_SESSION["warning"] = "Username must have no letters";
		header("location: files.php");
	
	}
	
	else if($count != 0){

	$_SESSION['warning'] = "Similar User ID found. Please try again.";
	header("location: files.php");

	}

	else if(is_numeric($mid)){

		$_SESSION['warning'] = "Middle Initial should be a letter!";
		header("location: files.php");

	}

	else{

		$coll_id = $_POST['coll_id'];
		$type = $_POST['staff_type'];


	
		$sql = "INSERT into user_accounts
				(user_id,type_no,password,coll_id)
				VALUES
				('$user','$type','$pass',$coll_id)";
				
		$result = mysql_query($sql);
		
		if(!($result))
			die("Error in sql1: " . mysql_error());
			
		$sql = "INSERT into user_profile
				(user_id,fname,lname,middle_initial)
				VALUES
				('$user','$first','$last','$mid')";
				
		$result = mysql_query($sql);
		
		if(!($result))
			die("Error in sql2: " . mysql_error());

		$sql = "insert into user_img
			(user_id)
			values
			('$user')
			";

		$result = mysql_query($sql);

		if(!($result))
			die("Error in sql3: " . mysql_error());
		
		$_SESSION['notification'] = "$last added.";
		header("location: files.php");
	
	}

}

?>




