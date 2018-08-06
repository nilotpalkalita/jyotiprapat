<?php

 ob_start();
 session_start();

 $sn_id = $_GET['id'];

 if (!isset($_SESSION['mail']) || $_SESSION['mail'] == '') {
    header("location:../logout.php");
  } /*elseif (!isset($_SESSION['file']) || !empty($_SESSION['file'])) {
  	header("location:../home.php");
  }*/

?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ajax File Upload with jQuery and PHP - Demo</title>
<script type="text/javascript" src="includes/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="includes/js/jquery.form.min.js"></script>

<script type="text/javascript">
$(document).ready(function() { 
	var options = { 
			target:   '#output',   // target element(s) to be updated with server response 
			beforeSubmit:  beforeSubmit,  // pre-submit callback 
			success:       afterSuccess,  // post-submit callback 
			uploadProgress: OnProgress, //upload progress callback 
			resetForm: true        // reset the form after successful submit 
		}; 
		
	 $('#MyUploadForm').submit(function() { 
			$(this).ajaxSubmit(options);  			
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}); 
		

//function after succesful file upload (when server response)
function afterSuccess()
{
	$('#submit-btn').show(); //hide submit button
	$('#loading-img').hide(); //hide submit button
	$('#wait-plz').hide();
	$('#progressbox').delay( 1000 ).fadeOut(); //hide progress bar

}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		
		if( !$('#FileInput').val()) //check empty input filed
		{
			$("#output").html("<b style='color:yellow;'>Please select a valid video file</b>");
			return false
		}
		
		var fsize = $('#FileInput')[0].files[0].size; //get file size
		var ftype = $('#FileInput')[0].files[0].type; // get file type
		

		//allow file types 
		switch(ftype)
        {
            /*case 'image/png': 
			case 'image/gif': 
			case 'image/jpeg': 
			case 'image/pjpeg':
			case 'text/plain':
			case 'text/html':
			case 'application/x-zip-compressed':
			case 'application/pdf':
			case 'application/msword':
			case 'application/vnd.ms-excel':*/
			case 'video/mp4':
                break;
            default:
                $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
				return false
        }
		
		//Allowed file size is less than 5 MB (1048576)
		if(fsize>524288000) 
		{
			$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big file! <br />File is too big, it should be less than 500 MB.");
			return false
		}
				
		$('#submit-btn').hide(); //hide submit button
		$('#loading-img').show(); //hide submit button
		$('#wait-plz').show();
		$("#output").html("");  
	}
	else
	{
		//Output error to older unsupported browsers that doesn't support HTML5 File API
		$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
		return false;
	}
}

//progress bar function
function OnProgress(event, position, total, percentComplete)
{
    //Progress bar
	$('#progressbox').show();
    $('#progressbar').width(percentComplete + '%') //update progressbar percent complete
    $('#statustxt').html(percentComplete + '%'); //update status text
    if(percentComplete>50)
        {
            $('#statustxt').css('color','#000'); //change status text to white after 50%
        }
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

}); 

</script>
<link href="includes/style/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="upload-wrapper">
<div align="center">
<h3>Upload Your Video Here (only mp4 format)</h3>
<form action="processupload.php" method="post" enctype="multipart/form-data" id="MyUploadForm">
<input name="FileInput" id="FileInput" placeholder="only mp4 format support" type="file" />

<input type="hidden" name="songid" value="<?php echo $sn_id ;?>">

<input type="submit"  id="submit-btn" value="Upload" />
<img src="includes/images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
<span id="wait-plz" style="display:none;">Please wait...</span>
</form>
<div id="progressbox" ><div id="progressbar"></div ><div id="statustxt">0%</div></div>
<div id="output"></div>
</div>
	<div align="right">
		<!-- <a href="../logout.php" id="myButton">Logout</a> -->
		<input type="button" id="myButton" value="CLOSE" onclick="self.close()">
	</div>
</div>

<style type="text/css">
    #myButton {
      margin-top: 8%;
  background-color:#3D91A2;
  -moz-border-radius:8px;
  -webkit-border-radius:8px;
  border-radius:8px;
  width: 10%;
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

</body>
</html>