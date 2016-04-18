<?php
	session_start();
	error_reporting(~E_NOTICE);
	require_once("functions.php");
	
	/*
		* class snippets
		*
		*
		* L-SNIPPET
		* @author Luis Alfredo Flores Hurtado.
		* Class CRUD for snippets on L-SNIPPET
	*/
	class snippets {
		
		/*
			* Set Configurations
			*
			* @return void
		*/
		function __construct() { 
			
			$this->userId = $_SESSION['userId'];
		} 
		
		/*
			* getSnippets
			*
			* Function for get the snippets
			* @param $idDirectory (ID directory)
			* @return json_encode with all the snippets for the logged user
		*/
		function getSnippets($idDirectory){
			
			$userId = $this->userId;
			
			$sqlSdataOptions = "";
			if($idDirectory!=''){
				$sqlSdataOptions = "AND S.ID_DIRECTORY = '".$idDirectory."' ";
			}
			$sqlSdata = "SELECT *
			FROM TB_SNIPPET S, TB_DIRECTORY D
			WHERE S.ID_DIRECTORY = D.ID_DIRECTORY
			AND D.DIR_STATUS != 'DELETED'
			AND S.SNI_STATUS = 'ACTIVE' 
			AND S.ID_USER = '".$userId."'";
			$sqlSdata .= $sqlSdataOptions;
			$sqlSdata .= "ORDER BY S.SNI_DATE";
			$resSdata = executeQuery($sqlSdata);
			
			$aData = array();
			foreach($resSdata as $key => $row){
				
				$parameters = $row['ID_SNIPPET'].",'".$row['ID_DIRECTORY']."',"."'".$row['SNI_TITLE']."',".$row['SNI_DESCRIPTION'].",'".$row['SNI_LANGUAGE']."',".$row['SNI_CODE'];
				$row['SNI_EDIT'] = $parameters;
				$row['SNI_DELETE'] = $row['ID_SNIPPET'];
				$row['SNI_SHARED'] = $row['ID_SNIPPET'];
				array_push($aData,$row);
			}
			
			$resData = array(
			"success" => true,
			"data" => $aData
			);
			
			return json_encode($resData);
		}
		
		/*
			* createSnippet
			*
			* Function for create new snippet
			* @param $idDirectory (ID directory)
			* @param $titleSnippet (Title for the snippet)
			* @param $descriptionSnippet (Description for the snippet)
			* @param $codeLanguage (Language for the snippet)
			* @param $codeSnippet (Code text for the snippet)
			* @return json_encode with success and message param
		*/
		function createSnippet($idDirectory, $titleSnippet, $descriptionSnippet, $codeLanguage, $codeSnippet){
			
			$userId = $this->userId;
			$currentDate = date("Y-m-d H:i:s");
			
			$sqlIsnippet = "INSERT INTO TB_SNIPPET(
			ID_DIRECTORY,
			ID_USER,
			SNI_DATE,
			SNI_TITLE,
			SNI_DESCRIPTION,
			SNI_LANGUAGE,
			SNI_CODE,
			SNI_STATUS
			)VALUES(
			'".$idDirectory."',
			'".$userId."',
			'".$currentDate."',
			'".mysql_escape_string($titleSnippet)."',
			'".mysql_escape_string($descriptionSnippet)."',
			'".$codeLanguage."',
			'".mysql_escape_string($codeSnippet)."',
			'ACTIVE'
			)";
			executeQuery($sqlIsnippet);
			
			$resData = array(
			"success" => true,
			"message" => "The snippet has been created."
			);
			
			return json_encode($resData);
		}
		
		/*
			* editSnippet
			*
			* Function for edit snippet
			* @param $idSnippet (ID snippet)
			* @param $idDirectory (ID directory)
			* @param $titleSnippet (Title for the snippet)
			* @param $descriptionSnippet (Description for the snippet)
			* @param $codeLanguage (Language for the snippet)
			* @param $codeSnippet (Code text for the snippet)
			* @return json_encode with success and message param
		*/
		function editSnippet($idSnippet, $idDirectory, $titleSnippet, $descriptionSnippet, $codeLanguage, $codeSnippet){
			
			$userId = $this->userId;
			$currentDate = date("Y-m-d H:i:s");
			
			$sqlUsnippet = "UPDATE TB_SNIPPET SET 
			ID_DIRECTORY = '".$idDirectory."',
			SNI_DATE = '".$currentDate."',
			SNI_TITLE = '".mysql_escape_string($titleSnippet)."',
			SNI_DESCRIPTION = '".mysql_escape_string($descriptionSnippet)."',
			SNI_LANGUAGE = '".$codeLanguage."',
			SNI_CODE = '".mysql_escape_string($codeSnippet)."'
			WHERE ID_SNIPPET = '".$idSnippet."'";
			executeQuery($sqlUsnippet);
			
			$resData = array(
			"success" => true,
			"message" => "The snippet has been updated."
			);
			
			return json_encode($resData);
		}
		
		/*
			* deleteSnippet
			*
			* Function for delete snippet
			* @param $idSnippet (ID snippet)
			* @return json_encode with success and message param
		*/
		function deleteSnippet($idSnippet){
			
			$sqlUsnippet = "UPDATE TB_SNIPPET D SET
			SNI_STATUS = 'DELETED'
			WHERE ID_SNIPPET = '".$idSnippet."'";
			executeQuery($sqlUsnippet);
			
			$sqlUsnippet = "UPDATE TB_SHARED_SNIPPETS D SET
			SHS_STATUS = 'DELETED'
			WHERE ID_SNIPPET = '".$idSnippet."'";
			executeQuery($sqlUsnippet);
			
			$resData = array(
			"success" => true,
			"message" => "The snippet has been deleted."
			);
			
			return json_encode($resData);
		}
		
		/*
			* getSharedSnippets
			*
			* Function for get the snippets
			* @param $idDirectory (ID directory)
			* @return json_encode with all the snippets for the logged user
		*/
		function getSharedSnippets(){
			
			$userId = $this->userId;
			
			$sqlSdata = "SELECT *
			FROM USERS U, TB_SNIPPET S, TB_SHARED_SNIPPETS SS
			WHERE U.STATUS = 'ACTIVE'
			AND SS.SHS_STATUS = 'ACTIVE'
			AND U.ID_USER = S.ID_USER
			AND S.ID_SNIPPET = SS.ID_SNIPPET
			AND SS.ID_USER_TO = '".$userId."'";
			$sqlSdata .= "ORDER BY S.SNI_DATE";
			$resSdata = executeQuery($sqlSdata);
			
			$aData = array();
			foreach($resSdata as $key => $row){
				
				$parameters = $row['ID_SNIPPET'].",'".$row['ID_DIRECTORY']."',"."'".$row['SNI_TITLE']."',".$row['SNI_DESCRIPTION'].",'".$row['SNI_LANGUAGE']."',".$row['SNI_CODE'];
				$row['SNI_EDIT'] = $parameters;
				$row['SNI_DELETE'] = $row['ID_SHARED_SNIPPET'];
				array_push($aData,$row);
			}
			
			$resData = array(
			"success" => true,
			"data" => $aData
			);
			
			return json_encode($resData);
		}
		
		/*
			* editSharedSnippet
			*
			* Function for edit snippet
			* @param $idSnippet (ID snippet)
			* @param $titleSnippet (Title for the snippet)
			* @param $descriptionSnippet (Description for the snippet)
			* @param $codeLanguage (Language for the snippet)
			* @param $codeSnippet (Code text for the snippet)
			* @return json_encode with success and message param
		*/
		function editSharedSnippet($idSnippet, $titleSnippet, $descriptionSnippet, $codeLanguage, $codeSnippet){
			
			$userId = $this->userId;
			$currentDate = date("Y-m-d H:i:s");
			
			$sqlUsnippet = "UPDATE TB_SNIPPET SET 
			SNI_DATE = '".$currentDate."',
			SNI_TITLE = '".mysql_escape_string($titleSnippet)."',
			SNI_DESCRIPTION = '".mysql_escape_string($descriptionSnippet)."',
			SNI_LANGUAGE = '".$codeLanguage."',
			SNI_CODE = '".mysql_escape_string($codeSnippet)."'
			WHERE ID_SNIPPET = '".$idSnippet."'";
			executeQuery($sqlUsnippet);
			
			$resData = array(
			"success" => true,
			"message" => "The snippet has been updated."
			);
			
			return json_encode($resData);
		}
		
		/*
			* copySharedSnippet
			*
			* Function for delete shared snippet
			* @param $idSnippet (ID snippet to be copied)
			* @param $idDirectory (ID directory where the snippet going to be copied)
			* @return json_encode with success and message param
		*/
		function copySharedSnippet($idSnippet, $idDirectory){
			
			$sqlSsnippet = "SELECT *
			FROM TB_SNIPPET
			WHERE ID_SNIPPET = '".$idSnippet."'";
			$resSsnippet = executeQuery($sqlSsnippet);
			
			$titleSnippet = $resSsnippet[0]['SNI_TITLE'];
			$descriptionSnippet = $resSsnippet[0]['SNI_DESCRIPTION'];
			$codeLanguage = $resSsnippet[0]['SNI_LANGUAGE'];
			$codeSnippet = $resSsnippet[0]['SNI_CODE'];
			$this->createSnippet($idDirectory, $titleSnippet, $descriptionSnippet, $codeLanguage, $codeSnippet);
			
			$resData = array(
			"success" => true,
			"message" => "The snippet has been copied succesfully."
			);
			
			return json_encode($resData);
		}
		
		/*
			* deleteSharedSnippet
			*
			* Function for delete shared snippet
			* @param $idSharedSnippet (ID shared snippet)
			* @return json_encode with success and message param
		*/
		function deleteSharedSnippet($idSharedSnippet){
			
			$sqlUsnippet = "UPDATE TB_SHARED_SNIPPETS D SET
			SHS_STATUS = 'DELETED'
			WHERE ID_SHARED_SNIPPET = '".$idSharedSnippet."'";
			executeQuery($sqlUsnippet);
			
			$resData = array(
			"success" => true,
			"message" => "The shared snippet has been deleted."
			);
			
			return json_encode($resData);
		}
		
		/*
			* detailsSharedSnippet
			*
			* Function for delete shared snippet
			* @param $idSharedSnippet (ID shared snippet)
			* @return json_encode with success and message param
		*/
		function detailsSharedSnippet($idSharedSnippet){
			
			$sqlSsnippet = "SELECT U.USERNAME, U.EMAIL, SS.SHS_DATE 
			FROM USERS U, TB_SNIPPET S, TB_SHARED_SNIPPETS SS
			WHERE SS.ID_SHARED_SNIPPET = '".$idSharedSnippet."'
			AND SS.ID_USER_FROM = U.ID_USER
			AND SS.ID_SNIPPET = S.ID_SNIPPET";
			$resSsnippet = executeQuery($sqlSsnippet);
			
			$resData = array(
			"success" => true,
			"data" => $resSsnippet
			);
			
			return json_encode($resData);
		}
		
		/*
			* shareSnippet
			*
			* Function for delete shared snippet
			* @param $idSnippet (ID snippet)
			* @param $userName (Username)
			* @return json_encode with success and message param
		*/
		function shareSnippet($idSnippet, $userName){
			
			$idUserFrom = $this->userId;
			$currentDate = date("Y-m-d H:i:s");
			
			$cUsers = new users;
			$resUserData = $cUsers->getUserInfoByName($userName);
			$idUserTo = $resUserData[0]['ID_USER'];
			
			$sqlIshare = "INSERT INTO TB_SHARED_SNIPPETS(
			ID_USER_FROM,
			ID_USER_TO,
			ID_SNIPPET,
			SHS_DATE,
			SHS_STATUS
			)VALUES(
			'".$idUserFrom."',
			'".$idUserTo."',
			'".$idSnippet."',
			'".$currentDate."',
			'ACTIVE'
			)";
			executeQuery($sqlIshare);
			
			$resData = array(
			"success" => true,
			"message" => "The snippet has been shared successfully."
			);
			
			return json_encode($resData);
			
		}
	}	
	
?>
