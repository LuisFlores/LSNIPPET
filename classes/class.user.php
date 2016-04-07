<?php
	session_start();
	error_reporting(~E_NOTICE);
	require_once("functions.php");
	
	/*
		* class users
		*
		*
		* L-SNIPPET
		* @author Luis Alfredo Flores Hurtado.
		* Class CRUD for users on L-SNIPPET
	*/
	class users {
		
		/*
			* Set Configurations
			*
			* @return void
		*/
		function __construct() { 
			
			$this->userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : "new";
		} 
		
		/*
			* validateUser
			*
			* Function for validate user
			* @param void
			* @return if the user is "new" or "old"
		*/
		function validateUser(){
			
			$userId = $this->userId;
			if($userId == "new"){
				
				return "new";
			}
			else{
				
				return "old";
			}
		}
		
		/*
			* verifyUser
			*
			* Function for verify user
			* @param $userName (User name)
			* @return array with the information if the user exist or not
		*/
		function verifyUser($userName){
			
			$sqlSdata = "SELECT *
			FROM USERS
			WHERE USERNAME = '".$userName."'";
			$resSdata = executeQuery($sqlSdata);
			$cntSdata = count($resSdata);
			
			if($cntSdata==0){
				$resData = array(
				"existUser" => false,
				"message" => "The user name it is available."
				);
			}
			else{
				
				$resData = array(
				"existUser" => true,
				"message" => "Someone already has that username."
				);
			}
			
			return json_encode($resData);
		}
		
		/*
			* getUserInfo
			*
			* Function for get user information 
			* @param $userId (ID user)
			* @return array with all the information about the user
		*/
		function getUserInfo($userId){
			
			$sqlSdata = "SELECT *
			FROM USERS U
			WHERE U.ID_USER = '".$userId."'";
			$resSdata = executeQuery($sqlSdata);
			
			return $resSdata;
		}
		
		/*
			* getUserInfoByName
			*
			* Function for get user information 
			* @param $userName (userName)
			* @return array with all the information about the user
		*/
		function getUserInfoByName($userName){
			
			$sqlSdata = "SELECT *
			FROM USERS U
			WHERE U.USERNAME = '".$userName."'";
			$resSdata = executeQuery($sqlSdata);
			
			return $resSdata;
		}
		
		/*
			* createUser
			*
			* Function for update user 
			* @param $firstName (User first name)
			* @param $lastName (User last name)
			* @param $email (User email)
			* @param $password (User password)
			* @return success
		*/
		function createUser($userName, $firstName, $lastName, $email, $password){
			
			session_unset();
			session_destroy();

			$validateUser = $this->validateUser();
			
			if($validateUser=="new"){
				
				$sqlIdata = "INSERT INTO USERS(
				USERNAME,
				FIRSTNAME,
				LASTNAME,
				EMAIL,
				PASSWORD,
				STATUS
				)VALUES(
				'".$userName."',
				'".$firstName."',
				'".$lastName."',
				'".$email."',
				'".md5($password)."',
				'ACTIVE'
				)";
				executeQuery($sqlIdata);
				
				$aUser = $this->getUserInfoByName($userName);
				$userId = $aUser[0]['ID_USER'];

				$resData = array(
				"success" => true,
				"userId" => $userId
				);
				
				echo json_encode($resData); 
			}
		}
		
		/*
			* updateUser
			*
			* Function for update user 
			* @param $firstName (User first name)
			* @param $lastName (User last name)
			* @param $email (User email)
			* @param $password (User password)
			* @return success
		*/
		function updateUser($firstName, $lastName, $email, $password){
			
			$validateUser = $this->validateUser();
			if($validateUser=="old"){
				
				$userId = $this->userId;
				
				if($password == ''){
					
					$userData = $this->getUserInfo($userId);
					$password = $userData[0]['PASSWORD'];
				}
				
				$sqlUdata = "UPDATE USERS U SET
				FIRSTNAME = '".$firstName."',
				LASTNAME = '".$lastName."',
				EMAIL = '".$email."',
				PASSWORD = '".md5($password)."'
				WHERE ID_USER = '".$userId."'";
				executeQuery($sqlUdata);
				
				return "success";
			}
		}
		
	}	
	
?>