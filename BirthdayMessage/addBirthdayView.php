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
<title>添加生日信息</title>
<style> 
	body {font-size:30px;} 
	a{color:#039;text-decoration:none;}
	select,input,table,text{font-size:20px;} 
	#page {width:600px;margin:0 auto;} 
</style> 
<script language="javascript" type="text/javascript" src="My97DatePicker/WdatePicker.js"></script>
</head>
<form action="addBirthdayControllor.php" method="post">
<table>
<tr><td>请输入姓名：</td></tr>
<tr><td><input type="text" name="emp_name"/></td></tr>
<tr><td>请输入员工编号：</td></tr>
<tr><td><input type="text" name="emp_id"/></td></tr>
<tr><td>请输入微信号：</td></tr>
<tr><td><input type="text" name="weixin_id"/></td></tr>
<tr><td>请选择生日：</td></tr>
<tr><td><input class="Wdate" type="text" name="birthdayDate" onClick="WdatePicker()"></td></tr>
<tr><td><input type="submit" value="提交"/>&nbsp;&nbsp;&nbsp;<input type="reset" value="重置"/></td></tr>
</table>
</form>
</html>