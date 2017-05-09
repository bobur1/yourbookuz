<?php session_start;
require_once("config.php");
	$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);


if (isset($_POST['err'])){
	$error_message = $_POST['err'];
}
if(!empty($_POST["register-user"])) {
	/* Form Required Field Validation */
	foreach($_POST as $key=>$value) {
if(empty($_POST[$key])) {
$error_message = "All Fields are required";
break;
}
}
/* Password Matching Validation */
if($_POST['password'] != $_POST['confirm_password']){
$error_message = 'Passwords should be same<br>';
}
/*Gender Validation*/
if(!$_POST['gender']){
$error_message = 'You should identify your gender<br>';
}
/* Email Validation */
if(!isset($error_message)) {
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
$error_message = "Invalid Email Address";
}
}

if(!isset($error_message)) {
//include("dbcontroller.php");
if ($status == "doctor"){
$specialization =  $_POST['specialization'];
$bio =  $_POST['details'];
}
$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$username = $_POST['username'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$birthday = $_POST['birthday'];
	$salt1    = "qm&h*";
	$salt2   = "pg!@";
	$pass = $_POST['password'];
$pass = hash('ripemd128', "$salt1$pass$salt2");
$region = $_POST['regions_name'];
$tel = $_POST['tel'];
$address= $_POST['address'];
//$link = Connection();

//echo "STATUS -> ".$_GET["status"] . "  ". $status;
//$query = "INSERT INTO patient (first_name, last_name, username, pwd, email, gender, birthday, contact, address) VALUES ( '".$first_name."',".$last_name."',  '".$username."','".$pass."', '".$email."', '".$gender."', '".$birthday."', '111', 'SLC')";
//mysqli_query($link, $query);
//mysqli_close($link);
//header("Location: ../index.php");
//if(!empty($link)) {
//$error_message = "";
//$success_message = "You have registered successfully!";

$query = "INSERT INTO patient (id,username, first_name, last_name, pwd, email, gender, birthday, contact, address, region) VALUES (default,'$username','$fname','$lname','$pass','$email','$gender','$birthday','$tel','$address', '$region')";




		 $result = $conn->query($query);

		 $query1 = "Select * from doctor where username = '$username'";
		$result1 = $conn->query($query1);
  //if (!$result) die ("Database access failed: " . $conn->error);
  if (!$result or !$result1) {
  $_POST["err"]  = "Such user with the same name = '".$username."' exist!<br>Please, choose another username";
	  //header("Location: index.php"); /* Redirect browser To Error page */
	
	
	  }
  
  if($result){ //$header("Location: ../index.php");
  echo "New $status added to the database successfully.";}
unset($_POST);
//} else {
//$error_message = "Problem in registration. Try Again!";
//}
}
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
  <body onbeforeunload="return UploadPage()" id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    <div class="fixed_nav_2">
      <ul class="fixed_nav_list">
        <li>
          <a href="index.html"><img class="menu_bar_icon" src="img/Menu_white/Home.png">
          <h5 class="menu_bar_text">Home</h5></a>
        </li>
        <li>
          <a href="search_advanced.html"><img class="menu_bar_icon" src="img/Menu_white/Search.png">
          <h5 class="menu_bar_text">Advanced <br>Search</h5></a>
        </li>
        <li>
          <a href="booking.html"><img class="menu_bar_icon" src="img/Menu_white/Booking.png">
          <h5 class="menu_bar_text">Booking</h5></a>
        </li>
        <li>
          <a href="sign_in.html"><img class="menu_bar_icon" src="img/Menu_white/Registration.png">
          <h5 class="menu_bar_text">Registration</h5></a>
        </li>
        <li>
          <a href="#news"><img class="menu_bar_icon" src="img/Menu_white/News.png">
          <h5 class="menu_bar_text">News</h5></a>
        </li>
        <li>
          <a href="login.html"><img class="menu_bar_icon" src="img/Menu_white/Admin.png">
          <h5 class="menu_bar_text">Admin</h5></a>
        </li>
      </ul>
    </div>
  	<!--banner-->
	<section id="banner-2a" class="banner">
		<div class="bg-color-2a">
			<div class="container">
				<div class="row">
					<div class="banner-info">
						<div class="banner-text text-center">
							<h1 class="white">Sign Up</h1>
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


<!--Sign up main-->
      <div id="sign_up" style="display:block" class="col-md-6 right-side">
        <ul class="sign-up-list">
          <p class="paragraph">Sign up as</p>
          <li><button class="sign-up-button" onclick="Specialist()">Specialist</button></li>
          <li class="active_page"><button class="sign-up-button" onclick="Clinic()">Clinic</button></li>
          <li><button class="sign-up-button" onclick="Patient()">Patient</button></li>
        </ul>
    </div>

<!--Sign up as clinic-->
<form name="frmRegistration" method="post" action="">
    <div id="sign_up_clinic" style="display:none" class="col-md-6 right-side">
      	<button class="goto-button" onclick="GoToMain()">Go Back</button>
    	<p class="paragraph">Sign up as <b>Clinic</b></p>
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="name"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="name">
            <span class="input__label-content input__label-content--hoshi">Name</span>
          </label>
        </span>
        
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="password"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password">
            <span class="input__label-content input__label-content--hoshi">Password</span>
          </label>
        </span>
        
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="email" />
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="email">
            <span class="input__label-content input__label-content--hoshi">E-mail</span>
          </label>
        </span>

        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="number" id="phone" />
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="phone">
            <span class="input__label-content input__label-content--hoshi">Phone</span>
          </label>
        </span>

        <span class="input input--hoshi">
          <label class="input_title" for="country">Region</label>
          <br>
          <select name="regions_name" class="input_select" id="country">
            <option value=""><span class="choice"></span></option>
            <?php
			require_once("config.php");
			
			$conn = new mysqli($hn, $un, $pw, $db);
			if ($conn->connect_error) die($conn->connect_error);
			
			$query="select * from regions";
				$result = $conn->query($query);
				if (!$result) die($conn->error);

			while ($row = $result->fetch_assoc()) {
                  		unset($regions_name);
                  		$name = $row['regions_name']; 
 	                        echo '<option value='.$name.'>'.$name.'</option>';
			}
		?>
          </select>
        </span>

        

         <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="address"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="address">
            <span class="input__label-content input__label-content--hoshi">Address</span>
          </label>
        </span>

        <span class="input input--hoshi">
              <h3 class="doctor-name2"><b>Self Introduction: </b></h3>
              <textarea class="doctor-textarea"></textarea>
          
        </span>

        <div class="cta">
          <button class="btn btn-primary pull-left">
            Sign-Up
          </button>
        </div>
      </div>
</form>
<form name="frmRegistration" method="post" action="">
<!--Sign up as patient-->
      <div id="sign_up_patient" style="display:none" class="col-md-6 right-side">
      	<button class="goto-button" onclick="GoToMain()">Go Back</button>
      	<?php if(!empty($error_message)) { ?>
                <div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
            <?php } ?>
		<p class="paragraph">Sign up as <b>Patient</b></p>
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="firstname" name ="first_name" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name']; ?>"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="firstname">
            <span class="input__label-content input__label-content--hoshi">First Name</span>
          </label>
        </span>
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="lastname" name ="last_name"  value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name']; ?>" />
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="lastname">
            <span class="input__label-content input__label-content--hoshi">Last Name</span>
          </label>
        </span>
		<span class="input input--hoshi">
		 
      
			
             Birthday<input class="input__field input__field--hoshi" type="date" id="name" name ="birthday"  value="<?php if(isset($_POST['birthday'])) echo $_POST['birthday']; ?>" />
         <label class="input__label input__label--hoshi input__label--hoshi-color-4" for="name">
		 </label>
        </span>
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="username"  name ="username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="username">
            <span class="input__label-content input__label-content--hoshi">User Name</span>
          </label>
        </span>
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="password" id="password" name="password"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password">
            <span class="input__label-content input__label-content--hoshi">Password</span>
          </label>
        </span>
<span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="password" id="password" name="confirm_password"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password">
              <span class="input__label-content input__label-content--hoshi">Confirm Password</span>
          </label>
        </span>
        <span class="input input--hoshi">
          <label class="input_title" for="insurance" >Gender</label>
          <br>
          <select class="input_select" id="insurance" name = "gender">
            <option    value="Male">Male</option>
            <option  value="Female">Female</option>
          </select>
        </span>
        
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="email" name ="email"  value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" />
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="email">
            <span class="input__label-content input__label-content--hoshi">E-mail</span>
          </label>
        </span>


        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="number" id="phone" name="tel" value="<?php if(isset($_POST['tel'])) echo $_POST['tel']; ?>"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="phone">
            <span class="input__label-content input__label-content--hoshi">Phone</span>
          </label>
        </span>

         <span class="input input--hoshi">
          <label class="input_title" for="country">Region</label>
          <br>
          <select name="regions_name" class="input_select" id="country" >
            <option value="<?php if(isset($_POST['regions_name'])) echo $_POST['regions_name']; ?>"><?php echo $_POST['regions_name'];?></option>
            <?php
			require_once("config.php");
			
			$conn = new mysqli($hn, $un, $pw, $db);
			if ($conn->connect_error) die($conn->connect_error);
			
			$query="select * from regions";
				$result = $conn->query($query);
				if (!$result) die($conn->error);

			while ($row = $result->fetch_assoc()) {
                  		unset($regions_name);
                  		$name = $row['regions_name']; 
 	                        echo '<option value='.$name.'>'.$name.'</option>';
			}
		?>
          </select>
        </span>

        

         <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="address" name= "address" value ="<?php if(isset($_POST['address'])) echo $_POST['address']; ?>"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="address">
            <span class="input__label-content input__label-content--hoshi">Address</span>
          </label>
        </span>

         <div class="cta">
            <input type="submit" name="register-user" value="Register"  class="btn btn-primary pull-left">

          
        </div>
      </div>

</form>
<form name="frmRegistration" method="post" action="">
<!--Sign up as specialist-->
      <div id="sign_up_specialist" style="display:none" class="col-md-6 right-side">
      	<button class="goto-button" onclick="GoToMain()">Go Back</button>
      	<p class="paragraph">Sign up as <b>Specialist</b></p>
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="firstname"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="firstname">
            <span class="input__label-content input__label-content--hoshi">First Name</span>
          </label>
        </span>
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="lastname"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="lastname">
            <span class="input__label-content input__label-content--hoshi">Last Name</span>
          </label>
        </span>
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="username"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="username">
            <span class="input__label-content input__label-content--hoshi">User Name</span>
          </label>
        </span>
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="password"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password">
            <span class="input__label-content input__label-content--hoshi">Password</span>
          </label>
        </span>
        
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="email" />
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="email">
            <span class="input__label-content input__label-content--hoshi">E-mail</span>
          </label>
        </span>

        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="number" id="phone" />
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="phone">
            <span class="input__label-content input__label-content--hoshi">Phone</span>
          </label>
        </span>
        
        <span class="input input--hoshi">
          <label class="input_title" for="insurance">Specilization</label>
          <br>
          <select class="input_select" id="insurance">
            <option value="a"><span class="choice"></span></option>
            <option value="a"><span class="choice">Type 1</span></option>
            <option value="b"><span class="choice">Type 2</span></option>
            <option value="c"><span class="choice">Type 3</span></option>
          </select>
        </span>

        <span class="input input--hoshi">
          <label class="input_title" for="country">Region</label>
          <br>
          <select name="regions_name" class="input_select" id="country">
            <option value="a"><span class="choice"></span></option>
            <?php
			require_once("config.php");
			
			$conn = new mysqli($hn, $un, $pw, $db);
			if ($conn->connect_error) die($conn->connect_error);
			
			$query="select * from regions";
				$result = $conn->query($query);
				if (!$result) die($conn->error);

			while ($row = $result->fetch_assoc()) {
                  		unset($regions_name);
                  		$name = $row['regions_name']; 
 	                        echo '<option value='.$name.'>'.$name.'</option>';
			}
		?>
          </select>
        </span>
        

         <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="address"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="address">
            <span class="input__label-content input__label-content--hoshi">Work place</span>
          </label>
        </span>

        <span class="input input--hoshi">
              <h3 class="doctor-name2"><b>Self Introduction: </b></h3>
              <textarea class="doctor-textarea"></textarea>
        </span>
        <div class="cta">
          <button class="btn btn-primary pull-left">
            Sign-Up
          </button>
        </div>
      </div>
</form>

      <div id="left_side_intro" style="display:block" class="col-md-6 left-side">
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
	<footer id="footer">
		<div class="top-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-4 marb20">
							<div class="ftr-tle">
								<h4 class="white no-padding">About Us</h4>
							</div>
							<div class="info-sec">
								<p>To provide a comfort to users to find a doctor which they need, find their place of work, to know more about their background.</p>
							</div>
					</div>
					<div class="col-md-4 col-sm-4 margin-tob20">
						<div class="ftr-tle">
							<h4 class="white no-padding">Quick Links</h4>
						</div>
						<div class="info-sec">
							<ul class="quick-info">
								<li><a href="index.html"><i class="fa fa-circle"></i>Home</a></li>
								<li><a href="#service"><i class="fa fa-circle"></i>Service</a></li>
								<li><a href="#contact"><i class="fa fa-circle"></i>Appointment</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 marb20">
						<div class="ftr-tle">
							<h4 class="white no-padding">Follow us</h4>
						</div>
						<div class="info-sec">
							<ul class="social-icon">
								<li class="bglight-blue"><i class="fa fa-facebook"></i></li>
								<li class="bgdark-blue"><i class="fa fa-linkedin"></i></li>
						
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-line">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						© All Rights Reserved
                        <div class="credits">
                            
                            Designed by <a href="https://inha.uz/en/">IOTech team</a>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!--/ footer-->
	<script>
	function Clinic() {
		document.getElementById("sign_up").style.display="none";
		document.getElementById("sign_up_patient").style.display="none";
		document.getElementById("sign_up_specialist").style.display="none";
		document.getElementById("sign_up_clinic").style.display="block";
    document.getElementById("left_side_intro").style.display="none";
	}

	function Patient() {
		document.getElementById("sign_up").style.display="none";
		document.getElementById("sign_up_clinic").style.display="none";
		document.getElementById("sign_up_specialist").style.display="none";
		document.getElementById("sign_up_patient").style.display="block";
    document.getElementById("left_side_intro").style.display="none";
	}

	function Specialist() {
		document.getElementById("sign_up").style.display="none";
		document.getElementById("sign_up_clinic").style.display="none";
		document.getElementById("sign_up_patient").style.display="none";
		document.getElementById("sign_up_specialist").style.display="block";
    document.getElementById("left_side_intro").style.display="none";
	}

	
	</script>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="contactform/contactform.js"></script>
    
  </body>
</html>