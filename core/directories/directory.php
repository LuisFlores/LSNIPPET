<?php
	session_start();
	error_reporting(~E_NOTICE);
	require_once("../headers/mainHeader.php");
	
?>

<div class="container">
	<div class="bs-docs-section">
		
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<h1 id="forms">Directories</h1>
				</div>
			</div>
		</div>
		
		<!-- Datatable directories -->
		<div class="row">
			<div class="col-lg-12">
				<div class="well bs-component">
					<form class="form-horizontal">
						<fieldset>
							
							<div class="form-group">
								<table id="tableDirectories" style="margin-left:1px;" cellspacing="0" class="table table-striped table-bordered table-hover ">
									<thead>
										<tr>
											<th width="40%">Name</th>
											<th width="40%">Description</th>
											<th width="10%">Edit</th>
											<th width="10%">Delete</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Name</th>
											<th>Description</th>
											<th>Edit</th>
											<th>Delete</th>
										</tr>
									</tfoot>
								</table>
							</div>
							
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		<!-- Datatable directories -->
		
		
		<!-- Dialog to create new directory-->
		<div id="dialogCreateDirectory" class="modal fade col-lg-12" role="dialog">
			<div class="modal-dialog">
				
				<!-- Modal content-->
				<div class="modal-content">
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">New directory</h4>
					</div>
					
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="well bs-component">
									<form class="form-horizontal" id="formCreateDirectory">
										<fieldset>
											
											<div class="form-group">
												<label class="col-lg-3 control-label">Name directory: <font color="red">*</font></label>
												<div class="col-lg-9">
													<input type="text" class="form-control" id="txtNameDirectory" name="txtNameDirectory" placeholder="Name directory" maxlength="80">
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-lg-3 control-label">Description:</label>
												<div class="col-lg-9">
													<textarea class="form-control" rows="3" id="txaDescriptionDirectory" maxlength="400"></textarea>
												</div>
											</div>
											
											<div class="form-group">
												<div class="col-lg-12 col-lg-offset-5">
													<button type="button" class="btn btn-primary" onclick="createDirectory()">Save</button>
												</div>
											</div>
										</fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				
			</div>
		</div>
		<!-- Dialog to create new directory-->
		
		
		<!-- Dialog to edit directory-->
		<div id="dialogEditDirectory" class="modal fade col-lg-12" role="dialog">
			<div class="modal-dialog">
				
				<!-- Modal content-->
				<div class="modal-content">
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Edit directory</h4>
					</div>
					
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="well bs-component">
									<form class="form-horizontal" id="formEditDirectory">
										<fieldset>
											<input type="hidden" class="form-control" id="hiddenEditIdDirectory" name="hiddenEditIdDirectory" value="">
											
											<div class="form-group">
												<label class="col-lg-3 control-label">Name directory: <font color="red">*</font></label>
												<div class="col-lg-9">
													<input type="text" class="form-control" id="txtEditNameDirectory" name="txtEditNameDirectory" placeholder="Name directory" >
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-lg-3 control-label">Description:</label>
												<div class="col-lg-9">
													<textarea class="form-control" rows="3" id="txaEditDescriptionDirectory"></textarea>
												</div>
											</div>
											
											<div class="form-group">
												<div class="col-lg-12 col-lg-offset-5">
													<button type="button" class="btn btn-primary" onclick="editDirectory()">Save</button>
												</div>
											</div>
										</fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				
			</div>
		</div>
		<!-- Dialog to edit directory-->
		
		
		
	</div>
</div>

