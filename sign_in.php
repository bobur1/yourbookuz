<?php require_once 'config.php';
	session_start();
	
	
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$status = "";
	if (isset ($_SESSION['username'])){
	$status = $_SESSION['status'];
	//echo $status."- status<br>";
	$query="select * from {$_SESSION[status]} where username = '{$_SESSION[username]}' and pwd = '{$_SESSION[password]}'";
	$result = $conn->query($query);
	if ($result){
		$link = "Location: ".$status."_page.php";
		header ($link);
		}
		else {
			$status = "";
			}
	}
	if (isset($_POST['username']) && isset($_POST['password'])) {
	$username= $_POST['username'];
	$password = $_POST['password'];
		$checkname2=mysqli_query( $conn,"SELECT * FROM doctor WHERE username='{$username}'");
if (mysqli_num_rows($checkname2)!=0) 
		{
			$status .= "doctor";
		}
		$checkname1=mysqli_query( $conn,"SELECT * FROM patient WHERE username='$username'");
if (mysqli_num_rows($checkname1)!=0) 
		{
			$status .= "patient";
		}

$checkname3=mysqli_query( $conn,"SELECT * FROM clinic WHERE username='$username'");
if (mysqli_num_rows($checkname3)!=0) 
		{
			$status .= "clinic";
		}
	
		$un_temp = mysql_entities_fix_string($conn, $_POST['username']);
		$pw_temp = mysql_entities_fix_string($conn, $_POST['password']);
		$query = "SELECT * FROM $status where username='$un_temp'";
		
		$result = $conn->query($query);
	if(!$result) $error_message="Your Login Name or Password is invalid";
	elseif($result->num_rows){
		$row = $result->fetch_array(MYSQLI_NUM);
		$correct_pw = $row['4'];
		
		$username=$row['1'];
		$result->close();
	
		$salt1 = 'qm&h*';
		$salt2 = 'pg!@';
		$token = hash('ripemd128', "$salt1$pw_temp$salt2" );
		
			if($token == $correct_pw){
			$_SESSION['status'] = $status;
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $correct_pw;
			
			$link = "Location: ".$status."_page.php";
			header ($link);
		}else{
			$error_message = "Your Password is invalid";
			
		}		
	}else{
		$error_now = "User does not exist!<br>";
		echo "Status - $status";
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
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YouBook</title>
    <meta name="description" content="Medical booking platform">
    <meta name="keywords" content="YouBook, Medical booking, Doctors booking">
    
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/signUp.css">
    <link rel="stylesheet" type="text/css" href="css/my_style.css">
   
  </head>
  <?php include_once "right_menu.php";?>
  	<!--banner-->
	<section id="banner-2a" class="banner">
		<div class="bg-color-2a">
			<div class="container">
				<div class="row">
				<?php if (isset($error_now)) echo $error_now;?>
					<div class="banner-info">
						<div class="banner-text text-center">
							<h1 class="white">Sign In</h1>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/ banner-->
	<!--service-->
	<section id="service" class="section-padding">
		<div class="container">
			<div class="row">


<!--Sign In-->
 <form name="frmSign-in" method="post" action="">
    <div id="sign_up_clinic" class="col-md-6 right-side">
      <p class="paragraph">Sign-In</p>
        <span class="input input--hoshi">
		<?php if($error_message) echo $error_message;?>
          <input class="input__field input__field--hoshi" type="text" id="name" name = "username" />
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="name">
            <span class="input__label-content input__label-content--hoshi">Username</span>
          </label>
        </span>
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="password" id="password" name = "password"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password">
            <span class="input__label-content input__label-content--hoshi">Password</span>
          </label>
        </span>
         <div class="cta">
            <input type="submit" name="register-user" value="Sign-In"  class="btn btn-primary pull-left">

          </form>
        </div>
        <div class="sign_up_block">
          <p class="sign_up_inline paragraph">Not registered yet?</p>
          <a class="sign_up_inline sign_up_link" href="registration/index.php">Sign-Up</a>
        </div>
        
      </div>


	<div class="col-md-6 left-side left-side_clinic">
        <header>
          
          <h3>Welcome!</h3>

          <div class="textBorder">
            <p>
              This is for some text...
              Having a great idea, and assembling a team to bring that concept to life is the first step in creating a successful business venture. While finding a new and unique idea is rare enough; the ability to successfully execute this idea is what separates the dreamers from the entrepreneurs. However you see yourself, whatever your age may be, as soon as you make that exciting first hire, you have taken the first steps in becoming a powerful leader. Take a breath, calm yourself down, and remind yourself of the leader you are and would like to become. Here are some key qualities that every good leader should possess, and learn to emphasize. Honesty. Whatever ethical plane you hold yourself to, when you are responsible for a team of people, its important to raise the bar even higher. <b>(This text is visible till the end!)</b>
            </p>
          </div>
        </header>
      </div>

	</div><!--End of row-->
</div>
</section>
	<!--/ service-->

	<!--footer-->
	<?php include_once "footer.php";?>
	<!--/ footer-->
	  
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="contactform/contactform.js"></script>
    
  </body>
</html>