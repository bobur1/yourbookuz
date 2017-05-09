<?php session_start();
	
		?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YourBook</title>
    <meta name="description" content="Medical booking platform">
    <meta name="keywords" content="YouBook, Medical booking, Doctors booking">
    
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/my_style.css">
	<link rel="icon" type="image/png" href="img/medical_directory-512.png">
  </head>
  <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

  <?php include_once "right_menu.php"?>
  	<!--banner-->
	<section id="banner" class="banner">
		<div class="bg-color">
			<nav class="navbar navbar-default navbar-fixed-top">
			  <div class="container">
			  	<div class="col-md-12">
				    <div class="navbar-header">
				      
				      <div class="navbar-brand">
				      	<img src="img/Logo(white).png" class="img-responsive" style="width: 140px; margin-top: -16px;">
				      </div>
				    </div>
				    <div class="collapse navbar-collapse navbar-right" id="myNavbar">
				      <ul class="nav navbar-nav">
				        <li class="active"><a class="home_nav_link" href="#banner">Home</a></li>
				        <li class=""><a href="#service">Services</a></li>
				        <li class=""><a href="#about">About</a></li>
						<li class=""><a href="#contact">Contact</a></li>
						
					  </ul>
				    </div>
				</div>
			  </div>
			</nav>
			<div class="container">
				<div class="row">
					<div class="banner-info">
						<div class="banner-logo text-center">
							<img src="img/Logo(white).png" class="img-responsive">
						</div>
						<div class="banner-text text-center">
							<h1 class="white">List of doctors on your hand!</h1>
							<p>Medical booking platform</p>

							<div class="searchPanel">
								<form action="search.php" method="post">		    
									
            <input  type="hidden" name="f_status" value="doctor"></input>
          
									<input class="searchInput" type="text" placeholder="What are you looking for?" id="search-text-input" name ="f_name" value = "<?php if (isset($_POST['f_name'])) echo $_POST['f_name'];?>">
									<input class="searchButton" type="submit" name ="submit" value="Search">
								</form>
							</div>
						</div>

						<div class="overlay-detail text-center">
			               <a href="#service"><i class="fa fa-angle-down"></i></a>
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
				<div class="col-md-4 col-sm-4">
					<h2 class="ser-title">Specialists</h2>
					<hr class="botm-line">
					<p>The basis of our service is doctors - professors, candidates of medical sciences, doctors of the highest category.</p>

				<button type="submit" class="btn btn-form">Main section</button>
				</div>

				<div class="col-md-4 col-sm-4">
					<div class="service-info">
						<div class="icon">
							<i class="fa fa-stethoscope"></i> 
							
							<i class="fa fa-user-md"></i>
							
							<i class="fa fa-ambulance"></i>
							
							<i class="fa fa-medkit"></i>
						</div>
						<div class="icon-info">
							
							<p>The main indicators of the quality of service are compliance with the ethical code of the doctor and international protocols, the use of expert equipment, confidentiality, the creation of comfortable conditions for the whole family.</p>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</section>
	<!--/ service-->
	
	<!--about-->
	<section id="about" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-4 col-xs-12">
			        <div class="section-title">
			          <h2 class="head-title lg-line">Our goals</h2>
			          <hr class="botm-line">
			          <p class="sec-para">To provide a comfort to users to find a doctor which they need, find their place of work, to know more about their background.</p>
			          <a href="" style="color: #0cb8b6; padding-top:10px;">More..</a>
			        </div>
			    </div>
			    <div class="col-md-9 col-sm-8 col-xs-12">
			       <div style="visibility: visible;" class="col-sm-9 more-features-box">
			          <div class="more-features-box-text">
			            <div class="more-features-box-text-icon"> <i class="fa fa-angle-right" aria-hidden="true"></i> </div>
			            <div class="more-features-box-text-description">
				            <h3></h3>
				            <p>Our goal is to provide the reader with the necessary information, the patient with timely advice and subsequent treatment.  Attracting the people with interesting content and quality service.</p>
				        </div>
			          </div>
			          <div class="more-features-box-text">
			            <div class="more-features-box-text-icon"> <i class="fa fa-angle-right" aria-hidden="true"></i> </div>
			            <div class="more-features-box-text-description">
				            <h3></h3>
				            <p>To provide a comfort to users to find a doctor which they need, find their place of work, to know more about their background.</p>
				        </div>
                        </div>
			        </div>
			    </div>
			</div>
		</div>
	</section>
	<!--/ about-->
	
	<!--cta 2-->
	<section id="cta-2" class="section-padding">
		<div class="container">
			<div class=" row">
				<div class="col-md-2"></div>
	            <div class="text-right-md col-md-4 col-sm-4">
	              <h2 class="section-title white lg-line">Your book <br> Your health service</h2>
	            </div>
	            <div class="col-md-4 col-sm-5">
	              To provide a comfort to users to find a doctor which they need, find their place of work, to know more about their background.
	              <p class="text-right text-primary"><i>— International Healthcare Support</i></p>
	            </div>
	            <div class="col-md-2"></div>
	        </div>
		</div>
	</section>
	<!--cta-->
	<!--contact-->
	<section id="contact" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="ser-title">Contact us</h2>
					<hr class="botm-line">
				</div>
				<div class="col-md-4 col-sm-4">
			      <h3>Contact Info</h3>
			      <div class="space"></div>
			      <p><i class="fa fa-map-marker fa-fw pull-left fa-2x"></i>9 Ziyolilar Street<br>
			        Tashkent 100190</p>
			      <div class="space"></div>
			      <p><i class="fa fa-envelope-o fa-fw pull-left fa-2x"></i>ourteam@fakemail.com</p>
			      <div class="space"></div>
			      <p><i class="fa fa-phone fa-fw pull-left fa-2x"></i>+998 90 9099090</p>
			    </div>
				<div class="col-md-8 col-sm-8 marb20">
					<div class="contact-info">
							<h3 class="cnt-ttl">Have Any Query?</h3>
							<div class="space"></div>
                            <div id="sendmessage">Your message has been sent. Thank you!</div>
                            <div id="errormessage"></div>
							<form action="" method="post" role="form" class="contactForm">
							    <div class="form-group">
                                    <input type="text" name="name" class="form-control br-radius-zero" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                    <div class="validation"></div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control br-radius-zero" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                    <div class="validation"></div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control br-radius-zero" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                    <div class="validation"></div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control br-radius-zero" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                                    <div class="validation"></div>
                                </div>
                                
								<div class="form-action">
									<button type="submit" class="btn btn-form">Send Message</button>
								</div>
							</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/ contact-->
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