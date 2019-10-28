<?php
session_start();
include("config.php"); // incude �����������������¡��ҹ
$mysqli = connect();
date_default_timezone_set("Asia/Bangkok");

$login_user=$_SESSION['login_user'];
//check login
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
$employeeID_=$_SESSION['EmployeeID'];
$firstlast=$_SESSION['Name']. ' ' . $_SESSION['Last'];
$level=$_SESSION['Level'];
$date_time=$_SESSION['Date_Time'];
$position=$_SESSION['Level'];
//new update entityNo. 23/9/60.
$entityNo=$_SESSION['EntityNo'];
$branchName_=$_SESSION['BranchName'];
$dailywage_=$_SESSION['Dailywage']; 

if($level == "Admin")
{
    $sql = "SELECT * FROM users  ORDER BY UID DESC";
    $objQuery = select($sql);
    $Num_Rows = count($objQuery);
}
else 
{

    $sql = "SELECT * FROM users WHERE EntityNo='$entityNo' AND Level NOT IN ('Admin')  ORDER BY UID DESC";
    $objQuery = select($sql);
    $Num_Rows = count($objQuery);


}





//echo $sql;


//insert data from modal.
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if($_POST[btn_save] == 'save_action')
    {
        $EmployeeID = $_POST['txbEmployeeID']; 
        $Level = $_POST['txbLevel']; 
        $Username = $_POST['txbUsername']; 
        $Password = $_POST['txbPassword']; 
        $FirstName = $_POST['txbFirstName']; 
        $LastName = $_POST['txbLastName']; 
        $EntityNo = $_POST['txbEntityNo']; 
        $BranchName = $_POST['txbBranchName']; 
        $Email = $_POST['txbEmail']; 
        $Phone = $_POST['txbPhone'];
        $Status = $_POST['txbStatus'];
        $Dailywage = $_POST['txbDailywage'];

        //check EmployeeID
        $sql_check ="SELECT UID FROM users WHERE EmployeeID = '$EmployeeID'" ;
        $qr_check=select($sql_check);
        $row_check= $qr_check[0];
        if($row_check == 0 )
        {
            $Images = $_FILES['fileupload']['name'];
            if(!empty($Images))
            {
                move_uploaded_file($_FILES["fileupload"]["tmp_name"],"uploads/".$_FILES["fileupload"]["name"]);
                $sql_insert = "INSERT INTO users (EmployeeID,UserName,Password,FirstName,LastName,Level,Phone,Email,Dailywage,Date_Time,EntityNo,BranchName,Status,Images) VALUES";
                $sql_insert .= " ('$EmployeeID','$Username','$Password','$FirstName','$LastName','$Level','$Phone','$Email','$Dailywage',NOW(),'$EntityNo','$BranchName','$Status','$Images')";
                $excute_sql = query($sql_insert);
            }
            else
            {

                $sql_insert = "INSERT INTO users (EmployeeID,UserName,Password,FirstName,LastName,Level,Phone,Email,Dailywage,Date_Time,EntityNo,BranchName,Status,Images) VALUES";
                $sql_insert .= " ('$EmployeeID','$Username','$Password','$FirstName','$LastName','$Level','$Phone','$Email','$Dailywage',NOW(),'$EntityNo','$BranchName','$Status','profile.png')";
                $excute_sql = query($sql_insert);
            }

            //select user now.
            if($level == "Admin")
            {
                $sql = "SELECT * FROM users  ORDER BY UID DESC";
                $objQuery = select($sql);
                $Num_Rows = count($objQuery);
    $Per_Page = 7;   // Per Page
    $i=0;
}
else 
{
    $sql = "SELECT * FROM users WHERE EntityNo='$entityNo' AND Level NOT IN ('Admin')  ORDER BY UID DESC";
    $objQuery = select($sql);
    $Num_Rows = count($objQuery);
    $Per_Page = 7;   // Per Page
    $i=0;
}

            //message alert.
$Msg_action = "<div id='ohsnap'></div> <script>	$(function(){ ohSnap('สำเร็จ! เพิ่มข้อมูลเรียบร้อย', {color: 'success'});	});	</script>";
}else{

            //message alert.
   $Msg_action = "<div id='ohsnap'></div> <script>	$(function(){ ohSnap('ผิดพลาด! Tech ID มีผู้ใช้งานแล้ว', {color: 'danger'});	});	</script>";
}
}
}
//update data from modal.
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if($_POST[btn_edit] == 'edit_action')
    {
        $EmployeeID = $_POST['txbEmployeeID_']; 
        $Level = $_POST['txbLevel_']; 
        $Username = $_POST['txbUsername_']; 
        $Password = $_POST['txbPassword_']; 
        $FirstName = $_POST['txbFirstName_']; 
        $LastName = $_POST['txbLastName_']; 
        $EntityNo = $_POST['txbEntityNo']; 
        $BranchName = $_POST['txbBranchName_']; 
        $Email = $_POST['txbEmail_']; 
        $Phone = $_POST['txbPhone_']; 
        $UID = $_POST['txbId'];
        $Status = $_POST['txbStatus_'];
        $Dailywage = $_POST['txbDailywage_'];
        
        //check EmployeeID
        //$sql_check ="SELECT UID FROM users WHERE EmployeeID = '$EmployeeID'" ;
        //$qr_check=select($sql_check);
        //$row_check= $qr_check[0];
        //if($row_check == 0 )
        //{
        $Images = $_FILES['fileupload_edit']['name'];
        if(!empty($Images))
        {
            move_uploaded_file($_FILES["fileupload_edit"]["tmp_name"],"uploads/".$_FILES["fileupload_edit"]["name"]);
            $sql_update = "UPDATE users SET EmployeeID = '$EmployeeID',Level = '$Level',UserName = '$Username',Password='$Password',FirstName= '$FirstName',LastName = '$LastName',EntityNo='$EntityNo',BranchName='$BranchName',Email='$Email',Phone='$Phone',Status='$Status',Dailywage='$Dailywage',Images='$Images' WHERE UID = '$UID'";
            $result_update = query($sql_update);
        }
        else
        {
            $sql_update = "UPDATE users SET EmployeeID = '$EmployeeID',Level = '$Level',UserName = '$Username',Password='$Password',FirstName= '$FirstName',LastName = '$LastName',EntityNo='$EntityNo',BranchName='$BranchName',Email='$Email',Phone='$Phone',Status='$Status',Dailywage='$Dailywage' WHERE UID = '$UID'";
            $result_update = query($sql_update);
        }

        //select user now.
        if($level == "Admin")
        {
            $sql = "SELECT * FROM users  ORDER BY UID DESC";
            $objQuery = select($sql);
            $Num_Rows = count($objQuery);
    $Per_Page = 7;   // Per Page
    $i=0;
}
else 
{
    $sql = "SELECT * FROM users WHERE EntityNo='$entityNo' AND Level NOT IN ('Admin')  ORDER BY UID DESC";
    $objQuery = select($sql);
    $Num_Rows = count($objQuery);
    $Per_Page = 7;   // Per Page  // จำนวนรายการทั้งหมด ที่ select
    $i=0;
}
        //message alert.
$Msg_action = "<div id='ohsnap'></div> <script>	$(function(){ ohSnap('สำเร็จ! แก้ไขเพิ่มข้อมูลเรียบร้อย', {color: 'success'});	});	</script>";

        //}else
        //{
        //    //message alert.
        //    $Msg_action = "<div id='ohsnap'></div> <script>	$(function(){ ohSnap('ผิดพลาด! Tech ID มีผู้ใช้งานแล้ว', {color: 'danger'});	});	</script>";
        //}





}
}

