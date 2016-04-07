<?php
	session_start();
	error_reporting(~E_NOTICE);
	require_once("../headers/mainHeader.php");
	
	$userId = $_SESSION['userId'];
	
	//Get user data
	$cUser = new users;
	$resSdata = $cUser->getUserInfo($userId);
	
	$userName = $resSdata[0]['USERNAME'];
	$firstName = $resSdata[0]['FIRSTNAME'];
	$lastName = $resSdata[0]['LASTNAME'];
	$email = $resSdata[0]['EMAIL'];	
?>

<div class="container">
	<div class="bs-docs-section">
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="page-header">
					<h1 id="forms">Edit user</h1>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="well bs-component">
					<form class="form-horizontal" id="formEditUser">
						<fieldset>
							<input type="hidden" class="form-control" id="txtID" name="txtID" value="<?php echo $userId ?>">
							<div class="form-group">
								<label class="col-lg-3 control-label">User name:</label>
								<div class="col-lg-9">
									<input type="text" class="form-control-static" id="txtUserName" name="txtUserName" placeholder="User Name" disabled="1" value="<?php echo $userName ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">First name: <font color="red">*</font></label>
								<div class="col-lg-9">
									<input type="text" maxlength="100" class="form-control" id="txtFirstName" name="txtFirstName" placeholder="First Name" value="<?php echo $firstName ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Last name:</label>
								<div class="col-lg-9">
									<input type="text" maxlength="100" class="form-control" id="txtLastName" name="txtLastName" placeholder="Last Name" value="<?php echo $lastName ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Email: <font color="red">*</font></label>
								<div class="col-lg-9">
									<input type="text" maxlength="100" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email" value="<?php echo $email ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">New password</label>
								<div class="col-lg-9">
									<input type="password" maxlength="100" class="form-control" id="txtPassword" name="txtPassword" placeholder="Password">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Confirm password</label>
								<div class="col-lg-9">
									<input type="password" maxlength="100" class="form-control" id="txtPassword2" name="txtPassword2" placeholder="Password">
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-lg-12 col-lg-offset-5">
									<button type="button" class="btn btn-primary" onclick="saveUser()">Save</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		
	</div>
</div>

<script type="text/javascript">
	
	//Rules for validate the "formEditUser"
	$('#formEditUser').validate({
		rules: {
			txtFirstName: 'required',
			txtEmail: 'required'
		},
		messages: {
			txtFirstName: '<label class="text-danger"><i>The field it is required.</i></label>',
			txtEmail: '<label class="text-danger"><i>The field it is required.</i></label>'
		}
	});
	
	//Function for save the user information
	function saveUser(){
		
		var validEditUser = $('#formEditUser').valid();
		
		if(validEditUser==true){
			
			var txtID = $('#txtID').val();
			var txtFirstName = $('#txtFirstName').val();
			var txtLastName = $('#txtLastName').val();
			var txtEmail = $('#txtEmail').val();
			var txtPassword = $('#txtPassword').val();
			var txtPassword2 = $('#txtPassword2').val();
			
			if(txtPassword != txtPassword2){
				
				$('#alertLegend').text('The passwords are differents');
				$('#alertDialog').modal('show');
			}
			else{
				
				$.ajax({
					url: 'editUserAjax.php', 
					data: {
						txtID: txtID,
						txtFirstName: txtFirstName,
						txtLastName: txtLastName,
						txtEmail: txtEmail,
						txtPassword: txtPassword
					},
					success: function(result){
						
						var resData = JSON.parse(result);
						if(resData.success==true){
							
							//Change alert message
							$('#alertLegend').text(resData.message);
							$('#alertDialog').modal('show');
							
						}
						else{
							
							alert(resData.message);
						}
					}
				});	
			}
		}
	}
	
	
</script>
<?php
	require_once("../footers/mainFooter.php");
?>	