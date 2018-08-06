<?php
ob_start();
session_start();
//session_unset();
if(session_destroy())
{
header("Location: login.php");
}

?>