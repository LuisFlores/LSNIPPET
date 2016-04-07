<?php
	require_once("../../classes/functions.php");
	session_start();
	session_unset();
	session_destroy();

	header('Location: ../main/login.php');	
?>