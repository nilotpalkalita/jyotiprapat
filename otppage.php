<?php
  ob_start();
  session_start();

  if (!isset($_SESSION['mail']) || $_SESSION['mail'] == '') {
    header("location:logout.php");
  } else {
    $name = $_SESSION['name'];
  }

  $pay = $_SESSION["payment"];

  $reg = $_SESSION['reg'];
  //$rndm = $_SESSION["RandomNo"];

?>

<?php
  
  //include('login.php'); // Include Login Script

  /*if ((isset($_SESSION['email']) != '')) 
  {
    header('Location: upload/index.php');
  } */
  $nm = '';
  $sng_id = 'x';

  $dwn = '';
  $up = '';

  include("upload/dbconfig.php"); //Establishing connection with our database
  
  $error = ""; //Variable for storing our errors.
  if(isset($_POST["submit"]))
  {
    if(empty($_POST["otp"]))
    {
      $error = "Enter OTP";
    } else {
      // Define $username and $password
      $otp=$_POST['otp'];

      $result = $conn->prepare("SELECT * FROM upload_list WHERE otp_no='$otp' and reg_no=$reg ");
      $result->execute();
      //$rows = $result->fetch(PDO::FETCH_NUM); 
      $rows1 = $result->fetch(PDO::FETCH_ASSOC);   

      if($rows1 > 0)
      {

          $sng_id = $rows1['song_id'];

          $stmt2 = $conn->prepare("SELECT * FROM song_list WHERE song_id = $sng_id ");
          $stmt2->execute();
          $row2=$stmt2->fetch(PDO::FETCH_ASSOC);

          $nm = $row2['song_name'];

          $dwn = 'Download';
          $up = 'Upload Your Song';

           // Redirecting To Other Page
      } else {
          $error = "Enter a valid OTP";
      }

    }
  }

?>


<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>song</title>
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
  <div class="form" style="margin-top: 6%;">
      
      <ul class="tab-group">
        <li class="tab active"><a><b>Welcome&nbsp;</b> <?php echo $name ?> </a></li>
        <!-- <li class="tab active"><a href="#login"><h3></h3></a></li> -->
      </ul>
      
  
        <div id="signup">
             
          <!-- <h1>Sign Up </h1> -->
          <form action="" method="post"  name="form_name" id="form_name">

          <div class="field-wrap" style="color:yellow;">
            <div style="text-align: center; line-height: 22px; letter-spacing: 1px;">Enter OTP And Download Your Song</div>
          </div>

          <div class="field-wrap" style="color:#1ab188; margin-left: 10%;">
            <p style="color: red;"><?php echo $error;?></p>
            <input type="text" name="otp" id="otp" placeholder="Enter OTP No *" autocomplete="off" style="width:380px; " />
            <button type="submit" class="button" name="submit" id="submit" style="font-size: 12px; padding-left: 2%; padding-right: 2%; margin-top: 2%;">Submit</button>
          </div>



          <div class="field-wrap" style="color:#1ab188;margin-left: 10%;">
            <span style="color:white;"> &nbsp;<?php echo $nm; ?> </span>
            <a href="song/<?php echo $nm; ?>.mp3" download>&nbsp;&nbsp;<?php echo $dwn; ?></a> &nbsp;&nbsp;
            <a href='upload/up.php?id=<?php echo $sng_id; ?>' target='_blank' style='color:red;'><?php echo $up; ?> </a>
          </div>
            
          </form>

          <center><!-- <input type="button" name="logout" id="myButton" value="Logout" > -->
          <a href="logout.php" id="myButton">Logout</a>
          </center>

          </form>

        </div>
  
      
  </div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  <!--   <script src="js/index.js"></script> -->

  <style type="text/css">
    #myButton {
      margin-top: 8%;
      background-color:#1a283933;
      -moz-border-radius:8px;
      -webkit-border-radius:8px;
      border-radius:8px;
      width: 20%;
      height: 8%;
      border:1px solid #295b62;
      display:inline-block;
      cursor:pointer;
      color:#ffffff;
      font-family:Arial;
      font-size:14px;
      padding: 8px 10px;
      text-decoration:none;
      text-shadow:0px 1px 0px #2f6627;
    }
    #myButton:hover {
      background-color:#179b77;
    }
    #myButton:active {
      position:relative;
      top:1px;
    }

  </style>

  <script type="text/javascript">
    function ValidationEvent() {

    }
  </script>

</body>
</html>
