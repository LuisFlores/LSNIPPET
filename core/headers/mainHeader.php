<?php
	session_start();
	error_reporting(~E_NOTICE);
	require_once("../../classes/functions.php");
	require_once("../../classes/classes.php");
	
	//Validate the session
	if(!isset($_SESSION['userId'])){
		
		header('Location: ../../index.php');
	}
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		
		<!-- Jquery JS -->
		<script type="text/javascript" src="../../js/jquery/jquery-1.12.0.min.js"></script>
		<script type="text/javascript" src="../../js/jquery/jquery-migrate-1.2.1.js"></script>
		<script type="text/javascript" src="../../js/jquery/jquery.blockUI.js"></script>
		
		<!-- Bootstrap JS -->
		<script src="../../js/bootstrap/bootstrap.min.js"></script>
		<script src="../../js/bootstrap/custom.js"></script>
		
		<!-- Datatables JS -->
		<script type="text/javascript" language="javascript" src="../../js/DataTables-1.10.11/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" src="../../js/DataTables-1.10.11/media/js/jquery.dataTables.js"></script>
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="../../css/bootstrap/bootstrap.css" />
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="../../js/DataTables-1.10.11/media/css/jquery.dataTables.css" />
		
		<!-- Jquery validation JS and CSS -->
		<script type="text/javascript" src="../../js/jquery-validation-1.15.0/dist/jquery.validate.js"></script>		
		
		
		
		<title>L-SNIPPETS</title>
		<meta charset="utf-8"/>
	</head>
	<style>
		.navbar-brand {
		padding: 0px; /* firefox bug fix */
		}
		.navbar-brand>img {
		height: 100%;
		padding: 15px; /* firefox bug fix */
		width: auto;
		}	
	</style>
	<body>
		
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand"><img src="../../images/logoLSnippet.png" width="10%"/></a>
					
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="navbar-collapse collapse" id="navbar-main">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" >Snippets  <span class="caret"></span></a>
							<ul class="dropdown-menu" aria-labelledby="themes">
								<li><a href="../mySnippets/mySnippets.php">My snippets</a></li>
								<li><a href="../sharedSnippets/sharedSnippets.php">Shared with me</a></li>
								<li><a href="../recycleSnippets/recycleSnippets.php">Recycle bin</a></li>
							</ul>
						</li>
						<li>
							<a href="../directories/directory.php">Directories</a>
						</li>
						<li>
							<a href="../users/editUser.php">User</a>
						</li>
						
						<li>
							<a href="http://news.bootswatch.com">Contact us</a>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="../logout/logout.php" style="color:0ce3ac;">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>	
		<br><br><br>	
		
		<!-- Alert Popup -->
		<div id="alertDialog" class="modal fade col-lg-12" role="dialog" style="z-index:100000;">
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