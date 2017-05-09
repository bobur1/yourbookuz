<?php
  include ('include_fns.php');
  
  if (isset($_REQUEST['story']))
  {
    $story = get_story_record($_REQUEST['story']);
  }
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
              
           
              
              <!-- User Account: style can be found in dropdown.less -->
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
        <?php include_once"search.php";?>
          <!-- /.search form -->
          <?php include_once"menu.php";?>
      </aside>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Main Page
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
<h1>Add / edit</h1>


<form action="story_submit.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="story" value="<?php echo $_REQUEST['story'];?>">
<input type="hidden" name="destination" 
       value="<?php echo $_SERVER['HTTP_REFERER'];?>">
<table>

<tr>
  <td>Headline<td>
</tr>
<tr>
  <td><input size="80" name="headline"
             value="<?php echo $story['headline'];?>"></td>
</tr>

<tr>
  <td>Page</td>
</tr>
<tr>
  <td>
<?php 
  if(isset($_REQUEST['story']))
  {
    $query = "select p.code, p.description 
              from pages p, writer_permissions wp, stories s
              where p.code = wp.page
                    and wp.writer = s.writer
                    and s.id =".$_REQUEST['story'];
  }
  else
  {
    $query = "select p.code, p.description 
              from pages p, writer_permissions wp
              where p.code = wp.page
                    and wp.writer = '{$_SESSION['admin']}'";
  }
  echo query_select('page', $query, $story['page']);
?>
  </td>
</tr>

<tr>
  <td>Story text (can contain HTML tags)</td>
</tr>
<tr>
  <td><textarea cols="80" rows="7" name="story_text"
           wrap="virtual"><?php echo $story['story_text'];?></textarea>
  </td>
</tr>

<tr>
  <td>Or upload HTML file</td>
</tr>
<tr>
  <td><input type="file" name="html" size="40"></td>
</tr>

<tr>
  <td>Picture</td>
</tr>
<tr>
  <td><input type="file" name="picture" size="40"></td>
</tr>

<?php 
  if ($story[picture]) 
  {
    $size   = getImageSize('../'.$story['picture']);
    $width  = $size[0];
    $height = $size[1];
?>
    <tr>
      <td>
        <img src="<?php echo '../'.$story['picture'];?>" 
              width="<?php echo $width;?>" height="<?php echo $height;?>">
      </td>
    </tr>
<?php 
  }
?>

<tr>
  <td align="center"><input type="submit" value="Submit"></td>
</tr>

</table>
</form>
<!--text can be written here-->

              </div><!-- /.box -->
                </div><!-- /.box-body -->

            </div><!--/.col (left) -->

            <!-- right column -->
            
           <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!--<footer class="main-footer">
        <strong>All rights reserved</strong>
      </footer>-->

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
        //Initialize Select2 Elements
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

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
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