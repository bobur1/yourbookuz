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
							<h1 class="white">ADVANCED SEARCH</h1>
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
				 <div class="col-md-9 col-sm-8 col-xs-12">
			       <div class="more-features-box-text">
			            <div class="more-features-box-text-description">
			            	<h3>Please, select your choice: </h3>
			        		<button class="btn btn-form margin-btn" onclick="showOrganization()">Organization</button>
			        		<button class="btn btn-form margin-btn" onclick="showDoctor()">Doctor</button>

				            <div id="organ" style="display:none" class="advanced-search-form">
				            	<label class="text_prop" for="organ">Area of organization</label>
								<input class="advancedSearch" type="text" id="my_organ" name="my_organ" placeholder="Enter area of organization">

								<label class="text_prop" for="organ">Country of organization</label>
								<input class="advancedSearch" type="text" id="my_organ" name="my_organ" placeholder="Enter country of organization">

								<label class="text_prop" for="organ">City of organization</label>
								<input class="advancedSearch" type="text" id="my_organ" name="my_organ" placeholder="Enter city of organization">

								<input class="btn btn-form margin-2-btn" type="submit" value="Search" onclick="organizationList()">
				            </div>

				            <div id="doctor" style="display:none" class="advanced-search-form">
				            	<label class="text_prop" for="doctor">Specialization</label>
								<input class="advancedSearch" type="text" id="my_doctor" name="my_doctor" placeholder="Enter specialization">

								<label class="text_prop" for="organ">Country</label>
								<input class="advancedSearch" type="text" id="my_doctor" name="my_doctor" placeholder="Enter country">

								<label class="text_prop" for="organ">City</label>
								<input class="advancedSearch" type="text" id="my_doctor" name="my_doctor" placeholder="Enter city">
								<br>
								<input class="btn btn-form margin-2-btn" type="submit" value="Search" onclick="doctorsList()">
				            </div>

				            <div id="doctor_list" style="display:none">
<table class="table-list">
	<tr>
		<th>Picture</th>
		<th>Name</th>
		<th>Last Name</th>
		<th>Workplace</th>
		<th>Status</th>
		<th>GO</th>
	</tr>

	<tr>
		<td><img class="search-list-image" src="img/user.jpg"></td>
		<td>Alexandro</td>
		<td>Roman</td>
		<td>Tashkent, Mirzo Ulug'bek district</td>
		<td>
			<img class="doctor-status2" src="img/star.png">
			<img class="doctor-status2" src="img/star.png">
			
		</td>
		<td><a href="doctor_page.html"><img class="arrow-icon-image" src="img/arrow.png"></a></td>
	</tr>

	<tr>
		<td><img class="search-list-image" src="img/user.jpg"></td>
		<td>Enrique</td>
		<td>Roman</td>
		<td>Tashkent, Uchtepa district</td>
		<td>
			<img class="doctor-status2" src="img/star.png">
			<img class="doctor-status2" src="img/star.png">
			<img class="doctor-status2" src="img/star.png">
			
		</td>
		<td><a href="doctor_page.html"><img class="arrow-icon-image" src="img/arrow.png"></a></td>
	</tr>

	<tr>
		<td><img class="search-list-image" src="img/user.jpg"></td>
		<td>Paoul</td>
		<td>Wester</td>
		<td>Tashkent, Chilonzor district</td>
		<td>
			<img class="doctor-status2" src="img/star.png">
			<img class="doctor-status2" src="img/star.png">
			<img class="doctor-status2" src="img/star.png">
			<img class="doctor-status2" src="img/star.png">
			<img class="doctor-status2" src="img/star.png">
		</td>
		<td><a href="doctor_page.html"><img class="arrow-icon-image" src="img/arrow.png"></a></td>
	</tr>
</table>

</div>



<div id="organ_list" style="display:none">
<table class="table-list">
	<tr>
		<th>Picture</th>
		<th>Name</th>
		<th>Workplace</th>
		<th>Status</th>
		<th>GO</th>
	</tr>

	<tr>
		<td><img class="search-list-image" src="img/hospital.png"></td>
		<td>Academy of ministry</td>
		<td>Tashkent, Mirzo Ulug'bek district</td>
		<td>
			<img class="doctor-status2" src="img/star.png">
			<img class="doctor-status2" src="img/star.png">
			<img class="doctor-status2" src="img/star.png">
			<img class="doctor-status2" src="img/star.png">
			
		</td>
		<td><a href="organization_page.html"><img class="arrow-icon-image" src="img/arrow.png"></a></td>
	</tr>

	<tr>
		<td><img class="search-list-image" src="img/hospital.png"></td>
		<td>Academy of sth</td>
		<td>Tashkent, Uchtepa district</td>
		<td>
			<img class="doctor-status2" src="img/star.png">
			<img class="doctor-status2" src="img/star.png">
			<img class="doctor-status2" src="img/star.png">
			<img class="doctor-status2" src="img/star.png">
			<img class="doctor-status2" src="img/star.png">
		</td>
		<td><a href="organization_page.html"><img class="arrow-icon-image" src="img/arrow.png"></a></td>
	</tr>

	<tr>
		<td><img class="search-list-image" src="img/hospital.png"></td>
		<td>Academy of sth else</td>
		<td>Tashkent, Chilonzor district</td>
		<td>
			<img class="doctor-status2" src="img/star.png">
			<img class="doctor-status2" src="img/star.png">
			<img class="doctor-status2" src="img/star.png">
			</td>
		<td><a href="organization_page.html"><img class="arrow-icon-image" src="img/arrow.png"></a></td>
	</tr>
</table>

				            </div>
				        </div>
			          </div> <!--end of more features box text-->
			        </div>
			</div>
		</div>
	</section>
	<!--/ service-->

	<!--about-->
	<section id="about" class="section-padding">
		<div class="container">
			
		</div>
	</section>
	<!--/ about-->

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
	function showOrganization() {
		document.getElementById("doctor_list").style.display="none";
		document.getElementById("organ_list").style.display="none";
		document.getElementById("doctor").style.display="none";
		document.getElementById("organ").style.display="block";
	}

	function showDoctor() {
		document.getElementById("doctor_list").style.display="none";
		document.getElementById("organ_list").style.display="none";
		document.getElementById("organ").style.display="none";
		document.getElementById("doctor").style.display="block";
	}

	function doctorsList() {
		document.getElementById("doctor_list").style.display="block";
	}

	function organizationList() {
		document.getElementById("organ_list").style.display="block";
	}
	</script>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="contactform/contactform.js"></script>
    
  </body>
</html>