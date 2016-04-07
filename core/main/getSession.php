<?php
	session_start();
	error_reporting(~E_NOTICE);
	require_once("../../classes/functions.php");
	require_once("../headers/loginHeader.php");

	$_SESSION['userId'] = $_REQUEST['userId'];
	if($_SESSION['userId'] != false){
		
		header('Location: ../mySnippets/mySnippets.php');
	}
	else{
		
		header('Location: login.php?error=true');
	}

	require_once("../footers/mainFooter.php");
?>						