<?php
	session_start();
	error_reporting(~E_NOTICE);
	require_once("../../classes/functions.php");
	require_once("../../classes/classes.php");
	
	$option = $_REQUEST['option'];
	
	switch ($option) {
		
		//Get snippets
		case 'getSharedSnippets':
        $cSnippet = new snippets;
		echo $cSnippet->getSharedSnippets();
        break;
		
		//Edit snippet
		case 'editSharedSnippet':
		$idSnippet = $_REQUEST['idSnippet'];
		$txtEditTitleSnippet = $_REQUEST['txtEditTitleSnippet'];
		$txaEditDescriptionSnippet = $_REQUEST['txaEditDescriptionSnippet'];
		$selectLanguage = $_REQUEST['selectLanguage'];
		$txaSnippetCode = $_REQUEST['txaSnippetCode'];
		$cSnippet = new snippets;
		echo $cSnippet->editSharedSnippet($idSnippet, $txtEditTitleSnippet, $txaEditDescriptionSnippet, $selectLanguage, $txaSnippetCode);
		break;
		
		//Copy shared snippet
		case 'copySharedSnippet':
		$idSnippet = $_REQUEST['idSnippet'];
		$idDirectory = $_REQUEST['selectDirectoryDialog'];
        $cSnippet = new snippets;
		echo $cSnippet->copySharedSnippet($idSnippet, $idDirectory);
        break;
		
		//Delete shared snippet
		case 'deleteSharedSnippet':
		$idSharedSnippet = $_REQUEST['idSharedSnippet'];
        $cSnippet = new snippets;
		echo $cSnippet->deleteSharedSnippet($idSharedSnippet);
        break;
		
		//Details shared snippet
		case 'detailsSharedSnippet':
		$idSharedSnippet = $_REQUEST['idSharedSnippet'];
        $cSnippet = new snippets;
		echo $cSnippet->detailsSharedSnippet($idSharedSnippet);
        break;
	}

?>