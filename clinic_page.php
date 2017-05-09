<?php session_start();
	require_once 'checkSession.php';
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
    <link rel="stylesheet" type="text/css" href="css/my_style.css">
   
  </head>
   <?php
				
				require_once 'config.php';
				
				$conn = new mysqli($hn, $un, $pw, $db);
				if ($conn->connect_error) die($conn->connect_error);
				$status = $_SESSION['status'];
				$username = $_SESSION['username'];
				$query="select * from $status where username = '$username'";
				$result = $conn->query($query);
				if (!$result) die($conn->error);
				$rows = $result->num_rows;

				for ($j = 0 ; $j < $rows ; ++$j){
					$result->data_seek($j);
					$row = $result->fetch_array(MYSQLI_NUM);
					$_SESSION['userid'] = $row['0'];			
			?>
  <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
<?php include_once "right_menu.php";?>
  	<!--banner-->
	<?php include_once "header.php";?>
	<!--/ banner-->
<!--about-->
	<section id="about" class="section-padding">
		<div class="container">
				<div class="title-doctor">
			        <h2 class="head-title lg-line"></h2>
			    </div>

				<div class="col-md-3 col-sm-4 col-xs-12">
					<img class="doctor-image" src="img/hospital.png"/>
					<div class="doctor-status">
					  <h3 class="doctor-name"> 5.0
					    <img class="doctor-mark" src="img/star.png">
					    <img class="doctor-mark" src="img/star.png">
					    <img class="doctor-mark" src="img/star.png">
					    <img class="doctor-mark" src="img/star.png">
					    <img class="doctor-mark" src="img/star.png">
					  </h3>
				    </div>
			    </div>
			    <div class="col-md-9 col-sm-8 col-xs-12">
			       <div class="col-sm-9 more-features-box">
			          <div class="more-features-box-text">
				            <h3 class="doctor-name"><b>Name: </b><?php echo $row['2'];?></h3>
				            
				        	<hr class="doctor-line">
		
				        	<h3 class="doctor-name"><b>Work place: </b><?php echo $row['7'];?></h3>
				        	<h3 class="doctor-name"><b>Contact: </b><?php echo $row['9'];?></h3>
				        	<h3 class="doctor-name"><b>Email: </b><?php echo $row['3'];?></h3>
                        </div>
			        </div>
			    </div>
			    <div class="col-md-9 col-sm-8 col-xs-12">
			    	<h3 class="doctor-name"><b>Certificates: </b></h3>
			    	<img class="doctor-certificate" src="certificate1.jpg"/>
			    	<img class="doctor-certificate" src="certificate2.jpg"/>
			    	<h3 class="doctor-name"><b>Self Introduction: </b></h3>
			    	<p class="doctor-self-intro">
				<?php echo $row['5']; } ?>
						</p>
			    	
		</div>
	</section>
	<!--/ about-->

	<!--footer-->
	<?php include_once "footer.php;"?>
	<!--/ footer-->
	<script>
	function showOrganization() {
		document.getElementById("doctor").style.display="none";
		document.getElementById("organ").style.display="block";
	}

	function showDoctor() {
		document.getElementById("organ").style.display="none";
		document.getElementById("doctor").style.display="block";
	}

	function doctorsPage() {
		document.getElementById("doctor_page").style.display="block";
	}
	</script>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="contactform/contactform.js"></script>
    
  </body>
</html>


