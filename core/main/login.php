<?php
	session_start();
	error_reporting(~E_NOTICE);
	require_once("../../classes/functions.php");
	require_once("../headers/loginHeader.php");
	
	$txtUser = $_REQUEST['txtUser'];
	$txtPassword = $_REQUEST['txtPassword'];
	
	//Review the valid user
	if(isset($txtUser) && isset($txtPassword)){
		
		$sqlSuser = "SELECT *
		FROM USERS 
		WHERE USERNAME = '".$txtUser."'
		AND PASSWORD = '".md5($txtPassword)."'
		AND STATUS = 'active'";
		$resSuser = executeQuery($sqlSuser);
		
		$_SESSION['userId'] = isset($resSuser[0]['ID_USER']) ? $resSuser[0]['ID_USER'] : false;
		
		if($_SESSION['userId'] != false){
			
			header('Location: ../mySnippets/mySnippets.php');
		}
		else{
			
			header('Location: login.php?error=true');
		}
		
	}
?>

<div class="container">
	
	<div class="bs-docs-section">
		
		<div class="row">
			<div class="col-lg-1">
				<a href="../users/createUser.php" class="btn btn-primary">Create account</a>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<center><img class="img-responsive" src="../../images/logoLSnippet.png" ></center>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				
				<div class="well bs-component">
					<div class="alert alert-warning" id="myAlert">
						<strong>WARNING:</strong> Wrong login credentials.
					</div>
					<form id="login" name="login" action="login.php" method="post" class="form-horizontal"><br>
						<p>
							<label>User:</label><br>
							<input type="text" id="txtUser" name="txtUser" size="20" maxlength="50" class="form-control" onblur="fnToLower()"/>
						</p>
						<p>
							<label>Password:</label><br>
							<input type="password" id="txtPassword" name="txtPassword" size="20" maxlength="20" class="form-control"/>
						</p>
						<p>
							<center><input type="submit" value="Login" class="btn btn-primary"></center>
						</p>
						<p>
							<input type="hidden" id="hiddenError" name="hiddenError" value="<?php echo $_REQUEST['error']?>" />
						</p>
					</form>
				</div>
			</div>
		</div>
		
	</div>
	
</div>
<script type="text/javascript">
	
	//Review if the credentials are wrong
	if(document.getElementById('hiddenError').value == 'true'){
		setTimeout(closeAlert, 10000);
	}
	else{
		$('#myAlert').alert('close');
	}
	
	function closeAlert(){
		$('#myAlert').alert('close');		
	};
	
	function fnToLower(){
	
		var txtUser = $('#txtUser').val();
		var txtUser = txtUser.toLowerCase();
		$('#txtUser').val(txtUser);
	};
</script>

<?
	require_once("../footers/mainFooter.php");
?>						