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
	<title>网页提示</title>
	<style> 
		body {font-size:30px;} 
		a{color:#039;text-decoration:none;}
		select,input,table,text{font-size:20px;} 
		#page {width:600px;margin:0 auto;} 
	</style> 
<?php
	include_once 'SqlHelper.class.php';
	header("Content-type:text/html;charset=utf-8");

	$sCode =$_GET["code"];
    $sState=$_GET["state"];

	$sAccess_TokenHttp="https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=wxb51b21673c0d413c&corpsecret=kRhoqbXZzfoT6vrCpEtkJw3MLJvHmioGUqUTgm66nbxM0V9YMygqTbMkRpwj8yTe";
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_TIMEOUT, 500);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_URL, $sAccess_TokenHttp);
	$resURL = curl_exec($curl);
	curl_close($curl);
	
	$arrAccess_Token = json_decode($resURL,true);
	$strAccess_Token=$arrAccess_Token['access_token'];

	$sUserIDHttp="https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=".$strAccess_Token."&code=".$sCode."&agentid=5";

	$curl1 = curl_init();
	curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl1, CURLOPT_TIMEOUT, 500);
	curl_setopt($curl1, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl1, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl1, CURLOPT_URL, $sUserIDHttp);
	$sUserReturn = curl_exec($curl1);
	curl_close($curl1);
	
	$arrstrUserID = json_decode($sUserReturn,true);
	$strUserID=$arrstrUserID['UserId'];

	//$strUserID是员工编号，在微信企业号里面作为账号
    //echo $strUserID;
	//exit();
    //获取员工信息
	
	echo "<table border='1' bordercolor='blue' cellspacing='0px' width='700px'>";
	echo "<tr><td>员工编号</td><td>员工姓名</td><td>员工微信号</td><td>员工生日</td></tr>";
	$sqlHelper=new SqlHelper();
	$sql="select * from empinfo where emp_id='$strUserID'";
	$res=$sqlHelper->excute_dql2($sql);
	foreach($res as $k=>$val){
		echo "<tr><td>{$val['emp_id']}</td><td>{$val['emp_name']}</td><td>{$val['weixin_id']}</td><td>{$val['birthday']}</td></tr>";
	}
	echo "</table>";
?>
</html>

	


