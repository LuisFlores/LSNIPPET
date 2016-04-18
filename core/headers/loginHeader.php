<html>
	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		
		<!-- Jquery JS -->
		<script type="text/javascript" src="/lsnippet/js/jquery/jquery-1.12.0.min.js"></script>
		<script type="text/javascript" src="/lsnippet/js/jquery/jquery-migrate-1.2.1.js"></script>
		<script type="text/javascript" src="/lsnippet/js/jquery/jquery.blockUI.js"></script>
		
		<!-- Bootstrap JS -->
		<script src="/lsnippet/js/bootstrap/bootstrap.min.js"></script>
		<script src="/lsnippet/js/bootstrap/custom.js"></script>
		
		<!-- Datatables JS -->
		<script type="text/javascript" language="javascript" src="/lsnippet/js/DataTables-1.10.11/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" src="/lsnippet/js/DataTables-1.10.11/media/js/jquery.dataTables.js"></script>
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="/lsnippet/css/bootstrap/bootstrap.css" />
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="/lsnippet/js/DataTables-1.10.11/media/css/jquery.dataTables.css" />
		
		<!-- Jquery validation JS and CSS -->
		<script type="text/javascript" src="/lsnippet/js/jquery-validation-1.15.0/dist/jquery.validate.js"></script>		
		
		<title>L-SNIPPETS</title>
		
	</head>
	
	<!-- Alert Popup -->
	<div id="alertDialog" class="modal fade col-lg-12" role="dialog">
		<div class="modal-dialog">
			
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					
					<div class="panel panel-warning">
						<div class="panel-heading">
							<h3 class="panel-title">Message</h3>
						</div>
						<div class="panel-body">
							<legend id="alertLegend"></legend>
						</div>
						
						<div class="panel-body">
							<div class="col-lg-12 col-lg-offset-5">
								<input type="button" id="alertCloseButton" value="Ok" class="btn btn-primary" onclick="closeAlert()"></input>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			
		</div>
	</div>
	<script type="text/javascript">
		function closeAlert(){
			
			$('#alertDialog').modal('toggle');
		}
	</script>	
<body>