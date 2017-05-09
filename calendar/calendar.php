<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include('calendar/php/connect.php'); 
include('calendar/classes/class_calendar.php');

$calendar = new booking_diary($link);

if(isset($_GET['month'])) $month = $_GET['month']; else $month = date("m");
if(isset($_GET['year'])) $year = $_GET['year']; else $year = date("Y");
if(isset($_GET['day'])) $day = $_GET['day']; else $day = 0;

$selected_date = mktime(0, 0, 0, $month, 01, $year);

$back = strtotime("-1 month", $selected_date);

$forward = strtotime("+1 month", $selected_date);

?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript">

var check_array = [];

$(document).ready(function(){

	$(".fields").click(function(){
	
		dataval = $(this).data('val');
	
		if($("#outer_basket").css("display") == 'none') {
			$("#outer_basket").css("display", "block");
		}

		if(jQuery.inArray(dataval, check_array) == -1) {
			check_array.push(dataval);
		} else {
			check_array.splice($.inArray(dataval, check_array) ,1);
		}
		
		slots=''; hidden=''; basket = 0;
		
		cost_per_slot = $("#cost_per_slot").val();

		for (i=0; i< check_array.length; i++) {
			slots += check_array[i] + '\r\n';
			hidden += check_array[i].substring(0, 8) + '|';
			basket = (basket + parseFloat(cost_per_slot));
		}
		
		$("#selected_slots").html(slots);
		
		$("#slots_booked").val(hidden);

		basket = basket.toFixed(2);
		$("#total").html(basket);	

		if(check_array.length == 0)
		$("#outer_basket").css("display", "none");
		
	});
	
	
	$(".classname").click(function(){
	
		msg = '';
	
		if($("#name").val() == '')
		msg += 'Please enter a Name\r\n';

		if($("#email").val() == '')
		msg += 'Please enter an Email address\r\n';

		if($("#phone").val() == '')
		msg += 'Please enter a Phone number\r\n';	

		if(msg != '') {
			alert(msg);
			return false;
		}

	});

	$('input:checkbox').removeAttr('checked');
	
});




</script>

