<?php
	session_start();
	error_reporting(~E_NOTICE);
	require_once("../headers/mainHeader.php");
	
	//Get select directories
	$userId = $_SESSION['userId'];
	$sqlSdir = "SELECT *
	FROM TB_DIRECTORY
	WHERE DIR_STATUS != 'DELETED'
	AND ID_USER = '".$userId."'
	ORDER BY DIR_NAME";
	$resSdir = executeQuery($sqlSdir);
	
	$selectDirectory = '<select id="selectDirectory" ><option value="">All</option>';
	$selectDirectoryDialog = '<select id="selectDirectoryDialog" name="selectDirectoryDialog" class="form-control"><option value="">-- Select --</option>';
	$selectEditDirectoryDialog = '<select id="selectEditDirectoryDialog" name="selectEditDirectoryDialog" class="form-control"><option value="">-- Select --</option>';
	
	foreach($resSdir as $key => $row){
		
		$selectDirectory .= '<option value="'.$row['ID_DIRECTORY'].'">'.mysql_real_escape_string($row['DIR_NAME']).'</option>';
		$selectDirectoryDialog .= '<option value="'.$row['ID_DIRECTORY'].'">'.$row['DIR_NAME'].'</option>';
		$selectEditDirectoryDialog .= '<option value="'.$row['ID_DIRECTORY'].'">'.$row['DIR_NAME'].'</option>';
	}
	
	$selectDirectory .= '</select>';
	$selectDirectoryDialog .= '</select>';
	$selectEditDirectoryDialog .= '</select>';	
	
?>
<style>
	.embed-responsive
	{
	display: block;
	height: 0;
	overflow: hidden;
	position: relative;
	}
	
	.embed-responsive.embed-responsive-4by3
	{
	padding-bottom: 70%
	}
	
	.embed-responsive .embed-responsive-item, .embed-responsive iframe, .embed-responsive embed, .embed-responsive object
	{
	border: 0 none;
	bottom: 0;
	height: 100%;
	left: 0;
	position: absolute;
	top: 0;
	width: 100%;
	}
