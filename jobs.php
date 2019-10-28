 <?php
session_start();
include("config.php"); // incude ครั้งเดียวในไฟล์ที่เรียกใช้งาน
$mysqli = connect();
date_default_timezone_set("Asia/Bangkok");
//load data from session.
$employeeID = $_SESSION['EmployeeID'];
$last=      $_SESSION['Last'];
$name =     $_SESSION['Name'];
$level=     $_SESSION['Level'];
$date_time=    $_SESSION['Date_Time'];
$status =   $_SESSION['Status'];
//
$firstlast  =  $_SESSION['FirstLast'];
$entityNo =    $_SESSION['EntityNo'];
$branchName =  $_SESSION['BranchName'];
$login_user= $_SESSION['login_user'];
$techid = $_SESSION['TechID'];


if(!isset($login_user))
{
    header("Location: index");
}
    //form_modal_confirm_logout
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if($_POST["btn_confirm_logout"] == "confirm_logout")
    {
        header("Location: index");
    }
}

//insert data from modal.
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if($_POST["btn_save"] == "save_action")
    {
        $CreateDate_ = $_POST['txbdatejobinsert']; 
        $SO_ = $_POST['txbSO']; 
        $Company_ = $_POST['txbCompany']; 
        $Model_    = $_POST['txbModel']; 
        $TypePM_    = $_POST['txbType']; 
        $PricePM_   = $_POST['txbPrice']; 
        $GPS = $_POST["cbGPS"];
        $Survey = $_POST["cbSurvey"];
        $Appoint = $_POST["cbAppoint"];

        $values = $GPS;

        //search SO before add to database!
        $sql ="SELECT UID FROM orderjob WHERE SO = '$SO_'";
        $qr=select($sql);
        $row_=$qr[0];
        if($row_ == 0)
        {
            //check cctv in today.
            $sql_check ="SELECT UID FROM orderjob WHERE CreateDate = '$CreateDate_' AND TypePM = 'CCTV' AND EmployeeID = '$employeeID'";
            $qr_check=select($sql_check);
            $row_check= $qr_check[0];
            if($row_check > 0)
            {
                if($TypePM_ == "CCTV")
                {
                    $PricePM_ = 0;
                }
            }

            $sql_insert = "INSERT INTO orderjob(SO,Company,Model,TypePM,PricePM,EmployeeID,CreateDate,Date_Time,EntityNo,GPS,Survey,Appoint) VALUES ";
            $sql_insert .= "('$SO_', '$Company_', '$Model_','$TypePM_','$PricePM_','$employeeID','$CreateDate_',NOW(),'$entityNo','$GPS','$Survey','$Appoint')";
            $qr_insert = query($sql_insert);
            
            //message alert.
            $Msg_action = "<div id='ohsnap'></div> <script> $(function(){ ohSnap('สำเร็จ! เพิ่มข้อมูลเรียบร้อย', {color: 'success'});   }); </script>";

        }
        else
        {
            //message alert.
         $Msg_action = "<div id='ohsnap'></div> <script> $(function(){ ohSnap('ไม่สำเร็จ! ไม่สามารถเพิ่มข้อมูลได้', {color: 'warning'});    }); </script>";

     }
 }
}
 //echo $TypePM_;
//update data from modal.
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if($_POST["btn_edit"] == "edit_action")
    {
        $CreateDate_ = $_POST['txbdatejobedit']; 
        $SO_ = $_POST['txbSOEdit']; 
        $Company_ = $_POST['txbCompanyEdit']; 
        $TypePM_    = $_POST['txbTypeEdit']; 
        $Model_    = $_POST['txbModelEdit']; 
        $PricePM_    = $_POST['txbPriceEdit']; 
        $UID_ = $_POST['txbId'];
        $GPS = $_POST["cbGPS"];
        $Survey = $_POST["cbSurvey"];
        $Appoint = $_POST["cbAppoint"];

        //check cctv in today.
        $sql_check ="SELECT UID FROM orderjob WHERE CreateDate = '$CreateDate_' AND TypePM = 'CCTV' AND EmployeeID = '$employeeID'";
        $qr_check=select($sql_check);
        $row_check= $qr_check[0];
        if($row_check > 0)
        {
            if($TypePM_ == "CCTV")
            {
                $PricePM_ = 0;
            }
        }
        //sql update database.
        $sql_update = "UPDATE orderjob SET SO = '$SO_',Company = '$Company_',Model = '$Model_',TypePM='$TypePM_',PricePM= '$PricePM_',CreateDate = '$CreateDate_'";
        $sql_update .= ",GPS = '$GPS',Survey = '$Survey',Appoint = '$Appoint' WHERE UID = '$UID_'";
        $qr_update = query($sql_update);
        $Msg_action = "Edit complete.";

        $Msg_action = "<div id='ohsnap'></div> <script> $(function(){ ohSnap('สำเร็จ! แก้ไขข้อมูลเรียบร้อย', {color: 'success'});   }); </script>";
    }
}

