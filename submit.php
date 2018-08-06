<?php

	ob_start();
	include "upload/dbconfig.php";

	require_once 'class.user.php';

	$reg_user = new USER();

	
	function generateRandomString($length = 6) {
    $characters = '12346789ABCDEFGHIJKLMNOPQRTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    	}
    return $randomString;
	}


	if(isset($_POST['submit'])) {
		session_start();

		$Ran_Number = rand(0, 9999999999);
		$Ran_String = 'JTP'.generateRandomString();

		  $nam = $_POST['name'];
    	$ema = $_POST['email'];
    	$phn = $_POST['phone'];

    	//$sng = $_POST['songs'];

    	$sql = "INSERT INTO user_ac(reg_no, password, person_name, email_id, contact) 
    			VALUES($Ran_Number, '$Ran_String', :user_name, :user_email, :user_contact)";

    	$stmt = $conn->prepare($sql);
    	$stmt->bindparam(":user_name",$nam);
    	$stmt->bindparam(":user_email",$ema);
    	$stmt->bindparam(":user_contact",$phn);
    	$result = $stmt->execute();

      $pay = 0;
      foreach($_POST['chk'] as $sng){
        $otp = rand(10000,99999);
        $sql1 = "INSERT INTO upload_list(reg_no, song_id, file_name, otp_no) VALUES ($Ran_Number, :song_id, '', $otp)";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bindparam(":song_id",$sng);
        $result1 = $stmt1->execute();
        $pay = $pay+500;
      }


      $sql2 = "INSERT INTO payment(reg_no, payment, dd_no) VALUES ($Ran_Number, $pay, '')";
      $stmt2 = $conn->prepare($sql2);
      $result2 = $stmt2->execute();


      $_SESSION['mail'] = $ema;
      $_SESSION['name'] = $nam;
      $_SESSION["payment"] = $pay;
    	//session variable
    	$_SESSION["RandomNo"] = $Ran_Number;
    	$_SESSION["RandomStr"] = $Ran_String;

    	$message = "<h3>BOOM CELEBRATIONS</h3> <br>                
                        <b>Name:</b> $nam <br>
                        <b>Id:</b> $ema <br>
                        <b>Password:</b> $Ran_String <br>
                        (Use your id & password to login)<br>
                        For more details contact us @ 9854068006";

    	//$message = 'Your Id: $email & Password: $Ran_String (Use this to login) <br> For more details contact us @ 9854068006';
    	$subject = 'BOOM CELEBRATIONS';

    	$reg_user->send_mail($ema,$message,$subject);

    	$abc = "<br><br><h3 align=\"center\" style=\"color:green;\">Form Submission Successful</h3>
    		<h4><span style='color:red;'>Email id: $ema </span> & <span style='color:red;'>Password: $Ran_String </span>(Use this to login)</h4>
            <p align=\"center\">Make your payment of &nbsp; Rs  $pay &nbsp;&nbsp;<a href=\"payment.php\">HERE</a></p>
            <p align=\"center\">Or Pay later &nbsp;<a href=\"logout.php\">Logout</a></p>"; 

	}	 else 
    //echo "<br><br><h3 align=\"center\" style=\"color:red;\">Something went Wrong. Please try again...</h3><p align=\"center\"></p>";
    	$abc = "<br><h3 align=\"center\" style=\"color:red;\">Something went Wrong. Please try again...</h3>
          <p align=\"center\">Go to &nbsp;<a href=\"register.php\">HOME</a></p>";

?>

<!Doctype> 
<html> 
<head> 
  <style> 
    .allblur 
    {   width:750px;height:250px; 
      border: solid 1px rgba(243, 238, 238, 0); 
      background-color: rgba(238, 238, 221, 0.29); 
      box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.07);
      -moz-box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.07);
      -webkit-box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.07);
      -o-box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.07);
      margin-top: 5%; 
    } 
  </style> 
</head> 
<body style="background-color: white;"> 
<center>
  <div class="allblur"><?php echo $abc ?></div> 
</center>
  
</body> 
</html>