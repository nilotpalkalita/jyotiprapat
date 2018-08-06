<?php
  ob_start();
  session_start();

  if (!isset($_SESSION['mail']) || $_SESSION['mail'] == '') {
    header("location:logout.php");
  } else {
    $name = $_SESSION['name'];
  }

  $pay = $_SESSION["payment"];
  //$rndm = $_SESSION["RandomNo"];

?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>payment</title>
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="include/css/style.css">

  
</head>

<body>
  <div class="form" style="margin-top: 6%;">
      
      <ul class="tab-group">
        <li class="tab active"><a><b>Welcome&nbsp;</b> <?php echo $name ?> </a></li>
        <!-- <li class="tab active"><a href="#login"><h3></h3></a></li> -->
      </ul>
      
  
        <div id="signup">   
          <!-- <h1>Sign Up </h1> -->
          <form action="make_pay.php" method="post" onsubmit="return ValidationEvent()" name="form_name" id="form_name">

          <div class="field-wrap" style="color:yellow;">
            <div style="text-align: center; line-height: 22px; letter-spacing: 1px;">Thank You for registering.</div>
          </div>

          <div class="field-wrap" style="color:yellow;">
            <div style="text-align: center; line-height: 22px; letter-spacing: 1px;">Your have to Pay Rs <?php echo $pay; ?>.</div>
          </div>
          

          <div class="field-wrap" style="color:#1ab188;">
            <div style="text-align: center; line-height: 12px; letter-spacing: 1px; margin-bottom: 2%;">Enter Your Demand Draft No</div>
            <div style=" margin-left: 18%;"> 
              <input type="text" name="DD" id="DD" placeholder="Enter Demand Draft No *" autocomplete="off" style="width:300px;" maxlength="28" />
              <button type="submit" class="button" name="submit" id="submit" style="font-size: 12px; padding-left: 2%; padding-right: 2%; margin-top: 2%;">MAKE PAYMENT</button>
            </div>
            
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
