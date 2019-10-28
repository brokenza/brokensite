<?php
// ฟังก์ชันสำหรับเชื่อมต่อกับฐานข้อมูล
function connect()
{
    // เริ่มต้นส่วนกำหนดการเชิ่อมต่อฐานข้อมูล //
    $db_config=array(
       "host"=>"localhost",  // กำหนด host
       "user"=>"root", // กำหนดชื่อ user
       "pass"=>"11111111",   // กำหนดรหัสผ่าน
       "dbname"=>"baanfaruk_bs",  // กำหนดชื่อฐานข้อมูล
       "charset"=>"utf8"  // กำหนด charset

   );


    ///Local
       //    "host"=>"localhost",  // กำหนด host
       //"user"=>"root", // กำหนดชื่อ user
       //"pass"=>"11111111",   // กำหนดรหัสผ่าน
       //"dbname"=>"brokensi_demo",  // กำหนดชื่อฐานข้อมูล
       //"charset"=>"utf8"  // กำหนด charset





    // สิ้นสุุดส่วนกำหนดการเชิ่อมต่อฐานข้อมูล //
	$mysqli = @new mysqli($db_config["host"], $db_config["user"], $db_config["pass"], $db_config["dbname"]);
	if(mysqli_connect_error()) {
		die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
		exit;
	}
	if(!$mysqli->set_charset($db_config["charset"])) { // เปลี่ยน charset เป้น utf8 พร้อมตรวจสอบการเปลี่ยน
        //    printf("Error loading character set utf8: %sn", $mysqli->error);  // ถ้าเปลี่ยนไม่ได้
	}else{
        //    printf("Current character set: %sn", $mysqli->character_set_name()); // ถ้าเปลี่ยนได้
	}
	return $mysqli;
	//echo $mysqli->character_set_name();  // แสดง charset เอา comment ออก
	//echo 'Success... ' . $mysqli->host_info . "n";
	//$mysqli->close();
}
//	  ฟังก์ชันสำหรับคิวรี่คำสั่ง sql
function query($sql)
{
	global $mysqli;
	if($mysqli->query($sql)) { return true; }
	else { die("SQL Error: <br>".$sql."<br>".$mysqli->error); return false; }
}
//    ฟังก์ชัน select ข้อมูลในฐานข้อมูลมาแสดง
function select($sql)
{
	global $mysqli;
	$result=array();
	$res = $mysqli->query($sql) or die("SQL Error: <br>".$sql."<br>".$mysqli->error);
	while($data= $res->fetch_assoc()) {
		$result[]=$data;
	}
	return $result;
}
//    ฟังก์ชันสำหรับการ insert ข้อมูล
function insert($table,$data)
{
	global $mysqli;
	$fields=""; $values="";
	$i=1;
	foreach($data as $key=>$val)
	{
		if($i!=1) { $fields.=", "; $values.=", "; }
		$fields.="$key";
		$values.="'$val'";
		$i++;
	}
	$sql = "INSERT INTO $table ($fields) VALUES ($values)";
	if($mysqli->query($sql)) { return true; }
	else { die("SQL Error: <br>".$sql."<br>".$mysqli->error); return false; }
}
//    ฟังก์ชันสำหรับการ update ข้อมูล
function update($table,$data,$where)
{
	global $mysqli;
	$modifs="";
	$i=1;
	foreach($data as $key=>$val)
	{
		if($i!=1){ $modifs.=", "; }
		$modifs.=$key.' = "'.$val.'"';
		$i++;
	}
	$sql = ("UPDATE $table SET $modifs WHERE $where");
	if($mysqli->query($sql)) { return true; }
	else { die("SQL Error: <br>".$sql."<br>".$mysqli->error); return false; }
}
//    ฟังก์ชันสำหรับการ delete ข้อมูล
function delete($table, $where)
{
	global $mysqli;
	$sql = "DELETE FROM $table WHERE $where";
	if($mysqli->query($sql)) { return true; }
	else { die("SQL Error: <br>".$sql."<br>".$mysqli->error); return false; }
}
//    ฟังก์ชันสำหรับแสดงรายการฟิลด์ในตาราง
function listfield($table)
{
	global $mysqli;
	$sql="SELECT * FROM $table LIMIT 1 ";
	$row_title="\$data=array(<br/>";
	$res = $mysqli->query($sql) or die("SQL Error: <br>".$sql."<br>".$mysqli->error);
	$i=1;
	while($data= $res->fetch_field()) {
		$var=$data->name;
		$row_title.="\"$var\"=>\"value$i\",<br/>";
		$i++;
	}
	$row_title.=");<br/>";
	echo $row_title;
}

