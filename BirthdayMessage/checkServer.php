<?php
header("Content-Type:text/html;charset=utf-8");  
date_default_timezone_set("PRC");
require_once 'Common.php';
$now_date=date("Y-m-d",time());
$now_date1=date("Y-m-d H:i:s");

function getWeek($unixTime=''){
	$unixTime=is_numeric($unixTime)?$unixTime:time();
	$weekarray=array('日','一','二','三','四','五','六');
	return '星期'.$weekarray[date('w',$unixTime)];
}

$serverName = "192.168.50.159\lk"; //数据库服务器地址
$uid = "sa"; //数据库用户名
$pwd = "password"; //数据库密码

$connectionInfo = array("UID"=>$uid, "PWD"=>$pwd, "Database"=>"lkweixin","CharacterSet"=>"UTF-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    if( $conn == false)
    {
    	echo "false";
    	die( print_r( sqlsrv_errors(), true));
    }
    $sql = "select * from lkworkday where workday='$now_date' and iswork='√'";
    $res=sqlsrv_query($conn,$sql);
    
    if($row=sqlsrv_fetch_array ($res)){
    	$access_token=getAccessToken();

		$url = "https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token=".$access_token;
		//$contents="今天日期是".$row['workday'].",状态是".$row['iswork'];
		$contents="北京时间".$now_date1.",".getWeek().",状态是".$row['iswork'];
		/*$data = '{
				"touser":"20092110080509",
				"toparty":"",
				"totag":"",
				"msgtype":"text",
				"agentid":"5",
				"text":
					{"content":".$row['workday']."},
				"safe":"0"}';*/
		$json = array (
				"touser" => "20092110080509",
				//"touser" => "001009818",
				"toparty" => "",
				"totag" => "",
				"totag" => "",
				"msgtype" => "text",
				"agentid" => "5",
				"text" => array (
						"content" => $contents
				),
				"safe" => "0"
		);
		$data = JSON ( $json );

		  $ch = curl_init();
		  curl_setopt($ch, CURLOPT_URL, $url);
		  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
		  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
		  curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (compatible; MSIE 5.01;Windows NT 5.0)');
		  curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		  curl_setopt($ch, CURLOPT_AUTOREFERER,1);
		  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		  $info = curl_exec($ch);
		  if(curl_errno($ch)){
		  	echo 'Errno'.curl_error($ch);
		  }
		  curl_close($ch);
  		print_r($info);
  		
    }else{
    	echo '今天休息，谢谢！';
    }
    
    sqlsrv_free_stmt($res);
    sqlsrv_close($conn);
    
?>
