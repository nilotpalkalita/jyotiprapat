<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>SignUp</title>
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="include/css/style.css">

  <script language=JavaScript> 
    var max_count=3;
    var clickedData = new Array(false,false,false,false,false,false,false,false,false);
    function itemsClicked()
    {
      var i=0;
      for(var j=0;j<clickedData.length;j++)
        i+=clickedData[j]?1:0;
        return(i);
    }
    function itemClicked(t)
    {
      var check_this=true;
      var x=itemsClicked();
      if (x>=max_count && !clickedData[t])
      {
        check_this=false;
        alert('Your can select maximum 3 songs');
      }
      else
      {
        clickedData[t]=clickedData[t]?false:true;
        eval("document.test.check"+t+".clicked=false;");
      }
      return (check_this); 
    } 

  </script>
  
</head>

<body>
  <div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a>Register For The Contest</a></li>
        <!-- <li class="tab active"><a href="#login"><h3></h3></a></li> -->
      </ul>    
  
        <div id="signup">   

          <form action="submit.php" method="post" onsubmit="return ValidationEvent()" name="form_name" id="form_name">
          
          <div class="field-wrap">
            <input type="text" name="name" id="name1" placeholder="Your Name *" autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <input type="text" name="email" id="email1" placeholder="Your email *" autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <input type="text" name="phone" id="phone1" placeholder="Your contact no *" autocomplete="off"/>
          </div> 

          <div class="field-wrap">
            <h4 style="color:rgba(255, 255, 255, 0.82);">Select songs from the list (maximun 3)</h4>
            &nbsp;
            <input type="checkbox" name="chk[]" id="c" value="1" onclick="return itemClicked(1)" /><span style="color:rgba(255, 255, 255, 0.69);">&nbsp;&nbsp;Jaya alokamoyoi</span>
            &nbsp;&nbsp;
            <input type="checkbox" name="chk[]" id="c" value="2" onclick="return itemClicked(2)" /><span style="color:rgba(255, 255, 255, 0.69);">&nbsp;&nbsp;Jonaki karngot</span>
            &nbsp;&nbsp;
            <input type="checkbox" name="chk[]" id="c" value="3" onclick="return itemClicked(3)" /><span style="color:rgba(255, 255, 255, 0.69);">&nbsp;&nbsp;Luitare pani</span>
            &nbsp;&nbsp;
            <input type="checkbox" name="chk[]" id="c" value="4" onclick="return itemClicked(4)" /><span style="color:rgba(255, 255, 255, 0.69);">&nbsp;&nbsp;Oo sakhi aji</span>
            <br><br>&nbsp;
            <input type="checkbox" name="chk[]" id="c" value="5" onclick="return itemClicked(5)" /><span style="color:rgba(255, 255, 255, 0.69);">&nbsp;&nbsp;Mor raag</span>
            &nbsp;
            <input type="checkbox" name="chk[]" id="c" value="6" onclick="return itemClicked(6)" /><span style="color:rgba(255, 255, 255, 0.69);">&nbsp;&nbsp;Sata Saki</span>
            &nbsp;
            <input type="checkbox" name="chk[]" id="c" value="7" onclick="return itemClicked(7)" /><span style="color:rgba(255, 255, 255, 0.69);">&nbsp;&nbsp;Seuji seuji</span>
            &nbsp;
            <input type="checkbox" name="chk[]" id="c" value="8" onclick="return itemClicked(8)" /><span style="color:rgba(255, 255, 255, 0.69);">&nbsp;&nbsp;Toi kariba lagiba</span>
            &nbsp;
            <input type="checkbox" name="chk[]" id="c" value="9" onclick="return itemClicked(9)" /><span style="color:rgba(255, 255, 255, 0.69);">&nbsp;&nbsp;Tore more</span>

          </div>
          
          <button type="submit" class="button button-block" name="submit" id="submit">Get Started</button>

          <center><h5 style="color: yellow; letter-spacing: 1px;">Already Registered &nbsp;<a href="login.php">Login</a> </h5></center>
          
          
          </form>

        </div>
  
      
  </div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  <!--   <script src="js/index.js"></script> -->

  <script type="text/javascript">
    function ValidationEvent() {

      //alert("Here");

      var filter = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      var IndNum = /^[0]?[789]\d{9}$/;
      var tex = /^([A-Za-z]+ )+[A-Za-z]+$|^[A-Za-z]+$/;

      var name = document.getElementById("name1").value;
      var email = document.getElementById("email1").value;
      var phone = document.getElementById("phone1").value;

      if (name == '' || email == '' || phone == '') {
          alert('Please fill up the details correctly');
          return false;
      } else if (!(tex.test(name))) {
          alert('Enter name correctly');
          return false;
      } else if(!(filter.test(email))){
          alert("Enter valid email id");
          return false;
      } else if(!(IndNum.test(phone))){
          alert("Enter valid phone no");
          return false;
      } if($('input[name="chk[]"]').is(':checked')){
          //alert('checked');
          return true;
      } else {
          alert('Select at least one song')
          return false;
      }

    }
  </script>

</body>
</html>