<script type="text/javascript">
	
	//Rules for validate the "formCreateDirectory"
	$("#formCreateDirectory").validate({
		rules: {
			txtNameDirectory: "required"
		},
		messages: {
			txtNameDirectory: '<label class="text-danger"><i>The field it is required.</i></label>'
		}
	});
	
	//Rules for validate the "formEditDirectory"
	$("#formEditDirectory").validate({
		rules: {
			txtEditNameDirectory: "required"
		},
		messages: {
			txtEditNameDirectory: '<label class="text-danger"><i>The field it is required.</i></label>'
		}
	});
	
	//Datatable JS classes
	var tableDirectories = $('#tableDirectories').DataTable({
	
		ajax: {
			url: 'directoryAjax.php',
			data: { 
				option: 'getDirectories'
			},
			type: 'POST'
		},
		scrollX: true,
		sScrollXInner: "99%",
		dom: '<"toolbarDirectory">lfrtip',
		lengthMenu: [ 10, 25, 50, 75, 100 ],
		columns: [
		{data: 'DIR_NAME'},
		{data: 'DIR_DESCRIPTION' },
		{data: 'DIR_EDIT', className:'dt-center', orderable:false, mRender: function(data, type, full){
			var ID_DIRECTORY = full.ID_DIRECTORY;
			var DIR_NAME = escape(full.DIR_NAME.toString());
			var DIR_DESCRIPTION = escape(full.DIR_DESCRIPTION.toString());
			var parameters = "'"+ID_DIRECTORY+"','"+DIR_NAME+"','"+DIR_DESCRIPTION+"'";
			return '<input type="button" value="Edit" class="btn btn-warning btn-xs" onclick="openEditForm('+parameters+')" />';
		}},
		{data: 'DIR_DELETE', className:'dt-center', orderable:false, mRender: function(data, type, full){
			var ID_DIRECTORY = full.ID_DIRECTORY;
			return '<input type="button" value="Delete" class="btn btn-danger btn-xs" onclick="deleteDirectory('+ID_DIRECTORY+')" />';
		}}
		]
	});
	$('div.toolbarDirectory').html('<input type="button" value="New directory" class="btn btn-success" data-toggle="modal" data-target="#dialogCreateDirectory"/><br><br>');
	
	//Function to create directory
	function createDirectory(){
		
		var validCreateDirectory = $("#formCreateDirectory").valid();
		
		if(validCreateDirectory==true){
		
			var txtNameDirectory = $('#txtNameDirectory').val();
			var txaDescriptionDirectory = $('#txaDescriptionDirectory').val();
			
			$.ajax({
				
				url: 'directoryAjax.php',
				data: { 
					
					option: 'createDirectory',
					txtNameDirectory: txtNameDirectory,
					txaDescriptionDirectory: txaDescriptionDirectory
				},
				success: function(result){
					
					var resData = JSON.parse(result);
					
					if(resData.success == true){
						
						$('#txtNameDirectory').val('');
						$('#txaDescriptionDirectory').val('');
						//Hide the form
						$('#dialogCreateDirectory').modal('toggle');
						//Change alert message
						$('#alertLegend').text(resData.message);
						$('#alertDialog').modal('show');
						tableDirectories.ajax.reload();
						
					}
					else{
						
						alert('Error');	
					}
					
				}
			});	
		}
		
	};
	
	//Function to open the edit form
	function openEditForm(idDirectory, nameDirectory, descriptionDirectory){
		
		$('#hiddenEditIdDirectory').val(idDirectory);
		$('#txtEditNameDirectory').val(unescape(nameDirectory));
		$('#txaEditDescriptionDirectory').val(unescape(descriptionDirectory));
		$('#dialogEditDirectory').modal('show');
	};
	
	//Function to edit directory
	function editDirectory(){
		
		var validEditDirectory = $("#formEditDirectory").valid();
		
		if(validEditDirectory==true){
		
			var idDirectory = $('#hiddenEditIdDirectory').val();
			var txtEditNameDirectory = $('#txtEditNameDirectory').val();
			var txaEditDescriptionDirectory = $('#txaEditDescriptionDirectory').val();
			
			$.ajax({
				
				url: 'directoryAjax.php',
				data: { 
					
					option: 'editDirectory',
					idDirectory: idDirectory,
					txtEditNameDirectory: txtEditNameDirectory,
					txaEditDescriptionDirectory: txaEditDescriptionDirectory
				},
				success: function(result){
					
					var resData = JSON.parse(result);
					
					if(resData.success == true){
						
						//Hide the form
						$('#dialogEditDirectory').modal('toggle');
						//Change alert message
						$('#alertLegend').text(resData.message);
						$('#alertDialog').modal('show');
						tableDirectories.ajax.reload();
						
					}
					else{
						
						alert('Error');	
					}
					
				}
			});
		}
	};
	
	//Function for delete directories
	function deleteDirectory(idDirectory){
		
		$.ajax({
			
			url: 'directoryAjax.php',
			data: { 
				
				option: 'deleteDirectory',
				idDirectory: idDirectory
			},
			success: function(result){
				
				var resData = JSON.parse(result);
				
				if(resData.success == true){
					
					tableDirectories.ajax.reload();
					//Change alert message
					$('#alertLegend').text(resData.message);
					$('#alertDialog').modal('show');
				}
				else{
					
					alert('Error');	
				}
			}
		});
	};
	
</script>

<?php
	require_once("../footers/mainFooter.php");
?>																																