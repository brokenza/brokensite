<?php

include("config.php"); // incude �����������������¡��ҹ
$mysqli = connect();
session_start();
date_default_timezone_set("Asia/Bangkok");
$msg = "";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];

    //$password = md5($password);


    $sql="SELECT * FROM users WHERE UserName = '$username' and Password='$password'";
    $qr=select($sql);
    $row_=$qr[0];
    if($row_ != null)
    {
        $UID=$row_['UID'];
        $EmployeeID=$row_['EmployeeID'];
        $Name=$row_['FirstName'];
        $Last=$row_['LastName'];
        $level=$row_['Level'];
        $date_time=$row_['Date_Time'];
        $status=$row_['Status'];
        $EntityNo=$row_['EntityNo'];
        $Username=$row_['UserName'];
        $Password=$row_['Password'];
        $Dailywage=$row_['Dailywage'];
        $BranchName=$row_['BranchName'];
        $Phone=$row_['Phone'];
        $Email=$row_['Email'];
        $Images=$row_['Images'];
        $TechID = $row_['TechID'];

        //set value session.
        $_SESSION['UID'] = $UID;
        $_SESSION['EmployeeID'] = $EmployeeID;
        $_SESSION['Name'] = $Name;
        $_SESSION['Last'] = $Last;
        $_SESSION['Level']   = $level;
        $_SESSION['Date_Time'] = $date_time;
        $_SESSION['Status'] = $status;
        $_SESSION['FirstLast'] = $Name.=" ".$Last;
        $_SESSION['EntityNo'] = $EntityNo;
        $_SESSION['BranchName'] = $BranchName;
        $_SESSION['Username']= $Username;
        $_SESSION['Password']=$Password;
        $_SESSION['Dailywage'] = $Dailywage;
        $_SESSION['Phone'] = $Phone;
        $_SESSION['Email'] = $Email;
        $_SESSION['Images'] = $Images;


        $_SESSION['login_user'] = $username;

        $_SESSION['TechID'] = $TechID;


        //echo $level;
        header("location: main");
    }
    else
    {
        $msg = "Fail! username,password";
   }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="images/broken__lodp.ico" rel="shortcut icon" />
    <title>Loging | BrokenSite</title>

    <!--test notification. create date 4-11-60.-->
  <link rel="stylesheet" href="ios/css/bootstrap.min.css">
  <link rel="stylesheet" href="ios/css/custom.css">
  <link rel="stylesheet" href="ios/css/iosOverlay.css">
  <link rel="stylesheet" href="ios/css/prettify.css">
  <script src="ios/js/modernizr-2.0.6.min.js"></script>


    <!-- Tell the browser to be responsive to screen width -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css" />
    <!-- daterange picker -->
    <link rel="stylesheet" href=".bower_components/bootstrap-daterangepicker/daterangepicker.css" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href=".plugins/iCheck/all.css" />
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" />
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css" />
    <!-- Select2 -->
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css" />
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css" />



</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-green layout-top-nav">
    <div class="wrapper">
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="index" class="navbar-brand ajax">
                            <b>Broken</b>SITE
                        </a>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
        <div class="content-wrapper">
            <div class="container">
                <section class="content-header"></section>
                <section class="content">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="box box-primary">
                                <div class="box-header with-border" style="background-color: #3c8cba">
                                    <h3 class="box-title" style="color: white">Document Management System</h3>
                                </div>
                                <form action="index" method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box-body">
                                                <div class="form-group-lg">
                                                    <label for="">Username:</label>
                                                    <div class="form-group has-feedback">
                                                        <input type="text" name="txtUsername" value="" class="form-control" placeholder="Username" required />
                                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group-lg">
                                                    <label for="">Password:</label>
                                                    <!--<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">-->
                                                    <div class="form-group has-feedback">
                                                        <input type="password" name="txtPassword" value="" class="form-control" placeholder="Password" required />
                                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!--<input type="text" class="form-control pull-right" id="datepicker" />-->
                                                    <div class="col-xs-12" style="color:red">
                                                        <?php
                                                         echo $msg;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <div class="form-group-lg">
                                            <div class="col-xs-12">
                                                <button type="submit" class="btn btn-primary btn-lg btn-block pull-right glyphicon glyphicon-check ajax">Login</button>
                                                <!--<button style="width: 45%;"  href="#ModalDelete" class="btn btn-default pull-right glyphicon glyphicon-remove">Cancel</button>-->
                                                <!--<button class="btn btn-success" data-toggle="modal" data-target="#ModalDelete"><span class="glyphicon glyphicon-plus"></span>New Order</button>-->
                                                <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2016-<?php echo date("Y");?> Rosaree Doloh (R570168)</strong>&nbsp;All rights reserved. &nbsp; | &nbsp; <i><?php echo "Today is " . date("l"); ?>&nbsp;<?php echo "". date("Y-m-d"); ?>&nbsp; | &nbsp; <?php echo "" . date("h:i:s A");?> </i>
            <div class="pull-right hidden-xs">
              <b>Version</b> 2.4   
            </div>
        </footer>
    </div>



    <script>
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function () {
            $("#success-alert").closest(500);
        });
    </script>
    <!--notifi-->
        <script src="n/lib/jquery.1.11.min.js"></script>
        <!--<script src="bootstrap/dist/js/bootstrap.min.js"></script>-->
        <script src="n/js/Lobibox.js"></script>
        <script src="n/demo/demo.js"></script>


    <!-- jQuery 3 -->
    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/input-mask/jquery.inputmask.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="bower_components/moment/min/moment.min.js"></script>
    <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- bootstrap color picker -->
    <script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- SlimScroll -->
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>



    <script>
        //Date picker
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: 'TRUE',
            autoclose: true
        })
    </script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
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
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
            )

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            })

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            })
            //Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            })
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            })

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false
            })
        })
    </script>
    <!-- page script -->
  <script src="ios/js/jquery.min.js"></script>
  <script src="ios/js/iosOverlay.js"></script>
  <script src="ios/js/spin.min.js"></script>
  <script src="ios/js/prettify.js"></script>
  <script src="ios/js/custom.js"></script>
  <script>
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-37502505-1']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  </script>
		    


</body>
</html>