function BindOrderByMonth($month_,$year_,$employeeID_)
{
	global $mysqli;
	$result=array();
	$sql = "SELECT * FROM `vw_report` where  MONTH(CreateDate) = $month_ AND YEAR(CreateDate) = $year_ and EmployeeID = '$employeeID_' order by CreateDate ASC";
	$res = $mysqli->query($sql) or die("SQL Error: <br>".$sql."<br>".$mysqli->error);
	while($data= $res->fetch_assoc()) {
		$result[]=$data;
	}
	return $result;

}
function SumOrderByMonth($month_,$year_,$employeeID_)
{
	global $mysqli;
	$result=array();
	$sql = "SELECT sum(Income)as Income FROM `vw_report` where  MONTH(CreateDate) = $month_ AND YEAR(CreateDate) = $year_ and EmployeeID = '$employeeID_'";
	$res = $mysqli->query($sql) or die("SQL Error: <br>".$sql."<br>".$mysqli->error);
	while($data= $res->fetch_assoc()) {
		$result[]=$data;
	}
	return $result;

}
function CountTypePMDay($emloyeeid_,$date_,$typepm_)
{
	global $mysqli;
	$result=array();
	$sql = "SELECT Amount FROM `view_jobs` where CreateDate = '$date_'  and EmployeeID = '$emloyeeid_' and TypePM = '$typepm_'";
	$res = $mysqli->query($sql) or die("SQL Error: <br>".$sql."<br>".$mysqli->error);
	while($data= $res->fetch_assoc()) {
		$result[]=$data;
	}
	return $result;
}


function RoutineChk($value,$type)
{
	$result = null;
	switch ($type) {
		case GPS:
		if($value == 1)
		{
			$result =  '<img src="images/check-circle.svg" width="20" height="20"/>';
		}else  { $result =  '<img src="images/x-circle.svg" width="20" height="20" />'; }
			break;
		case Survey:
		if($value == 1)
		{
			$result =  '<img src="images/check-circle.svg" width="20" height="20"/>';
		}else { $result =  '<img src="images/x-circle.svg" width="20" height="20" />'; }
			break;
		case Appoint:
			if($value == 1)
			{
				$result =  '<img src="images/check-circle.svg" width="20" height="20"/>';
			}else  { $result =  '<img src="images/x-circle.svg" width="20" height="20" />'; }
			break;
		}
	return $result;
}




class Paginator{
  	var $items_per_page;
  	var $items_total;
  	var $current_page;
  	var $num_pages;
  	var $mid_range;
  	var $low;
  	var $high;
  	var $limit;
  	var $return;
  	var $default_ipp;
  	var $querystring;
  	var $url_next;

  	function Paginator()
  	{
  		$this->current_page = 1;
  		$this->mid_range = 7;
  		$this->items_per_page = $this->default_ipp;
  		$this->url_next = $this->url_next;
  	}
  	function paginate()
  	{

  		if(!is_numeric($this->items_per_page) OR $this->items_per_page <= 0) $this->items_per_page = $this->default_ipp;
  		$this->num_pages = ceil($this->items_total/$this->items_per_page);

  		if($this->current_page < 1 Or !is_numeric($this->current_page)) $this->current_page = 1;
  		if($this->current_page > $this->num_pages) $this->current_page = $this->num_pages;
  		$prev_page = $this->current_page-1;
  		$next_page = $this->current_page+1;


  		if($this->num_pages > 10)
  		{
  			$this->return = ($this->current_page != 1 And $this->items_total >= 10) ? "<a class=\"paginate\" href=\"".$this->url_next.$this->$prev_page."\">&laquo; Previous</a> ":"<span class=\"inactive\" href=\"#\">&laquo; Previous</span> ";

  			$this->start_range = $this->current_page - floor($this->mid_range/2);
  			$this->end_range = $this->current_page + floor($this->mid_range/2);

  			if($this->start_range <= 0)
  			{
  				$this->end_range += abs($this->start_range)+1;
  				$this->start_range = 1;
  			}
  			if($this->end_range > $this->num_pages)
  			{
  				$this->start_range -= $this->end_range-$this->num_pages;
  				$this->end_range = $this->num_pages;
  			}
  			$this->range = range($this->start_range,$this->end_range);

  			for($i=1;$i<=$this->num_pages;$i++)
  			{
  				if($this->range[0] > 2 And $i == $this->range[0]) $this->return .= " ... ";
  				if($i==1 Or $i==$this->num_pages Or in_array($i,$this->range))
  				{
  					$this->return .= ($i == $this->current_page And $_GET['Page'] != 'All') ? "<a title=\"Go to page $i of $this->num_pages\" class=\"current\" href=\"#\">$i</a> ":"<a class=\"paginate\" title=\"Go to page $i of $this->num_pages\" href=\"".$this->url_next.$i."\">$i</a> ";
  				}
  				if($this->range[$this->mid_range-1] < $this->num_pages-1 And $i == $this->range[$this->mid_range-1]) $this->return .= " ... ";
  			}
  			$this->return .= (($this->current_page != $this->num_pages And $this->items_total >= 10) And ($_GET['Page'] != 'All')) ? "<a class=\"paginate\" href=\"".$this->url_next.$next_page."\">Next &raquo;</a>\n":"<span class=\"inactive\" href=\"#\">&raquo; Next</span>\n";
  		}
  		else
  		{
  			for($i=1;$i<=$this->num_pages;$i++)
  			{
  				$this->return .= ($i == $this->current_page) ? "<a class=\"current\" href=\"#\">$i</a> ":"<a class=\"paginate\" href=\"".$this->url_next.$i."\">$i</a> ";
  			}
  		}
  		$this->low = ($this->current_page-1) * $this->items_per_page;
  		$this->high = ($_GET['ipp'] == 'All') ? $this->items_total:($this->current_page * $this->items_per_page)-1;
  		$this->limit = ($_GET['ipp'] == 'All') ? "":" LIMIT $this->low,$this->items_per_page";
  	}

  	function display_pages()
  	{
  		return $this->return;
  	}
  }
  

  
 
?>