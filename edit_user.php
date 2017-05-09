<?php session_start();

require_once("config.php");
	$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
$status = $_SESSION["status"];
$username = $_SESSION['username'];
if ($status !="doctor" and $status !="patient" and $status !="clinic"){
	header ("Location: index.php");
}
/*Info from db*/
$row = array("");

	$query="select * from $status where username = '$username'";
				$result = $conn->query($query);
				if (!$result) die($conn->error);
				
				$row = $result->fetch_assoc();
				
    
			

if ($status == "doctor"){
	$checkname1=mysqli_query( $conn,"SELECT * FROM doctor WHERE username='$username'");
	while ($info = $checkname1->fetch_assoc()) {}
	}
if ($status == "clinic")
{$checkname1=mysqli_query( $conn,"SELECT * FROM clinic WHERE username='$username'");
while ($info = $checkname1->fetch_assoc()) {}
	}
	// error
if (isset($_POST['err'])){
	$error_message = $_POST['err'];
}

if(!empty($_POST["submit"])) {
	/* Form Required Field Validation */
	foreach($_POST as $key=>$value) {
if(empty($_POST[$key])) {
$error_message = "All Fields are required";
break;
}
}
/* Password Matching Validation */
if($_POST['password'] != $_POST['confirm_password']){
$error_message = 'Passwords should be the same<br>';
}
if(!$_POST['gender'] && $status !="clinic"){
$error_message = 'You should identify your gender<br>';
}

/* Email Validation */
if(!isset($error_message)) {
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
$error_message = "Invalid Email Address";
}
}

