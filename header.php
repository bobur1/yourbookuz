<section id="banner-2a" class="banner">
		<div class="bg-color-2a">
			<div class="container">
				<div class="row">
					<div class="banner-info">
						<div class="banner-text text-center">
							<h1 class="white"><?php if($_SESSION['status']) echo $_SESSION['status'];?> page</h1>
						</div>	
					</div>
				<?php if ($_SESSION['status']=="patient") { ?><div class="searchPanel" align = "center">
								<form action="search.php" method="post">		    
									<select class="input_select" id="insurance" name = "f_status">
            <option    value="doctor">Doctor</option>
            <option  value="clinic">Clinic</option>
          </select>
									<input class="searchInput" type="text" placeholder="What are you looking for?" id="search-text-input" name ="f_name">
									<input class="searchButton" name= "submit" type="submit" value="Search">
								</form>
				</div> <?php } ?>
				</div>
			</div>
		</div>
	</section>