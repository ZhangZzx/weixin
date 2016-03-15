<?php

include_once "errorCode.php";

/**
 * SHA1 class
 *
 * 计算公众平台的消息签名接口.
 */
class SHA1
{
	/**
	 * 用SHA1算法生成安全签名
	 * @param string $token 票据
	 * @param string $timestamp 时间戳
	 * @param string $nonce 随机字符串
	 * @param string $encrypt 密文消息
	 */
	public function getSHA1($token, $timestamp, $nonce, $encrypt_msg)
	{
		//排序
		try {
			$array = array($encrypt_msg, $token, $timestamp, $nonce);
            
			sort($array, SORT_STRING);
            /*
            print '$array[0]:'.$array[0];
             print "<br />";
            print '$array[1]:'.$array[1];
             print "<br />";
            print '$array[2]:'.$array[2];
             print "<br />";
            print '$array[3]:'.$array[3];
             print "<br />";
             */
            $str = implode($array);//implode() 函数把数组元素组合为一个字符串。
            /*
            print '$str:'.$str;
             print "<br />";
            print 'sha1($str):'.sha1($str);
             print "<br />";
            */
			return array(ErrorCode::$OK, sha1($str));
		} catch (Exception $e) {
			print $e . "\n";
			return array(ErrorCode::$ComputeSignatureError, null);
		}
	}

}


?>