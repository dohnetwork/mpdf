<html>
<head>
<title>ThaiCreate.Com PHP & MySQL (mysqli)</title>
</head>
<body>
<?php
	ini_set('display_errors', 1);
	error_reporting(~0);

	$strKeyword = null;

	if(isset($_POST["txtKeyword"]))
	{
		$strKeyword = $_POST["txtKeyword"];
	}
?>

<form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
  <table width="599" border="1">
   <tr>
      <th>เลือกเดือน 
 
	<select name="ddlSelect" id="ddlSelect">
          <option>- Select -</option>
	 <option value="Jan" <?if(isset($_POST["ddlSelect"]) && $_POST["ddlSelect"]  == "Jan") echo "selected"; ?>>มกราคม </option>
	 <option value="Feb" <?if(isset($_POST["ddlSelect"]) && $_POST["ddlSelect"]  == "Feb") echo "selected"; ?>>กุมภาพันธ์ </option>
	<option value="Mar" <?if(isset($_POST["ddlSelect"]) && $_POST["ddlSelect"]  == "Mar") echo "selected"; ?>>   มีนาคม   </option>
	<option value="Apr" <?if(isset($_POST["ddlSelect"]) && $_POST["ddlSelect"]  == "Apr") echo "selected"; ?>>   เมษายน   </option>
	<option value="May" <?if(isset($_POST["ddlSelect"]) && $_POST["ddlSelect"]  == "May") echo "selected"; ?>>   พฤษภาคม   </option>
	<option value="Jun" <?if(isset($_POST["ddlSelect"]) && $_POST["ddlSelect"]  == "Jun") echo "selected"; ?>>   มิถุนายน   </option>
          <option value="Jul" <?if(isset($_POST["ddlSelect"]) && $_POST["ddlSelect"]  == "Jul") echo "selected"; ?>>   กรกฏาคม   </option>
          <option value="Aug" <?if(isset($_POST["ddlSelect"]) && $_POST["ddlSelect"]  == "Aug") echo "selected"; ?>>   สิงหาคม   </option>
          <option value="Sep" <?if(isset($_POST["ddlSelect"]) && $_POST["ddlSelect"]  == "Sep") echo "selected"; ?>> กันยายน </option>
          <option value="Oct" <?if(isset($_POST["ddlSelect"]) && $_POST["ddlSelect"]  == "Oct") echo "selected"; ?>> ตุลาคม   </option>
          <option value="Nov" <?if(isset($_POST["ddlSelect"]) && $_POST["ddlSelect"]  == "Nov") echo "selected"; ?>>พฤศจิกายน </option>
          <option value="Dec" <?if(isset($_POST["ddlSelect"]) && $_POST["ddlSelect"]  == "Dec") echo "selected"; ?>> ธันวาคม   </option>
 		</select>
           Key วันที่
              <input name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $strKeyword;?>">
      <input type="submit" value="Search"></th>
    </tr>
  </table>
</form>




<?php

   $serverName = "172.16.1.212";
   $userName = "root";
   $userPassword = "camel";
   $dbName = "report";

$conn = new mysqli($serverName, $userName, $userPassword, $dbName);
   if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//   $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
//   $sql = "SELECT * FROM customer WHERE Name LIKE '%".$strKeyword."%' ";
//   $query = mysqli_query($conn,$sql);
//--------------------------------------------------------------------------
      $sql = "select * from month ";
	  //'Aug' and  C  like '%1'  order by Server,d
//    $strSQL = "select * from month where B = 'Aug' and C = '18' order by server,d" ;
	if($_POST["ddlSelect"] != "" and  $_POST["txtKeyword"]  != '')
	{
//	  $strSQL .= " AND (".$_POST["ddlSelect"]." LIKE '%".$_POST["txtKeyword"]."%' ) ";
//	  $strSQL .= .$_POST["ddlSelect"]." LIKE '%".$_POST["txtKeyword"]."%' ";
	  $sql .= "where B = ('".$_POST["ddlSelect"]."') and C like '%".$_POST["txtKeyword"]."%' " ;
//	  $strSQL .= "('".$_POST["ddlSelect"]."' and C = '01' )" ;
//      $strSQL .= " 
	  $sql .= " Order by Server,d";
	  //$sql = "select * from month where B = 'Jun' and C like '%22%' Order by Server,d";
	  echo $_POST["ddlSelect"];
	  $query = mysqli_query($conn,$sql);
	  	  //echo str($query) ;
	}	
//------------------------------------------------------------------------------------------------

?>

    <form id="myform" method="post" action="genPDF.php">	
	<table border="0" align="center">
	<table width="791" border="1">
	  <tr>
		<th width="100"> <div align="center">รายงานผลการสำรองข้อมูล (แบบ Manual)ประจำวัน <?=$_POST["txtKeyword"]?> เดือน <?=$_POST["ddlSelect"]?> 2564</div></th>
	  </tr>
	</table>


	<table width="791" border="1">
	  <tr>
		<th width="100"> <div align="center">เครื่องแม่ข่าย</div></th>
		<th width="91"> <div align="center">วัน</div></th>
		<th width="91"> <div align="center">วันที่ </div></th>
		<th width="98"> <div align="center">เดือน </div></th>
		<th width="97"> <div align="center">ปี</div></th>
		<th width="100"> <div align="center">เวลาเริ่ม</div></th>
		<th width="100"> <div align="center">เวลาสิ้นสุด</div></th>
		<th width="71"> <div align="center">Used </div></th>
	  </tr>

<?php
$Sum = 0;
while($objResult=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
?>
<? if (($Sum % 2 ) == 0) { ?>
<tr>
 <td><input type="text" name="server[]" id="name" value="<?=$objResult["SERVER"];?>"  /></td>
   <td><input type="text" name="a[]" id="a" value="<?=$objResult["A"];?>"  /></td>				
       <td><input type="text" name="c[]" id="c" value="<?=$objResult["C"];?>"  /></td>						
<td><input type="text" name="b[]" id="b" value="<?=$objResult["B"];?>"  /></td>								
<td><input type="text" name="e[]" id="e" value="<?=$objResult["E"];?>"  /></td>								
<td><input type="text" name="d[]" id="d" value="<?=$objResult["D"];?>"  /></td>						
         <?}else {?>
<td><input type="text" name="d1[]" id="d1" value="<?=$objResult["D"];?>"  /></td>								  

 </tr>
<? } ?> 

	<?
         $TempX = $objResult["SERVER"];
         $TempY = $objResult["D"];
		 $Sum = $Sum + 1 ;
	}
	?>
  <tr><td><input  type="submit" id="submitbtn" /> พิมพ์รายงาน</td> </tr>	
	</table>
	</form>		
  
<?php
//}
?>
</table>
<?php
mysqli_close($conn);
?>
</body>
</html>
