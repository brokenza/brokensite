
 <?php	
session_start();
include("config.php"); // incude �����������������¡��ҹ
$mysqli = connect();
date_default_timezone_set("Asia/Bangkok");


$employeeID=$_SESSION['EmployeeID'];
$techid=$_SESSION['TechID'];
$login_user=$_SESSION['login_user'];
$firstlast=$_SESSION['FirstLast'];
$level=$_SESSION['Level'];
$date_time=$_SESSION['Date_Time'];
$entityNo=$_SESSION['EntityNo'];
$date_get = $_GET['Createdate'];
	
 
//call function count typepm



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
      header("Location: index");
    }
 }


 $strSQL = "SELECT * FROM view_order WHERE EmployeeID = '$employeeID' AND CreateDate = '$date_get' order by UID asc";
$objQuery = select($strSQL);
$total=count($objQuery);  // จำนวนรายการทั้งหมด ที่ select
$i=0;
?> 

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="images/broken__lodp.ico" rel="shortcut icon">
    <?php
    $date = date_create($_GET['Createdate']);
    ?>

<title><?php echo date_format($date,"dMY"); ?> Report | Development By 610040 Rosaree</title>

    <style type="text/css">
        table.StypePrice {
            font-family: FreesiaUPC;
            font-size: 16px;
            color: #333333;
            border-width: 1px;
            border-color: #CCCCCC;
            border-collapse: collapse;
        }

            table.StypePrice td {
                background: #CCCCCC url('cell-blue.jpg');
                border-width: 1px;
                padding: 0px;
                border-style: solid;
                border-color: #CCCCCC;
                color: #CCCCCC;
            }

            table.StypePrice th {
                background: #CCCCCC url('cell-blue.jpg');
                border-width: 1px;
                padding: 0px;
                border-style: solid;
                border-color: #CCCCCC;
            }
    .redme {
	margin-left: 1px;
	padding-left: 1px;
	font-family: FreesiaUPC;
}
    .imagetable tr th_B {
}
    .imagetable tr many {
	font-family: FreesiaUPC;
}
    </style>

    <style type="text/css">
        table.imagetable {
            font-family: FreesiaUPC;
            font-size: 16px;
            color: #333333;
            border-width: 1px;
            border-color: #CCCCCC;
            border-collapse: collapse;
        }

            table.imagetable td {
                background: #CCCCCC url('cell-blue.jpg');
                border-width: 1px;
                padding: 0px;
                border-style: solid;
                border-color: #CCCCCC;
                color: #CCCCCC;
            }

            table.imagetable th {
                background: #CCCCCC url('cell-blue.jpg');
                border-width: 1px;
                padding: 0px;
                border-style: solid;
                border-color: #CCCCCC;
            }
    </style>

<style type="text/css">
        table.OUTSOURCE {
            font-family: FreesiaUPC;
            font-size: 16px;
            color: #333333;
            border-width: 1px;
            border-color: #999999;
            border-collapse: collapse;
        }

            table.OUTSOURCE td {
                background: #C7C7C0 url('cell-blue.jpg');
                border-width: 1px;
                padding: 0px;
                border-style: solid;
                border-color: #999999;
                color: #333333;
            }

            table.OUTSOURCE th {
                background: #C7C7C0 url('cell-blue.jpg');
                border-width: 0px;
                padding: 0px;
                border-style: solid;
                border-color: #999999;
            }
    </style>
<style type="text/css">
        table.imagetable {
	font-size: 16px;
	color: #333333;
	border-width: 1px;
	border-color: #999999;
	border-collapse: separate;
        }

            table.imagetable td {
	color: #333333;
	background-color: #dce6f1;
	border: 1px solid #000000;
            }

            table.imagetable th {
	padding: 0px;
	background-image: none;
	background-color: #FFF;
	border: 1px outset #000000;
            }
    </style>

    <style type="text/css">
        table.Check {
            font-family: FreesiaUPC;
            font-size: 16px;
            color: #333333;
            border-width: 1px;
            border-color: #999999;
            border-collapse: collapse;
        }

        table.Check td {
	border-width: 1px;
	padding: 0px;
	border-style: solid;
	border-color: #999999;
	color: #333333;
	font-family: FreesiaUPC;
	background-color: #ffffff;
	background-image: none;
	font-weight: bold;
            }

            table.Check th {
	border-width: 1px;
	padding: 0px;
	border-style: solid;
	border-color: #999999;
	font-weight: bold;
	font-size: 18px;
	font-family: FreesiaUPC;
	background-color: #dce6f1;
	background-image: none;
            }

        .AAAAAA {
            font-family: FreesiaUPC;
            text-align: center;
        }

        .nema {
            font-size: 16px;
        }
    </style>