//delete data from modal.
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if($_POST[btn_delete] == 'delete_action')
    {
        $delete_id =   $_POST['delete_id'];
        $delete_employeeID_ =   $_POST['employeeID_1'];

        if($delete_employeeID_!= $employeeID_)
        {
            $sqli_query="DELETE FROM users WHERE UID = '$delete_id'";
            $obj_delete = query($sqli_query);

            //select user now.
            if($level == "Admin")
            {
                $sql = "SELECT * FROM users  ORDER BY UID DESC";
                $objQuery = select($sql);
                $Num_Rows = count($objQuery);
                $Per_Page = 7;   // Per Page  // จำนวนรายการทั้งหมด ที่ select
                $i=0;
            }
            else 
            {
                $sql = "SELECT * FROM users WHERE EntityNo='$entityNo' AND Level NOT IN ('Admin')  ORDER BY UID DESC";
                $objQuery = select($sql);
                $Num_Rows = count($objQuery);
                $Per_Page = 7;   // Per Page  // จำนวนรายการทั้งหมด ที่ select
                $i=0;
            }

            //message alert.
            $Msg_action = "<div id='ohsnap'></div> <script>	$(function(){ ohSnap('สำเร็จ! ลบข้อมูลเรียบร้อย', {color: 'success'});	});	</script>";


        }else
        {
            //message alert.
            $Msg_action = "<div id='ohsnap'></div> <script>	$(function(){ ohSnap('ผิดพลาด! ไม่สามารถลบข้อมูลได้', {color: 'danger'});	});	</script>";
        }
    }
}

