<?php
	
	session_start();
	error_reporting(~E_NOTICE);
	require_once("classes/functions.php");
	require_once("core/headers/loginHeader.php");
?>

<div class="col-lg-12 col-md-12 col-sm-12" style="height:100%;">
	<iframe class="embed-responsive-item" id="mainFrame" name="mainFrame" src="/lsnippet/core/main/login.php" style="overflow:hidden; height:100%; width:100%; margin:0px" frameborder="0"></iframe>
</div>

<?php
	require_once("core/footers/loginFooter.php");
?>	