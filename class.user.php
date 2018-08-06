<?php

class USER
{	

	function send_mail($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		//$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "ssl";                 
		$mail->Host       = "smtp.gmail.com";      
		$mail->Port       = 465;             
		$mail->AddAddress($email);
		$mail->Username="training.techvariable@gmail.com";  
		$mail->Password="tech9401";            
		$mail->SetFrom('training.techvariable@gmail.com','TechVariable');
		$mail->AddReplyTo("training.techvariable@gmail.com","TechVariable");
		$mail->Subject = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}	
}

?>