//search data from db.
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if($_POST[btn_searchall] == 'searchall_action')
    {
        if($_POST['txbSearch'] != "")
        {
            $txtsearch =   $_POST['txbSearch'];
            //select user now.
            if($level == "Admin")
            {
                $sql = "SELECT * FROM users WHERE EmployeeID = '$txtsearch' OR EntityNo = '$txtsearch' OR Level ='$txtsearch' OR BranchName LIKE '$txtsearch%'  ORDER BY UID DESC";
                $objQuery = select($sql);
                $Num_Rows = count($objQuery);
                 $Per_Page = 7;   // Per Page  // จำนวนรายการทั้งหมด ที่ select
                 $i=0;
             }
             else 
             {
                $sql = "SELECT * FROM users WHERE  EmployeeID = '$txtsearch' OR EntityNo='$entityNo' AND Level NOT IN ('Admin') AND EntityNo = '$txtsearch' OR Level ='$txtsearch' OR BranchName LIKE '$txtsearch%'  ORDER BY UID DESC";
                $objQuery = select($sql);
                $Num_Rows = count($objQuery);
                $Per_Page = 7;   // Per Page  // จำนวนรายการทั้งหมด ที่ select
                $i=0;
            }
            //message alert.
            $Msg_action = "<div id='ohsnap'></div> <script>	$(function(){ ohSnap('สำเร็จ! ค้นหาข้อมูลสำเร็จ', {color: 'warning'});	});	</script>";
        }
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="images/broken__lodp.ico" rel="shortcut icon">
    <title>Users | BrokenSite</title>
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

       <!-- DataTables -->
       <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

       <script src="js/ohsnap.js"></script>
       <link rel="stylesheet" href="/code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css" />
       <link rel="stylesheet" href="/resources/demos/style.css" />


   <script src="js/jquery_.js"></script>
   <script src="js/jquery_ui.js"></script>

       <style type="text/css"> 
       .paginate {
        font-family: Arial, Helvetica, sans-serif;
        font-size: .7em;
    }
    a.paginate {
        border: 1px solid #000080;
        padding: 2px 6px 2px 6px;
        text-decoration: none;
        color: #000080;
    }
    h2 {
        font-size: 12pt;
        color: #003366;
    }

    h2 {
        line-height: 1.2em;
        letter-spacing:-1px;
        margin: 0;
        padding: 0;
        text-align: left;
    }
    a.paginate:hover {
        background-color: #000080;
        color: #FFF;
        text-decoration: underline;
    }
    a.current {
        border: 1px solid #000080;
        font: bold .7em Arial,Helvetica,sans-serif;
        padding: 2px 6px 2px 6px;
        cursor: default;
        background:#000080;
        color: #FFF;
        text-decoration: none;
    }
    span.inactive {
        border: 1px solid #999;
        font-family: Arial, Helvetica, sans-serif;
        font-size: .7em;
        padding: 2px 6px 2px 6px;
        color: #999;
        cursor: default;
    }
</style> 
</head>
<body class="hold-transition skin-green sidebar-collapse sidebar-mini">
    <!-- <body class="hold-transition skin-blue fixed sidebar-mini">  -->
        <!-- Site wrapper -->
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
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="uploads/<?php echo $_SESSION['Images']; ?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo $firstlast; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="uploads/<?php echo $_SESSION['Images']; ?>" class="img-circle" alt="User Image">
                                        <p>
                                            <?php echo $firstlast; ?> |  <b><i><?php echo $employeeID_; ?></b></i>
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
                                            <a data-toggle="modal" data-target="#ModalConfirmLogout" class="btn btn-default btn-flat">Logout</a>
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
                                <?php echo $firstlast; ?>
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
                                <li class="active">
                                    <a href="users">
                                        <i class="fa fa-user-plus text-aqua"></i>
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

            <div class="content-wrapper">

                 <!-- Content Header (Page header) -->
                     <section class="content-header">
                             <h1>
                              Register User
                              <small>Control page</small>
                             </h1>
                             <ol class="breadcrumb">
                             <li><a href="main"><i class="fa fa-home"></i> Home</a></li>
                             <li class="active">Register</li>
                            </ol>
                     </section> 
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!--<div class="col-md-12">-->
                            <div class="col-md-4">
                                <button class="btn btn-success" style="width: auto;" data-toggle="modal" data-target="#ModalNewUser"><span class="glyphicon glyphicon-plus"></span>New User</button>
                                <!--<button href="#myModal"  class="btn btn-success" data-toggle="modal">Launch demo modal</button>-->
                            </div>
                            <div class="col-md-4">

                            </div>                     
<!--                             <div class="col-md-4">
                                <form action="users" name="form_searchall" method="post" class="eventInsForm">
                                    <div class="input-group input-group">
                                        <input name="txbSearch" id="txbSearch" type="text" class="form-control txbSearch" placeholder="EmployeeID , EntityNo" required />
                                        <div class="input-group-btn">
                                            <button type="submit" name="btn_searchall" value="searchall_action" id="search-btn" class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-search"></span>Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>   -->                    
                        </div>
                        <!--</div>-->
                        <br />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-primary"> 
                                        <div class="row">
                                           <?php echo $Msg_action; ?>
                                       </div>
                                   <div class="box-body">
                                    <div style="overflow-x:auto;" class="col-md-12">
                                        <table id="example2" class="table table-hover">
                                            <thead>
                                                <tr style="background-color:#3c8cba; color:white;">
                                                    <th style="width: ; text-align:center">No.</th>
                                                    <th style="width: ; text-align:center">Employee ID</th>
                                                    <th style="width: ;text-align:center">User</th>
                                                    <th style="width: ;text-align:center">Name</th>
                                                    <th style="width: ;text-align:center">Last</th>
                                                    <th style="width: ;text-align:center">Level</th>
                                                    <th style="width: ;text-align:center">EntityNo</th>
                                                    <th style="width: ;text-align:center">Date</th>
                                                    <th style="width: ;text-align:center">Command</th>
                                                </tr>
                                            </thead>
                                            <?php  
                                    //if ($_SERVER["REQUEST_METHOD"] == "POST") 
                                    //{
                                            $i = 0;
                                            while($i<count($objQuery))
                                            {                                    
                                                $row11=$objQuery[$i];
                                                $i++;                                                         
                                                ?>
                                                <tr>
                                                    <?php 
                                                    $name_last = $row11["FirstName"];
                                                    ?>
                                                    <td style="text-align: center"><?php echo $i; ?>.</td>
                                                    <td style="text-align: center"><?php echo $row11["EmployeeID"]; ?> </td>
                                                    <td style="text-align: center"><?php echo $row11["UserName"]; ?> </td>
                                                    <td style="text-align: center"><?php echo $row11["FirstName"]; ?> </td>
                                                    <td style="text-align: center"><?php echo $row11["LastName"]; ?> </td>
                                                    <td style="text-align: center"><?php echo $row11["Level"]; ?></td>
                                                    <td style="text-align: center"><?php echo $row11["EntityNo"]; ?> </td>
                                                    <td style="text-align: center"><?php echo $row11["Date_Time"]; ?> </td>
                                                    <td style="text-align: center" class="form-inline">
                                                        <!--<button class="btn btn-primary fa-trash-o" data-toggle="modal" data-target="">Delete</button>-->
                                                        <?php 
                                                        if($level == "Admin")
                                                        {
                                                         ?>
                                                         <button type="button" data-toggle="modal" href="#ModalDelete" onClick="pupup_confirmdelete('<?php echo $row11['UID'];  ?>','<?php echo $row11['EmployeeID']; ?>')" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                                         <?php        
                                                     }
                                                     else
                                                     {   
                                                        ?>
                                                        <button type="button" disabled="disabled" data-toggle="modal" href="#ModalDelete" onClick="pupup_confirmdelete('<?php echo $row11['UID'];  ?>','<?php echo $row11['EmployeeID']; ?>')" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                                        <?php
                                                    }
                                                    ?>

                                                    <button type="button" data-toggle="modal" href="#ModalEditUser" class="btn btn-sm btn-warning" onClick="popup_edit('<?php echo $row11['UID']; ?>','<?php echo $row11['EmployeeID']; ?>','<?php echo $row11['Level']; ?>','<?php echo $row11['EntityNo']; ?>','<?php echo $row11['BranchName']; ?>','<?php echo $row11['UserName']; ?>','<?php echo $row11['Password']; ?>','<?php echo $row11['FirstName']; ?>','<?php echo $row11['LastName']; ?>','<?php echo $row11['Email']; ?>','<?php echo $row11['Phone']; ?>','<?php echo $row11['Status']; ?>','<?php echo $row11['Dailywage']; ?>','<?php echo $row11['Images']; ?>')"><span class="glyphicon glyphicon-edit"></span></button>
                                                </td>
                                            </tr>
                                            <?php 
                                        }
                                    //}
                                        ?>

                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">

                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
                </div>

                <h4><?php echo $Msg_action; ?></h4>
            </section>

            <!--modal new user.-->
            <form action="users" name="form_modal_insert1" method="post" class="eventInsForm" enctype="multipart/form-data">
                <div class="modal fade" id="ModalNewUser" tabindex="-1" role="dialog" aria-labelledby="NewOrder" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #286090">
                                <div style="color: white">
                                    <button type="button" style="color: white" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="">New User</h4>

                                </div>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-10">
                                                <!--images-->
                                                <input type="file" id="fileimg_add" name="fileupload" value="" multiple />
                                                <div style="height:10px;"></div>
                                                <img id="images_add" src="uploads/profile.png" style="width:250px;" class="img-thumbnail" />
                                            </div>
                                        </div>
                                        <div style="height:10px;"></div>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Name file</label>
                                                    <input type="text" readonly name="txbImageName" value="profile.png" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <div class="form-group-lg">
                                                        <label>Employee ID</label>
                                                        <div>
                                                            <input type="text" name="txbEmployeeID" class="form-control pull-right" id="" placeholder="Employee ID" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group-lg">
                                                        <label for="text">Level</label>
                                                        <select name="txbLevel" class="form-control" required>
                                                            <?php 
                                                            if($level == "Sup")
                                                            {
                                                                ?>
                                                                <option value="User">User</option>  
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                ?>

                                                                <option value="User">User</option>
                                                                <option value="Sup">Sup</option>
                                                                <option value="Admin">Admin</option>


                                                                <?php
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <div class="form-group-lg">
                                                        <label for="text">Entity NO</label>   
                                                        <?php 
                                                        if($level == "Sup")
                                                        {
                                                         ?>

                                                         <input type="text" id="" name="txbEntityNo" value="<?php echo $entityNo; ?>" class="form-control" required>
                                                         <?php
                                                     }else
                                                     {
                                                        ?>
                                                        <select name="txbEntityNo" class="form-control" required>
                                                            <option value="0102235">0102235</option>
                                                            <option value="0102511">0102511</option>
                                                            <option value="0102521">0102521</option>

                                                            <!-- <input type="text" id="" name="txbBranchNo" placeholder="EntityNo" class="form-control" required> -->
                                                        </select>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="form-group-lg">
                                                    <label for="text">์Branch Name</label>
                                                    <?php 
                                                    if($level == "Sup")
                                                    {
                                                     ?>
                                                     <input type="text" id="" name="txbBranchName" value="<?php echo $branchName_; ?>"  class="form-control" required>
                                                     <?php
                                                 }else
                                                 {
                                                     ?>
                                                     <input type="text" id="" name="txbBranchName" placeholder="Branch" class="form-control" required>

                                                     <?php
                                                 }
                                                 ?>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group-lg">
                                                <label for="text">Username</label>
                                                <input type="text" id="" name="txbUsername" placeholder="Username" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group-lg">
                                                <label for="text">Password</label>
                                                <input type="password" name="txbPassword" value="" class="form-control" id="" placeholder="Password" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group-lg">
                                                <label for="text">First Name</label>
                                                <input type="text" name="txbFirstName" class="form-control" id="" placeholder="First Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group-lg">
                                                <label for="text">Last Name</label>
                                                <input type="text" name="txbLastName" class="form-control" id="" placeholder="Last Name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group-lg">
                                                <label for="text">E-mail</label>
                                                <input type="text" name="txbEmail" class="form-control" id="" placeholder="E-mail" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group-lg">
                                                <label for="text">Phone</label>
                                                <input type="text" value="" name="txbPhone" class="form-control" id="" placeholder="Phone" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group-lg">
                                                <label for="text">Daily Wage</label>

                                                <input type="text" name="txbDailywage" value="300"  class="form-control" id="" placeholder="Daily Wage" required >
                                            </div>
                                        </div>  
                                        <div class="col-md-6">
                                         <div class="form-group-lg">
                                            <label for="text">Status</label>
                                            <select name="txbStatus" class="form-control" required>
                                             <?php 
                                             if($level == "Sup")
                                             {
                                                 ?>
                                                 <option value="Active">Active</option>
                                                 <?php
                                             }else
                                             {
                                                ?>                                           
                                                <option value="Active">Active</option>
                                                <option value="Null">Null</option>

                                                <?php
                                            }                                          
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="btn_save" value="save_action" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span>&nbsp; Save</button>
                <button type="submit" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp; Cancel</button>
            </div>
        </div>
    </div>
</div>
</form>



<!--modal edit user.-->
<form action="users" name="form_modal_insert1" method="post" class="eventInsForm" enctype="multipart/form-data">
    <div class="modal fade" id="ModalEditUser" tabindex="-1" role="dialog" aria-labelledby="NewOrder" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #286090">
                    <div style="color: white">
                        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="">Edit User</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <!--images-->
                                    <input type="file" id="fileimg_edit" name="fileupload_edit" value="" multiple />
                                    <div style="height:10px;"></div>
                                    <img id="images_edit" src="" style="width:250px;" class="img-thumbnail" />
                                </div>
                            </div>
                            <div style="height:10px;"></div>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Name file</label>
                                        <input type="text" readonly id="ImgName_id" name="txbImageName" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <input type="text" hidden="hidden" name="txbId" id="txbId">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group-lg">
                                            <label>Employee ID</label>
                                            <div>
                                                <input type="text" name="txbEmployeeID_" id="EmployeeID_id" class="form-control pull-right" id="" placeholder="Employee ID" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group-lg">
                                            <label for="text">Level</label>
                                            <?php 
                                            if($level == "Admin")
                                            {
                                             ?>
                                             <select name="txbLevel_" class="form-control" id="level_id" required>
                                                <option value="User">User</option>
                                                <option value="Sup">Sup</option>
                                                <option value="Admin">Admin</option>               
                                            </select>
                                            <?php        
                                        }
                                        else
                                        {   
                                            ?>
                                            <select name="txbLevel_" disabled="disabled" class="form-control" id="level_id" required>
                                                <option value="User">User</option>
                                                <option value="Sup">Sup</option>
                                                <option value="Admin">Admin</option>                                                   
                                            </select>

                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group-lg">
                                        <label for="text">Entity No</label>
                                        <?php 
                                        if($level == "Admin")
                                        {
                                         ?>
                                         <select name="txbEntityNo" class="form-control" id="EntityNo_id" required>
                                             <option value=""><< Select Item >></option>
                                             <option value="0102235">0102235</option>
                                             <option value="0102511">0102511</option>
                                             <option value="0102521">0102521</option>
                                             <!-- <input type="text" name="txbBranchNo_" id="branchno_id" placeholder="BranchNo" class="form-control" required> -->						
                                         </select>
                                         <?php        
                                     }
                                     else
                                     {   
                                        ?>
                                        <select name="txbEntityNo" disabled="disabled" class="form-control" id="EntityNo_id" required>
                                         <option value=""><< Select Item >></option>
                                         <option value="0102235">0102235</option>
                                         <option value="0102511">0102511</option>
                                         <option value="0102521">0102521</option>
                                         <!-- <input type="text" name="txbBranchNo_" id="branchno_id" placeholder="BranchNo" class="form-control" required> -->                       
                                     </select>
                                     <?php
                                 }
                                 ?>

                             </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group-lg">
                                <label for="text">BranchName</label>
                                <input type="text" name="txbBranchName_" id="branchname_id" placeholder="BranchName" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group-lg">
                                <label for="text">Username</label>
                                <input type="text" id="username_id" name="txbUsername_" placeholder="Username" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-lg">
                                <label for="text">Password</label>
                                <input type="password" name="txbPassword_" class="form-control" id="password_id" placeholder="Password" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group-lg">
                                <label for="text">First Name</label>
                                <input type="text" name="txbFirstName_" class="form-control" id="firstname_id" placeholder="First Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-lg">
                                <label for="text">Last Name</label>
                                <input type="text" name="txbLastName_" class="form-control" id="lastname_id" placeholder="Last Name" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group-lg">
                                <label for="text">E-mail</label>
                                <input type="text" name="txbEmail_" class="form-control" id="email_id" placeholder="E-mail" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-lg">
                                <label for="text">Phone</label>
                                <input type="text" value="" name="txbPhone_" class="form-control" id="phone_id" placeholder="Phone" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                     <div class="col-md-6">
                        <div class="form-group-lg">
                            <label for="text">Dailywage</label>
                            <input type="text" name="txbDailywage_" class="form-control" id="dialywage_id" placeholder="Dailywage" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                     <div class="form-group-lg">
                        <label for="text">Status</label>
                        <select name="txbStatus_" class="form-control" id="status_id" required>                                                 
                            <option value="Active">Active</option>
                            <option value="Null">Null</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal-footer">
    <button type="submit"  name="btn_edit" value="edit_action" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span>&nbsp; Save</button>
    <button type="submit"  class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp; Cancel</button>
</div>
</div>
</div>
</div>
</form>

<!--modal delete-->
<form class="" action="users" name="form_modal_insert3" method="POST">
    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="ModalDelete" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #286090">
                    <div style="color: white">
                        <button type="button" style="color: white" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="">Delete User</h4>

                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Are you sure to delete this user?</h4>
                            <input type="hidden" name="delete_id" class="form-control" value="" id="delete_id">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" style="width: 20%" name="btn_delete" value="delete_action" class="btn btn-primary"><span class="glyphicon glyphicon-trash"></span>&nbsp; Delete</button>
                    <button type="submit" style="width: 20%" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp; Cancel</button>
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
                    <button type="submit" style="width: 20%" name="btn_confirm_logout" value="confirm_logout" class="btn btn-primary"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Ok</button>
                    <button href="main" type="submit" style="width: 20%" class="btn btn-default" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp; Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <style>
    .datepicker {
        z-index: 1151 !important;
    }
</style>
</form>

</div>


<footer class="main-footer">
    <strong>Copyright &copy; 2016-<?php echo date("Y");?> Rosaree Doloh (R570168)</strong>&nbsp;All rights reserved. &nbsp; | &nbsp; <i><?php echo "Today is " . date("l"); ?>&nbsp;<?php echo "". date("Y-m-d"); ?>&nbsp; | &nbsp; <?php echo "" . date("h:i:s A");?> </i>
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4   
  </div>
</footer>
<!-- <div class="control-sidebar-bg"></div> -->
</div>

<!-- ./wrapper --><!-- Bootstrap 3.3.7 -->
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
            'info'        : true,
            'autoWidth'   : false,
            "aLengthMenu": [ 5 ],

            "columns": [
            { "title": "No" },
            { "title": "EmployeeID" },
            { "title": "User" },
            { "title": "Name" },
            { "title": "Last"  },
            { "title": "Level" },
            { "title": "EntityNo" },
            { "title": "Date" },
            { "title": "Command" }
            ]
        })
    })
