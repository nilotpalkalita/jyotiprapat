<?php
	
	session_start();

	include "upload/dbconfig.php";

	if(isset($_POST['submit'])) {

		$ddn = $_POST['DD'];

		$rndm = $_SESSION["RandomNo"];

		$sql = "UPDATE payment SET dd_no='$ddn' WHERE reg_no=$rndm";

	   	$stmt = $conn->prepare($sql);
	   	$result = $stmt->execute();

	   	$abc = "<br><br><h3 align=\"center\" style=\"color:green;\">Thank You</h3>
    		<h4><span style='color:red;'>We will mail you the OTP to download the song.</h4>
            <p align=\"center\">For any query you can contact us.</a></p>
            <p><a href=\"logout.php\">Logout</a>&nbsp;Now</p>"; 
	} else

		$abc = "<br><br><h3 align=\"center\" style=\"color:red;\">Something went Wrong. Please try again...</h3>
            <p><a href=\"logout.php\">Logout</a></p>";

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