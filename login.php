<?php require_once 'config.php';
	session_start();
	
	
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	
	if (isset ($_SESSION['admin'])){
	$password = $_SESSION['admin_pass'];
	//echo $status."- status<br>";
	$query="select * from {$_SESSION[admin]} where username = '{$_SESSION[admin]}' and pwd = '{$_SESSION[admin_password]}'";
	$result = $conn->query($query);
	if ($result){
		$link = "Location:admin/index.php";
		header ($link);
		}
		
	}
	if (isset($_POST['submit'])) {
	$username= $_POST['username'];
	$password = $_POST['password'];
		
		$query = "SELECT * FROM admin where username='$username'";
		$result = $conn->query($query);
	if(!$result) $error_message="Your Login Name or Password is invalid";
	else if($result->num_rows){
		$row = $result->fetch_array(MYSQLI_NUM);
		$correct_pw = $row['7'];
		$username=$row['0'];
		$result->close();
	
		
			if($password == $correct_pw){
			
			$_SESSION['admin'] = $username;
			$_SESSION['admin_password'] = $correct_pw;
			
			
			header ("Location: admin/index.php");
		}else{
			echo "Your Password is invalid";
			
		}		
	}else{
		$error_now = "User does not exist!<br>";
	}	
		
	}

$conn->close();


function mysql_entities_fix_string($conn, $string){
	return htmlentities(mysql_fix_string($conn, $string));
}

function mysql_fix_string($conn, $string){
	if(get_magic_quotes_gpc()) $string = stripslashes($string);
	return $conn->real_escape_string($string);
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <link href="css/login_style.css" rel="stylesheet" type="text/css"/>
  
  </head>

<body>
		
		<div class="header">
			<div>Log <span>In</span></div>
		</div>
		<br>
		
		<div class="login">
		<form method = "post" action = "">
				<?php if ($error_message){echo $error_message;}?>
				<input type="text" placeholder="username" name="username"><br>
				<input type="password" placeholder="password" name="password"><br>
				<input type="submit" name ="submit" value="OK">
			</form>	
		</div>
		
</body>

</html>