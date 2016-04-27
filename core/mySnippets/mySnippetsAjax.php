<?php
	session_start();
	error_reporting(~E_NOTICE);
	require_once("../../classes/functions.php");
	require_once("../../classes/classes.php");
	
	$option = $_REQUEST['option'];
	
	switch ($option) {
		
		//Get snippets
		case 'getSnippets':
		$idDirectory = isset($_REQUEST['idDirectory']) ? $_REQUEST['idDirectory'] : '';
        $cSnippet = new snippets;
		echo $cSnippet->getSnippets($idDirectory);
        break;

		//Create snippet
		case 'createSnippet':
		$selectDirectoryDialog = $_REQUEST['selectDirectoryDialog'];
		$txtTitleSnippet = $_REQUEST['txtTitleSnippet'];
		$txaDescriptionSnippet = $_REQUEST['txaDescriptionSnippet'];
		$txaSnippetCode = $_REQUEST['txaSnippetCode'];
		$selectLanguage = $_REQUEST['selectLanguage'];
		$cSnippet = new snippets;
		echo $cSnippet->createSnippet($selectDirectoryDialog, $txtTitleSnippet, $txaDescriptionSnippet, $selectLanguage, $txaSnippetCode);
		break;
		
		//Edit snippet
		case 'editSnippet':
		$idSnippet = $_REQUEST['idSnippet'];
		$selectEditDirectoryDialog = $_REQUEST['selectEditDirectoryDialog'];
		$txtEditTitleSnippet = $_REQUEST['txtEditTitleSnippet'];
		$txaEditDescriptionSnippet = $_REQUEST['txaEditDescriptionSnippet'];
		$selectLanguage = $_REQUEST['selectLanguage'];
		$txaSnippetCode = $_REQUEST['txaSnippetCode'];
		$cSnippet = new snippets;
		echo $cSnippet->editSnippet($idSnippet, $selectEditDirectoryDialog, $txtEditTitleSnippet, $txaEditDescriptionSnippet, $selectLanguage, $txaSnippetCode);
		break;
		
		//Delete snippet
		case 'deleteSnippet':
		$idSnippet = $_REQUEST['idSnippet'];
        $cSnippet = new snippets;
		echo $cSnippet->deleteSnippet($idSnippet);
        break;
		
		//Review username at the share moment 
		case 'reviewUsername':
		$txtUsername = $_REQUEST['txtUsername'];
        $cUsers = new users;
		echo $cUsers->verifyUser($txtUsername);
        break;
		
		//Share snippet
		case 'shareSnippet':
		$hiddenShareIdSnippet = $_REQUEST['hiddenShareIdSnippet'];
		$txtUsername = $_REQUEST['txtUsername'];
        $cSnippet = new snippets;
		echo $cSnippet->shareSnippet($hiddenShareIdSnippet, $txtUsername);
        break;
		
		//Get users shared
		case 'getUsersShared':
		$idSnippet = $_REQUEST['idSnippet'];
        $cSnippet = new snippets;
		echo $cSnippet->getUsersShared($idSnippet);
        break;
	}

?>