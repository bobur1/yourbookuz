<?php session_start();
		
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
  <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
  	<?php include_once "right_menu.php";?>
  	<!--banner-->
	<section id="banner-2a" class="banner">
		<div class="bg-color-2a">
			<div class="container">
				<div class="row">
					<div class="banner-info">
						<div class="banner-text text-center">
							<h1 class="white">Search</h1>
						</div>	
					</div>
					<div class="searchPanel" align = "center">
								<form action="search.php" method="post">		    
									<select class="input_select" id="insurance" name = "f_status">
            <option    value="doctor">Doctor</option>
            
          </select>
									<input class="searchInput" type="text" placeholder="What are you looking for?" id="search-text-input" name ="f_name" value = "<?php if (isset($_POST['f_name'])) echo $_POST['f_name'];?>">
									<input class="searchButton" type="submit" name ="submit" value="Search">
								</form>
				</div> 
				</div>
			</div>
		</div>
	</section>
	<!--/ banner-->

<!--about-->
	<section id="about" class="section-padding">
		<div class="container">

			    
<div id="doctor_list">
<table class="table-list">
	<?php
	if ($_POST['submit']){
	require_once 'config.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	
	$f_status = $_POST ['f_status'];
	$f_name = $_POST ['f_name'];
	$query = "SELECT * FROM $f_status where first_name = '{$f_name}' or last_name = '{$f_name}' or username = '{$f_name}'";
	$result = $conn->query($query);
	if (!$result) {$error = "No such $f_status";};
	if ($error<1){
	$rows = $result->num_rows;
	$count = mysqli_num_rows($result);
	unset($_POST);
	for ($j = 0 ; $j < $rows ; ++$j){
					$result->data_seek($j);
					$row = $result->fetch_array(MYSQLI_NUM);	
?>	
	<tr>
		<th>Picture</th>
		<th>Full Name</th>
		<th>Specialization</th>
		<th>Address</th>
		<th>Email</th>
		<?php if ($_SESSION['status']=="patient") { ?> <th>GO</th><?php } ?>
	</tr>

	<tr>
		<td><img class="search-list-image" src="img/user.jpg"></td>
		<td><?php echo $row['2'] . " " . $row['3'];?></td>
		<td><?php echo $row['7'];?></td>
		<td><?php echo $row['11'];?></td>
		<td><?php echo $row['3'];?></td>
		<?php if ($_SESSION['status']=="patient") { ?><td><a href="user.php?user=<?php echo $row['1'];?>&status=<?php echo $f_status?>"><img class="arrow-icon-image" src="img/arrow.png"></a></td><?php } ?>
	</tr>
	
<?php } echo "</table>";
	} else echo "<div>{$error}</div>";
	} else { ?>Here you can find doctors</div><?php } ?>
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


