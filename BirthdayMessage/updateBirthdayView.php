<html>
	<!--mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">  
	<!--[if lt IE 9]>     
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>   
	<![endif]-->
	<link rel="stylesheet" type="text/css"　media="screen and (max-device-width: 728px)" href="/style/mindex.css" />
	<link rel="stylesheet" type="text/css"　media="screen and (min-width: 729px) and (max-device-width: 1024px)"　href="/style/webs_index.css" />
	<link rel="stylesheet" type="text/css"　media="screen and (min-width: 1025px) "　href="/style/web_index.css" />
	<!--mobile end-->
	<title>修改生日</title>
	<style> 
		body {font-size:30px;} 
		a{color:#039;text-decoration:none;}
		select,input,table,text{font-size:20px;} 
		#page {width:600px;margin:0 auto;} 
	</style>
	<script language="javascript" type="text/javascript" src="My97DatePicker/WdatePicker.js"></script>
	
<?php
header("Content-type:text/html;charset=utf-8");
include_once 'SqlHelper.class.php';
include_once 'getUserID.php';
if(empty($_REQUEST['emp_id'])){
	$emp_id=getUserID();
}else{
	$emp_id=$_REQUEST['emp_id'];
}


$sqlHelper=new SqlHelper();
$sql="select * from empinfo where emp_id='$emp_id'";
$res=$sqlHelper->excute_dql2($sql);
foreach($res as $k=>$val){
	//echo "<tr><td>{$val['emp_id']}</td><td>{$val['emp_name']}</td><td>{$val['weixin_id']}</td><td>{$val['birthday']}</td></tr>";
	echo "<form action='updateBirthdayControllor.php?emp_id=$emp_id' method='post'>";
	echo "<table>";
	echo "<tr><td>".$val['emp_name']."：请选择生日：</td></tr>";
	echo "<tr><td><input class='Wdate' type='text' name='birthdayDate' onClick='WdatePicker()'></td></tr>";
	echo "<tr><td><input type='submit' value='提交'/>&nbsp;&nbsp;&nbsp;<input type='reset' value='重置'/></td></tr>";
	echo "</table>";
	echo "</from>";
}
?>
</html>