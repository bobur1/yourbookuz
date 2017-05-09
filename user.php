<?php session_start();
	include_once "calendar/calendar.php";
if ((isset($_GET['user'])) and (isset($_GET['status']))){ //clode it
require_once("config.php");
	$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
$status = $_GET["status"];
$username = $_GET['user'];
if ($status != "doctor" && $status != "clinic" && $status !="patinet")
	$error_message = "Not Funny";
$_POST["status"]=$status;
$_POST["user"]= $username;
$_SESSION["doc"]= $username;

$checkname=mysqli_query( $conn,"SELECT * FROM $status WHERE username='$username'");
if (mysqli_num_rows($checkname)==0) 
		{
			$error_message= "Such username = ".$_GET['user']." does not exist, please do not play with it!<br>";
		}
if (!$error_message){
	$query="select * from $status where username = '$username'";
				$result = $conn->query($query);
				if (!$result) die($conn->error);
				$rows = $result->num_rows;
				$row = array("");
				for ($j = 0 ; $j < $rows ; ++$j){
					$result->data_seek($j);
					$row = $result->fetch_array(MYSQLI_NUM);
					$_SESSION['userid'] = $row['0'];
				}
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
    
	<link href="calendar/style.css" rel="stylesheet" type="text/css">

	<link href="http://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet" type="text/css">
	

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/my_style.css">
  
  </head>
  <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
  	<?php include_once "right_menu.php";?>
  	<!--banner-->
	<section id="banner-2a" class="banner">
		<div class="bg-color-2a">
			<div class="container">
				<div class="row">
					<div class="banner-info">
						<div class="banner-text text-center">
							<h1 class="white">User details</h1>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/ banner-->

<!--about-->
	<section id="about" class="section-padding">
		<div class="container">

			    <div class="col-md-9 col-sm-8 col-xs-12">
			       <div class="col-sm-9 more-features-box">
			          <div class="more-features-box-text">
						<?php if (!isset($error_message)){?>
				            <h3 class="doctor-name"><b>Full Name: </b><?php echo $row['2'];?> <?php echo $row['3'];?></h3>
				            <h3 class="doctor-name"><b>User name: </b><?php echo $row['1'];?></h3>
				            
				        	<hr class="doctor-line">
				        	<h3 class="doctor-name"><b>Birthday: </b><?php echo $row['9'];?></h3>
				        	<h3 class="doctor-name"><b>Gender: </b><?php echo $row['6'];?></h3>
							<h3 class="doctor-name"><b>Specialization: </b><?php echo $row['7'];?></h3>
				        	<h3 class="doctor-name"><b>Contact: </b>+<?php echo $row['10'];?></h3>
				        	<h3 class="doctor-name"><b>Email: </b> <?php echo $row['5'];?></h3>
				        	<h3 class="doctor-name"><b>Region: </b> <?php echo $row['12'];?></h3>
							<h3 class="doctor-name"><b>Address: </b> <?php echo $row['11'];?></h3>
                        <a href="chat/index.php?doc=<?=$row['1']?>&name=<?php echo $_SESSION['username'];?>">Chatting</a>
						<?php     
        
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $calendar->after_post($month, $day, $year);  
}   

// Call calendar function
$calendar->make_calendar($selected_date, $back, $forward, $day, $month, $year);
		} else { echo "<h3> $error_message</h3>";}
?>
						</div>
			        

					</div>
			    </div>

	</section>
	<!--/ about-->

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


