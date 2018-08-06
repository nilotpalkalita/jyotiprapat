<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Download Form</title>
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="include/css/style.css">
</head>

<body>
  <div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a>Download Your Songs</a></li>
        <!-- <li class="tab active"><a href="#login"><h3></h3></a></li> -->
      </ul>
      
  
        <div id="signup">   
          <!-- <h1>Sign Up </h1> -->
          
          <form action="submit.php" method="post">

          <?php
            ob_start();
            session_start();

            $reg = $_SESSION['reg'];

            include("upload/dbconfig.php");
            $i = 0;
            $stmt1 = $conn->prepare("SELECT * FROM upload_list WHERE reg_no = $reg ");
            $stmt1->execute();
            while($row1=$stmt1->fetch(PDO::FETCH_ASSOC)) {
              $sng = $row1['song_id'];
              //echo $sng;

              $stmt2 = $conn->prepare("SELECT * FROM song_list WHERE song_id = $sng ");
              $stmt2->execute();
              
              while ($row2=$stmt2->fetch(PDO::FETCH_ASSOC)) {
                $nm = $row2['song_name'];
                $i++;
                //echo $nm;
          ?>
          
          <div class="field-wrap">
            <center>
              <span style="color:yellow;"><?php echo $i++; ?>.</span>
              <span style="color:white;"> &nbsp;<?php echo $nm; ?> </span>
              <a href="song/<?php echo $nm; ?>.mp3" download>&nbsp;&nbsp;Download</a> &nbsp;&nbsp;

              <a href='upload/up.php?id=<?php echo $sng; ?>' target='_blank' style='color:red;'>Upload Your Song</a>

              <!-- <input type="text" name="name" id="name1" placeholder="Your Name *" autocomplete="off"> -->
            </center>
          </div>

          <?php

              }

            }

          ?>
          
          </form>
          <center><!-- <input type="button" name="logout" id="myButton" value="Logout" > -->
              <a href="logout.php" id="myButton">Logout</a>
          </center>
        </div>
  
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
      
  </div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
