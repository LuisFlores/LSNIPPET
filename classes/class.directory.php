<?php
	session_start();
	error_reporting(~E_NOTICE);
	require_once("functions.php");
	
	/*
		* class directories
		*
		*
		* L-SNIPPET
		* @author Luis Alfredo Flores Hurtado.
		* Class CRUD for directories on L-SNIPPET
	*/
	class directories {
		
		/*
			* Set Configurations
			*
			* @return void
		*/
		function __construct() { 
			
			$this->userId = $_SESSION['userId'];
		} 
		
		/*
			* getDirectories
			*
			* Function to get the directories
			* @param void
			* @return json_encode with all the directories
		*/
		function getDirectories(){
			
			$userId = $this->userId;
			
			$sqlSdata = "SELECT *
			FROM TB_DIRECTORY D
			WHERE D.DIR_STATUS = 'ACTIVE'
			AND D.ID_USER = '".$userId."'
			ORDER BY DIR_NAME";
			$resSdata = executeQuery($sqlSdata);
			
			$aData = array();
			$parameters = array();
			foreach($resSdata as $key => $row){
				
				$parameters = $row['ID_DIRECTORY'].",'".$row['DIR_NAME']."','".$row['DIR_DESCRIPTION']."'";
				$row['DIR_EDIT'] = $parameters;
				$row['DIR_DELETE'] = $row['ID_DIRECTORY'];
				array_push($aData,$row);
			}
			
			$resData = array(
			"success" => true,
			"data" => $aData
			);
			
			return json_encode($resData);
		}
		
		/*
			* createDirectory
			*
			* Function for create new directory
			* @param $txtNameDirectory (Name of directory)
			* @param $txaDescriptionDirectory (Description of directory)
			* @return json_encode with success and message param
		*/
		function createDirectory($txtNameDirectory, $txaDescriptionDirectory){
			
			$userId = $this->userId;
			
			$sqlIdirectory = "INSERT INTO TB_DIRECTORY(
			ID_USER,
			DIR_NAME,
			DIR_DESCRIPTION,
			DIR_STATUS
			)VALUES(
			'".$userId."',
			'".mysql_escape_string($txtNameDirectory)."',
			'".mysql_escape_string($txaDescriptionDirectory)."',
			'ACTIVE'
			)";
			executeQuery($sqlIdirectory);
			
			$resData = array(
			"success" => true,
			"message" => "The directory has been created."
			);
			
			return json_encode($resData);
		}
		
		/*
			* editDirectory
			*
			* Function for edit directory
			* @param $idDirectory (ID directory)
			* @param $txtEditNameDirectory (Name of directory)
			* @param $txaEditDescriptionDirectory (Description of directory)
			* @return json_encode with success and message param
		*/
		function editDirectory($idDirectory, $txtEditNameDirectory, $txaEditDescriptionDirectory){
			
			$userId = $this->userId;
			
			$sqlUdirectory = "UPDATE TB_DIRECTORY SET 
			DIR_NAME = '".mysql_escape_string($txtEditNameDirectory)."',
			DIR_DESCRIPTION = '".mysql_escape_string($txaEditDescriptionDirectory)."'
			WHERE ID_DIRECTORY = '".$idDirectory."'";
			executeQuery($sqlUdirectory);
			
			$resData = array(
			"success" => true,
			"message" => "The directory has been updated."
			);
			
			return json_encode($resData);
		}
		
		/*
			* deleteDirectory
			*
			* Function for delete directory
			* @param $idDirectory (ID directory)
			* @return json_encode with success and message param
		*/
		function deleteDirectory($idDirectory){
			
			$sqlUdirectory = "UPDATE TB_DIRECTORY D SET
			DIR_STATUS = 'DELETED'
			WHERE ID_DIRECTORY = '".$idDirectory."'";
			executeQuery($sqlUdirectory);
			
			$resData = array(
			"success" => true,
			"message" => "The directory has been deleted."
			);
			
			return json_encode($resData);
		}
	}	
	
?>
