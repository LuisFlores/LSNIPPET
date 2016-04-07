<?php
	session_start();
	error_reporting(~E_NOTICE);
	require_once("../headers/loginHeader.php");
?>

<div class="container">
	<div class="bs-docs-section">
		
		<div class="row">
			<div class="col-lg-1">
				<a href="../logout/logout.php" class="btn btn-primary">Login</a>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<h1 id="forms">Create user</h1>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="well bs-component">
					<form class="form-horizontal" id="formCreateUser">
						<fieldset>
							
							<div class="form-group">
								<label class="col-lg-3 control-label">User name: <font color="red">*</font></label>
								<div class="col-lg-6">
									<input type="text" class="form-control" id="txtUserName" name="txtUserName" placeholder="User Name" onblur="fnToLower()">
								</div>
								<div class="col-lg-1">
									<button type="button" class="btn btn-info" id="btnVerify" onclick="fnVerifyUser()">Verify user</button>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">First name: <font color="red">*</font></label>
								<div class="col-lg-9">
									<input type="text" maxlength="100" class="form-control" id="txtFirstName" name="txtFirstName" placeholder="First Name" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Last name:</label>
								<div class="col-lg-9">
									<input type="text" maxlength="100" class="form-control" id="txtLastName" name="txtLastName" placeholder="Last Name" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Email: <font color="red">*</font></label>
								<div class="col-lg-9">
									<input type="text" maxlength="100" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Password <font color="red">*</font></label>
								<div class="col-lg-9">
									<input type="password" maxlength="100" class="form-control" id="txtPassword" name="txtPassword" placeholder="Password">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Confirm password <font color="red">*</font></label>
								<div class="col-lg-9">
									<input type="password" maxlength="100" class="form-control" id="txtPassword2" name="txtPassword2" placeholder="Password">
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-lg-12 col-lg-offset-5">
									<button type="button" class="btn btn-primary" id="btnSave" onclick="saveUser()">Save</button>
								</div>
							</div>
							<input type="hidden" class="form-control" id="varReturn" name="varReturn">
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		
	</div>
</div>

<script type="text/javascript">
	
	var SaveInformationMessageOptions = {message: '<font> Creating user...</font>', css: { 
		border: 'none', 
		padding: '15px', 
		backgroundColor: '#FFFFFF', 
		'-webkit-border-radius': '10px', 
		'-moz-border-radius': '10px', 
		//opacity: .5, 
		color: '#000000'  
	}};
	
	var verifyMessageOptions = {message: '<font> Verifing user...</font>', css: { 
		border: 'none', 
		padding: '15px', 
		backgroundColor: '#FFFFFF', 
		'-webkit-border-radius': '10px', 
		'-moz-border-radius': '10px', 
		//opacity: .5, 
		color: '#000000'  
	}};
	
	//Rules for validate the "formCreateUser"
	$('#formCreateUser').validate({
		rules: {
			txtUserName: 'required',
			txtFirstName: 'required',
			txtEmail: 'required',
			txtPassword: 'required',
			txtPassword2: 'required'
		},
		messages: {
			txtUserName: '<label class="text-danger"><i>The field it is required.</i></label>',
			txtFirstName: '<label class="text-danger"><i>The field it is required.</i></label>',
			txtEmail: '<label class="text-danger"><i>The field it is required.</i></label>',
			txtPassword: '<label class="text-danger"><i>The field it is required.</i></label>',
			txtPassword2: '<label class="text-danger"><i>The field it is required.</i></label>'
		}
	});
	
	//Function to refresh index
	function fnRefreshIndex(){
		window.location.href = '../../index.php'; 
	};
	
	
	//Function to call the "verifyUserAjax" function
	function fnVerifyUser(){
		
		var validCreateUser = $('#formCreateUser').validate();
		var validUserName = validCreateUser.element('#txtUserName');
		
		if(validUserName==true){
			
			$.blockUI(verifyMessageOptions);
			var txtUserName = $('#txtUserName').val();
			
			$.ajax({
				url: 'createUserAjax.php', 
				data: {
					option: 'verifyUser',
					txtUserName: txtUserName
				},
				success: function(result){
					
					var resData = JSON.parse(result);
					if(resData.existUser==true){
						
						//If the user exists return false
						$('#varReturn').val('false');
						$.unblockUI();
						var validUserNameMessage = $('#formCreateUser').validate();
						validUserNameMessage.showErrors({
							txtUserName: '<label class="text-warning"><i>'+resData.message+'</i></label>'
						});
						
						
					}
					else{
						
						//If the user does not exist show a success message
						$('#varReturn').val('true');
						$.unblockUI();
						var validUserNameMessage = $('#formCreateUser').validate();
						validUserNameMessage.showErrors({
							txtUserName: '<label class="text-success"><i>'+resData.message+'</i></label>'
						});
						
					}
					
				}
			});	
		}
	};
	
	//Function for save the user information
	function saveUser(){
		
		var validCreateUser = $('#formCreateUser').valid();
		
		var validCreateUser = $('#formCreateUser').validate();
		var validUserName = validCreateUser.element('#txtUserName');
		
		if(validUserName==true){
			
			$.blockUI(verifyMessageOptions);
			var txtUserName = $('#txtUserName').val();
			
			$.ajax({
				url: 'createUserAjax.php', 
				data: {
					option: 'verifyUser',
					txtUserName: txtUserName
				},
				success: function(result){
					
					var resData = JSON.parse(result);
					if(resData.existUser==true){
						
						//If the user exists return false
						$('#varReturn').val('false');
						$.unblockUI();
						var validUserNameMessage = $('#formCreateUser').validate();
						validUserNameMessage.showErrors({
							txtUserName: '<label class="text-warning"><i>'+resData.message+'</i></label>'
						});
						
						
					}
					else{
						
						//If the user does not exist show a success message
						var validUserNameMessage = $('#formCreateUser').validate();
						validUserNameMessage.showErrors({
							txtUserName: '<label class="text-success"><i>'+resData.message+'</i></label>'
						});
						
						var txtUserName = $('#txtUserName').val();
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
							$.blockUI(SaveInformationMessageOptions);
							$.ajax({
								url: 'createUserAjax.php', 
								data: {
									
									option: 'createUser',
									txtUserName: txtUserName,
									txtFirstName: txtFirstName,
									txtLastName: txtLastName,
									txtEmail: txtEmail,
									txtPassword: txtPassword
								},
								success: function(result){
									
									var resData = JSON.parse(result);
									if(resData.success==true){
										
										window.location = '../main/getSession.php?userId='+resData.userId;
									}
								}
							});	
						}
					}	
				}
			});	
		}
	};
	
	function fnToLower(){
		
		var txtUserName = $('#txtUserName').val();
		var txtUserName = txtUserName.toLowerCase();
		$('#txtUserName').val(txtUserName);
	};
	
</script>
<?php
	require_once("../footers/mainFooter.php");
?>	