</script>

<!--script reset text new modal-->
<script>
    $('#ModalNewUser').on('hidden.bs.modal', function () {
        $(this).find("input,textarea,select,file").val('').end();

    });
</script>


<!--script preview image-->
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

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#images_add').attr('src', e.target.result);
                    $('#images_edit').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#fileimg_add").change(function ()
        {
            readURL(this);
        });
        $("#fileimg_edit").change(function ()
        {
            readURL(this);
        });
    </script>




    <style>
    .alert {
        padding: 15px;
        margin-bottom: 22px;
        border: 1px solid #eed3d7;
        border-radius: 4px;
        position: absolute;
        /*bottom: 40px;*/
        top:455px;           
        right: 5px;

        font-size: 16px;
        /* Each alert has its own width */
        float: right;
        clear: right;
        background-color: white;
        z-index: 1151 !important;
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

<script>
    $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();

            //Datemask dd/mm/yyyy
            $("#datemask").inputmask("dd/mm/yyyy", { "placeholder": "dd/mm/yyyy" });
            //Datemask2 mm/dd/yyyy
            $("#datemask2").inputmask("mm/dd/yyyy", { "placeholder": "mm/dd/yyyy" });
            //Money Euro
            $("[data-mask]").inputmask();

            //Date range picker
            $('#reservation').daterangepicker();
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' });
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
            $('#datepicker').datepicker({ format: 'yyyy-mm-dd', autoclose: true });
            $('#datepicker1').datepicker({ format: 'yyyy-mm-dd', autoclose: true });
            //$('#txtDate').datepicker({ dateFormat: 'dd-mm-yy' }).val();

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
    <script>
        $(".txbCompany").autocomplete({
            source: 'autocomplete.php'
        });
        $('#modalIns').modal('show');
        $(".txbCompany").autocomplete("option", "appendTo", ".eventInsForm");
    </script>
    <script>
        $(".txbSearch").autocomplete({
            source: 'autosearch.php'
        });
        $(".txbSearch").autocomplete("option", "appendTo", ".eventInsForm");
    </script>
    <script type="text/javascript">
     function popup_edit(id, EmployeeID, Level, EntityNo, BranchName, Username, Password, FirstName, LastName, Email, Phone, Status, dailywage, image)
     {
         document.getElementById("txbId").value = id;
         document.getElementById("EmployeeID_id").value = EmployeeID;
         document.getElementById("level_id").value = Level;
         document.getElementById("EntityNo_id").value = EntityNo;
         document.getElementById("branchname_id").value = BranchName;
         document.getElementById("username_id").value = Username;
         document.getElementById("password_id").value = Password;
         document.getElementById("firstname_id").value = FirstName;
         document.getElementById("lastname_id").value = LastName;
         document.getElementById("email_id").value = Email;
         document.getElementById("phone_id").value = Phone;
         document.getElementById("status_id").value = Status;
         document.getElementById("dialywage_id").value = dailywage;
         document.getElementById("ImgName_id").value = image;
         document.getElementById("images_edit").src = "uploads/" +image;
     }

 </script>
 <script>
    $(function () {
        $('#datetimepicker1').datetimepicker({
            language: 'pt-BR'
        });
    });

</script>
<!--script delete-->
<script>
    function pupup_confirmdelete(id,t_id) {
        var delete_id = document.getElementById("delete_id");
        var employeeID_1 = document.getElementById("employeeID_1");
        delete_id.value = id;
        employeeID_1.value = t_id;
        <?php 
        $delete_id = id;
        $employeeID_1 = t_id;
        ?>
    }
</script>


</body>
</html>
