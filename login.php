<?php

  ob_start();
  session_start();
  
  //include('login.php'); // Include Login Script

  /*if ((isset($_SESSION['email']) != '')) 
  {
    header('Location: upload/index.php');
  } */
  

  include("upload/dbconfig.php"); //Establishing connection with our database
  
  $error = ""; //Variable for storing our errors.
  if(isset($_POST["submit"]))
  {
    if(empty($_POST["email"]) || empty($_POST["password"]))
    {
      $error = "Both fields are required.";
    } else {
      // Define $username and $password
      $email=$_POST['email'];
      $password=$_POST['password'];


      $result = $conn->prepare("SELECT * FROM user_ac WHERE email_id=:mail and password=:pwd ");
      $result->bindParam(':mail', $email);
      $result->bindParam(':pwd', $password);
      $result->execute();
      //$rows = $result->fetch(PDO::FETCH_NUM); 
      $rows1 = $result->fetch(PDO::FETCH_ASSOC);   

      if($rows1 > 0)
      {

          $_SESSION['mail'] = $email;
          $_SESSION['reg'] = $rows1['reg_no'];

          $_SESSION["RandomNo"] = $rows1['reg_no'];

          $_SESSION['name'] = $rows1['person_name'];

          //$file = $rows1['file_name'];
          $rn = $rows1['reg_no'];
          $result1 = $conn->prepare("SELECT * FROM payment WHERE reg_no = $rn");
          $result1->execute();
          $rows2 = $result1->fetch(PDO::FETCH_ASSOC);
          $_SESSION["payment"] = $rows2['payment'];
          
          if ($rows2['dd_no'] != '') {
            header("location:otppage.php");
          } else {
            header("location:payment.php");
          }


          //$_SESSION['file'] = $file;

          //if ($file == '') {

            
          /*} else {
            header("location:home.php");
          }*/

           // Redirecting To Other Page
      } else {
          $error = "Incorrect username or password.";
      }

    }
  }

?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

      <link rel="stylesheet" href="include/css/style.css">
       <style type="text/css">
            .error
      {
        color:red;
        font-family:Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", monospace;
        font-size:16px;
      }
        </style>
  
</head>

<body>
  <div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a>Login</a></li>
        <!-- <li class="tab active"><a href="#login"><h3></h3></a></li> -->
      </ul>
      
  
        <div id="signup">   
          <!-- <h1>Sign Up </h1> -->
          <p style="color: red;"><?php echo $error;?></p>
          <form role="form" action="" method="post">
          

          <div class="field-wrap">
            <input type="text" name="email" id="email1" placeholder="Enter your email " autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <input type="password" name="password" id="password" placeholder="Enter your password " autocomplete="off"/>
          </div>
          
          
          <button type="submit" class="button button-block" name="submit" />Get Started</button>

          <center><h5 style="color: yellow; letter-spacing: 1px;">Not Registered &nbsp;<a href="register.php">Register Now</a> </h5></center>
          
          </form>

        </div>
  
      
  </div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  <!--   <script src="js/index.js"></script> -->

</body>
</html>
