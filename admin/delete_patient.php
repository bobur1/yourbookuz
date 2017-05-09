<?php session_start();
	include_once("checkSession.php")
	
	
	?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin page</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../css/admin/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../css/admin/daterangepicker.css">
      <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../css/admin/bootstrap-timepicker.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link href="../css/admin/AdminLTE.min.css" rel="stylesheet" type="text/css" />
   
    <link href="../css/admin/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <link href="../css/admin/properties.css" rel="stylesheet" type="text/css" />
  <link href="../css/my_style.css" rel="stylesheet" type="text/css" />
   
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      
      <header class="main-header">
        <a class="logo">
          <span class="logo-lg"><b>You</b>Book</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../images/user.jpg" class="user-image" alt="User Image"/>
                  <span class="hidden-xs">Administrator</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../images/user.jpg" class="img-circle" alt="User Image" />
                    <p>
                      Administrator
                      <small></small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <!--for padding-->
          </div>
          <!-- search form -->
          
          <!-- /.search form -->
          <?php include_once"menu.php";?>
      </aside>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Patients list
          </h1>
          <ol class="breadcrumb">
            <li class="active">Home</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              
                <div class="box-body">
                <!--Main text goes here-->

<table class="table-list">
	<th>Picture</th>
		<th>Username</th>
		<th>Full name</th>
		<th>email</th>
		<th>Contact</th>
		<th>Delete</th>
	</tr>
<?php 
	require_once '../config.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	$id = $_POST['delete'];
	if ($id){
	$newconn = mysqli_connect($hn, $un, $pw, $db);
	$sql = "DELETE FROM patient WHERE id = {$id}";
	
	if (mysqli_query($newconn, $sql)) {
    echo "Record deleted successfully";
	unset ($_POST);
	} else {
		echo "Error deleting record: " . mysqli_error($conn);
	}
	}
	if ($conn->connect_error) die($conn->connect_error);
	$query = "SELECT * FROM patient ";
	$result = $conn->query($query);
	if (!$result) {$error = "No such $f_status";};
	if ($error<1){
	$rows = $result->num_rows;
	$count = mysqli_num_rows($result);
	for ($j = 0 ; $j < $rows ; ++$j){
					$result->data_seek($j);
					$row = $result->fetch_array(MYSQLI_NUM);
	
	?>

	<tr>
		<td><img class="search-list-image" src="../img/user.jpg" width="25" height="25"></td>
		<td><?php echo $row['1'] ;?></td>
		<td><?php echo $row['2']." ".$row['3'];?></td>
		<td><?php echo $row['5'];?></td>
		<td><?php echo $row['8'];?></td>
		<form method = "post">
	<td><input type="submit"  value="delete" ></input></td>
	<input name='delete' type='hidden'  class='text_box' value = "<?=$row['0']?>">
	</form>
	</tr>
	<?php }echo "</table>"; 
	} else {?>
			
				   <div><br>here should be smth</div>
	<?php } ?>
				</div>

				</div>
<!--text can be written here-->

              </div><!-- /.box -->
                </div><!-- /.box-body -->

            </div><!--/.col (left) -->

            <!-- right column -->
            
           <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="../jQuery/jQuery-2.1.3.min.js"></script>

    <!-- jQuery 2.2.3 -->
    <script src="../jQuery/jquery-2.2.3.min.js"></script>

    <!-- Bootstrap 3.3.2 JS -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- FastClick -->
    <script src='../js/fastclick.min.js'></script>

    <!-- AdminLTE App -->
    <script src="../js/app.min.js"></script>

    <!--Google Maps contents-->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../js/dashboard2.js"></script>

    <!-- jvectormap -->
    <script src="../jvectormap/jquery-jvectormap-1.2.2.min.js"></script>

    <script src="../jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>

    <!-- Page script -->
    <script>
      $(function () {

        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
            function (start, end) {
              $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
        );

        //Date picker
        $('#datepicker').datepicker({
          autoclose: true
        });


        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });


        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });


        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>

  </body>
</html>