if($error_massage<1) {
//include("dbcontroller.php");
if ($status == "doctor"){
$specialization =  $_POST['specialization'];

}
$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$username = $_SESSION['username'];
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
$bio =  $_POST['bio']; 



//$link = Connection();

//echo "STATUS -> ".$_GET["status"] . "  ". $status;
//$query = "INSERT INTO patient (first_name, last_name, username, pwd, email, gender, birthday, contact, address) VALUES ( '".$first_name."',".$last_name."',  '".$username."','".$pass."', '".$email."', '".$gender."', '".$birthday."', '111', 'SLC')";
//mysqli_query($link, $query);
//mysqli_close($link);
//header("Location: ../index.php");
//if(!empty($link)) {
//$error_message = "";
//$success_message = "You have registered successfully!";

if ($status == "patient"){
$query = "UPDATE {$status} SET first_name = '{$fname}', last_name = '{$lname}', pwd = '{$pass}', email = '{$email}', gender = '{$gender}', birthday= '{$birthday}', contact = '{$tel}', address= '{$address}', region = = '{$region}' WHERE username = {$username}";
}
if ($status == "doctor"){
$query = "UPDATE {$status} SET first_name = '{$fname}', last_name = '{$lname}', pwd = '{$pass}', email = '{$email}', gender = '{$gender}', birthday= '{$birthday}', contact = '{$tel}', address= '{$address}', region = = '{$region}', bio = {$bio}, specialization = {$specialization}  WHERE username = {$username})";
}
if ($status == "clinic"){
$query = "UPDATE {$status} SET first_name = '{$fname}', pwd = '{$pass}', email = '{$email}', contact = '{$tel}', address= '{$address}', region = = '{$region}', bio = {$bio}, WHERE username = {$username})";
}

		 $result = $conn->query($query);
		 
  //if (!$result) die ("Database access failed: " . $conn->error);
  
  
  if($result){ //$header("Location: ../index.php");
  $success = "New $status added to the database successfully.";}
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
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/signUp.css">
    <link rel="stylesheet" type="text/css" href="../css/my_style.css">
   
  </head>
  <body onbeforeunload="return UploadPage()" id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    <?php include_once "right_menu.php";?>
  	<!--banner-->
	<section id="banner-2a" class="banner">
		<div class="bg-color-2a">
			<div class="container">
				<div class="row">
					<div class="banner-info">
						<div class="banner-text text-center">
							<h1 class="white"><?php echo "Edit ".$row['first_name']." ".$row["last_name"];?></h1>
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


  <div class="container-fluid">
    <div class="row">
      <div id="left_side_intro" style="display:block" class="col-md-6 left-side">
        
      </div>
      <div class="col-md-6 right-side">
<form name="frmRegistration" method="post" action="">
        <ul class="social list-inline">
		<?php if (isset ($success))echo $success;?>
		<?php if(!empty($success_message)) { ?>
                <div style ="width: 200px;   background: #ccc;
    padding: 5px;
    padding-right: 20px; 
    border: solid 1px black; 
    float: left;" class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
            <?php } ?>
            <?php if(!empty($error_message)) { ?>
                <div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
            <?php } ?>
          <p class="paragraph">Edit your profile</p>
           
            
        </ul>
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="name" name ="first_name" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name']; else echo $row['first_name']?>"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="name">
            <span class="input__label-content input__label-content--hoshi"><?php if($status == "clinic") echo "Clinic name"; else { ?>First name <?php  } ?></span>
          </label>
        </span>
		<?if ($status !="clinic") { ?>
		<span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="name" name ="last_name" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name']; else echo $row['last_name']?>"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="name">
            <span class="input__label-content input__label-content--hoshi">Last name</span>
          </label>
        </span>
		
		 <span class="input input--hoshi">
		 
      
			
             Birthday<input class="input__field input__field--hoshi" type="date" id="name" name ="birthday"  value="<?php if(isset($_POST['birthday'])) echo $_POST['birthday']; else echo $row['birthday']?>" />
         <label class="input__label input__label--hoshi input__label--hoshi-color-4" for="name">
		 </label>
        </span>
          <span class="input input--hoshi">
          <label class="input_title" for="insurance" >Gender</label>
          <br>
          <select class="input_select" id="insurance" name = "gender">
		  <option    value="<?php echo $row['gender']?>"><?php echo $row['gender']?></option>
            <option    value="Male">Male</option>
            <option  value="Female">Female</option>
          </select>
        </span>
		 <?php } ?>
       <?php if ($status == "doctor") {?>
        <span class="input input--hoshi">
		
		
		<select name="specialization"  class="input_select" required> 
		<option value=""> Select Specialization </option>
		<?php
			require_once("../config.php");
			
			$conn = new mysqli($hn, $un, $pw, $db);
			if ($conn->connect_error) die($conn->connect_error);
			
			$query="select * from doctor_specialty";
				$result = $conn->query($query);
				if (!$result) die($conn->error);
			echo '<option value='.$row['specialization'].'>'.$row['specialization'].'</option>';
			while ($row = $result->fetch_assoc()) {
                  		unset($specialty);
                  		$name = $row['specialty']; 
 	                        echo '<option value='.$name.'>'.$name.'</option>';
			}
	   }
		?>
		    </span>
            <span class="input__label-content input__label-content--hoshi">Select specialization</span>
          
        </span>
	  
		</select>		
          <span class="input input--hoshi">
          <label class="input_title" for="country">Region</label>
          <br>
          <select name="regions_name" class="input_select" id="country">
            
            <?php
			require_once("config.php");
			
			$conn = new mysqli($hn, $un, $pw, $db);
			if ($conn->connect_error) die($conn->connect_error);
			
			$query="select * from regions";
				$result = $conn->query($query);
				if (!$result) die($conn->error);
			echo '<option value='.$row['region'].'>'.$row['region'].'</option>';
			while ($row = $result->fetch_assoc()) {
                  		unset($regions_name);
                  		$name = $row['regions_name']; 
 	                        echo '<option value='.$name.'>'.$name.'</option>';
			}
		?>
          </select>
    
		<span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="name1" name ="address" value="<?php if(isset($_POST['address'])) echo $_POST['address']; else echo $row['address']?>"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="name">
            <span class="input__label-content input__label-content--hoshi">Address</span>
          </label>
        </span>
	
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="email " name ="email"  value="<?php if(isset($_POST['email'])) echo $_POST['email']; else echo $row['email']?>" />
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="email">
            <span class="input__label-content input__label-content--hoshi">E-mail</span>
          </label>
        </span>
		<span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="number" id="phone" name="tel" value="<?php if(isset($_POST['tel'])) echo $_POST['tel']; else echo $row['contact']?>"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="phone">
            <span class="input__label-content input__label-content--hoshi">Phone</span>
          </label>
        </span>
		
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="password" id="password" name="password" />
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
        </span>
		<?php if($status == "doctor" or $status =="clinic"){ ?>
		 <span class="input input--hoshi">
              <h3 class="doctor-name2"><b>Self Introduction: </b></h3>
              <textarea name ="bio" class="doctor-textarea"><?if (isset($_POST['bio']))echo $_POST['bio'];else echo $row['bio']?></textarea>
        </span>
<?php } ?>
		
			
        <div class="cta">
            <input type="submit" name="submit" value="submit"  class="btn btn-primary pull-left">

          
        </div>
        </form>
      </div>
    </div>
  </div>

</div> <!-- end #main-wrapper -->


	</div><!--End of row-->
</div>
</section>
	<!--/ service-->

	<!--footer-->
	<footer id="footer">
		<div class="top-footer">
			<div class="container">
				<div class="row">
				
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
<!-- Scripts -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="js/scripts.js"></script>
<script src="js/classie.js"></script>
<script>
	
  (function() {
    if (!String.prototype.trim) {
      (function() {
        // Make sure we trim BOM and NBSP
        var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
        String.prototype.trim = function() {
          return this.replace(rtrim, '');
        };
      })();
    }

    [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
      // in case the input is already filled..
      if( inputEl.value.trim() !== '' ) {
        classie.add( inputEl.parentNode, 'input--filled' );
      }

      // events:
      inputEl.addEventListener( 'focus', onInputFocus );
      inputEl.addEventListener( 'blur', onInputBlur );
    } );

    function onInputFocus( ev ) {
      classie.add( ev.target.parentNode, 'input--filled' );
    }

    function onInputBlur( ev ) {
      if( ev.target.value.trim() === '' ) {
        classie.remove( ev.target.parentNode, 'input--filled' );
      }
    }
  })();
</script>
<script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.easing.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/custom.js"></script>
    <script src="../contactform/contactform.js"></script>
    
  </body>
</html>