<?php
session_start();
include("config.php"); // incude �����������������¡��ҹ
$mysqli = connect();
date_default_timezone_set("Asia/Bangkok");

//load data from session.
$UID = $_SESSION['UID'];
$employeeID = $_SESSION['EmployeeID'];
$Name =     $_SESSION['Name'];
$Last =      $_SESSION['Last'];
$Level =     $_SESSION['Level'];
$date_time=    $_SESSION['Date_Time'];
$status =   $_SESSION['Status'];
$firstlast  =  $_SESSION['FirstLast'];
$entityNo =    $_SESSION['EntityNo'];
$BranchName =  $_SESSION['BranchName'];
$login_user = $_SESSION['login_user'];
$Username = $_SESSION['Username'];
$Password = $_SESSION['Password'];
$Dailywage = $_SESSION['Dailywage'];
$Phone = $_SESSION['Phone'];
$Email = $_SESSION['Email'];
$Images = $_SESSION['Images'];


if(!isset($login_user))
{
    header("Location: index");
}
//form_modal_confirm_logout
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if($_POST["btn_confirm_logout"] == 'confirm_logout')
    {
        if(session_destroy())
        {
            header("Location: index");
        }
    }
}
//search data from db.
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    if($_POST["btn_save_edit"] == 'save_edit_action')
    {
        $UID = $_POST['txbUID'];
        $Username = $_POST['txbUsername'];
        $Password = $_POST['txbPassword'];
        $Name= $_POST['txbFirstName'];
        $Last = $_POST['txbLastName'];
        $Phone = $_POST['txbPhone'];
        $Email = $_POST['txbEmail'];
        $Dailywage = $_POST['txbDailywage'];


        $Images = $_FILES['fileupload']['name'];
        if(!empty($Images))
        {
            move_uploaded_file($_FILES["fileupload"]["tmp_name"],"uploads/".$_FILES["fileupload"]["name"]);

            //$Msg_action = "Copy/Upload Complete";
            $sql_2 = "UPDATE users SET UserName='$Username',Password = '$Password',FirstName = '$Name',LastName='$Last',Phone='$Phone',Email='$Email',Dailywage='$Dailywage',Images='$Images' WHERE UID ='$UID'";
            $qr2 = query($sql_2);
            //set new session.
            //if(isset($_FILES["fileupload"]) and !empty($_FILES["fileupload"]))
            //{
                $_SESSION['Images'] = $Images;
               $ImageName=$_SESSION['Images'];
            //}

            $_SESSION['txbUsername'] = $Username;
            $_SESSION['txbPassword'] = $Password;
            $_SESSION['txbName'] =$Name;
            $_SESSION['txbName'] = $Last;
            $_SESSION['txbPhone'] = $Phone;
            $_SESSION['txbEmail'] = $Email;
            $_SESSION['txbDailywage'] = $Dailywage;
            //message alert.
            $Msg_action = "<div id='ohsnap'></div> <script> $(function(){ ohSnap('สำเร็จ! อัปโหลดไฟล์เรียบร้อย', {color: 'success'});	});	</script>";

            //$Msg = 'Data: '.$_SESSION['Images'];
            //$Msg_action = "<div id='ohsnap'></div> <script> $(function(){ ohSnap('มีไฟล์', {color: 'success'});	});	</script>";
        }else{

            $sql_1 = "UPDATE users SET UserName='$Username',Password = '$Password',FirstName = '$Name',LastName='$Last',Phone='$Phone',Email='$Email',Dailywage='$Dailywage' WHERE UID ='$UID'";
            $qr1 = query($sql_1);

            //set new session.
            $_SESSION['txbFirstName'] = $FirstName;
            $_SESSION['txbUsername'] = $Username;
            $_SESSION['txbPassword'] = $Password;
            $_SESSION['txbName'] =$Name;
            $_SESSION['txbLast'] = $Last;
            $_SESSION['txbPhone'] = $Phone;
            $_SESSION['txbEmail'] = $Email;
            $_SESSION['txbDailywage'] = $Dailywage;

            $Msg_action = "<div id='ohsnap'></div> <script> $(function(){ ohSnap('สำเร็จ! แก้ไขข้อมูลเรียบร้อย', {color: 'info'});	});	</script>";
        }



        //$Images = $_FILES['fileupload']['name'];
        //if(isset($_FILES["fileupload"]))
        //{
        //        $Images = $_FILES['fileupload']['name'];
        //        if(!empty($Images) and empty($_FILES['fileupload']))
        //        {

        //            move_uploaded_file($_FILES["fileupload"]["tmp_name"],"uploads/".$_FILES["fileupload"]["name"]);

        //            //$Msg_action = "Copy/Upload Complete";
        //            $sql_2 = "UPDATE users SET UserName='$Username',Password = '$Password',FirstName = '$Name',LastName='$Last',Phone='$Phone',Email='$Email',Dailywage='$Dailywage',Images='$Images' WHERE UID ='$UID'";
        //            $qr2 = query($sql_2);
        //            //set new session.
        //            //if(isset($_FILES["fileupload"]) and !empty($_FILES["fileupload"]))
        //            //{
        //            //    $_SESSION['Images'] = $Images;
        //            //    $ImageName=$_SESSION['Images'];
        //            //}

        //            $_SESSION['txbUsername'] = $Username;
        //            $_SESSION['txbPassword'] = $Password;
        //            $_SESSION['txbName'] =$Name;
        //            $_SESSION['txbName'] = $Last;
        //            $_SESSION['txbPhone'] = $Phone;
        //            $_SESSION['txbEmail'] = $Email;
        //            $_SESSION['txbDailywage'] = $Dailywage;
        //            //message alert.
        //            $Msg_action = "<div id='ohsnap'></div> <script> $(function(){ ohSnap('สำเร็จ! อัปโหลดไฟล์เรียบร้อย', {color: 'success'});	});	</script>";
        //        }
        ////else{

        //        ////message alert.
        //        ////$_SESSION['Images'] = $ImageName;
        //        //$Msg_action = "<div id='ohsnap'></div> <script> $(function(){ ohSnap('ผิดพลาด! ไม่สามารถอัปโหดลได้', {color: 'danger'});	});	</script>";
        //        //}

        //}else
        //{
        //    $sql_1 = "UPDATE users SET UserName='$Username',Password = '$Password',FirstName = '$Name',LastName='$Last',Phone='$Phone',Email='$Email',Dailywage='$Dailywage' WHERE UID ='$UID'";
        //    $qr1 = query($sql_1);

        //    //set new session.
        //    $_SESSION['txbFirstName'] = $FirstName;
        //    $_SESSION['txbUsername'] = $Username;
        //    $_SESSION['txbPassword'] = $Password;
        //    $_SESSION['txbName'] =$Name;
        //    $_SESSION['txbLast'] = $Last;
        //    $_SESSION['txbPhone'] = $Phone;
        //    $_SESSION['txbEmail'] = $Email;
        //    $_SESSION['txbDailywage'] = $Dailywage;
        //    //message alert.
        //    $Msg_action = "<div id='ohsnap'></div> <script> $(function(){ ohSnap('สำเร็จ! แก้ไขข้อมูลเรียบร้อย', {color: 'info'});	});	</script>";
        //    //message alert.
        //    //$_SESSION['Images'] = $ImageName;
        //    //$Msg_action = "<div id='ohsnap'></div> <script> $(function(){ ohSnap('ผิดพลาด! ไม่สามารถอัปโหดลได้', {color: 'danger'});	});	</script>";

        //}


    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="images/broken__lodp.ico" rel="shortcut icon" />
    <title>Profile | BrokenSite</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css" />
    <!-- Pace style -->
    <link rel="stylesheet" href="plugins/pace/pace.min.css" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
    <!--datepicker-->
    <link rel="stylesheet" href="bower_components/jquery-ui/themes/base/jquery-ui.css" />

    <link rel="stylesheet" href="code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="resources/demos/style.css" />

    <script src="js/ohsnap.js"></script>

    <!--datepicker-->
    <link rel="stylesheet" href="/code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="/resources/demos/style.css" />
    <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>-->

    <!------------ Including  jQuery Date UI with CSS -------------->
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

</head>

<body class="hold-transition skin-green sidebar-collapse sidebar-mini">
<!-- <body class="hold-transition skin-blue fixed sidebar-mini">  -->
    <!-- Site wrapper -->
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="main" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">
                    <b>B</b>S
                </span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">
                    <b>Broken</b>SITE
                </span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="uploads/<?php echo $Images; ?>" class="user-image" alt="User Image" />
                                <span class="hidden-xs">
                                    <?php  echo $Name.' ' .$Last;  ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="uploads/<?php echo $Images; ?>" class="img-circle" alt="User Image" />

                                    <p>
                                        <?php echo $Name.' ' .$Last; ?> |  <b><i><?php echo $employeeID; ?></b></i>
                                        <small>
                                            <?php echo $date_time;  ?>
                                        </small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                               <!-- <li class="user-body"></li> -->
                                <!-- Menu Footer-->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="profile" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a data-toggle="modal" data-target="#ModalConfirmLogout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- =============================================== -->
        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            
            <section class="sidebar">
              
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="uploads/<?php echo $_SESSION['Images']; ?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>
                            <?php echo $Name.' ' .$Last; ?>
                        </p>
                        <a href="#">
                            <i class="fa fa-circle text-success"></i>Online
                        </a>
                    </div>
                </div>
                
               <ul class="sidebar-menu">
                    <ul class="sidebar-menu">
                        <li class="header">LIST MENU</li>
                        <li class="">
                            <a href="main">
                                <i class="fa fa-home"></i>
                                <span>Menu</span>
                                <i class=""></i>
                            </a>
                        </li>
                        <li class="">
                            <a href="jobs">
                                <i class="fa fa-file"></i>
                                <span>Job</span>
                                <i class=""></i>
                            </a>
                        </li>
                        <li class="">
                            <a href="report">
                                <i class="fa fa-print"></i>
                                <span>Report</span>
                                <i class=""></i>
                            </a>
                        </li>
                        <li class="active">
                            <a href="profile">
                                <i class="fa fa-user text-aqua"></i>
                                <span>Profile</span>
                                <i class=""></i>
                            </a>
                        </li>
                         <?php
                        if($Level == "Sup")
                        {
                        ?>
                        <li class="">
                            <a href="users">
                                <i class="fa fa-user-plus"></i>
                                <span>Users</span>
                                <i class=""></i>
                            </a>
                        </li>
                        <?php
                        }
                        ?>  
                        <?php
                        if($Level == "Admin"  || $level == "Sup")
                        {
                        ?>
                        <li class="">
                            <a href="users">
                                <i class="fa fa-user-plus"></i>
                                <span>Users</span>
                                <i class=""></i>
                            </a>
                        </li>                      
                        <?php
                        }
                        ?>
                        <?php
                        if($Level == "Admin")
                        {
                        ?>
                         <li class="">
                            <a href="#">
                                <i class="fa fa-bar-chart "></i>
                                <span>Statistics</span>
                                <i class=""></i>
                            </a>
                        </li>
                        <li class="">
                            <a href="#">
                                <i class="fa fa-wrench"></i>
                                <span>Tools</span>
                                <i class=""></i>
                            </a>
                        </li>
                        <?php
                        }
                        ?>
                        <li class="">
                            <a href="#">
                                <i class="fa fa-question"></i>
                                <span>About</span>
                                <i class=""></i>
                            </a>
                        </li>
                        <li class="">
                            <a data-toggle="modal" href="#ModalConfirmLogout">
                                <i class="fa fa-sign-out"></i>
                                <span>Logout</span>
                                <i class=""></i>
                            </a>
                        </li>
                    </ul>
                </ul>
            </section>
        </aside> 

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
                     <section class="content-header">
                             <h1>
                              User Profile
                              <small>Preview page</small>
                             </h1>
                             <ol class="breadcrumb">
                             <li><a href="main"><i class="fa fa-home"></i> Home</a></li>
                             <li class="active">Profile</li>
                            </ol>
                     </section> 
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                
                            </div>
                            <form action="profile" method="post" enctype="multipart/form-data" id="uploadForm">
                                <div class="box-body">
                                    <!--<div class="row">-->
                                    <div class="col-md-4">
                                        <div class="row" style="height:280px;">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <!--images-->
                                                <input type="file" id="imgInp" name="fileupload" multiple />
                                                <div style="height:10px;"></div>
                                                <!--<div id="thumb-output"></div>-->
                                                <img id="image" src="uploads/<?php echo $_SESSION['Images']; ?>" style="width:250px; height:250px" class="img-thumbnail" />
                                            </div>
                                        </div>
                                        <div style="height:10px;"></div>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label>Name file</label>
                                                    <input type="text" readonly="readonly" name="txbImageName" value="<?php echo $_SESSION['Images']; ?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <!--<div class="col-md-1"></div>-->
                                          <div class="col-md-6">
                                                <div class="form-group-lg">
                                                  <!--  <label for="exampleInputEmail1">UID</label>
                                                    <input type="text" name="txbUID" readonly="readonly" value="<?php echo $UID; ?>" class="form-control" placeholder="UID" />
                                                -->
                                                <label for="exampleInputEmail1">Entity No</label>
                                                    <input type="text" name="txbentityNo" readonly="readonly" value="<?php echo $entityNo; ?>" class="form-control" placeholder="Entity No" />
                                                </div>
                                            </div>
                                            

                                            <div class="col-md-6">
                                                <div class="form-group-lg">
                                                    <label for="exampleInputPassword1">EmployeeID</label>
                                                    <input type="text" name="txbEmployeeID" readonly="readonly" value="<?php echo $employeeID; ?>" class="form-control" placeholder="EmployeeID" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!--<div class="col-md-1"></div>-->
                                            <div class="col-md-6">
                                                <div class="form-group-lg">
                                                    <label for="exampleInputEmail1">Username</label>
                                                    <input type="text" name="txbUsername" class="form-control" value="<?php echo $Username; ?>" placeholder="Username" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group-lg">
                                                    <label for="exampleInputPassword1">Password</label>
                                                    <input type="text" name="txbPassword" class="form-control" value="<?php echo $Password; ?>" placeholder="Password" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!--<div class="col-md-1"></div>-->
                                            <div class="col-md-6">
                                                <div class="form-group-lg">
                                                    <label for="exampleInputEmail1">First Name</label>
                                                    <input type="text" name="txbFirstName" class="form-control" value="<?php echo $Name; ?>" placeholder="First Name" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group-lg">
                                                    <label for="exampleInputPassword1">Last Name</label>
                                                    <input type="text" name="txbLastName" class="form-control" value="<?php echo $Last; ?>" placeholder="Last Name" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!--<div class="col-md-1"></div>-->
                                            <div class="col-md-6">
                                                <div class="form-group-lg">
                                                    <label for="exampleInputEmail1">E-mail</label>
                                                    <input type="text" name="txbEmail" class="form-control" value="<?php echo $Email; ?>" placeholder="E-mail" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group-lg">
                                                    <label for="exampleInputPassword1">Phone</label>
                                                    <input type="text" name="txbPhone" class="form-control" value="<?php echo $Phone; ?>" placeholder="Phone" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!--<div class="col-md-1"></div>-->
                                            <div class="col-md-6">
                                                <div class="form-group-lg">
                                                    <label for="exampleInputPassword1">Create Date</label>
                                                    <input type="text" name="txbCreateDate" readonly="readonly" class="form-control" value="<?php echo $date_time; ?>" placeholder="Create Date" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group-lg">
                                                    <label for="exampleInputEmail1">Leve</label>
                                                    <input type="text" name="txbLevel" readonly="readonly" class="form-control" value="<?php echo $Level; ?>" placeholder="Level" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group-lg">
                                                    <label for="exampleInputEmail1">Daily Wage</label>
                                                    <input type="text" name="txbDailywage" class="form-control" value="<?php echo $Dailywage; ?>" placeholder="Daily wage" required />
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <!--</div>-->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                   <button type="submit" class="btn btn-default pull-right">
                                        <span class="glyphicon glyphicon-share-alt"></span>&nbsp;Reply
                                    </button>
                                    <button type="submit" name="btn_save_edit" value="save_edit_action" class="btn btn-primary pull-right">
                                        <span class="glyphicon glyphicon-ok"></span>&nbsp;Save
                                    </button>
                                    <!--<button type="submit" name="btn_save_edit" style="width:10%" value="save_edit_action" class="btn btn-primary pull-left btn-flat">
                                            <span class="glyphicon glyphicon-saved"></span>Save
                                        </button>-->
                                    <!--                                        <button type="button" class="col-sm-1 btn btn-default fa fa-close" data-dismiss="modal">Close</button>-->
                                    <!--</div>-->
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </div>

    
    <!--modal logout-->
    <form class="" action="profile" name="form_modal_confirm_logout" method="POST">
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
                        <button type="submit" style="width: 20%" name="btn_confirm_logout" value="confirm_logout" class="btn btn-primary">
                            <span class="glyphicon glyphicon-log-out"></span>&nbsp; Ok
                        </button>
                        <button type="submit" style="width: 20%" class="btn btn-default" class="close" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span>&nbsp; Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Message alert -->
    <div clase="row">
        <?php echo $Msg_action; ?>
    </div>
    <footer class="main-footer">
            <strong>Copyright &copy; 2016-<?php echo date("Y");?> Rosaree Doloh (R570168)</strong>&nbsp;All rights reserved. &nbsp; | &nbsp; <i><?php echo "Today is " . date("l"); ?>&nbsp;<?php echo "". date("Y-m-d"); ?>&nbsp; | &nbsp; <?php echo "" . date("h:i:s A");?> </i>
            <div class="pull-right hidden-xs">
              <b>Version</b> 2.4   
            </div>
        </footer>
    <!-- ./wrapper -->
    <style>
        .thumb {
            margin: 10px 5px 0 0;
            width: 250px;
        }
    </style>

    <!--script preview image-->
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
        });
    </script>


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


    <!--alert popup-->
    <script>
        function ohSnap(text, options) {
            var defaultOptions = {
                'color': null,     // color is  CSS class `alert-color`
                'icon': 'icon fa fa-warning',     // class of the icon to show before the alert text
                'duration': '7000',   // duration of the notification in ms
                'container-id': 'ohsnap', // id of the alert container
                'fade-duration': 'fast',  // duration of the fade in/out of the alerts. fast, slow or integer in ms
            }

            options = (typeof options == 'object') ? $.extend(defaultOptions, options) : defaultOptions;

            var $container = $('#' + options['container-id']),
                icon_markup = "",
                color_markup = "";

            if (options.icon) {
                icon_markup = "<span class='" + options.icon + "'></span> ";
            }

            if (options.color) {
                color_markup = 'alert-' + options.color;
            }

            // Generate the HTML
            var html = $('<div class="alert ' + color_markup + '">' + icon_markup + text + '</div>').fadeIn(options['fade-duration']);

            // Append the label to the container
            $container.append(html);

            // Remove the notification on click
            html.on('click', function () {
                ohSnapX($(this));
            });

            // After 'duration' seconds, the animation fades out
            setTimeout(function () {
                ohSnapX(html);
            }, options.duration);
        }

        /* Removes a toast from the page
         * params:
         *    Called without arguments, the function removes all alerts
         *    element: a jQuery object to remove
         *    options:
         *      duration: duration of the alert fade out - 'fast', 'slow' or time in ms. Default 'fast'
         */
        function ohSnapX(element, options) {
            defaultOptions = {
                'duration': 'fast'
            }

            options = (typeof options == 'object') ? $.extend(defaultOptions, options) : defaultOptions;

            if (typeof element !== "undefined") {
                element.fadeOut(options.duration, function () {
                    $(this).remove();
                });
            } else {
                $('.alert').fadeOut(options.duration, function () {
                    $(this).remove();
                });
            }
        }
    </script>

    <style>
        .alert {
            padding: 15px;
            margin-bottom: 22px;
            border: 1px solid #eed3d7;
            border-radius: 4px;
            position: absolute;
            bottom: 30px;
            right: 0px;
            font-size: 16px;
            /* Each alert has its own width */
            float: right;
            clear: right;
            background-color: white;
        }

        .alert-red {
            color: white;
            background-color: #DA4453;
        }

        .alert-green {
            color: white;
            background-color: #37BC9B;
        }

        .alert-blue {
            color: white;
            background-color: #4A89DC;
        }

        .alert-yellow {
            color: white;
            background-color: #F6BB42;
        }

        .alert-orange {
            color: white;
            background-color: #E9573F;
        }
    </style>

</body>
</html>