//delete data from modal.
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if($_POST["btn_delete"] == "delete_action")
    {

        $delete_id =   $_POST['delete_id'];

        $sql_delete="DELETE FROM orderjob WHERE UID = '$delete_id'";
        $qr_delete = query($sql_delete);

        //$sql_query = "SELECT * FROM orderjob where  EmployeeID ='$employeeID'  ORDER BY UID DESC LIMIT 10";
        //$qr_query = select($sql_query);
        //$total=count($qr_query);  // จำนวนรายการทั้งหมด ที่ select
      //$i=0;
        //message alert.
        $Msg_action = "<div id='ohsnap'></div> <script> $(function(){ ohSnap('สำเร็จ! ลบข้อมูลเรียบร้อย', {color: 'danger'});   }); </script>";
    }
}

//search data from db.
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if($_POST["btn_searchall"] == "searchall_action")
    {
        if($_POST["txbSearch"] != "")
        {
            $txtsearch =    $_POST['txbSearch'];
            //echo $txtsearch;

            //$sql_ = "SELECT * FROM orderjob WHERE EmployeeID = '$employeeID' AND (SO = '$txtsearch' OR Company LIKE 'เทเลคอป' OR CreateDate LIKE '%$txtsearch') ORDER BY UID DESC LIMIT 7";
            $sql_select = "SELECT * FROM orderjob WHERE EmployeeID = '$employeeID' AND (Company LIKE '%$txtsearch%' OR CreateDate LIKE  '%$txtsearch%' OR SO = '$txtsearch' ) ORDER BY UID DESC LIMIT 6";
            $qr_query = select($sql_select);
            $total=count($qr_query);  // จำนวนรายการทั้งหมด ที่ select
            $i=0;
            //message alert.
            $Msg_action = "<div id='ohsnap'></div> <script>  $(function(){ ohSnap('สำเร็จ! ค้นหาข้อมูลเรียบร้อย', {color: 'info'}); });   </script>";
        }
    }
}

        $sql_query = "SELECT * FROM orderjob where  EmployeeID ='$employeeID'  ORDER BY UID ASC";
        $qr_query = select($sql_query);
        $total=count($qr_query);  // จำนวนรายการทั้งหมด ที่ select
        $i=0;
        ?> 
        <!DOCTYPE html>
        <html>
        <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">

          <link href="images/broken__lodp.ico" rel="shortcut icon">
          <title>Jobs | BrokenSite</title>
          <!-- Tell the browser to be responsive to screen width -->
          <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
          <!-- Bootstrap 3.3.7 -->
          <link rel="stylesheet" href="./bower_components/bootstrap/dist/css/bootstrap.min.css">
          <!-- Font Awesome -->
          <link rel="stylesheet" href="./bower_components/font-awesome/css/font-awesome.min.css">
          <!-- Ionicons -->
          <link rel="stylesheet" href="./bower_components/Ionicons/css/ionicons.min.css">
          <!-- DataTables -->
          <link rel="stylesheet" href="./bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
          <!-- Theme style -->
          <link rel="stylesheet" href="./dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="./dist/css/skins/_all-skins.min.css">
   <!-- Pace style -->
   <link rel="stylesheet" href="./plugins/pace/pace.min.css">
   <!-- bootstrap datepicker -->
   <link rel="stylesheet" href="./bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
   <!--datepicker-->
   <link rel="stylesheet" href="./bower_components/jquery-ui/themes/base/jquery-ui.css">
<!-- 
   <link rel="stylesheet" href="code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
   <link rel="stylesheet" href="resources/demos/style.css"> -->

   <!-- <script src="js/ohsnap.js"></script> -->
   <script src="js/jquery_.js"></script>
   <script src="js/jquery_ui.js"></script>




   <!--datepicker-->
