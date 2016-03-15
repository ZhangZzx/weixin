<?php
/*
 * do_post_request函数在CMD调用的时候报错
 * 暂时不使用此PHP文件
 * 2015-10-28
 */
include_once 'Common.php';
function sendMessage($userID, $contents) {
	$access_token = getAccessToken ();
	
	$json = array (
			"touser" => $userID,
			//"touser" => "20092110080509",
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
	$url = "https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token=" . $access_token;
	
	return do_post_request ( $url, $data );
}
?>
