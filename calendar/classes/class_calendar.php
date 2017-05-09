<?php
session_start();	
	
class booking_diary {


function __construct($link) {
    $this->link = $link;	
}


public $booking_start_time          = "09:30";
public $booking_end_time            = "19:00";
public $booking_frequency           = 30;


public $day_format					= 1;
	
public $day_closed					= array("Saturday", "Sunday");
public $day_closed_text				= "CLOSED";


public $day_order	 				= array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
public $day, $month, $year, $selected_date, $back, $back_month, $back_year, $forward, $forward_month, $forward_year, $bookings, $count, $days, $is_slot_booked_today;



function make_calendar($selected_date, $back, $forward, $day, $month, $year) {

    $this->day = $day;
    $this->month = $month;
    $this->year = $year;
    
    $this->selected_date = $selected_date;
    $this->back = $back;
    $this->back_month = date("m", $back);
    $this->back_year = date("Y", $back);
    
    $this->forward = $forward;
    $this->forward_month = date("m", $forward);
    $this->forward_year = date("Y", $forward);
    
    // Make the booking array
    $this->make_booking_array($year, $month);
    
}


function make_booking_array($year, $month, $j = 0) { 
	$doctor = $_SESSION['doc'];
	$stmt = $this->link->prepare("SELECT name, date, start, doctor FROM bookings WHERE date LIKE  CONCAT(?, '-', ?, '%') and doctor = ?"); 
	$this->is_slot_booked_today = 0; // Defaults to 0

	$stmt->bind_param('sss', $year, $month, $doctor);	
	$stmt->bind_result($name, $date, $start, $specialist);	
	$stmt->execute();
	$stmt->store_result();
	
	while($stmt->fetch()) {    

		$this->bookings_per_day[$date][] = $start;

		$this->bookings[] = array(
            "name" => $name, 
            "date" => $date, 
            "start" => $start,
			"specialist" => $specialist
 		); 
	
		if(($date == $this->year . '-' . $this->month . '-' . $this->day) or ($specialist == $this->doctor)) {
			$this->is_slot_booked_today = 1;
		} 

	}

	$this->slots_per_day = 0;
	for($i = strtotime($this->booking_start_time); $i<= strtotime($this->booking_end_time); $i = $i + $this->booking_frequency * 60) {
		$this->slots_per_day ++;
	}	

	$stmt->close();		
    $this->make_days_array($year, $month);    
            
}

 
function make_days_array($year, $month) { 

    $num_days_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    

	for ($i = 1; $i <= $num_days_month; $i++) {	
	
		// Work out the Day Name ( Monday, Tuesday... ) from the $month and $year variables
        $d = mktime(0, 0, 0, $month, $i, $year); 
		
		// Create the array
        $this->days[] = array("daynumber" => $i, "dayname" => date("l", $d)); 		
    }   

	
	$this->make_blank_start($year, $month);
	$this->make_blank_end($year, $month);	

}


function make_blank_start($year, $month) {


	
	$first_day = $this->days[0]['dayname'];	$s = 0;
		
		foreach($this->day_order as $i => $r) {
		
			if($first_day == $r && $s == 0) {
				
				$s = 1;
				
			} elseif($s == 0) {

				$blank = array(
					"daynumber" => 'blank',
					"dayname" => 'blank'
				);
			
				// Prepend elements to the beginning of the $day array
				array_unshift($this->days, $blank);
			}
			
	}

}
	

function make_blank_end($year, $month) {

    $pad_end = 7 - (count($this->days) % 7);

    if ($pad_end < 7) {
	
		$blank = array(
			"daynumber" => 'blank',
			"dayname" => 'blank'
		);
	
        for ($i = 1; $i <= $pad_end; $i++) {							
			array_push($this->days, $blank);
		}
		
    }
		
	$this->calendar_top(); 

}
   
    
function calendar_top() {


	echo "
    <div id='lhs'><div id='outer_calendar'>
    
	<table border='0' cellpadding='0' cellspacing='0' id='calendar'>
        <tr id='week'>
        <td align='left'><a href='?month=" . date("m", $this->back) . "&amp;year=" . date("Y", $this->back) . "'>&laquo;</a></td>
        <td colspan='5' id='center_date'>" . date("F, Y", $this->selected_date) . "</td>    
        <td align='right'><a href='?month=" . date("m", $this->forward) . "&amp;year=" . date("Y", $this->forward) . "'>&raquo;</a></td>
    </tr>
    <tr>";
		

	foreach($this->day_order as $r) {
	
		switch($this->day_format) {
		
			case(1): 	
				echo "<th>" . substr($r, 0, 1) . "</th>";					
			break;
			
			case(2):
				echo "<th>" . substr($r, 0, 3) . "</th>";			
			break;
			
			case(3): 	
				echo "<th>" . $r . "</th>";
			break;
			
		}
	
	}

			
	echo "</tr>";   

	$this->make_cells();
    
}


function make_cells($table = '') {

	echo "<tr>";

	foreach($this->days as $i => $r) {
		$j = $i + 1; $tag = 0;	 		

		if(in_array($r['dayname'], $this->day_closed)) {
			echo "\r\n<td width='21' valign='top' class='closed'>" . $this->day_closed_text . "</td>";		
			$tag = 1;
		}
		

		if (mktime(0, 0, 0, $this->month, sprintf("%02s", $r['daynumber']) + 1, $this->year) < strtotime("now") && $tag != 1) {
			
			echo "\r\n<td width='21' valign='top' class='past'>";			
				if($r['daynumber'] != 'blank') echo $r['daynumber'];

			echo "</td>";		
			$tag = 1;
		}
		
		if($r['dayname'] == 'blank' && $tag != 1) {
			echo "\r\n<td width='21' valign='top' class='unavailable'></td>";	
			$tag = 1;
		}
				
				
		$current_day = $this->year . '-' . $this->month . '-' . sprintf("%02s", $r['daynumber']);

		if(isset($this->bookings_per_day[$current_day]) && $tag == 0) {
		
			$current_day_slots_booked = count($this->bookings_per_day[$current_day]);

				if($current_day_slots_booked < $this->slots_per_day) {
				
					echo "\r\n<td width='21' valign='top'>
					<a href='user.php?user=".$_POST['user']."&status=".$_POST['status']."&month=" .  $this->month . "&amp;year=" .  $this->year . "&amp;day=" . sprintf("%02s", $r['daynumber']) . "' class='part_booked' title='This day is part booked'>" . 
					$r['daynumber'] . "</a></td>"; 
					$tag = 1;
				
				} else {
				
					echo "\r\n<td width='21' valign='top'>
					<a href='user.php?user=".$_POST['user']."&status=".$_POST['status']."&month=" .  $this->month . "&amp;year=" .  $this->year . "&amp;day=" . sprintf("%02s", $r['daynumber']) . "' class='fully_booked' title='This day is fully booked'>" . 
					$r['daynumber'] . "</a></td>"; 
					$tag = 1;			
				
				}
		
		}
		
		if($tag == 0) {
		
			echo "\r\n<td width='21' valign='top'>
			<a href='user.php?user=".$_POST['user']."&status=".$_POST['status']."&month=" .  $this->month . "&amp;year=" .  $this->year . "&amp;day=" . sprintf("%02s", $r['daynumber']) . "' class='green' title='Please click to view bookings'>" . 
			$r['daynumber'] . "</a></td>";			
		
		}
		
			if($j % 7 == 0 && $i >1) {
			echo "\r\n</tr>\r\n<tr>";
		}		
		
	}		
		
	echo "</tr></table></div><!-- Close outer_calendar DIV -->";
	
	if(isset($_GET['year']))
	$this->basket();
		
	echo "</div><!-- Close LHS DIV -->";

	$current_day = $this->year . '-' . $this->month . '-' . $this->day;
	$slots_selected_day = 0;
	
	if(isset($this->bookings_per_day[$current_day]))
	$slots_selected_day = count($this->bookings_per_day[$current_day]);
	
	if($this->day != 0 && $slots_selected_day < $this->slots_per_day ) { 
		$this->booking_form();
	}
	
	
}


function booking_form() {

	echo "
	<div id='outer_booking'><h2>Available Slots</h2>

	<p>
	The following slots are available on <span> " . $this->day . "-" . $this->month . "-" . $this->year . "</span>
	</p>
	
	<table width='400' border='0' cellpadding='2' cellspacing='0' id='booking'>
		<tr>
			<th width='150' align='left'>Start</th>
			<th width='150' align='left'>End</th>
			
			<th width='20' align='left'>Book</th>			
		</tr>
		<tr>
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
		</tr>";
				

		for($i = strtotime($this->booking_start_time); $i<= strtotime($this->booking_end_time); $i = $i + $this->booking_frequency * 60) {
			$slots[] = date("H:i:s", $i);  
		}			
				


		if($this->is_slot_booked_today == 1) {
		
			foreach($this->bookings as $i => $b) { 
				
				if(($b['date'] == $this->year . '-' . $this->month . '-' . $this->day) && ($b['specialist']==$_SESSION['doc'])) {
					
                    $slots = array_diffe($slots, array($b['start']));
					
				}
				
			}
		
		}

		foreach($slots as $i => $start) {			

			$finish_time = strtotime($start) + $this->booking_frequency * 60;
		
			echo "
			<tr>\r\n
				<td>" . $start . "</td>\r\n
				<td>" . date("H:i:s", $finish_time) . "</td>\r\n
				<td>" . $this->cost_currency_tag . number_format($this->cost_per_slot, 2) . "</td>\r\n
				<td width='110'><input data-val='" . $start . " - " . date("H:i:s", $finish_time) . "' class='fields' type='checkbox'></td>
			</tr>";
		
		}
	
		echo "</table></div><!-- Close outer_booking DIV -->";
		

}


function basket($selected_day = '') {

	if(!isset($_GET['day']))
	$day = '01';
	else
	$day = $_GET['day'];	

	// Validate GET date values
	if(checkdate($_GET['month'], $day, $_GET['year']) !== false) {
		$selected_day = $_GET['year'] . '-' . $_GET['month'] . '-' . $day;	
	} else { 
		echo 'Invalid date!';
		exit();
	}

				$hn = 'localhost';
				$db = 'medical_system';
				$un = 'root';
				$pw = 'root';
	
				$conn = new mysqli($hn, $un, $pw, $db);
				if ($conn->connect_error) die($conn->connect_error);
				$status = $_SESSION['status'];
				$username = $_SESSION['username'];
				$query="select * from $status where username = '$username'";
				$result = $conn->query($query);
				if (!$result) die($conn->error);
				$rows = $result->num_rows;
				$row = array("");
				for ($j = 0 ; $j < $rows ; ++$j){
					$result->data_seek($j);
					$row = $result->fetch_array(MYSQLI_NUM);
				$_SESSION['userid'] = $row['0'];}
	$patient = $_SESSION['username'];
	$doc = $SESSION['doc'];
	echo "<div id='outer_basket'>
	
	<h2>Selected Slots</h2>
		
		<div id='selected_slots'></div>		
	
			<div id='basket_details'>
			
				<form method='post' action='book_slots.php'>
				
					<label>Name</label>
					<input name='name' id='name' type='text' disabled='disabled' class='text_box' value = ".$patient.">
					<input name='name' id='name' type='hidden'  class='text_box' value = ".$patient.">
					<label>Email</label>
					<input name='email' id='email' type='text' disabled='disabled' class='text_box' value = ".$row['5'].">	
					<input name='email' id='email' type='hidden'  class='text_box' value = ".$row['5'].">
					<label>Phone</label>
					<input name='phone' id='phone'  type='text' disabled='disabled' class='text_box' value = ".$row ['8'].">	
					<input name='phone' id='phone'  type='hidden' class='text_box' value = ".$row ['8'].">	
					<input name='doctor' id='doctor' type='hidden' class='text_box' value = ".$doc.">	

														
					
					<input type='hidden' name='slots_booked' id='slots_booked'>
					
					<input type='hidden' name='booking_date' value='" . $_GET['year'] . '-' . $_GET['month'] . '-' . $day . "'>
					
					<input type='submit' class='classname' value='Make Booking'>

				</form>
			
			</div><!-- Close basket_details DIV -->
		
	</div><!-- Close outer_basket DIV -->";

}

                 
}

?>