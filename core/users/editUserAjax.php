<?php
	session_start();
	error_reporting(~E_NOTICE);
	require_once("../../classes/functions.php");
	require_once("../../classes/classes.php");
	
	$firstName = isset($_REQUEST['txtFirstName']) ? $_REQUEST['txtFirstName'] : "";
	$lastName = isset($_REQUEST['txtLastName']) ? $_REQUEST['txtLastName'] : "";
	$email = isset($_REQUEST['txtEmail']) ? $_REQUEST['txtEmail'] : "";
	$password = isset($_REQUEST['txtPassword']) ? $_REQUEST['txtPassword'] : "";
	
	$cUser = new users;
	$update = $cUser->updateUser($firstName, $lastName, $email, $password);
	
	if($update=="success"){
		
		$resData = array(
		"success" => true,
		"message" => "The user has been updated successfully."
		);
	}
	else{
		
		$resData = array(
		"success" => false,
		"message" => "Error updating user."
		);
	}
	
	echo json_encode($resData); 
?>