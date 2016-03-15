<?php
/**************************************************************
 *
*	使用特定function对数组中所有元素做处理
*	@param	string	&$array		要处理的字符串
*	@param	string	$function	要执行的函数
*	@return boolean	$apply_to_keys_also		是否也应用到key上
*	@access public
*
*************************************************************/
function arrayRecursive(&$array, $function, $apply_to_keys_also = false) {
	static $recursive_counter = 0;
	if (++ $recursive_counter > 1000) {
		die ( 'possible deep recursion attack' );
	}
	foreach ( $array as $key => $value ) {
		if (is_array ( $value )) {
			arrayRecursive ( $array [$key], $function, $apply_to_keys_also );
		} else {
			$array [$key] = $function ( $value );
		}
		
		if ($apply_to_keys_also && is_string ( $key )) {
			$new_key = $function ( $key );
			if ($new_key != $key) {
				$array [$new_key] = $array [$key];
				unset ( $array [$key] );
			}
		}
	}
	$recursive_counter --;
}

/**
 * ************************************************************
 *
 * 将数组转换为JSON字符串（兼容中文）
 * 
 * @param array $array        	
 * @return string
 * @access public
 *        
 *         ***********************************************************
 */
function JSON($array) {
	arrayRecursive ( $array, 'urlencode', true );
	$json = json_encode ( $array );
	return urldecode ( $json );
}
/*
 * 通过http post发送json数据
 */
/*
 function http_post_data($url, $data_string) {

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json; charset=utf-8',
	'Content-Length: ' . strlen($data_string))
	);
	ob_start();
	curl_exec($ch);
	$return_content = ob_get_contents();
	ob_end_clean();

	$return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	return array($return_code, $return_content);
}
*/

function do_post_request($url, $data, $optional_headers = null) {
	$params = array (
			'http' => array (
					'method' => 'POST',
					'content' => $data 
			) 
	);
	if ($optional_headers !== null) {
		$params ['http'] ['header'] = $optional_headers;
	}
	$ctx = stream_context_create ( $params );
	$fp = @fopen ( $url, 'rb', false, $ctx );
	if (! $fp) {
		throw new Exception ( "Problem with $url, $php_errormsg" );
	}
	$response = @stream_get_contents ( $fp );
	if ($response === false) {
		throw new Exception ( "Problem reading data from $url, $php_errormsg" );
	}
	return $response;
}
// 获取access_token
function getAccessToken() {
	$sAccess_TokenHttp = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=wxb51b21673c0d413c&corpsecret=kRhoqbXZzfoT6vrCpEtkJw3MLJvHmioGUqUTgm66nbxM0V9YMygqTbMkRpwj8yTe";
	
	$curl = curl_init ();
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
	curl_setopt ( $curl, CURLOPT_TIMEOUT, 500 );
	curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, false );
	curl_setopt ( $curl, CURLOPT_URL, $sAccess_TokenHttp );
	$resURL = curl_exec ( $curl );
	curl_close ( $curl );
	
	$arrAccess_Token = json_decode ( $resURL, true );
	return $arrAccess_Token ['access_token'];
}
//向URL发送数据
function sendURL($url,$data){
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
	//print_r($info);
	echo '发送成功！';
}