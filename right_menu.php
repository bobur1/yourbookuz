<?php session_start ();?>
<div class="fixed_nav_2">
      <ul class="fixed_nav_list">
        <li>
          <a href="index.php"><img class="menu_bar_icon" src="img/Menu_white/Home.png">
          <h5 class="menu_bar_text">Home</h5></a>
        </li>
        <li>
          <a href="search.php"><img class="menu_bar_icon" src="img/Menu_white/Search.png">
          <h5 class="menu_bar_text">Search</h5></a>
        </li>
        <?php 
		$status = $_SESSION['status'];
		if($_SESSION['status']) {?>
		<li>
          <a href="<?php echo $status."_page.php"; ?>"><img class="menu_bar_icon" src="img/Menu_white/Booking.png">
          <h5 class="menu_bar_text">Profile</h5></a>
		  
        </li>
        
		<li>
		
          <a href="logout.php"><img class="menu_bar_icon" src="img/Menu_white/logout.png">
          <h5 class="menu_bar_text">Log-out</h5></a>
        </li>
		
		
		<?php } else { ?>
		<li>
          <a href="sign_in.php"><img class="menu_bar_icon" src="img/Menu_white/login.png">
          <h5 class="menu_bar_text">Sign-in</h5></a>
        </li>
		<li>
          <a href="registration/index.php"><img class="menu_bar_icon" src="img/Menu_white/Registration.png">
          <h5 class="menu_bar_text">Sign-up</h5></a>
		  
        </li>
		<?php } ?>
        <li>
          <a href="news.php"><img class="menu_bar_icon" src="img/Menu_white/News.png">
          <h5 class="menu_bar_text">News</h5></a>
        </li>
        <li>
          <a href="login.php"><img class="menu_bar_icon" src="img/Menu_white/Admin.png">
          <h5 class="menu_bar_text">Admin</h5></a>
        </li>
		
      </ul>
    </div>