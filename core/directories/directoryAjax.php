<?php
	session_start();
	error_reporting(~E_NOTICE);
	require_once("../../classes/functions.php");
	require_once("../../classes/classes.php");
	
	$option = $_REQUEST['option'];
	
	switch ($option) {
		
		//Get directories
		case "getDirectories":
        $cDirectories = new directories;
		echo $cDirectories->getDirectories();
        break;

		//Create directory
		case "createDirectory":
		$txtNameDirectory = $_REQUEST['txtNameDirectory'];
		$txaDescriptionDirectory = $_REQUEST['txaDescriptionDirectory'];
		$cDirectories = new directories;
		echo $cDirectories->createDirectory($txtNameDirectory, $txaDescriptionDirectory);
		break;
		
		//Edit directory
		case "editDirectory":
		$idDirectory = $_REQUEST['idDirectory'];
		$txtEditNameDirectory = $_REQUEST['txtEditNameDirectory'];
		$txaEditDescriptionDirectory = $_REQUEST['txaEditDescriptionDirectory'];
		$cDirectories = new directories;
		echo $cDirectories->editDirectory($idDirectory, $txtEditNameDirectory, $txaEditDescriptionDirectory);
		break;
		
		//Delete directory
		case "deleteDirectory":
		$idDirectory = $_REQUEST['idDirectory'];
        $cDirectories = new directories;
		echo $cDirectories->deleteDirectory($idDirectory);
        break;
	}

?>