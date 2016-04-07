<?php
	session_start();
	error_reporting(~E_NOTICE);
	require_once("../../classes/functions.php");
	require_once("../../classes/classes.php");

	$option = $_REQUEST['option'];
	
	switch ($option) {
		
		//Verify user
		case 'verifyUser':
		$txtUserName = isset($_REQUEST['txtUserName']) ? $_REQUEST['txtUserName'] : '';
        $cUser = new users;
		echo $cUser->verifyUser($txtUserName);
        break;
		
		//Create user
		case 'createUser':
		$txtUserName = isset($_REQUEST['txtUserName']) ? $_REQUEST['txtUserName'] : '';
		$txtFirstName = isset($_REQUEST['txtFirstName']) ? $_REQUEST['txtFirstName'] : '';
		$txtLastName = isset($_REQUEST['txtLastName']) ? $_REQUEST['txtLastName'] : '';
		$txtEmail = isset($_REQUEST['txtEmail']) ? $_REQUEST['txtEmail'] : '';
		$txtPassword = isset($_REQUEST['txtPassword']) ? $_REQUEST['txtPassword'] : '';
		
        $cUser = new users;
		echo $cUser->createUser($txtUserName, $txtFirstName, $txtLastName, $txtEmail, $txtPassword);
		
		//Send email to the user
		$subject = "Welcome to L-SNIPPET";
		$emailTemplate = "Dear ".$txtFirstName." ".$txtLastName." <b>(".$txtUserName.")</b>, <br><br>
		Welcome to L-SNIPPET software!!! Now you can save code snippets in different languages. <br><br>
		
		Enjoy your L-SNIPPET account!";
		sendMessage($txtEmail, $subject, $emailTemplate);
        break;
	}

?>