<?php
	/*
		*
		* Generic functions for L-SNIPPETS
		*
	*/
	
	/*
		* dbConnection
		*
		* Function for connect with the database
		* @param void
		* @return connection param with database
	*/
	function dbConnection(){
		
		$connection = mysql_connect("localhost", "root", "sample");
		mysql_select_db ("db_snippet");
		return $connection;
	}
	
	/*
		* executeQuery
		*
		* Function to execute a query
		* @param $sqlQuery (Statement sql)
		* @return array with all the information
	*/
	//Function to execute a query
	function executeQuery($sqlQuery){
		
		$connection = dbConnection();
		$resQuery = mysql_query($sqlQuery, $connection);
		
		$aData = array();
		
		while($row = mysql_fetch_assoc($resQuery)){
			
			array_push($aData, $row);	
		}  
		
		return $aData;
	}
	
	/*
		* printData
		*
		* Function to print data
		* @param $var (Statement to be printed)
		* @return void
	*/
	function printData($var)
    {
        print ("<pre>") ;
        print_r( $var );
        print ("</pre>") ;
	}
	
	/*
		* sendMessage
		*
		* Function for send email messages
		* @param $email (Email address)
		* @param $subject (Subject for the email)
		* @param $message (Message in html format)
		* @return void
	*/
	function sendMessage($email, $subject, $message)
    {
        $mail = new PHPMailer();
		
		$mail->IsSMTP(); // set mailer to use SMTP
		//$mail->SMTPDebug  = 2;  
		$mail->SMTPSecure = "tls";
		$mail->Host = "smtp.gmail.com"; // specify main and backup server
		$mail->SMTPAuth = true; // turn on SMTP authentication
		$mail->Port = 587;
		$mail->IsHTML(true);
		
		$mail->Username = "luis.snippet@gmail.com"; // SMTP username 
		$mail->Password = "1123581321snippet"; // SMTP password
		
		$mail->From = "luis.snippet@gmail.com";
		$mail->FromName = "L-SNIPPETS";
		$mail->AddAddress($email, "Receiver Name");
		$mail->Subject = $subject;
		
		$mail->Body = $message;
		$mail->Send();
		/*
		if(!$mail->Send())
		{
			echo "Message could not be sent. <p>";
			echo "Mailer Error: " . $mail->ErrorInfo;
			die;
		}
		*/
	}
?>
