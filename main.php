<?php
session_start();
include('config.php');
date_default_timezone_set("Asia/Bangkok");

$UID = $_SESSION['UID'];
$employeeID = $_SESSION['EmployeeID'];
$Name =     $_SESSION['Name'];
$Last =      $_SESSION['Last'];
$Level =     $_SESSION['Level'];
$date_time=    $_SESSION['Date_Time'];
$status =   $_SESSION['Status'];
$firstlast=$_SESSION['FirstLast'];
$entityNo =    $_SESSION['EntityNo'];
$BranchName =  $_SESSION['BranchName'];
$login_user = $_SESSION['login_user'];
$Username = $_SESSION['Username'];
$Password = $_SESSION['Password'];
$Dailywage = $_SESSION['Dailywage'];
$Phone = $_SESSION['Phone'];
$Email = $_SESSION['Email'];


//echo $Images. "TEst";

if(!isset($login_user))
{
    header("Location: index");
}
//form_modal_confirm_logout
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if($_POST[btn_confirm_logout] == 'confirm_logout')
    {
        if(session_destroy())
        {
            header("Location: index");
        }
    }
 }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="images/broken__lodp.ico" rel="shortcut icon" />
    <title>Menu | BrokenSite</title>
 <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css"> 
  <!-- Pace style -->
  <link rel="stylesheet" href="plugins/pace/pace.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="main" class="navbar-brand ajax"><b>Broken</b>SITE</a>
        </div>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
           <ul class="nav navbar-nav">

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="uploads/<?php echo $_SESSION['Images']; ?>" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo $firstlast . $_SESSION['TechID'];?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="uploads/<?php echo $_SESSION['Images']; ?>" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $firstlast; ?> |  <b><i><?php echo $employeeID; ?></b></i>
                    <small><?php echo $date_time; ?></small>
                  </p>
                </li>
                <!-- Menu Body -->
              <!-- <li class="user-body"></li>  -->
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="profile" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a data-toggle="modal" data-target="#ModalConfirmLogout" class="btn btn-default btn-flat"> Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
        <div class="content-wrapper">
            <div class="container">
                <section class="content-header">
                    <h1>Menu
                        <small>v 2.4</small>
                    </h1>
                </section>
                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>O</h3>
                                    <p>Order</p>
                                </div>
                                <?php
                                if($status == 'Active')
                                {
                                ?>
                                <div class="icon">
                                   <a href="jobs" i class="ion ion-clipboard ajax"></i> </a>
                                </div>
                                <a href="jobs" class="small-box-footer ajax">Add Order <i class="fa fa-arrow-circle-right"></i></a>
                                 <?php
                                }else
                                {
                                ?>
                                <div class="icon">
                                    <a href="#" data-toggle="modal" data-target="#myModal" i class="ion ion-clipboard"></i> </a>
                                </div>
                                    <a href="#" data-toggle="modal" data-target="#myModal" class="small-box-footer">Add Order <i class="fa fa-arrow-circle-right"></i></a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>R<sup style="font-size: 20px"></sup></h3>
                                    <p>Report</p>
                                </div>
                                <?php
                                if($status == 'Active')
                                {
                                ?>
                                <div class="icon">
                                   <a href="report" i class="ion ion-printer ajax"></i> </a>
                                </div>
                                    <a href="report" class="small-box-footer ajax">View Report <i class="fa fa-arrow-circle-right"></i></a>
                                <?php
                                }else
                                {
                                ?>
                                <div class="icon">
                                    <a href="#" data-toggle="modal" data-target="#myModal" i class="ion ion-printer"></i> </a>
                                </div>
                                    <a href="#" data-toggle="modal" data-target="#myModal" class="small-box-footer">View Report<i class="fa fa-arrow-circle-right"></i></a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-maroon-active">
                                <div class="inner">
                                    <h3>P</h3>
                                    <p>Profile</p>
                                </div>
                                <?php
                                if($status == 'Active')
                                {
                                ?>
                                <div class="icon">
                                   <a href="profile" i class="ion-person ajax"></i> </a>
                                </div>
                                <a href="profile" class="small-box-footer ajax"> Profile <i class="fa fa-arrow-circle-right"></i></a>
                                <?php
                                }else
                                {
                                ?>
                                <div class="icon">
                                   <a href="#" data-toggle="modal" data-target="#myModal" i class="ion ion-gear-b"></i> </a>
                                </div>
                                <a href="#" data-toggle="modal" data-target="#myModal" class="small-box-footer"> Profile <i class="fa fa-arrow-circle-right"></i></a>
                                <?
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-teal-active">
                                <div class="inner">
                                    <h3>E</h3>
                                    <p>E-mail</p>
                                </div>
                                <?php
                                if($status == 'Active')
                                {
                                ?>
                                <div class="icon">
                                   <a href="https://www.bs.baanfaruk.com/roundcube/" target="_blank" i class="ion ion-email ajax"></i> </a>
                                </div>
                                <a href="https://www.bs.baanfaruk.com/roundcube/" target="_blank" class="small-box-footer ajax">E-mail <i class="fa fa-arrow-circle-right"></i></a>
                               <?php
                                }else
                                {
                                ?>
                                <div class="icon">
                                   <a href="#" data-toggle="modal" data-target="#myModal" target="_blank" i class="ion ion-email"></i> </a>
                                </div>
                                <a href="#" data-toggle="modal" data-target="#myModal" target="_blank" class="small-box-footer">E-mail <i class="fa fa-arrow-circle-right"></i></a>
                                <?php
                                }
                                ?>
                                
                            </div>
                        </div>
                    </div>


                    <div class="row">
                       <?php
                       if($Level == "Admin" || $Level == "Sup")
                       {
                       ?>                      
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-fuchsia-active">
                                <div class="inner">
                                    <h3>U</h3>
                                    <p>User</p>
                                </div>
                                <div class="icon">
                                   <a href="users" i class="ion ion-person-add ajax"></i> </a>
                                </div>
                                <a href="users" class="small-box-footer ajax">Add Users <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        
                         <?php
                        }
                        //{                        
                        ?>

                          <?php
                          if($Level == "Admin" )
                       {
                       ?>
                       <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>S</h3>
                                    <p>Statistics</p>
                                </div>
                                <div class="icon">
                                   <a href="#" i class="ion ion-stats-bars ajax"></i> </a>
                                </div>
                                <a href="#" class="small-box-footer ajax">Statistics <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                            <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <h3>T</h3>
                                    <p>Tools</p>
                                </div>
                                <div class="icon">
                                   <a href="#" i class="ion-wrench ajax"></i> </a>
                                </div>
                                <a href="#" class="small-box-footer ajax">Tools<i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <?php
                        }
                        ?>

                         <div class="col-lg-3 col-xs-6">
                              <div class="small-box bg-gray disabled color-palette">
                                <div class="inner">
                                    <h3>A</h3>
                                    <p>About</p>
                                </div>
                                <?php
                                if($status == 'Active')
                                {
                                ?>
                                <div class="icon">
                                   <a href="#" i class="ion-help ajax"></i> </a>
                                </div>
                                <a href="#" class="small-box-footer ajax">About <i class="fa fa-arrow-circle-right"></i></a>
                                 <?php
                                }else
                                {
                                ?>
                                <div class="icon">
                                   <a href="#" data-toggle="modal" data-target="#myModal" target="_blank" i class="ion-help"></i> </a>
                                </div>
                                <a href="#" data-toggle="modal" data-target="#myModal" target="_blank" class="small-box-footer">About <i class="fa fa-arrow-circle-right"></i></a>
                                <?php
                                }?>
                            </div>
                        </div>
                        
                       <?php
                       if($Level != "Admin" )
                       {
                       ?>
                          <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-navy color-palette">
                                <div class="inner">
                                    <h3>L</h3>
                                    <p>Logout</p>
                                </div>
                                <div class="icon">
                                   <a data-toggle="modal" data-target="#ModalConfirmLogout" i class="ion ion-log-out" href="#" ></i> </a>
                                </div>                          
                                <a data-toggle="modal" data-toggle="modal" href="#ModalConfirmLogout" class="small-box-footer"> Logout<i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                          <?php
                          if($Level == "Admin" )
                       {
                       ?>
                    <div class="row">
                         <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-navy color-palette">
                                <div class="inner">
                                    <h3>L</h3>
                                    <p>Logout</p>
                                </div>
                                <div class="icon">
                                   <a data-toggle="modal" data-target="#ModalConfirmLogout" i class="ion ion-log-out" href="#"></i> </a>
                                </div>
                                <a data-toggle="modal" data-target="#ModalConfirmLogout" class="small-box-footer" href="#"> Logout<i class="fa fa-arrow-circle-right"></i></a>                                
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </section>
                <!-- /.content -->
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
               <!--modal กรุณาชำระเงินก่อนเข้าใช้งานระบบ! -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="ModalDelete" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #286090">
                                <div style="color: white">
                                    <button type="button" style="color: white" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id=""> Message aleart</h4>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>กรุณาชำระเงินก่อนเข้าใช้งานระบบ!</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">                               
                                <button type="button" class="btn btn-default ajax" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                            </div>
                        </div>

                    </div>
                </div>
            <!--modal logout-->
            <form class="" action="main" name="form_modal_confirm_logout" method="POST">
                <div class="modal fade" id="ModalConfirmLogout" tabindex="-1" role="dialog" aria-labelledby="ModalDelete" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #286090">
                                <div style="color: white">
                                    <button type="button" style="color: white" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="">Logout</h4>

                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>You need to logout from the system ?</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" style="width: 20%" name="btn_confirm_logout" value="confirm_logout" class="btn btn-primary ajax"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Yes.</button>
                                <button type="submit" style="width: 20%" class="btn btn-default" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp; No.</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    <!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- PACE -->
<script src="bower_components/PACE/pace.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script type="text/javascript">
  // To make Pace works on Ajax calls
  $(document).ajaxStart(function () {
    Pace.restart()
  })
  $('.ajax').click(function () {
    $.ajax({
      url: '#', success: function (result) {
        $('.ajax-content').html('<hr>Ajax Request Completed !')
      }
    })
  })
</script>
</body>
</html>
