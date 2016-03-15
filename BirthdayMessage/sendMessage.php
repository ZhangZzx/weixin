<?php
require_once 'Common.php';
function sendMessage($userID, $contents) {
    	$access_token=getAccessToken();
		$url = "https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token=".$access_token;
		
		$json = array (
				"touser" => $userID,
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
		
		sendURL($url, $data);
		 /*$ch = curl_init();
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
  		print_r($info);*/
}
    

?>
