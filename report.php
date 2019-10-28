<?
session_start();
include("config.php"); // incude ครั้งเดียวในไฟล์ที่เรียกใช้งาน
$mysqli = connect();
date_default_timezone_set("Asia/Bangkok");


$employeeID=$_SESSION['EmployeeID'];
$login_user=$_SESSION['login_user'];
$firstlast=$_SESSION['Name']. ' ' . $_SESSION['Last'];
$level=$_SESSION['Level'];
$date_time=$_SESSION['Date_Time'];
//$position=$_SESSION['Level'];
$entityNo=$_SESSION['EntityNo'];

$txbStart = date("Y-m");

//check login
if(!isset($login_user))
{
    header("Location: index");
}
//form_modal_confirm_logout
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if($_POST['btn_confirm_logout'] == 'confirm_logout')
    {
        header("Location: index");
    }
}
//search data from db.
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if($_POST["btn_searchall"] == 'searchall_action')
    {
        $txbStart =   $_POST["txbStart"];
        if($_POST["txbStart"] != "")
        {     

            list($year,$month) = explode('-', $txbStart);

            $qr_query = BindOrderByMonth($month,$year,$employeeID);
            $total=count($qr_query);  // จำนวนรายการทั้งหมด ที่ select
            if($total == 0)
            {
                $qr_query = null;

            }
			$i=0;


            $qr_result = SumOrderByMonth($month,$year,$employeeID);
            $row_=$qr_result[0];
            if($row_)
            {
                $total_money  =$row_['Income'];
            }
            
            //message alert.
            $Msg_action = "<div id='ohsnap'></div> <script> $(function(){ ohSnap('สำเร็จ! ค้นหาข้อมูลเรียบร้อย', {color: 'success'});	});	</script>";

        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="images/broken__lodp.ico" rel="shortcut icon" />
    <title>Report | BrokenSite</title>
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
       <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
     <!-- Pace style -->
     <link rel="stylesheet" href="plugins/pace/pace.min.css" />
     <!-- bootstrap datepicker -->
     <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
     <!--datepicker-->
     <link rel="stylesheet" href="bower_components/jquery-ui/themes/base/jquery-ui.css" />

     <!-- <link rel="stylesheet" href="code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css" />-->
     <link rel="stylesheet" href="resources/demos/style.css" />

     <script src="js/ohsnap.js"></script>

     <!------------ Including  jQuery Date UI with CSS -------------->
     <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
     <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>


 </head>
 <!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
 <!-- the fixed layout is not compatible with sidebar-mini -->
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
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="uploads/<? echo $_SESSION['Images']; ?>" class="user-image" alt="User Image" />
                                    <span class="hidden-xs">
                                        <? echo $firstlast; ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="uploads/<? echo $_SESSION['Images']; ?>" class="img-circle" alt="User Image" />

                                        <p>
                                            <? echo $firstlast; ?> |  <b><i><? echo $employeeID; ?></b></i>

                                            <small>
                                                <? echo $date_time; ?>
                                            </small>
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
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="uploads/<? echo $_SESSION['Images']; ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>
                                <? echo $firstlast;?>
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
                            <li class="active">
                                <a href="report">
                                    <i class="fa fa-print text-aqua"></i>
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
                            <?
                            if($level == "Admin"  || $level == "Sup")
                            {
                                ?>
                                <li class="">
                                    <a href="users">
                                        <i class="fa fa-user-plus "></i>
                                        <span>Users</span>
                                        <i class=""></i>
                                    </a>
                                </li>

                                <?
                            }
                            ?>
                            <?
                            if($level == "Admin")
                            {
                                ?>
                                <li class="">
                                    <a href="statistic">
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
                                <?
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
                              Report Print
                              <small>Preview page</small>
                             </h1>
                             <ol class="breadcrumb">
                             <li><a href="main"><i class="fa fa-home"></i> Home</a></li>
                             <li class="active">Report</li>
                            </ol>
                     </section> 
                   
            <!-- Main content -->
             <section class="content">
                         <div class="row">
                           <div class="col-md-8"></div>    
                           <div class="col-md-4">
                            <form action="report" name="form_searchall" method="post" class="eventInsForm">
                             <div class="input-group">
                                <input name="txbStart" id="StartDate_id" style="font-size: 20px" value="<? echo  $txbStart; ?>" readonly="" type="text" class="form-control" placeholder="ค้นหา ปี - เดือน" required />
                                  <div class="input-group-btn">
                                    <button type="submit" name="btn_searchall" value="searchall_action" id="search-btn" class="btn btn-primary btn-flat">
                                        <span class="glyphicon glyphicon-search">&nbsp;</span>Search
                                    </button>
                                 </div>
                             </div>
                           </form>
                         </div>                                       
                         </div>  
              <div style="height:10px"></div>
                <div class="row">
                    <!--<div class="col-md-2"></div>-->
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <div class="row">
                                    <di class="col-md-5">
                                       
                                    </di>
                                    <di class="col-md-3">
                                        <h1 class="box-title"></h1>
                                    </di>
                                    <div class="col-md-4">
                                       <input type="text" name="txbTotal" readonly="readonly" style=" height: 50px; font-size: 45px;background-color:black;text-align:right;color:rgb(0, 204, 0);" value="<? echo number_format($total_money,2,'.',','); ?>THB." class="form-control">
                                 </div>
                             </div>
                         </div>
                         <!-- /.box-header -->
                         <div class="box-body">
                            <div style="overflow-x:auto;" class="col-md-12">
                            <table id="example2" class="table table-hover">
                                <thead>
                                    <tr style="background-color:#3c8cba; color:white;">
                                        <th style="text-align:center">No</th>
                                        <th style="text-align:center">Date</th>
                                        <th style="text-align:center">EmployeeID</th>
                                        <th style="text-align:center">EntityNo</th>
                                        <th style="text-align:center">Salary</th>                                    
                                        <th style="text-align:center">PricePM</th>
                                        <th style="text-align:center">Amount</th>
                                        <th style="text-align:center">Total</th>
                                        <th style="text-align:center">Imcome</th>
                                        <th style="text-align:center">Command</th>
                                    </tr>
                                </thead>
                                <?
                                $i=0;
                                while($i < count($qr_query))
                                {
                                    $row11=$qr_query[$i];
                                    $i++;
                                    ?>
                                    <tr style="vertical-align:middle">
                                        <?

                                        $Total = $row11['Total'];
                                        $Income = $row11['Income'];
                                        ?>
                                        <td style="width:; text-align: center">
                                            <? echo $i; ?>.
                                        </td>
                                        <td style="width:; text-align: center">
                                            <b> 
                                                <? 
                                                $date = date_create($row11['CreateDate']);
                                            //echo $date;
                                                echo date_format($date,'d-M-Y');
                                                ?>   
                                            </b>
                                        </td>
                                        <td style="width:; text-align: center">
                                         <b> <? echo $row11['EmployeeID']; ?> </b>
                                     </td>
                                     <td style="width:; text-align: center; color: #F00">
                                         <? echo $entityNo; ?>
                                     </td>
                                     <td style="width:; text-align: center">
                                        <? echo $row11['Salary']; ?>
                                    </td>                                       
                                    <td style="width:; text-align: center">
                                        <? echo $row11['PricePM']; ?>
                                    </td>
                                    <td style="width:; text-align: center">
                                        <? echo $row11['Amount']; ?>
                                    </td>
                                    <td style="width:; text-align: center">
                                        <? echo number_format($Total); ?>
                                    </td>
                                    <td style="width:; text-align: right">
                                      <b>  <? echo number_format($Income,2,'.',','); ?> </b><img src="images/Thb_logo.svg" width="15" height="15">
                                  </td>
                                  <td style="width:; text-align: center;" class="form-inline">
                                    <a href="printreport?Createdate=<? echo $row11["CreateDate"];  ?>" target="_blank">
                                        <button class="btn btn-warning" style="width: 100%">
                                            <span class="glyphicon glyphicon-print"></span>

                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <?
                        }
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
</section>



<!--modal logout-->
<form class="" action="report" name="form_modal_confirm_logout" method="POST">
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
                    <button type="submit" name="btn_confirm_logout" value="confirm_logout" class="btn btn-primary">
                        <span class="glyphicon glyphicon-log-out"></span>Ok
                    </button>
                    <button type="submit" class="btn btn-default" class="close" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span>Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


</div>

<!-- Message alert -->
<div clase="row">
    <? echo $Msg_action; ?>
</div>
<footer class="main-footer">
    <strong>Copyright &copy; 2016-<? echo date("Y");?> Rosaree Doloh (R570168)</strong>&nbsp;All rights reserved. &nbsp; | &nbsp; <i><? echo "Today is " . date("l"); ?>&nbsp;<? echo "". date("Y-m-d"); ?>&nbsp; | &nbsp; <? echo "" . date("h:i:s A");?> </i>
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4   
  </div>
</footer>
</div>

<!-- ./wrapper -->
<style>
.datepicker {
    z-index: 1151 !important;
}
</style>



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


<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<script>
    $(function () {
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            "aLengthMenu": [   7, 10, 25, 50, 100, 150, 200 ],

            "columns": [
            { "title": "No" },
            { "title": "Date" },
            { "title": "EmployeeID" },
            { "title": "EntityNo" },
            { "title": "Salary"  },
            { "title": "PricePM" },
            { "title": "Amount" },
            { "title": "Total" },
            { "title": "Income" },
            { "title": "Command" }
            ]
        })
    })
</script>


<script type="text/javascript">
        //DateCreate format
        var date = $('#StartDate_id').datepicker(
        {
            format: "yyyy-mm",
            startMode: "months",
            minViewMode: "months",
            language: "en",            
            changeMonth: true,
            changeYear: true,
            minDate: '0d',
            maxDate: '1y',
            autoclose: true

        }
        ).val();

    </script>

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
        /*bottom: 40px;*/
        top: 555px;
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
</body>
</html>
