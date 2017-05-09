<?php error_reporting( E_ERROR ); ?>
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
  	<?php include_once "right_menu.php";
	include_once('admin/db_fns.php');
	$handle = db_connect();
	$time = time();
?>
  	<!--banner-->
	<section id="banner-2a" class="banner">
		<div class="bg-color-2a">
			<div class="container">
				<div class="row">
					<div class="banner-info">
						<div class="banner-text text-center">
							<h1 class="white">NEWS</h1>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/ banner-->

<!--about-->
<?php $query = "select * from stories ORDER BY id DESC";
			  $result = $handle->query($query);
			  while ($story = $result->fetch_assoc()) 
  {
    // headline
	 echo '<div style="margin-top: 125px; margin-left: 225px">';
    echo "<div class=\"team-text\"><h1>{$story['headline']}</h1></div>";
	
    //picture
    if ($story['picture']) 
    {
      echo '<div style="float:right; margin:0px 100px 6px 6px;">';
      echo '<img src="';
      echo "$story[picture]";
      echo '",  style="width:15%", align = right></div>';
	  echo "$story[picture]";
    }
    // byline
    $w = get_writer_record($story['writer']);
    echo '<br /><p class="byline">';
    
    
    echo '</p>';
    // main text
	echo "<div class=\"info\">";
    echo $story['story_text'];  
	echo "<br><br> Posted in:";
	echo date('M d, H:i', $story['modified']);
	echo "</div></div>";
  
  echo "<br/><br/>";
  }
			  
	
	?>


<!--/ about-->

	<!--footer-->
	<?php include_once "footer.php";?>
	<!--/ footer-->
	<script>
	function showOrganization() {
		document.getElementById("doctor").style.display="none";
		document.getElementById("organ").style.display="block";
	}
	function Patient() {
		document.getElementById("sign_up_patient").style.display="block";
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
