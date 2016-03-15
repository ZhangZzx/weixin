<!--mobile-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<!--[if lt IE 9]>     
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>   
<![endif]-->
<link rel="stylesheet" type="text/css"　media="screen and (max-device-width: 728px)" href="/style/mindex.css" />
<link rel="stylesheet" type="text/css"　media="screen and (min-width: 729px) and (max-device-width: 1024px)"　href="/style/webs_index.css" />
<link rel="stylesheet" type="text/css"　media="screen and (min-width: 1025px) "　href="/style/web_index.css" />
<!--mobile end-->
<title>发送消息</title>
<style> 
	body {font-size:30px;} 
	a{color:#039;text-decoration:none;}
	select,input,table,text{font-size:20px;} 
	#page {width:600px;margin:0 auto;} 
</style> 
<html>
<form action="webSendMessControllor.php" method="post">
欢迎你，请选择消息接收人<br/>
消息接收人：
<?php 
include 'SqlHelper.class.php';
$sqlHelper=new SqlHelper();
$sql="select emp_id,emp_name from empinfo";
$res=$sqlHelper->excute_dql2($sql);
echo "<select name='getter'>";
foreach($res as $k=>$val){
echo "<option value=".$val['emp_id'].">".$val['emp_name']."</option>";
}
echo "</select>";
?>
<br />
发送内容：
<br />
<input type="text" name="message" id="message" size="300" style="width:300px;"/>
<br/>
<br/>
<input type="submit" name="submit" id="submit" value="发送" style="width:100px;height:40px" />
</form>
</html>