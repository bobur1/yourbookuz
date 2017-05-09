<?php session_start();
	session_destroy();
   $token = '';
   header("Location: index.php");
   
?>