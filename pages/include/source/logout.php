<!DOCTYPE html>
<?php

	session_start();
	if(isset($_SESSION['user'])){
		unset($_SESSION['user']);
        unset($_SESSION['name']);
		unset($_SESSION['type']);
		unset($_SESSION['user_id']);
	}
		
	header("location:../../../index.php");
	
?>