</head>

 <body onLoad="window.print();">

   <!-- ตาราง BSP -->
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
           <td width="1061" height="223" align="center" valign="top">
             <table width="1061" border="0" align="center" cellpadding="0" cellspacing="0">
                 <tr>
                       <td colspan="8" align="left" valign="middle" scope="col">
                       </td>
                 </tr>
                 <tr>
                        <th width="108" align="center" valign="middle">Employee No.</th>
                        <td width="141" align="center" valign="middle" scope="col">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" scope="col">&nbsp;&nbsp;<?php echo $employeeID; ?>&nbsp;  </td>
                            </tr>          
                          </table> 
                          <hr align="left" width="80%" size="1"  color="#000000"> 
                      <!--  <img src="images/Report_Job_clip_image005.png" width="106" height="1" /> -->
                      </td>
                        <th width="59" align="center" valign="middle">Name :</th>
                        <td width="289" align="center" valign="middle" scope="col">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td valign="middle" scope="col">&nbsp;&nbsp;<?php echo $firstlast; ?>&nbsp;</td>   
                          </tr>
                        </table>
                        <hr align=left width="90%" size="1"  color="#000000">
                    <!--  <img src="images/Report_Job_clip_image005.png" width="238" height="1" /> -->
                      </td>
                        <th width="90" align="center" valign="middle">Tech-Code :</th>
                      <th width="150" align="center" valign="middle" scope="col">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="middle" scope="col">&nbsp;&nbsp;<?php echo $techid; ?>&nbsp; </td>
                        </tr> 
                     </table> 
                     <hr align="left" width="80%" size="1" color="#000000">
                       <!-- <img src="images/Report_Job_clip_image005.png" width="106" height="1" /> -->
                      </th>
                      <th width="59" align="center" valign="middle" scope="col">Date :</th>
                        <th width="165" align="center" valign="middle">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                           <tr>
                           <td valign="middle" scope="col">&nbsp;&nbsp;<?php echo date_format($date,"d-M-Y "); ?> &nbsp;</td>
                           </tr>
                         </table>
                         <hr align="left" width="80%" size="1" color="#000000">
                         <!--   <img src="images/Report_Job_clip_image005.png" width="132" height="1" /> -->
                        </th>
                </tr>
             </table>

            <table width="1063" border="0" align="center" cellpadding="0" cellspacing="0" class="imagetable">
                    <tr>
                        <td width="" rowspan="3" align="center" class="bbb" scope="col"><strong>No.</strong></td>
                        <td width="90" rowspan="3" align="center" class="bbb" scope="col"><strong>SO#,<br>CT#,<br>TRF#,</strong></td>
                        <td width="200" rowspan="3" align="center" class="bbb" scope="col"><strong>Cust-Name</strong></td>
                        <td width="90" rowspan="3" align="center" class="bbb" scope="col"> <strong>Model</strong></td>
                        <td width="" align="center" class="bbb" scope="col"><strong>Special<br>Job<br>Assignm<br>ent</strong></td>
                        <td colspan="5" align="center" class="bbb" scope="col"><strong>Installation MFP/ LP</strong></td>
                        <td colspan="5" align="center" class="bbb" scope="col"><strong>Cleaning (CL)</strong></td>
                        <td colspan="3" align="center" class="bbb" scope="col"><strong>Preventive Maintenance(PM)</strong></td>
                        <td align="center" class="bbb" scope="col"><strong>PM/ CL</strong></td>
                        <td align="center" class="bbb" scope="col"><strong>EM</strong></td>
                        <td width="" rowspan="3" align="center" class="bbb" scope="col"><strong>Docu<br>ment</strong></td>
                        <td colspan="3" align="center" class="bbb" scope="col"><strong>Rountine Check</strong></td>
                    </tr>
                    <tr>
                      <td align="center" class="bbb" scope="col">Ped day</td>
                        <td colspan="2" align="center" class="bbb" scope="col">HW</td>
                        <td colspan="2" align="center" class="bbb" scope="col">SW</td>
                        <td align="center" class="bbb" scope="col">Training</td>
                        <td colspan="3" align="center" class="bbb" scope="col">MFP/LP</td>
                        <td width="" rowspan="2" align="center" class="bbb" scope="col">DD</td>
                        <td width="" rowspan="2" align="center" class="bbb" scope="col">Fax</td>
                        <td colspan="3" align="center" class="bbb" scope="col">MFP/LP</td>
                        <td width="" align="center" valign="bottom" class="bbb" scope="col">CCTV<br>
                          POS</td>
                        <td align="center" class="bbb" scope="col">CCTV</td>
                        <td align="center" class="bbb" scope="col">GPS</td>
                        <td align="center" class="bbb" scope="col">Survey</td>
                        <td align="center" class="bbb" scope="col">นัด<br/>หมาย</td>
                    </tr>
                    <tr>
                        <td align="center" class="bbb" scope="col">All<br>activity</td>
                        <td width="" align="center" class="bbb" scope="col">s1-2</td>
                        <td width="" align="center" class="bbb" scope="col">s3-4</td>
                        <td width="" align="center" class="bbb" scope="col" style="color: #F00;">Driver<br>Uni</td>
                        <td width="" align="center" class="bbb" scope="col">Payment<br>Baht<br>(1Baht<br>/Min.)</td>
                        <td width="" align="center" class="bbb" scope="col">Payment<br>Baht<br>(1Baht<br>/Min.)</td>
                        <td width="" align="center" class="bbb" scope="col">s1-2</td>
                        <td width="" align="center" class="bbb" scope="col">s3-4</td>
                        <td width="" align="center" class="bbb" scope="col">s5-6</td>
                        <td width="" align="center" class="bbb" scope="col">s1-2</td>
                        <td width="" align="center" class="bbb" scope="col">s3-4</td>
                        <td width="" align="center" class="bbb" scope="col">s5-6</td>
                        <td width="" align="center" class="bbb" scope="col">Per<br>Jobdone<br>or<br>Counter</td>                      
                        <td width="" align="center" class="bbb" scope="col">Per<br>Jobdone</td>
                        <td width="" align="center" class="bbb" scope="col">Yes<br>/No</td>
                        <td width="" align="center" class="bbb" scope="col">Yes<br>/No</td>
                        <td width="" align="center" class="bbb" scope="col">Yes<br>/No</td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center" class="bbb" scope="col">Standart Compensate</td>
                        <td width="39" align="center" scope="col">480</td>
                        <td width="39" align="center" scope="col">119</td>
                        <td width="39" align="center" scope="col">178</td>
                        <td width="39" align="center" scope="col"></td>
                        <td width="39" align="center" scope="col"></td>
                        <td width="39" align="center" scope="col"></td>
                        <td width="39" align="center" scope="col">48</td>
                        <td width="39" align="center" scope="col">79</td>
                        <td width="39" align="center" scope="col"></td>
                        <td width="39" align="center" scope="col">79</td>
                        <td width="39" align="center" scope="col">40</td>
                        <td width="39" align="center" scope="col">72</td>
                        <td width="39" align="center" scope="col">118</td>
                        <td width="39" align="center" scope="col">178</td>
                        <td width="39" align="center" scope="col">120</td>                    
                        <td width="39" align="center" scope="col">800</td>
                        <td width="39" align="center" scope="col">28</td>
                        <td width="39" align="center" scope="col">Non</td>
                        <td width="39" align="center" scope="col">Non</td>
                        <td width="39" align="center" scope="col">Non</td>
                     </tr>  
                        <?php	
                                       


                    //mysqli_fetch_assoc($result)
                        if ($_SERVER["REQUEST_METHOD"] == "GET") 
                        {
                        while($i<count($objQuery))
                        {
                        $objResult=$objQuery[$i];
                        $i++; 
                        ?> 
                    <tr>
                        <?
                         $TypePM = $objResult["TypePM"];      
                         $PricePM =  $objResult["PricePM"];
                         ?>
                        <th align="center" scope="col"> <?=$i; ?> </th>
                      <th align="center" scope="col"><?=$objResult["SO"];?></th>
                        
                      <th align="center" style="font-family: FreesiaUPC" scope="col"><?=$objResult["Company"];?></th>
                      <th align="center" scope="col"><?=$objResult["Model"];?></th>
                        <!--Group Special Job Assignment | Ped day-->
                       <th align="center" scope="col">
					    <?  if($TypePM == 'All-activity' && $PricePM == '480')  {
                        ?>
						480		    
					    <? } ?>						
						</th>
                       <!--Group Installation MFP/ LP | HW | SW | Training-->
                       <th align="center" scope="col">
                        <?  if($TypePM == 'INST-HW-S1-2' && $PricePM == '119')  {
                        ?>
						119		    
					    <? } ?>
                       </th>
                        <th align="center" scope="col">
                        <?  if($TypePM == 'INST-HW-S3-4' && $PricePM == '178')  {
                        ?>
                        178
                        <? } ?>    
                       </th>
                       <th align="center" scope="col">
                        <?  if($TypePM == 'INST-SW-Driver-Unit' && $PricePM == '0')  {
                        ?>
                        0                                     
                        <? } ?>                                
                      </th>
                        <th align="center" scope="col">
                        <?  if($TypePM == 'INST-SW-Payment1BMin' && $PricePM == '0')  {
                        ?>
                        0
					   <? } ?>              
                       </th>
                       <th align="center" scope="col">
                        <?  if($TypePM == 'INST-SW-Training1BMin' && $PricePM == '0')  {
                        ?>
                        0
                        <? } ?>
                       </th>
                         <!-- Group Cleaning (CL) | MFP/LP | DD | Fax -->
                       <th align="center" scope="col">
                        <?  if($TypePM == 'CL-MFP-S1-2' && $PricePM == '48')  {
                        ?>
                        48
                        <? } ?>
                       </th>
                       <th align="center" scope="col">
                        <? if($PricePM == '79' && $TypePM == 'CL-MFP-S3-4') {
                        ?>
                        79
                        <?
                        }else{
                        ?>
                        <? } ?> 
                       </th>
                       <th align="center" valign="top" scope="col">
                        <? if($PricePM == '0' && $TypePM == 'CL-MFP-S5-6' ) {
                        ?>
                        
                        <?
                        }else{
                        ?>
                        <? } ?>
                        </th>
                        <th align="center" scope="col">
                        <? if($PricePM == '79' && $TypePM == 'CL-DD') {
                        ?>
                        79
                        <?
                        }else{
                        ?>
                        <? } ?>
                        </th>
                        <th align="center" scope="col"><? if($PricePM == '40' && $TypePM == 'CL-FAX') {
                        ?>
                        40
                        <?
                        }else{
                        ?>
                        <? } ?> 
                       </th>
                         <!-- Group Preventive Maintenance (PM) | MFP/LP-->
                        <th align="center" scope="col"><? if($PricePM == '72' && $TypePM == 'PM-S1-2')
                                                          {
                                                       ?>
                            72
                            <?
                                                          }else{
                            ?>

                            <?
                                                          }
                            ?></th>
                           <th align="center" scope="col"><? if($PricePM == '118' && $TypePM == 'PM-S3-4')
                                                          {
                                                       ?>
                            118
                            <?
                                                          }else{
                            ?>

                            <?
                                                          }
                            ?></th>
                           <th align="center" scope="col"><? if($TypePM == 'PM-S5-6' )
                                                          {
                                                       ?>

                            178
                            <?
                                                          }else{
                            ?>

                            <?
                                                          }
                            ?></th>
                             <!-- Group PM/ CL | CCTV/ POS-->
                            <th align="center" scope="col">
						     <? if($PricePM == '120' && $TypePM == 'PJC')
                                                          {
                                                       ?>
                            120
                            <?
                                                          }else{
                            ?>

                            <?
                                                          }
                            ?></th>
                             <!-- Group EM | CCTV -->
                           <th align="center" scope="col">
                            <? if($PricePM == '800' && $TypePM == 'PJ')
                                                          {
                                                       ?>
                            800
                            <?
                                                          }else{
                            ?>

                            <?
                                                          }
                            ?>
                           </th>
                            <!-- Group Document -->
                            <th align="center" scope="col">
                            <? if($PricePM == '28' && $TypePM == 'Document')
                               {
                             ?>
                            28
                            <?
                               }else{
                            ?>
                            <?
                               }
                             ?>    
                           </th>
                           <th align="center" scope="col">
                            <? if($TypePM == 'Non')
                                 {?> <img src="images/ok.svg" width="12" height="14" /><?}
                             ?>
                            </th>
                            <th align="center" scope="col">
                            <? if($TypePM == 'Non')
                                 {?> <img src="images/ok.svg" width="12" height="14" /><?}
                            ?>
                           </th>
                           <th align="center" scope="col">
                            <? if($TypePM == 'Non')
                                 {?> <img src="images/ok.svg" width="12" height="14" /><?}
                            ?>
                           </th>
                            <?php	
                             }//close while.
                            }//close server load.
                            ?>
                    </tr>
                    <tr>
                        <th height="20" align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                    </tr>
                    <tr>
                        <th height="20" align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                        <th align="center" scope="col"></th>
                    </tr>
                    <tr>
                        <?php


						$strSQL_act = "SELECT sum(PricePM)AS ACT FROM orderjob where EmployeeID = '$employeeID' AND TypePM =  'All-activity' and CreateDate = '$date_get'";
                        $objQuery_act = select($strSQL_act);
                        $objResult_act = $objQuery_act[0];
						
						$strSQL_ihw12 = "SELECT sum(PricePM)AS IHW12 FROM orderjob where EmployeeID = '$employeeID' AND TypePM =  'INST-HW-S1-2' and CreateDate = '$date_get'";
                        $objQuery_ihw12 =  select($strSQL_ihw12);
                        $objResult_ihw12 = $objQuery_ihw12[0];
						
						$strSQL_ihw34 = "SELECT sum(PricePM)AS IHW34 FROM orderjob where EmployeeID = '$employeeID' AND TypePM =  'INST-HW-S3-4' and CreateDate = '$date_get'";
                        $objQuery_ihw34 =  select($strSQL_ihw34);
                        $objResult_ihw34 = $objQuery_ihw34[0];
						
						$strSQL_iswd = "SELECT sum(PricePM)AS ISWD FROM orderjob where EmployeeID = '$employeeID' AND TypePM =  'INST-SW-Driver-Unit' and CreateDate = '$date_get'";
                        $objQuery_iswd =  select($strSQL_iswd);
                        $objResult_iswd = $objQuery_iswd[0];
												
					    $strSQL_iswp = "SELECT sum(PricePM)AS ISWP FROM orderjob where EmployeeID = '$employeeID' AND TypePM = 'INST-SW-Payment1BMin' and CreateDate = '$date_get'";
                        $objQuery_iswp =  select($strSQL_iswp);
                        $objResult_iswp = $objQuery_iswp[0];
																	
					    $strSQL_iswt = "SELECT sum(PricePM)AS ISWT FROM orderjob where EmployeeID = '$employeeID' AND TypePM = 'INST-SW-Training1BMin' and CreateDate = '$date_get'";
                        $objQuery_iswt =  select($strSQL_iswt);
                        $objResult_iswt = $objQuery_iswt[0];
																	
					    $strSQL_cls12 = "SELECT sum(PricePM)AS CLS12 FROM orderjob where EmployeeID = '$employeeID' AND TypePM = 'CL-MFP-S1-2' and CreateDate = '$date_get'";
                        $objQuery_cls12 =  select($strSQL_cls12);
                        $objResult_cls12 = $objQuery_cls12[0];
											

												
						$strSQL_cls56 = "SELECT sum(PricePM)AS CLS56 FROM orderjob where EmployeeID = '$employeeID' AND TypePM =  'CL-MFP-S5-6' and CreateDate = '$date_get'";
                        $objQuery_cls56 =  select($strSQL_cls56);
                        $objResult_cls56 = $objQuery_cls56[0];
												
						$strSQL_cld = "SELECT sum(PricePM)AS CLD FROM orderjob where EmployeeID = '$employeeID' AND TypePM =  'CL-DD' and CreateDate = '$date_get'";
                        $objQuery_cld =  select($strSQL_cld);
                        $objResult_cld = $objQuery_cld[0];
						
				              $strSQL_clf = "SELECT sum(PricePM)AS CLF FROM orderjob where EmployeeID = '$employeeID' AND TypePM =  'CL-FAX' and CreateDate = '$date_get'";
                        $objQuery_clf =  select($strSQL_clf);
                        $objResult_clf = $objQuery_clf[0];
                     
                        $strSQL_pm12 = "SELECT sum(PricePM)AS PM12 FROM orderjob where EmployeeID = '$employeeID' AND TypePM =  'PM-S1-2' and CreateDate = '$date_get'";
                        $objQuery_pm12 =  select($strSQL_pm12);
                        $objResult_pm12 = $objQuery_pm12[0];

                        $strSQL_pm34 = "SELECT sum(PricePM)AS PM34 FROM orderjob where EmployeeID = '$employeeID' AND TypePM =  'PM-S3-4' and CreateDate = '$date_get'";
                        $objQuery_pm34 =  select($strSQL_pm34);
                        $objResult_pm34 = $objQuery_pm34[0];

                        $strSQL_pm56 = "SELECT sum(PricePM)AS PM56 FROM orderjob where EmployeeID = '$employeeID' AND TypePM =  'PM-S5-6' and CreateDate = '$date_get'";
                        $objQuery_pm56 =  select($strSQL_pm56);
                        $objResult_pm56 = $objQuery_pm56[0];

                        $strSQL_pjc = "SELECT sum(PricePM)AS PJC FROM orderjob where EmployeeID = '$employeeID' AND TypePM =  'PJC' and CreateDate = '$date_get'";
                        $objQuery_pjc =  select($strSQL_pjc);
                        $objResult_pjc = $objQuery_pjc[0];

                        $strSQL_pj = "SELECT sum(PricePM)AS PJ FROM orderjob where EmployeeID = '$employeeID' AND TypePM =  'PJ' and CreateDate = '$date_get'";
                        $objQuery_pj =  select($strSQL_pj);
                        $objResult_pj = $objQuery_pj[0];
                        
                         $strSQL_ctv ="SELECT sum(PricePM)AS CTV FROM orderjob where EmployeeID = '$employeeID' AND CreateDate = '$date_get' AND TypePM = 'CCTV'";
                         $objQuery_ctv = select($strSQL_ctv);
                         $objResult_ctv = $objQuery_ctv[0];
                      
                        $strSQL_doc = "SELECT sum(PricePM)AS DOC FROM orderjob where EmployeeID = '$employeeID' AND TypePM =  'Document' and CreateDate = '$date_get'";
                        $objQuery_doc =  select($strSQL_doc);
                        $objResult_doc = $objQuery_doc[0];
		
				        $strSQL_sum = "SELECT sum(PricePM)AS TOTAL FROM orderjob where  EmployeeID = '$employeeID' AND CreateDate = '$date_get'";
                        $objQuery_sum=  select($strSQL_sum);
                        $objResult_sum = $objQuery_sum[0];

		                 //Dailywage
	                    $sql_user = "SELECT Dailywage FROM users where  EmployeeID = '$employeeID'";
                        $result_user = select($sql_user);
                        $objResult_user = $result_user[0];		


                        $strSQL_cls34 = "SELECT sum(PricePM)AS CLS34 FROM orderjob where EmployeeID = '$employeeID' AND TypePM =  'CL-MFP-S3-4' and CreateDate = '$date_get'";
                        $objQuery_cls34 =  select($strSQL_cls34);
                        $objResult_cls34 = $objQuery_cls34[0];
                        
                        ?>
                        <th colspan="4" align="right"  class="bbb" scope="col"><strong>Grand Total Compensate&nbsp;</strong></th>
                        <td align="center"  class="bbb" scope="col"><strong><?=number_format($objResult_act['ACT'])?></strong></td>
                        <td align="center"  class="bbb" scope="col"><strong><?=number_format($objResult_ihw12['IHW12'])?></strong></td>
                        <td align="center"  class="bbb" scope="col"><strong><?=number_format($objResult_ihw34['IHW34'])?></strong></td>
                        <td align="center"  class="bbb" scope="col"><strong><?=number_format($objResult_iswd['ISWD'])?></strong></td>
                        <td align="center"  class="bbb" scope="col"><strong><?=number_format($objResult_iswp['ISWP'])?></strong></td>
                        <td align="center"  class="bbb" scope="col"><strong><?=number_format($objResult_iswt['ISWT'])?></strong></td>
                        <td align="center"  class="bbb" scope="col"><strong><?=number_format($objResult_cls12['CLS12'])?></strong></td>
                        <td align="center"  class="bbb" scope="col"><strong><?=number_format($objResult_cls34['CLS34']);?></strong></td>
                        <td align="center"  class="bbb" scope="col"><strong><?=number_format($objResult_cls56['CLS56']);?></strong></td>
                        <td align="center"  class="bbb" scope="col"><strong><?=number_format($objResult_cld['CLD']);?></strong></td>
                        <td align="center"  class="bbb" scope="col"><strong><?=number_format($objResult_clf['CLF']);?></strong></td>
                        <td align="center"  class="bbb" scope="col"><strong><?=number_format($objResult_pm12['PM12']);?></strong></td>
                        <td align="center"  class="bbb" scope="col"><strong><?=number_format($objResult_pm34['PM34']);?></strong></td>
                        <td align="center"  class="bbb" scope="col"><strong><?=number_format($objResult_pm56['PM56']);?></strong></td>
                        <td align="center"  class="bbb" scope="col"><strong><?=number_format($objResult_pjc['PJC']);?></strong></td>
                        <td align="center"  class="bbb" scope="col"><strong><?=number_format($objResult_pj['PJ'])?></strong></td>
                        <td align="center"  class="bbb" scope="col"><strong><?=number_format($objResult_doc['DOC'])?></strong></td>
                        <td align="center"  class="bbb" scope="col"><strong>&nbsp;</strong></td>
                        <td align="center"  class="bbb" scope="col"><strong>&nbsp;</strong></td>
                        <td align="center"  class="bbb" scope="col"><strong>&nbsp;</strong></td>
                    </tr>
            </table>
          </td>
        </tr>
        <tr>
        <td>
           <br>
            <table width="1060" height="90" border="0" align="center" cellpadding="0" cellspacing="0" dir="ltr">
                <tr>
                    <td width="88" align="right" class="AAAAAA" scope="col">หมายเหตุ</td>
                    <td width="540" valign="middle" class="redme" scope="col">1) กรณีมี OT ให้ส่งใบที่ได้รับอนุมัติมาด้วย (ไม่ต้องรวมยอดมาในรายงานนี้)</td>
                    <th width="143" align="left" class="AAAAAA" scope="col">&nbsp;</th>
                    <td width="289" rowspan="3" align="right" valign="top" scope="col">
                        
                      <table width="260" height="40" border="0" cellpadding="0" cellspacing="0" class="Check">
                      <tr>
                        <th width="95" align="center">รวมรายได้ต่องาน</th>
                        <th align="right"><?= number_format($objResult_sum['TOTAL']);?>
                          &nbsp;</th>
                        <th width="50" align="left">บาท</th>
                      </tr>
                      <tr>
                        <td align="center">ค่าแรงรายวัน</td>
                        <td align="right"><?php echo $objResult_user['Dailywage']; ?>&nbsp;</td>
                        <td align="left">บาท</td>
                      </tr>
                      <tr>
                        <th align="center">รวมทั้งสิ้น</th>
                        <?php
                                $M = $objResult_user['Dailywage'];
                                $Money1 = $objResult_sum["TOTAL"];
                                $Total_Money = $M + $Money1;

                                // echo 'Values: '.$objResult_pm34_['PM34_'];
                        ?>
                        <th align="right"><? echo number_format($Total_Money) ?>&nbsp;</th>
                        <th align="left">บาท</th>
                      </tr>
                     </table>
                    </td>
                </tr>
                <tr>
                  <td align="left" class="AAAAAA" scope="col">&nbsp;</td>
                  <td width="540" class="redme" scope="col">2) รายได้ - รายหัก ในตารางเป็นยอดที่ยังไม่หัก ภาษี และ ประกันสังคม </td>
                  <th width="143" align="left" class="AAAAAA" scope="col"></th>
                </tr>
                <tr>
                  <td align="left" class="AAAAAA" scope="col">                     
                  </td>
                  <td width="540" align="left" scope="col"><span class="AAAAAA" scope="col">
                    <table width="72%" border="0" cellpadding="0" cellspacing="0" class="AAAAAA">
                      <tr>
                        <td width="15%" valign="middle">ตรวจเช็คโดย</td>
                        <td colspan="6"><br><hr align="center" width="90%" size="1" color="#000000">                        </td>
                        <td width="34%" align="left" valign="middle">(Supervisor)</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td width="7%" valign="middle">วันที่</td>
                        <td width="15%"><br><hr align="center" width="80%" size="1" noshade="noshade" color="#000000"></td>
                        <td width="2%" valign="bottom">/</td>
                        <td width="15%"><br><hr align="center" width="80%" size="1" noshade="noshade" color="#000000"></td>
                        <td width="2%" valign="bottom">/</td>
                        <td width="12%"><br><hr align="left" width="100%" size="1" noshade="noshade" color="#000000"></td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                 </td>
                </tr>
            </table>
        </td>
        </tr>
    </table>

<!-- จบ ตาราง  BSP BOON -->

</body>
</html>
