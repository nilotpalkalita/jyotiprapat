<?php

ob_start();

include "dbconfig.php";

session_start();

if(isset($_SESSION['RandomNo']) && !empty($_SESSION['RandomNo'])) {
   $Random_No = $_SESSION['RandomNo'];
} else {
	$Random_No = 0;
}

$sn_id = $_POST['songid'];

if(isset($_FILES["FileInput"]) && $_FILES["FileInput"]["error"]== UPLOAD_ERR_OK)
{
	############ Edit settings ##############
	$UploadDirectory	= 'upload_files/'; //specify upload directory ends with / (slash)
	##########################################
	
	/*
	Note : You will run into errors or blank page if "memory_limit" or "upload_max_filesize" is set to low in "php.ini". 
	Open "php.ini" file, and search for "memory_limit" or "upload_max_filesize" limit 
	and set them adequately, also check "post_max_size".
	*/
	
	//check if this is an ajax request
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		die();
	}
	
	
	//Is file size is less than allowed size.
	if ($_FILES["FileInput"]["size"] > 524288000) {
		die("File size is too big!");
	}
	
	//allowed file type Server side check
	switch(strtolower($_FILES['FileInput']['type']))
		{
			//allowed file types
            /*case 'image/png': 
			case 'image/gif': 
			case 'image/jpeg': 
			case 'image/pjpeg':
			case 'text/plain':
			case 'text/html': //html file
			case 'application/x-zip-compressed':
			case 'application/pdf':
			case 'application/msword':
			case 'application/vnd.ms-excel':*/
			case 'video/mp4':
				break;
			default:
				die('Unsupported File!'); //output error
	}
	
	$File_Name          = strtolower($_FILES['FileInput']['name']);
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
	$Random_Number      = $Random_No;		//rand(0, 9999999999); //Random number to be added to name.
	$song_ran			= 'SongNo'.$sn_id.'_'.$Random_Number;
	$NewFileName 		= $song_ran.$File_Ext; //new file name
	
	if(move_uploaded_file($_FILES['FileInput']['tmp_name'], $UploadDirectory.$NewFileName ))
	   {

	   	$sql = "UPDATE upload_list SET file_name='$NewFileName' WHERE reg_no=$Random_No and song_id = $sn_id";

	   	//$sql = "INSERT INTO video_up(reg_no, person_name, email_id, contact, song, file_name) VALUES($Random_Number, 'user_name', 'user_dob', 'user_gen', 'user_rel', '$NewFileName')";
	   	$stmt = $conn->prepare($sql);
	   	$result = $stmt->execute();

		die('Success! File Uploaded. <b>Redirecting to home page...</b>');
	}else{
		die('error uploading File!');
	}
	
}
else
{
	die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
}