<!--    <link rel="stylesheet" href="/code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">-->
    <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>-->

        <!------------ Including  jQuery Date UI with CSS -------------->
        <!-- <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"> -->
        <!-- </script> -->


        <!-- Google Font -->
        <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
    </head>
    <!-- ADD THE CLASS sidebar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
    <body class="hold-transition skin-green sidebar-collapse sidebar-mini">
        <!-- <body class="hold-transition skin-blue fixed sidebar-mini">  -->
            <div class="wrapper">

                <header class="main-header">
                    <!-- Logo -->
                    <a href="main" class="logo">
                        <!-- mini logo for sidebar mini 50x50 pixels -->
                        <span class="logo-mini"><b>B</b>S</span>
                        <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg"><b>Broken</b>SITE</span>
                    </a>
                    <!-- Header Navbar: style can be found in header.less -->
                    <nav class="navbar navbar-static-top">
                        <!-- Sidebar toggle button-->
                        <!--  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> -->
                            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" class="active">
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
                                            <img src="uploads/<?php echo $_SESSION['Images']; ?>" class="user-image" alt="User Image">
                                            <span class="hidden-xs"><?php echo $firstlast ?></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <!-- User image -->
                                            <li class="user-header">
                                                <img src="uploads/<?php echo $_SESSION['Images']; ?>" class="img-circle" alt="User Image">

                                                <p><?php echo $firstlast ?> |  <b><i><?php echo $employeeID; ?></b></i>
                                                    <small><?php echo $date_time;  ?></small>
                                                </p>
                                            </li>
                                            <!-- Menu Body -->
                                            <!-- <li class="user-body"></li> -->
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
                    <!-- Left side column. contains the sidebar -->
                    <aside class="main-sidebar">
                        <!-- sidebar: style can be found in sidebar.less -->
                        <section class="sidebar">
                            <!-- Sidebar user panel -->
                            <div class="user-panel">
                                <div class="pull-left image">
                                    <img src="uploads/<?php echo $_SESSION['Images']; ?>" class="img-circle" alt="User Image" />
                                </div>
                                <div class="pull-left info">
                                    <p>
                                        <?php echo $firstlast;?>
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
                                    <li class="active">
                                        <a href="jobs">
                                            <i class="fa fa-file text-aqua"></i>
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
                                    <li class="">
                                        <a href="profile">
                                            <i class="fa fa-user"></i>
                                            <span>Profile</span>
                                            <i class=""></i>
                                        </a>
                                    </li>
                                    <?php
                                    if($level == "Admin"  || $level == "Sup")
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
                                    if($level == "Admin")
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
                    <!-- =============================================== -->
                    <!-- Content Wrapper. Contains page content -->
                    <div class="content-wrapper">   
                     <!-- Content Header (Page header) -->
                     <section class="content-header">
                             <h1>
                              Jobs All
                              <small>Preview page</small><?php echo 'show'.$_SESSION['TechID']; ?>
                             </h1>
                             <ol class="breadcrumb">
                             <li><a href="main"><i class="fa fa-home"></i> Home</a></li>
                             <li class="active">Jobs</li>
                             
                            </ol>
                        
                         <div class="row">
                                    <div class="col-md-2">
                                    <button class="btn btn btn-success btn-flat" style="font-size:14px;"  data-toggle="modal" data-target="#ModalNewOrder"><span class="glyphicon glyphicon-plus">&nbsp; </span>New Job</button>
                                    </div>                                       
                         </div>
                   </section> 

                    <!-- <div style="height:10px"></div> -->
                     <!-- Main content -->
                  <!--   <section class="content">
                        <div class="row">
                            <div class="col-xs-12">
                            <div class="box box-primary">

                               
                                <div class="box-body">
                                    <div class="col-xs-12">
                                        <div style="overflow-x:auto;" class="col-xs-12">
                                          <table id="example2" class="table table-hover"> 
                                            	<table id="example2" class="table table-bordered table-hover">
                                                <thead> 
                                                -->
                                                  <!-- Main content -->
     <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-body">
            <div style="overflow-x:auto;" class="col-md-12">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                                                 <tr style="background-color:#3c8cba; color:white">
                                                    <th style="text-align: center;width:;">No3</th>
                                                    <th style="text-align: center;width:;">SoNo</th>
                                                    <th style="text-align: center;width:;">Date</th>
                                                    <th style="text-align: center;width:;">Company</th>
                                                    <th style="text-align: center;width:;">Model</th>
                                                    <th style="text-align: center;width:;">Type</th>
                                                    <th style="text-align: center;width:;"></th>
                                                    <th style="text-align: center;width:;">Price</th>
                                                    <th style="text-align: center;width:;">Command</th>
                                                </tr>
                                            </thead>
                                            <?php   
                                            $i = 0;
                                            while($i<count($qr_query))
                                            {
                                                $row11=$qr_query[$i];
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td style="text-align:center;">
                                                        <?php echo $i;?>.
                                                    </td>
                                                    <td style="text-align: center">
                                                      <b><?php echo $row11["SO"];?></b>
                                                  </td>
                                                  <td style="text-align: center;">
                                                      <b>  <?php echo $row11["CreateDate"];?> </b>
                                                  </td>
                                                  <td style="text-align: center;">
                                                    <?php echo $row11["Company"];?>
                                                </td>
                                                <td style="text-align: center">
                                                    <?php echo $row11["Model"];?>
                                                </td>
                                                <td style="text-align: center">
                                                    <?php echo $row11["TypePM"];?>    
                                                </td>
                                                <td style="text-align: center">
                                                    <?php echo  RoutineChk($row11["GPS"],"GPS");?>                                             
                                                    <?php echo  RoutineChk($row11["Survey"],"Survey");?>   
                                                    <?php echo  RoutineChk($row11["Appoint"],"Appoint");?>        
                                               </td> 
                                                <td style="text-align: right"><b><i>
                                                    <?php echo $row11["PricePM"];?>.00</i></b>&nbsp;<img src="images/thai-baht-svgrepo-com.svg" width="20" height="20">
                                                </td>
                                                <td style="text-align: center;" class="form-inline">
                                                    <!--<button class="btn btn-primary fa-trash-o" data-toggle="modal" data-target="">Delete</button>-->
                                                    <button data-toggle="modal"  href="#ModalDelete" onClick="pupup_confirmdelete('<?php echo $row11['UID'];  ?>')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                                    <button data-toggle="modal"  href="#ModalEditOrder" class="btn btn-warning" onClick="pop_up('<?php echo $row11['UID']; ?>','<?php echo $row11['SO']; ?>','<?php echo $row11['Company']; ?>','<?php echo $row11['Model']; ?>','<?php echo $row11['TypePM']; ?>','<?php echo $row11['PricePM']; ?>','<?php echo $row11['CreateDate']; ?>','<?php echo $row11["GPS"]; ?>','<?php echo $row11["Survey"];?>','<?php echo $row11["Appoint"]; ?>')"><span class="glyphicon glyphicon-edit"></span></button>
                                                    <a href="printreport?Createdate=<?php echo $row11["CreateDate"]; ?>" target="_blank">
                                                        <button type="submit" data-toggle="modal"  class="btn btn-info ajax"><span class="glyphicon glyphicon-print"></span></button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                            }  
                                            ?>
                                    </table>
                                </div>
                                </div>
                             </div> 
                         </div>
                      </div>
             </section>
        <!-- /.content -->

        <!-- Message alert -->
        <div clase="row">
          <?php echo $Msg_action; ?>
      </div>

      <!--modal new jobs.-->
      <form action="jobs" name="form_modal_insert1" method="post" class="eventInsForm">
        <div class="modal fade" id="ModalNewOrder" tabindex="-1" role="dialog" aria-labelledby="NewOrder" aria-hidden="true" data-backdrop="static">>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #286090">
                        <div style="color: white">
                            <button type="button" style="color: white" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title" id=""> New Order</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group-lg">
                                        <label>Create Date</label>
                                        <div>
                                            <input type="text" name="txbdatejobinsert" autocomplete="off" class="form-control" id="DateCreate_id" placeholder="yyyy-mm-dd" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-lg">
                                        <label for="text">SO No</label>
                                        <input type="text" name="txbSO" class="form-control" autocomplete="off" id="txbSO" placeholder="SO" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group-lg">
                                        <label for="text">Company</label>
                                        <input type="text" id="txbCompanyInsert_id" name="txbCompany" placeholder="Company" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-lg">
                                        <label for="text">Model</label>
                                        <input type="text" id="txbModelInsert_id" name="txbModel" placeholder="Model" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-5">
                                    <div class="form-group-lg">
                                        <label for="text">Type PM</label>
                                       <?php 
                                       if($entityNo != "0102521")
                                        {
                                            ?> 
                                            <!-- ตาราง BSV / BOON -->
                                    <select name="item_value" onChange="resultName(this.value);" id="" class="form-control">
                                            <option></option>
                                            <optgroup label="Special Job Assignment | Ped day">
                                                 <option value="All-activity|480">All activity</option>
                                            </optgroup>    
                                            <optgroup label="Installation MFP/ LP | HW | SW | Training">    
                                                 <option value="INST-HW-S1-2|119">MFP/LP HW-S1-2</option>
                                                 <option value="INST-HW-S3-4|178">MFP/LP HW-S3-4</option>
                                                 <option value="INST-SW-Driver-Unit|">SW-Driver-Unit</option>
                                                 <option value="INST-SW-Payment1BMin|">SW(1 Baht/ Min.)</option>
                                                 <option value="INST-SW-Training1BMin|">Training(1 Baht/ Min.)</option>
                                            </optgroup>    
                                            <optgroup label="Cleaning (CL) | MFP/LP | DD | Fax">
                                                    <option value="CL-MFP-S1-2|48">(CL) MFP S1-2</option>
                                                    <option value="CL-MFP-S3-4|79">(CL) MFP S3-4</option>
                                                    <option value="CL-MFP-S5-6|">(CL) MFP S5-6</option>
                                                    <option value="CL-DD|79">(CL) DD</option>
                                                    <option value="CL-FAX|40">(CL) FAX</option>
                                            </optgroup>       
                                            <optgroup label="Preventive Maintenance (PM) | MFP/LP">    
                                                    <option value="PM-S1-2|72">(PM)  MFP/LP S1-2</option>
                                                    <option value="PM-S3-4|118">(PM)  MFP/LP S3-4</option>
                                                    <option value="PM-S5-6|178">(PM)  MFP/LP s5-6</option>
                                            </optgroup>
                                            <optgroup label="PM/ CL | CCTV/ POS">
                                                    <option value="PJC|120">Per Jobdone or Counter</option>
                                            </optgroup>
                                            <optgroup label="EM | CCTV">        
                                                    <option value="PJ|800">Per Jobdone</option>
                                            </optgroup>
                                            <optgroup label="Document">
                                                    <option value="Document|28">Document</option>
                                            </optgroup>
                                            </select>
                                            <!-- จบ ตาราง BSV / BOON  --> 
                                           <?php
                                        }
                                     else
                                        {
                                            ?>
                                            <!-- ตาราง0102521 -->
                                            <select name="item_value" onChange="resultName(this.value);" id="" class="form-control">
                                            <option></option>
                                            <optgroup label="Special Job Assignment | Ped day">
                                                 <option value="All-activity|480">All activity</option>
                                            </optgroup>    
                                            <optgroup label="Installation MFP/ LP | HW | SW | Training">    
                                                 <option value="INST-HW-S1-2|119">MFP/LP HW-S1-2</option>
                                                 <option value="INST-HW-S3-4|178">MFP/LP HW-S3-4</option>
                                                 <option value="INST-SW-Driver-Unit|">SW-Driver-Unit</option>
                                                 <option value="INST-SW-Payment1BMin|">SW(1 Baht/ Min.)</option>
                                                 <option value="INST-SW-Training1BMin|">Training(1 Baht/ Min.)</option>
                                            </optgroup>    
                                            <optgroup label="Cleaning (CL) | MFP/LP | DD | Fax">
                                                    <option value="CL-MFP-S1-2|48">(CL) MFP S1-2</option>
                                                    <option value="CL-MFP-S3-4|79">(CL) MFP S3-4</option>
                                                    <option value="CL-MFP-S5-6|">(CL) MFP S5-6</option>
                                                    <option value="CL-DD|79">(CL) DD</option>
                                                    <option value="CL-FAX|40">(CL) FAX</option>
                                            </optgroup>       
                                            <optgroup label="Preventive Maintenance (PM) | MFP/LP">    
                                                    <option value="PM-S1-2|72">(PM)  MFP/LP S1-2</option>
                                                    <option value="PM-S3-4|118">(PM)  MFP/LP S3-4</option>
                                                    <option value="PM-S5-6|178">(PM)  MFP/LP s5-6</option>
                                            </optgroup>
                                            <optgroup label="PM/ CL | CCTV/ POS">
                                                    <option value="PJC|120">Per Jobdone or Counter</option>
                                            </optgroup>
                                            <optgroup label="EM | CCTV">        
                                                    <option value="PJ|800">Per Jobdone</option>
                                            </optgroup>
                                            <optgroup label="Document">
                                                    <option value="Document|28">Document</option>
                                            </optgroup>
                                            </select>

                                        <?php 
                                        }
                                        ?> 
                                        <!-- จบตาราง0102521 -->             
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group-lg">
                                        <label for="text">Item</label>
                                        <input type="text" readonly value="" name="txbType" class="form-control" id="" placeholder="Type">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group-lg">
                                        <label for="text">Price</label>
                                        <input type="text" value="" name="txbPrice" class="form-control" id="" placeholder="Price">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                 <label for="text">Rountine Check</label>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                </div>
                            <div class="col-md-2">                                   
                             <div class="form-row align-items-center">
                              <div class="col-auto my-1">
                               <div class="custom-control custom-checkbox mr-sm-2">
                                 <label for="text">GPS</label><br>
                                 <input type="checkbox" class="custom-control-input" name="cbGPS"  id="cbGPS" value="1">
                                 <label class="custom-control-label" for="customControlAutosizing">Yes / No</label>
                              </div>
                             </div>
                            </div>
                          </div>
                          <div class="col-md-2">                                   
                            <div class="form-row align-items-center">
                             <div class="col-auto my-1">
                              <div class="custom-control custom-checkbox mr-sm-2">
                                 <label for="text">Survey</label><br>
                                 <input type="checkbox" class="custom-control-input" name="cbSurvey" id="cbSurvey" value="1">
                               <label class="custom-control-label" for="customControlAutosizing">Yes / No</label>
                             </div>
                           </div>
                         </div>
                         </div>
                         <div class="col-md-2">                                   
                           <div class="form-row align-items-center">
                            <div class="col-auto my-1">
                             <div class="custom-control custom-checkbox mr-sm-2">
                              <label for="text">นัดหมาย</label><br>
                               <input type="checkbox" class="custom-control-input" name="cbAppoint"  id="cbAppoint" value="1">
                               <label class="custom-control-label" for="customControlAutosizing">Yes / No</label>
                             </div>
                           </div>
                         </div>
                         </div>

                              
                    </div>
                    </div>
                    </div>
                        </div>
                    <div class="modal-footer">
                        <button type="submit" name="btn_save" value="save_action" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>&nbsp; Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp; Cancel</button>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <!--EditOrder -->
    <form action="jobs" name="form_modal_insert2" method="post">
        <div class="modal fade" id="ModalEditOrder" tabindex="-1" role="dialog" aria-labelledby="ModalEditOrder" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #286090">
                        <div style="color: white">
                            <button type="button" style="color: white" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="">Edit Job</h4>
                            <input type="text" hidden="hidden"  name="txbId" id="txbIdEdit_id">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <label for="txtDate">Date Create</label>
                                    <div class="form-group-lg">
                                        <input type="text" name="txbdatejobedit" id="DateCreateEdit_id" placeholder="yyyy-mm-dd" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-lg">
                                        <label for="text">SO No</label>
                                        <input type="text" name="txbSOEdit" class="form-control" id="txbSOEdit_id" placeholder="SO" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group-lg">
                                        <label for="text">Company</label>
                                        <input type="text" id="txbCompanyEdit_id" name="txbCompanyEdit" autocomplete="off" class="form-control txbCompany" placeholder="Company" required>
                                        <!--<input type="text" name="loso" class="form-control" id="loso" placeholder="Company" required>-->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-lg">
                                        <label for="text">Model</label>
                                        <input type="text" id="txbModelEdit_id" name="txbModelEdit" autocomplete="off" class="form-control txbModel" placeholder="Model" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group-lg">
                                        <label for="text">Type PM</label>
                                        <?php 
                                        if($entityNo != "0102521")
                                        {
                                            ?>
                                            <!-- ตาราง BSV / BOON -->
                                            <select name="item_value" onChange="resultName(this.value);" id="" class="form-control">
                                                <option></option>
                                            <optgroup label="Special Job Assignment | Ped day">
                                                 <option value="All-activity|480">All activity</option>
                                            </optgroup>    
                                            <optgroup label="Installation MFP/ LP | HW | SW | Training">    
                                                 <option value="INST-HW-S1-2|119">MFP/LP HW-S1-2</option>
                                                 <option value="INST-HW-S3-4|178">MFP/LP HW-S3-4</option>
                                                 <option value="INST-SW-Driver-Unit|">SW-Driver-Unit</option>
                                                 <option value="INST-SW-Payment1BMin|">SW(1 Baht/ Min.)</option>
                                                 <option value="INST-SW-Training1BMin|">Training(1 Baht/ Min.)</option>
                                            </optgroup>    
                                            <optgroup label="Cleaning (CL) | MFP/LP | DD | Fax">
                                                    <option value="CL-MFP-S1-2|48">(CL) MFP S1-2</option>
                                                    <option value="CL-MFP-S3-4|79">(CL) MFP S3-4</option>
                                                    <option value="CL-MFP-S5-6|">(CL) MFP S5-6</option>
                                                    <option value="CL-DD|79">(CL) DD</option>
                                                    <option value="CL-FAX|40">(CL) FAX</option>
                                            </optgroup>       
                                            <optgroup label="Preventive Maintenance (PM) | MFP/LP">    
                                                    <option value="PM-S1-2|72">(PM)  MFP/LP S1-2</option>
                                                    <option value="PM-S3-4|118">(PM)  MFP/LP S3-4</option>
                                                    <option value="PM-S5-6|178">(PM)  MFP/LP s5-6</option>
                                            </optgroup>
                                            <optgroup label="PM/ CL | CCTV/ POS">
                                                    <option value="PJC|120">Per Jobdone or Counter</option>
                                            </optgroup>
                                            <optgroup label="EM | CCTV">        
                                                    <option value="PJ|800">Per Jobdone</option>
                                            </optgroup>
                                            <optgroup label="Document">
                                                    <option value="Document|28">Document</option>
                                            </optgroup>
                                            </select>
                                            <!-- จบ ตาราง BSV / BOON  -->
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <!-- ตาราง0102521 -->
                                            <select name="item_value" onChange="resultName(this.value);" id="" class="form-control">
                                                <option></option>
                                            <optgroup label="Special Job Assignment | Ped day">
                                                 <option value="All-activity|480">All activity</option>
                                            </optgroup>    
                                            <optgroup label="Installation MFP/ LP | HW | SW | Training">    
                                                 <option value="INST-HW-S1-2|119">MFP/LP HW-S1-2</option>
                                                 <option value="INST-HW-S3-4|178">MFP/LP HW-S3-4</option>
                                                 <option value="INST-SW-Driver-Unit|">SW-Driver-Unit</option>
                                                 <option value="INST-SW-Payment1BMin|">SW(1 Baht/ Min.)</option>
                                                 <option value="INST-SW-Training1BMin|">Training(1 Baht/ Min.)</option>
                                            </optgroup>    
                                            <optgroup label="Cleaning (CL) | MFP/LP | DD | Fax">
                                                    <option value="CL-MFP-S1-2|48">(CL) MFP S1-2</option>
                                                    <option value="CL-MFP-S3-4|79">(CL) MFP S3-4</option>
                                                    <option value="CL-MFP-S5-6|">(CL) MFP S5-6</option>
                                                    <option value="CL-DD|79">(CL) DD</option>
                                                    <option value="CL-FAX|40">(CL) FAX</option>
                                            </optgroup>       
                                            <optgroup label="Preventive Maintenance (PM) | MFP/LP">    
                                                    <option value="PM-S1-2|72">(PM)  MFP/LP S1-2</option>
                                                    <option value="PM-S3-4|118">(PM)  MFP/LP S3-4</option>
                                                    <option value="PM-S5-6|178">(PM)  MFP/LP s5-6</option>
                                            </optgroup>
                                            <optgroup label="PM/ CL | CCTV/ POS">
                                                    <option value="PJC|120">Per Jobdone or Counter</option>
                                            </optgroup>
                                            <optgroup label="EM | CCTV">        
                                                    <option value="PJ|800">Per Jobdone</option>
                                            </optgroup>
                                            <optgroup label="Document">
                                                    <option value="Document|28">Document</option>
                                            </optgroup> 
                                            </select>

                                            <?php 
                                        }
                                        ?>
                                        <!-- จบตาราง0102521 -->             
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group-lg">
                                        <label for="text">Item</label>
                                        <input type="text" readonly value="" name="txbTypeEdit" class="form-control" id="txbTypeEdit_id" placeholder="Type">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group-lg">
                                        <label for="text">Price</label>
                                        <input type="text" value="" name="txbPriceEdit" class="form-control" id="txbPriceEdit_id" placeholder="Price">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                 <label for="text">Rountine Check</label>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                </div>
                            <div class="col-md-2">                                   
                             <div class="form-row align-items-center">
                              <div class="col-auto my-1">
                               <div class="custom-control custom-checkbox mr-sm-2">
                                 <label for="text">GPS</label><br>
                                 <input type="checkbox" class="custom-control-input" id="cbGps_id">
                                 <label class="custom-control-label" for="customControlAutosizing">Yes / No</label>
                              </div>
                             </div>
                            </div>
                          </div>
                          <div class="col-md-2">                                   
                            <div class="form-row align-items-center">
                             <div class="col-auto my-1">
                              <div class="custom-control custom-checkbox mr-sm-2">
                                 <label for="text">Survey</label><br>
                                 <input type="checkbox" class="custom-control-input" id="cbSurvey_id">
                               <label class="custom-control-label" for="customControlAutosizing">Yes / No</label>
                             </div>
                           </div>
                         </div>
                         </div>
                         <div class="col-md-2">                                   
                           <div class="form-row align-items-center">
                            <div class="col-auto my-1">
                             <div class="custom-control custom-checkbox mr-sm-2">
                              <label for="text">นัดหมาย</label><br>
                               <input type="checkbox" class="custom-control-input" id="cbAppoint_id">
                               <label class="custom-control-label" for="customControlAutosizing">Yes / No</label>
                             </div>
                           </div>
                         </div>
                         </div>

                              
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="btn_edit" value="edit_action" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span>&nbsp; Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp; Cancel</button>
                    </div>
                </div>

            </div>

        </div>
    </form>

    <!--modal delete-->
    <form class="" action="jobs" name="form_modal_insert3" method="POST">
        <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="ModalDelete" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #286090">
                        <div style="color: white">
                            <button type="button" style="color: white" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="">Delete Order</h4>

                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Are you sure to delete this order?</h4>
                                <input type="hidden" name="delete_id" class="form-control" value="" id="delete_id">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="btn_delete" value="delete_action" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp; OK</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp; Cancel</button>
                    </div>
                </div>

            </div>

        </div>
    </form>

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
                        <button type="submit" style="width: 20%" name="btn_confirm_logout" value="confirm_logout" class="btn btn-primary"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Yes.</button>
                        <button type="submit" style="width: 20%" class="btn btn-default" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp; No.</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- ./wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; 2016-<?php echo date("Y");?> Rosaree Doloh (610040)</strong>&nbsp;All rights reserved. &nbsp; | &nbsp; <i><?php echo "Today is " . date("l"); ?>&nbsp;<?php echo "". date("Y-m-d"); ?>&nbsp; | &nbsp; <?php echo "" . date("h:i:s A");?> </i>
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4   
  </div>
