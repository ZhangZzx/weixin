<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<!--mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">  
	<!--[if lt IE 9]>     
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>   
	<![endif]-->
	<link rel="stylesheet" type="text/css"　media="screen and (max-device-width: 728px)" href="/style/mindex.css" />
	<link rel="stylesheet" type="text/css"　media="screen and (min-width: 729px) and (max-device-width: 1024px)"　href="/style/webs_index.css" />
	<link rel="stylesheet" type="text/css"　media="screen and (min-width: 1025px) "　href="/style/web_index.css" />
	<!--mobile end-->
	<title>个人信息</title>
	<style> 
		body {font-size:30px;} 
		a{color:#039;text-decoration:none;}
		select,input,table,text{font-size:20px;} 
		#page {width:600px;margin:0 auto;} 
	</style> 
<?php
include_once 'SqlHelper.class.php';
include_once 'getUserID.php';
header("Content-type:text/html;charset=utf-8");

$emp_id=getUserID();

$sqlHelper=new SqlHelper();
$sql="select * from empinfo where emp_id='$emp_id'";
$res=$sqlHelper->excute_dql2($sql);

echo "<table border='1' bordercolor='blue' cellspacing='0px' width='350px'>";
foreach($res as $k=>$val){
	//echo "<tr><td>员工编号</td><td>员工姓名</td><td>员工生日</td></tr>";
	//echo "<tr><td>{$val['emp_id']}</td><td>{$val['emp_name']}</td><td>{$val['birthday']}</td></tr>";
	echo "<a href='updateBirthdayView.php?emp_id={$val['emp_id']}'>信息不对，点我！</a>";
	echo "<tr><td>员工编号</td></tr>";
	echo "<tr><td>{$val['emp_id']}</td></tr>";
	echo "<tr><td>员工姓名</td></tr>";
	echo "<tr><td>{$val['emp_name']}</td></tr>";
	echo "<tr><td>员工生日</td></tr>";
	echo "<tr><td>{$val['birthday']}</td></tr>";
}
echo "</table>";
?>
</html>