</style>
<article>
	<div class="container">
		<div class="bs-docs-section">
			<div class="row">
				<div class="col-lg-12">
					<div class="page-header">
						<h1 id="forms">Shared with me</h1>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="well bs-component">
						<form class="form-horizontal">
							<fieldset>
								
								<div class="form-group">
									<table id="tableSnippets" style="margin-left:1px;" cellspacing="0" class="table table-striped table-bordered table-hover ">
										<thead>
											<tr>
												<th width="20%">Title</th>
												<th width="30%">Description</th>
												<th width="10%">Language</th>
												<th width="10%">View/Edit</th>
												<th width="10%">Copy to</th>
												<th width="10%">Delete</th>
												<th width="10%">Details</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th width="20%">Title</th>
												<th width="30%">Description</th>
												<th width="10%">Language</th>
												<th width="10%">View/Edit</th>
												<th width="10%">Copy to</th>
												<th width="10%">Delete</th>
												<th width="10%">Details</th>
											</tr>
										</tfoot>
									</table>
								</div>
								
							</fieldset>
						</form>
					</div>
				</div>
			</div>
			
			<!-- Dialog to edit snippet-->
			<div id="dialogEditSnippet" class="modal fade col-lg-12" role="dialog">
				<div class="modal-dialog">
					
					<!-- Modal content-->
					<div class="modal-content">
						
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Edit snippet</h4>
						</div>
						
						<div class="modal-body">
							<div class="row">
								<div class="col-lg-12">
									<div class="well bs-component">
										<form class="form-horizontal" id="formEditSnippet">
											<fieldset>
												
												<input type="hidden" class="form-control" id="hiddenEditIdSnippet" name="hiddenEditIdSnippet" value="">
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Title snippet: <font color="red">*</font></label>
													<div class="col-lg-9">
														<input type="text" class="form-control" id="txtEditTitleSnippet" name="txtEditTitleSnippet" placeholder="Title snippet" maxlength="100">
													</div>
												</div>
												<div class="form-group">
													<div class="form-group">
														<label class="col-lg-3 control-label">Description:</label>
														<div class="col-lg-9">
															<textarea class="form-control" rows="3" id="txaEditDescriptionSnippet" maxlength="400"></textarea>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<!--<div class="embed-responsive embed-responsive-4by3">-->
														<div>
															<iframe class="embed-responsive-item" id="iframeEditSnippet" src="/lsnippet/core/sharedSnippets/sharedSnippets.html" style="overflow:hidden; height:440; width:100%; margin:0px" frameborder="0"></iframe>
														</div>
													</div>
												</div>
												
												<div class="form-group">
													<div class="col-lg-12 col-lg-offset-5">
														<button type="button" class="btn btn-primary" onclick="editSharedSnippet()">Save</button>
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
			<!-- Dialog to edit snippet-->
			
			
			
			
			
			
			<!-- Dialog to copy snippet-->
			<div id="dialogCopySnippet" class="modal fade col-lg-12" role="dialog">
				<div class="modal-dialog">
					
					<!-- Modal content-->
					<div class="modal-content">
						
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Copy to</h4>
						</div>
						
						<div class="modal-body">
							<div class="row">
								<div class="col-lg-12">
									<div class="well bs-component">
										<form class="form-horizontal" id="formCopySnippet">
											<fieldset>
												
												<input type="hidden" class="form-control" id="hiddenCopyIdSnippet" name="hiddenCopyIdSnippet" value="">
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Directory: <font color="red">*</font></label>
													<div class="col-lg-9">
														<?php echo $selectDirectoryDialog; ?>
													</div>
												</div>
												
												<div class="form-group">
													<div class="col-lg-12 col-lg-offset-5">
														<button type="button" class="btn btn-primary" onclick="fnCopyTo()">Save</button>
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
			<!-- Dialog to copy snippet-->
			
			
			
			<!-- Dialog to details snippet-->
			<div id="dialogDetailsSnippet" class="modal fade col-lg-12" role="dialog">
				<div class="modal-dialog">
					
					<!-- Modal content-->
					<div class="modal-content">
						
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Details</h4>
						</div>
						
						<div class="modal-body">
							<div class="row">
								<div class="col-lg-12">
									<div class="well bs-component">
										<form class="form-horizontal" id="formDetailsSnippet">
											<fieldset>
												
												<div class="bs-component" id="divDetails">
													
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
			<!-- Dialog to details snippet-->
			
		</div>
	</div>
	
	<script type="text/javascript">
		
		var selectDirectory = '<?php echo $selectDirectory; ?>';
		
		//Rules for validate the "formEditSnippet"
		$('#formEditSnippet').validate({
			rules: {
				selectEditDirectoryDialog: 'required',
				txtEditTitleSnippet: 'required'
			},
			messages: {
				selectEditDirectoryDialog: '<label class="text-danger"><i>The field it is required.</i></label>',
				txtEditTitleSnippet: '<label class="text-danger"><i>The field it is required.</i></label>'
			}
		});
		
		//Rules for validate the "formCopySnippet"
		$('#formCopySnippet').validate({
			rules: {
				selectDirectoryDialog: 'required'
			},
			messages: {
				selectDirectoryDialog: '<label class="text-danger"><i>The field it is required.</i></label>'
			}
		});
		
		//Initiate datatable
		var tableSnippets = $('#tableSnippets').DataTable({
			
			ajax: {
				url: 'sharedSnippetsAjax.php',
				data   : function( d ) {
					d.option = 'getSharedSnippets'
				},
				type: 'POST'
			},
			scrollX: true,
			sScrollXInner: "99%",
			dom: '<"toolbarSnippets">lfrtip',
			lengthMenu: [ 10, 25, 50, 75, 100 ],
			columns: [
			{data: 'SNI_TITLE'},
			{data: 'SNI_DESCRIPTION'},
			{data: 'SNI_LANGUAGE'},
			{data: 'SNI_EDIT', className:'dt-center', orderable: false, mRender: function(data, type, full){
				
				var ID_SNIPPET = full.ID_SNIPPET.toString();
				var ID_DIRECTORY = full.ID_DIRECTORY.toString();
				var SNI_TITLE = escape(full.SNI_TITLE.toString());
				var SNI_DESCRIPTION = escape(full.SNI_DESCRIPTION.toString());
				var SNI_LANGUAGE = full.SNI_LANGUAGE.toString();
				var SNI_CODE = escape(full.SNI_CODE.toString());
				var parameters = "'"+ID_SNIPPET+"','"+ID_DIRECTORY+"','"+SNI_TITLE+"','"+SNI_DESCRIPTION+"','"+SNI_LANGUAGE+"','"+SNI_CODE+"'";
				return '<input type="button" value="View / Edit" class="btn btn-warning btn-xs" onclick="openEditSnippet('+parameters+')" />';
			}},
			{data: 'ID_SHARED_SNIPPET', className:'dt-center', orderable:false, mRender: function(data, type, full){
				var ID_SNIPPET = full.ID_SNIPPET.toString();
				return '<input type="button" value="Copy to" class="btn btn-success btn-xs" onclick="openCopySnippet('+ID_SNIPPET+')"/>';
			}},
			{data: 'SNI_DELETE', className:'dt-center', orderable:false, mRender: function(data, type, full){
				var ID_SHARED_SNIPPET = full.ID_SHARED_SNIPPET;
				return '<input type="button" value="Delete" class="btn btn-danger btn-xs" onclick="deleteSharedSnippet('+ID_SHARED_SNIPPET+')"/>';
			}},
			{data: 'ID_SHARED_SNIPPET', className:'dt-center', orderable:false, mRender: function(data, type, full){
				var ID_SHARED_SNIPPET = full.ID_SHARED_SNIPPET;
				return '<input type="button" value="Details" class="btn btn-default btn-xs" onclick="openDetailsForm('+ID_SHARED_SNIPPET+')"/>';
			}}
			
			]
		});
		
		//Reload tableSnippets
		$('#selectDirectory').on('change', function() {
			var idDirectory = $('#selectDirectory').val();
			tableSnippets.ajax.reload();  
		});
		
		//Function to open edit snippet form
		function openEditSnippet(idSnippet, idDirectory, titleSnippet, descriptionSnippet, languageSnippet, codeSnippet){
			
			$('#hiddenEditIdSnippet').val(idSnippet);
			$('#txtEditTitleSnippet').val(unescape(titleSnippet));
			$('#txaEditDescriptionSnippet').val(unescape(descriptionSnippet));
			$('#dialogEditSnippet').modal('show');
			document.getElementById('iframeEditSnippet').contentWindow.setLanguageCode(languageSnippet, unescape(codeSnippet));
			
		};
		
		//Function to edit snippet
		function editSharedSnippet(){
			
			var validEditSnippet = $('#formEditSnippet').valid();
			
			if(validEditSnippet==true){
				
				var idSnippet = $('#hiddenEditIdSnippet').val();
				var txtEditTitleSnippet = $('#txtEditTitleSnippet').val();
				var txaEditDescriptionSnippet = $('#txaEditDescriptionSnippet').val();
				var selectLanguage = document.getElementById('iframeEditSnippet').contentWindow.getLanguage();
				var txaSnippetCode = document.getElementById('iframeEditSnippet').contentWindow.getValueEditor();
				
				$.ajax({
					
					url: 'sharedSnippetsAjax.php',
					type: 'POST',
					data: { 
						
						option: 'editSharedSnippet',
						idSnippet: idSnippet,
						txtEditTitleSnippet: txtEditTitleSnippet,
						txaEditDescriptionSnippet: txaEditDescriptionSnippet,
						selectLanguage: selectLanguage,
						txaSnippetCode: txaSnippetCode
						
					},
					success: function(result){
						
						var resData = JSON.parse(result);
						
						if(resData.success == true){
							
							//Hide the form
							$('#dialogEditSnippet').modal('toggle');
							//Change alert message
							$('#alertLegend').text(resData.message);
							$('#alertDialog').modal('show');
							tableSnippets.ajax.reload();
							
						}
						else{
							
							alert('Error');	
						}
						
					}
				});
			}
		};
		
		//Function to open edit snippet form
		function openCopySnippet(idSnippet){
			
			$('#hiddenCopyIdSnippet').val(idSnippet);
			$('#dialogCopySnippet').modal('show');
			
		};
		
		//Function for copy to 
		function fnCopyTo(){
			
			var validCopySnippet = $('#formCopySnippet').valid();
			
			if(validCopySnippet==true){
				
				var idSnippet = $('#hiddenCopyIdSnippet').val();
				var selectDirectoryDialog = $('#selectDirectoryDialog').val();
				
				$.ajax({
					
					url: 'sharedSnippetsAjax.php',
					type: 'POST',
					data: { 
						
						option: 'copySharedSnippet',
						idSnippet: idSnippet,
						selectDirectoryDialog: selectDirectoryDialog
						
					},
					success: function(result){
						
						var resData = JSON.parse(result);
						
						if(resData.success == true){
							
							//Hide the form
							$('#dialogCopySnippet').modal('toggle');
							//Change alert message
							$('#alertLegend').text(resData.message);
							$('#alertDialog').modal('show');
							tableSnippets.ajax.reload();
							$('#selectDirectoryDialog').val('');
							
						}
						else{
							
							alert('Error');	
						}
						
					}
				});
				
			}
			
		};
		
		//Function to open details form
		function openDetailsForm(idSharedSnippet){
			
			$.ajax({
				
				url: 'sharedSnippetsAjax.php',
				data: { 
					
					option: 'detailsSharedSnippet',
					idSharedSnippet: idSharedSnippet
				},
				success: function(result){
					
					var resData = JSON.parse(result);
					var data = resData.data;
					
					if(resData.success == true){
						
						//Change alert message
						var divMessage = '<center><p> <font>Shared by: </font><font class="text-muted">'+data[0].USERNAME+'</font></p><p> <font>Email: </font><font class="text-muted">'+data[0].EMAIL+'</font></p><p> <font>Date: </font><font class="text-muted">'+data[0].SHS_DATE+'</font></p></center>';
						$('#divDetails').html(divMessage);
						$('#dialogDetailsSnippet').modal('show');
					}
					else{
						
						alert('Error');	
					}
					
				}
				
			});

		};
		
		//Function for delete snippets
		function deleteSharedSnippet(idSharedSnippet){
			
			$.ajax({
				
				url: 'sharedSnippetsAjax.php',
				data: { 
					
					option: 'deleteSharedSnippet',
					idSharedSnippet: idSharedSnippet
				},
				success: function(result){
					
					var resData = JSON.parse(result);
					
					if(resData.success == true){
						
						tableSnippets.ajax.reload();
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
</article>
<?php
	require_once("../footers/mainFooter.php");
?>																																		