</footer>
</div>


<script type="text/javascript">
  function pop_up(id, so, company, model, type, price, date,gps,survey,appoint)
  {
    // form_modal_insert2.reset();
    // document.getElementById("#form_modal_insert2").reset();
//     document.getElementById("#myform").reset();
//     ocument.myFormName.reset();
// document.forms.myFormName.reset();
// document.forms['myFormName'].reset();


    document.getElementById("txbIdEdit_id").value = id;
    document.getElementById("txbSOEdit_id").value = so;
    document.getElementById("txbCompanyEdit_id").value = company;
    document.getElementById("txbModelEdit_id").value=model;
    document.getElementById("txbTypeEdit_id").value=type;
    document.getElementById("txbPriceEdit_id").value=price;
    document.getElementById("DateCreateEdit_id").value=date;
    if(gps = 1)
    document.getElementById("cbGps_id").checked = true;
    else
    document.getElementById("cbGps_id").checked = false;

    if(survey = 1)
    document.getElementById("cbSurvey_id").checked = true;
    else
    document.getElementById("cbSurvey_id").checked = false;
    if(appoint = 1)
    document.getElementById("cbAppoint_id").checked = true;
    else
    document.getElementById("cbAppoint_id").checked = false;
}
</script>

<script>
        //DateCreate format
        var date = $('#DateCreate_id').datepicker(
          { dateFormat: 'yy-mm-dd' }
          ).val();

      </script>
      <script>
        //DateCreate format
        var date = $('#DateCreateEdit_id').datepicker(
          { dateFormat: 'yy-mm-dd' }
          ).val();

      </script>
      <!--script delete-->
      <script>
        function pupup_confirmdelete(id) {
            var delete_id = document.getElementById("delete_id");
            delete_id.value = id;
            <?php $delete_id = id; 

            ?>
        }
    </script>

    <!-- <script src="bower_components/jquery/dist/jquery.min.js"></script> -->
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

    <!-- DataTables -->
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


    <script>
        $(function () {
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'bSortCellsTop' : true,
                'info'        : true,
                'autoWidth'   : true,
                "aLengthMenu":  [ 7,10, 25, 50, 100, 150, 200 ],

                "columns": [
                { "title": "No" },
                { "title": "SONo" },
                { "title": "Date" },
                { "title": "Company"  },
                { "title": "Model" },
                { "title": "Type" },
                { "title": "G/S/A" },
                { "title": "Price" },
                { "title": "Command" }
                ]
            })
        })
    </script>

    <script>
        $(function() {
            $( "#txbCompanyInsert_id" ).autocomplete({
                source: 'showlistscompany.php'

            });
            $( "#txbModelInsert_id" ).autocomplete({
                source: 'showlistsmodel.php'

            });
            $( "#txbCompanyEdit_id" ).autocomplete({
                source: 'showlistscompany.php'

            });
            $( "#txbModelEdit_id" ).autocomplete({
                source: 'showlistsmodel.php'

            });
            $( "#txbSearch_id" ).autocomplete({
                source: 'showlistscompany.php'

            });

        });
    </script>

    <script>
        function resultName(item_value) {
            form_modal_insert1.txbType.value = item_value.split("|")[0];
            form_modal_insert1.txbPrice.value = item_value.split("|")[1];
            form_modal_insert2.txbTypeEdit_id.value = item_value.split("|")[0];
            form_modal_insert2.txbPriceEdit_id.value = item_value.split("|")[1];
        }
    </script>
    <style >
    .ui-autocomplete {
        z-index: 1510 !important;
    }

</style>  



<script>
	function ohSnap(text, options) {
      var defaultOptions = {
    'color'       : null,     // color is  CSS class `alert-color`
    'icon'        : 'icon fa fa-warning',     // class of the icon to show before the alert text
    'duration'    : '7000',   // duration of the notification in ms
    'container-id': 'ohsnap', // id of the alert container
    'fade-duration': 'fast',  // duration of the fade in/out of the alerts. fast, slow or integer in ms
}

options = (typeof options == 'object') ? $.extend(defaultOptions, options) : defaultOptions;

var $container = $('#'+options['container-id']),
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
    html.on('click', function() {
        ohSnapX($(this));
    });

    // After 'duration' seconds, the animation fades out
    setTimeout(function() {
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
    element.fadeOut(options.duration, function() {
        $(this).remove();
    });
} else {
    $('.alert').fadeOut(options.duration, function() {
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
  font-size:16px;

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
  color:white;
  background-color: #E9573F;
}
</style>

</body>
</html>
