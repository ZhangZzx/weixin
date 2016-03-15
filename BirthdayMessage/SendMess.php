<?php 
require_once 'Common.php';
	function SendMess($m_strUser,$m_strUserID,$m_strMan,$m_strSend){
		//$m_strUser发送消息人 $m_strUserID发送消息人ID
		//$m_strMan接收消息人,$m_strSend发送内容
		$now_time=date("Y-m-d H:i:s",time());
		//有可能是程序自动发送，所以，发消息人的ID可能是空的，目前有英文-
		if (($m_strUser!="-") && ($m_strUserID!="-") ) {
			$strText = $m_strSend.chr(13).chr(10)."以上信息由".$m_strUser."在".$now_time."发送给你。\n可以使用@加人名再加个空格再加发送内容，直接将消息发送给对方。\n如@邱晶 你好！";
		}else{
			$strText=$m_strSend;
		}
		$strToParty="";
		$strToTag="";
	    /*$strSend = "{"."\"touser\"" . ": " . "\"" . $m_strMan . "\"" . ",".
	                 "\"toparty\"" . ": " . "\"" . $strToParty . "\"" . ",".
	                 "\"totag\"" . ": " . "\"" . $strToTag . "\"" . "," .
	                 "\"msgtype\"" . ": " . "\"text\"" . "," .
	                 "\"agentid\"" . ": " . "\"5\"" . "," .
	                 "\"text\"" . ": {" .
	                     "\"content\"" . ":" . "\"" . $strText . "\"" .
	                     "}," .
	                 "\"safe\"" . ":" . "\"0\"" .
	                 "}";*/
	    
	    $touser="20092110080509";
	    $content="生日快乐";
	    $json=array
	    (
	    		"touser"=>$touser,
	    		"toparty"=>"",
	    		"totag"=>"",
	    		"totag"=>"",
	    		"msgtype"=>"text",
	    		"agentid"=>"5",
	    		"text"=>array("content"=>$content),
	    		"safe"=>"0"
	    );
	    $strSend=JSON($json);
	    //return $strSend;
	    
	    $now_time=date("Y-m-d H:i:s",time());
	    
	// 	 $strAccess_Token;
		$strAccess_Token=getAccessToken();
	     $m = "https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token=".$strAccess_Token;

	     $now_time=date("Y-m-d H:i:s",time());
	     $strTime=$strTime."准备post".$now_time.$m.$strSend;
	     $arrAsk = do_post_request($m,$strSend);
	     $now_time=date("Y-m-d H:i:s",time());
	     $strTime=$strTime."获得post".$now_time;
	     //$arrAsk=$strTime;
		//return $arrAsk;
	     $kweb = "{"."\""."errcode"."\"".":0,"."\""."errmsg"."\"".":"."\""."ok"."\"".","."\""."invaliduser"."\"".":"."\""."\""."}";
	     $kSend = "{"."\""."errcode"."\"".":0,"."\""."errmsg"."\"".":"."\""."ok"."\""."}";
	     //print $arrAsk.$k;
	    If (($arrAsk!=$kweb) and ($arrAsk!=$kSend))
	    	{
    			return $arrAsk."发送消息失败，请将这个报错发给邱晶。".$strTime;
    		}else{
//    		 将发送消息的人，信息写入数据库日志
				
    			/*$now_date=date("Y-m-d",time());
    			include_once 'initdatabase.php';
    			initdb($serverName,$uid,$pwd);
    			$connectionInfo = array("UID"=>$uid, "PWD"=>$pwd, "Database"=>"lkorder","CharacterSet"=>"UTF-8");
    			$conn = sqlsrv_connect( $serverName, $connectionInfo);
    			if( $conn == false)
    			{
    				echo "false";
    				die( print_r( sqlsrv_errors(), true));
    			}else
    			{
    				$m_strMess=str_replace("'","''",$strSend);
    				$sql2="INSERT INTO lkorder.dbo.dc_logoperate(operate,empid,OPERATETIME) 
    				VALUES ('$m_strMess',  '$m_strUserID','$now_time')";
    				// $sql2;
    				$res=sqlsrv_query($conn,$sql2);*/
    				return "内容发送成功";
    			//}
    			
    		}
	}
?>