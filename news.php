<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Blank Page</title>
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

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="main.php" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>B</b>S</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Broken</b>SITE</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $firstlast; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                    <p><?php echo $firstlast; ?> -  <?php echo $position; ?>
                                        <small><?php echo $date_time;  ?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
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
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $firstlast; ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="">
                        <a href="main.php">
                            <i class="fa fa-home"></i><span>Menu</span> <i class=""></i>
                        </a>
                    </li>
                    <li class="active">
                        <a href="jobs.php">
                            <i class="fa fa-file text-aqua"></i><span>Order</span> <i class=""></i>
                        </a>
                    </li>
                    <li class="">
                        <a href="report.php">
                            <i class="fa fa-print"></i><span>Report</span> <i class=""></i>
                        </a>
                    </li>
                    <li class="">
                        <a href="profile.php">
                            <i class="fa fa-user"></i><span>Profile</span> <i class=""></i>
                        </a>
                    </li><?php
                         if($level == "Admin"  || $level == "Sup")
                         {
                         ?>
                    <li class="">
                        <a href="users.php">
                            <i class="fa fa-user-plus"></i><span>Users</span> <i class=""></i>
                        </a>
                    </li>
                    <li class="">
                        <a href="statistic.php">
                            <i class="fa fa-bar-chart"></i><span>Statistics</span> <i class=""></i>
                        </a>
                    </li><?php
                         }
                         ?><?php
                           if($level == "Admin")
                           {
                           ?>
                    <li class="">
                        <a href="tools.php">
                            <i class="fa fa-wrench"></i><span>Tools</span> <i class=""></i>
                        </a>
                    </li><?php
                           }
                         ?>
                    <li class="">
                        <a href="about.php">
                            <i class="fa fa-question"></i><span>About</span> <i class=""></i>
                        </a>
                    </li>
                    <li class="">
                        <a data-toggle="modal" data-target="#ModalConfirmLogout">
                            <i class="fa fa-sign-out"></i><span>Logout</span> <i class=""></i>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <!--<div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="callout callout-success">
                            <p>
                                Insert data completed.
                            </p>
                        </div>
                    </div>
                </div>-->
                <!-- Default box -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4" style='float: left;'>
                            <button class="btn btn-success" data-toggle="modal" data-target="#ModalNewOrder" data-backdrop="static"><span class="glyphicon glyphicon-plus"></span> New Order</button>
                        </div>
                        <!--<div class="col-md-3"></div>-->
                        <form action="jobs.php" name="form_searchall" method="post" class="eventInsForm">
                            <div class="col-md-4 input-group">
                                <input name="txbSearch" id="txbSearch" type="text" class="form-control txbSearch" placeholder=" SONo , Company" required />
                                <div class="input-group-btn">
                                    <button type="submit" name="btn_searchall" value="searchall_action" id="search-btn" class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-search"></span> Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h2 class="box-title">List orders.</h2>
                                <div class="box-tools">
                                </div>
                            </div>
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-striped table-bordered">
                                    <tr style="text-align: center">
                                        <th style="text-align: center" style="width: 4%">Ln</th>
                                        <th style="text-align: center" style="width: 7%">SONo.</th>
                                        <th style="text-align: center" style="width: 10%">Date</th>
                                        <th style="text-align: center" style="width: 20%">Company</th>
                                        <th style="text-align: center" style="width: 15%">Model</th>
                                        <th style="text-align: center" style="width: 10%">Type</th>
                                        <th style="text-align: center" style="width: 5%">Price</th>
                                        <th style="text-align: center" style="width: 20%">Command</th>
                                    </tr><?php
                                         if ($_SERVER["REQUEST_METHOD"] == "POST")
                                         {
                                             while($row11 = mysqli_fetch_array($result3))
                                             {
                                                 $i++
                                         ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo $i; ?>.</td>
                                        <td style="text-align: center"><? echo $row11["SO"]; ?> </td>
                                        <td style="text-align: center"><? echo $row11["CreateDate"]; ?> </td>
                                        <td style="text-align: center"><? echo $row11["Company"]; ?></td>
                                        <td style="text-align: center"><? echo $row11["Model"]; ?> </td>
                                        <td style="text-align: center"><? echo $row11["TypePM"]; ?> </td>
                                        <td style="text-align: center"><? echo $row11["PricePM"]; ?> </td>
                                        <td style="text-align: center;" class="form-inline">
                                            <!--<button class="btn btn-primary fa-trash-o" data-toggle="modal" data-target="">Delete</button>-->
                                            <button data-toggle="modal" style="width:30%" href="#ModalDelete" onClick="pupup_confirmdelete('<?php echo $row11['UID'];  ?>')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                                            <button data-toggle="modal" style="width:30%" href="#ModalEditOrder" class="btn btn-warning btn-sm" onClick="pop_up('<?php echo $row11['UID']; ?>','<?php echo $row11['SO']; ?>','<?php echo $row11['Company']; ?>','<?php echo $row11['Model']; ?>','<?php echo $row11['TypePM']; ?>','<?php echo $row11['PricePM']; ?>','<?php echo $row11['CreateDate']; ?>')"><span class="glyphicon glyphicon-edit"></span> Edit</button>
                                            <a href="printreport.php?createdate=<?php echo $row11["CreateDate"];  ?>" target="_blank">
                                                <button type="submit" data-toggle="modal" style="width: 30%" class="btn btn-info btn-sm ajax"><span class="glyphicon glyphicon-print"></span> Print</button>
                                            </a>
                                        </td>
                                    </tr><?php
                                             }
                                         }
                                         ?>

                                </table>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <h4><?php $Msg_action = "";      echo $Msg_action; ?></h4>
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <!--/Default box -->
            </section>
            <!-- /.content -->
            <!--modal new order.-->
            <form action="jobs.php" name="form_modal_insert1" method="post" class="eventInsForm">
                <div class="modal fade" id="ModalNewOrder" tabindex="-1" role="dialog" aria-labelledby="NewOrder" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog">
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
                                            <div class="form-group date">
                                                <label>Create Date</label>
                                                <div>
                                                    <input type="text" name="txbdatejobinsert" class="form-control pull-right" id="DateCreate_id" placeholder="yyyy-mm-dd" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="text">SO No</label>
                                                <input type="text" name="txbSO" class="form-control" id="txbSO" placeholder="SO" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="text">Company</label>
                                                <input type="text" id="txbCompany" name="txbCompany" placeholder="Company" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="text">Model</label>
                                                <input type="text" id="txbModel" name="txbModel" placeholder="Model" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="text">Type PM</label>
                                                <select name="item_value" onChange="resultName(this.value);" id="" class="form-control">
                                                    <option></option>
                                                    <optgroup label="EM-Project">
                                                        <option value="EM-Project|58">&nbsp;EM-Project</option>
                                                    </optgroup>
                                                    <optgroup label="MFP (B&amp;W,Color)">
                                                        <option value="MFP-s1-2|48">&nbsp;s1-2</option>
                                                        <option value="MFP-s3-4|79">&nbsp;s3-4</option>
                                                        <option value="MFP-s5-6|119">&nbsp;s5-6</option>
                                                    </optgroup>
                                                    <optgroup label="PRINTER">
                                                        <option value="Printer-s1-2|48">&nbsp;s1-2</option>
                                                        <option value="Printer-s3-4|79">&nbsp;s3-4</option>
                                                        <option value="Printer-s5-6|119">&nbsp;s5-6</option>
                                                    </optgroup>
                                                    <optgroup label="PM/ Fitpart">
                                                        <option value="PMs1-2|72">&nbsp;s1-2</option>
                                                        <option value="PMs3-4|119">&nbsp;s3-4</option>
                                                        <option value="PMs5-6|179">&nbsp;s5-6</option>
                                                    </optgroup>
                                                    <optgroup label="Copyprint,CCTV,RC">
                                                        <option value="Copyprint|79">&nbsp;Copyprint</option>
                                                        <option value="CCTV|800">&nbsp;CCTV</option>
                                                        <option value="RCCall|10">&nbsp;RCCall</option>
                                                        <option value="RC|40">&nbsp;RC</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="text">Item</label>
                                                <input type="text" readonly value="" name="txbType" class="form-control" id="" placeholder="Type">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="text">Price</label>
                                                <input type="text" value="" name="txbPrice" class="form-control" id="" placeholder="Price">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="btn_save" value="save_action" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
            <!--EditOrder -->
            <form action="jobs.php" name="form_modal_insert2" method="post">
                <div class="modal fade" id="ModalEditOrder" tabindex="-1" role="dialog" aria-labelledby="ModalEditOrder" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #286090">
                                <div style="color: white">
                                    <button type="button" style="color: white" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="">Edit Order</h4>
                                    <input type="text" hidden="hidden" name="txbId" id="txbId">
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <label for="txtDate">Date Create</label>
                                            <div class="form-group">
                                                <input type="text" name="txbdatejobeit" id="id_datejobedit" placeholder="yyyy/mm/dd" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="text">SO No</label>
                                                <input type="text" name="txbSO1" class="form-control" id="txbSO1" placeholder="SO" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="text">Company</label>
                                                <input type="text" id="txbCompany22222" name="txbCompany" class="form-control txbCompany" placeholder="Company" required>
                                                <!--<input type="text" name="loso" class="form-control" id="loso" placeholder="Company" required>-->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="text">Model</label>
                                                <input type="text" id="txbModel222" name="txbModel" class="form-control txbModel" placeholder="Model" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="text">Type PM</label>
                                                <select name="item_value" onChange="resultName(this.value);" id="item_value" class="form-control">
                                                    <option></option>
                                                    <optgroup label="EM-Project">
                                                        <option value="EM-Project|58">&nbsp;EM-Project</option>
                                                    </optgroup>
                                                    <optgroup label="MFP (B&amp;W,Color)">
                                                        <option value="MFP-s1-2|48">&nbsp;s1-2</option>
                                                        <option value="MFP-s3-4|79">&nbsp;s3-4</option>
                                                        <option value="MFP-s5-6|119">&nbsp;s5-6</option>
                                                    </optgroup>
                                                    <optgroup label="PRINTER">
                                                        <option value="Printer-s1-2|48">&nbsp;s1-2</option>
                                                        <option value="Printer-s3-4|79">&nbsp;s3-4</option>
                                                        <option value="Printer-s5-6|119">&nbsp;s5-6</option>
                                                    </optgroup>
                                                    <optgroup label="PM/ Fitpart">
                                                        <option value="PMs1-2|72">&nbsp;s1-2</option>
                                                        <option value="PMs3-4|119">&nbsp;s3-4</option>
                                                        <option value="PMs5-6|179">&nbsp;s5-6</option>
                                                    </optgroup>
                                                    <optgroup label="Copyprint,CCTV,RC">
                                                        <option value="Copyprint|79">&nbsp;Copyprint</option>
                                                        <option value="CCTV|800">&nbsp;CCTV</option>
                                                        <option value="RCCall|10">&nbsp;RCCall</option>
                                                        <option value="RC|40">&nbsp;RC</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="text">Item</label>
                                                <input type="text" readonly value="" name="txbType" class="form-control" id="txbType" placeholder="Type">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="text">Price</label>
                                                <input type="text" value="" name="txbPrice" class="form-control" id="txbPrice" placeholder="Price">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" name="btn_edit" value="edit_action" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                            </div>
                        </div>

                    </div>

                </div>
            </form>

            <!--modal delete-->
            <form class="" action="jobs.php" name="form_modal_insert3" method="POST">
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
                                <button type="submit" name="btn_delete" value="delete_action" class="btn btn-primary"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                            </div>
                        </div>

                    </div>

                </div>
            </form>
            <!--/modal delete-->
            <!-- /.content-wrapper -->
        </div>

        <!-- ./wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.2.0
            </div>
            <strong>Copyright &copy; 2016-2017 Rosharee Dorloa (R570168)</strong> All rights reserved.
        </footer>
    </div>
    
    <!-- ./wrapper -->
    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src=".bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
    </script>
</body>
</html>
