<?php
$host = "localhost";
$user = "root";
$password = "root";
$db_name = "chat";

$db = new mysqli($host, $user, $password, $db_name);

function formatData($data)
{
	return date('g:i a', strtotime($data));
}
?>