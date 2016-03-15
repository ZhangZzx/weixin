<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
<title>修改生日</title>
<style> 
	body {font-size:30px;} 
	a{color:#039;text-decoration:none;}
	select,input,table,text{font-size:20px;} 
	#page {width:600px;margin:0 auto;} 
</style> 
</head>
<?php
include_once 'SqlHelper.class.php';

$emp_id=$_REQUEST['emp_id'];
$birthdayDate=$_REQUEST['birthdayDate'];

$sqlHelper=new SqlHelper();
$sql="update empinfo set birthday='$birthdayDate' where emp_id='$emp_id'";
$b=$sqlHelper->excute_dml($sql);
echo "修改成功";
?>
</html>
