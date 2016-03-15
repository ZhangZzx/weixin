<?php
header("Content-type:text/html;charset=utf-8");

include_once "WXBizMsgCrypt.php";
include_once "messageType.class.php";
include_once "msSqlHelper.class.php";

$wechatObj = new wechatCallbackapiTest();
if(isset($_GET["echostr"])){
    $wechatObj->vaild();}
else{
    $wechatObj->responseMsg();
}

class wechatCallbackapiTest
{
    public function vaild(){
        $encodingAesKey = "EOrFMAyauBVzK0sndgnB6AwLXnhB5WUQxA2heOqgsbQ";
        $token = "birthdayMessage";
        $corpId = "wxb51b21673c0d413c";
        
        $sVerifyMsgSig = $_GET["msg_signature"];
        $sVerifyTimeStamp = $_GET["timestamp"];
        $sVerifyNonce = $_GET["nonce"];
        $sVerifyEchoStr = $_GET["echostr"];    
        
        $wxcpt = new WXBizMsgCrypt($token, $encodingAesKey, $corpId);
        if($sVerifyEchoStr){
            $sEchoStr = "";// 需要返回的明文
            $errCode = $wxcpt->VerifyURL($sVerifyMsgSig, $sVerifyTimeStamp, $sVerifyNonce, $sVerifyEchoStr, $sEchoStr);
            if ($errCode == 0) {
                print($sEchoStr);
            } else {
                print("ERR1: " . $errCode . "\n\n");
            }
            exit;
        }
    }
    
    public function responseMsg()
    {
	$encodingAesKey = "EOrFMAyauBVzK0sndgnB6AwLXnhB5WUQxA2heOqgsbQ";
 	$token = "birthdayMessage";
	$corpId = "wxb51b21673c0d413c";
    $secret = "kRhoqbXZzfoT6vrCpEtkJw3MLJvHmioGUqUTgm66nbxM0V9YMygqTbMkRpwj8yTe";
        
    $msg_signature  = $_GET["msg_signature"];
    $timestamp  = $_GET["timestamp"];
    $nonce  = $_GET["nonce"];
        
    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];//获取post过来的链接,

	$wxcpt = new WXBizMsgCrypt($token, $encodingAesKey, $corpId);
//******************第三方收到公众号平台（用户）发送的消息（用户回复的消息进行解密）******************
	$sMsg = "";//解密之后的明文
	$errCode = $wxcpt->DecryptMsg($msg_signature, $timestamp, $nonce, $postStr , $sMsg);
	$xml = new DOMDocument();
	$xml->loadXML($sMsg);
	//微信公众号ID，即wxb51b21673c0d413c
	$ToUserName = $xml->getElementsByTagName('ToUserName')->item(0)->nodeValue;  
	//员工编号，在微信企业号里面作为账号,注意：不是员工的微信号
	$FromUserName = $xml->getElementsByTagName('FromUserName')->item(0)->nodeValue;  
	//获取消息类型
    $MsgType = $xml->getElementsByTagName('MsgType')->item(0)->nodeValue; 
    $keyword = $xml->getElementsByTagName('Content')->item(0)->nodeValue;
    //获取事件类型
    $customerevent = $xml->getElementsByTagName('Event')->item(0)->nodeValue; 
    //获取自定义菜单的key值
	$EventKey = $xml->getElementsByTagName('EventKey')->item(0)->nodeValue;
		
	$messagetype = new messageType ();
	//定义文本回复格式
	$textTpl = $messagetype->text ();
	//定义图片回复格式
	$newsTpl = $messagetype->image ();
	
        switch($MsgType){
            case "event":
            if($customerevent == "subscribe"){
            $contentStr="您好，感谢关注中国龙工控股有限公司！！！\n回复1查看使用说明";
                $resultStr = sprintf($textTpl, $FromUserName, $ToUserName, $time, "text", $contentStr);
            }
            else if($customerevent == "click"){
                switch($EventKey){
                    case "502":
					$contentStr="您好，上海机械功能尚未完善，敬请期待！";
                    $resultStr = sprintf($textTpl, $FromUserName, $ToUserName, $time, "text", $contentStr);
                    break;
                    case "513":
					$contentStr="您好，中国销售功能尚未完善，敬请期待！";
                    $resultStr = sprintf($textTpl, $FromUserName, $ToUserName, $time, "text", $contentStr);
                    break;
                    case "518":
					$contentStr="您好，河南机械功能尚未完善，敬请期待！";
                    $resultStr = sprintf($textTpl, $FromUserName, $ToUserName, $time, "text", $contentStr);
                    break;
                }
            }
            break;

            case "text":
            /*switch($keyword){ 
                case "马云":  
                $contentStr="您好，马云！我知道您创建了阿里巴巴！";  
                break;  
                case "马化腾":  
                $contentStr="您好，马化腾！我知道创建了企鹅帝国！";  
                break;  
                case "史玉柱":  
                $contentStr="您好，史玉柱！我知道您创建了巨人网络！";  
                break;
                case "你妹":
                case "fuck":  
                $contentStr="你妹，不准骂人！";  
                break;
                case "hi":
                case "你好":  
                $contentStr="您好！欢迎访问中国龙工控股有限公司！Can I help  you？";  
                break;              
                case "1":
                $contentStr=" 回复1查看使用说明\n 回复2查看公司介绍\n 回复3查看公司位置";
                break;
                case "2":
                $contentStr="中国龙工控股有限公司，简称“LONKING”，系由第十一届全国人大代表、全国劳动模范、优秀中国特色社会主义事业建设者李新炎先生于1993年在福建龙岩创立的一家大型工程机械制造企业；2005年率中国工程机械行业之先在香港主板上市（股票代码：3339）；2009年公司综合实力跃居全球工程机械行业第24位；营业利润率增幅全球第四，销售额增幅全球第五，平均资产回报率全球第六。";
                break;
				case "3":
                $contentStr="上海市松江区民益路26号";
                break;
                case "oa":
                $contentStr="http://oa.lonking.cn";
                break;
                
                case "名字":
				$contentStr=$FromUserName."++".$ToUserName."++".$MsgType."++".$keyword."++".$customerevent."++".$EventKey;
                break;
                
                default :  
                $tranurl="http://openapi.baidu.com/public/2.0/bmt/translate?client_id=9peNkh97N6B9GGj9zBke9tGQ&q={$keyword}&from=auto&to=auto";//百度翻译地址
                $transtr=file_get_contents($tranurl);//读入文件
                $transon=json_decode($transtr);//json解析
				//print_r($transon);
				$contentStr = $transon->trans_result[0]->dst;//读取翻译内容  
                break;       
            }
            $resultStr = sprintf($textTpl, $FromUserName, $ToUserName, $time, $MsgType, $contentStr);
            */
            $msSqlHelper=new MsSqlHelper();
            if(substr($keyword,0,5)=="PPL20"){
            	$sql="select * from ic_erp004_pr_0 where ic_billcode='$keyword'";
            	$res=$msSqlHelper->excute_dql2($sql);
            	if(!empty($res)){
            	foreach ($res as $key=>$val){
            		if($val['ic_flag']==1){
            		$contentStr="您输入的单据编号是：".$keyword."。\n正在查询，请稍后……查询完毕，具体信息如下：公司组织名是".$val['ic_company'];
            		}
            		else{
            			$contentStr="您输入的单据编号是：".$keyword."。\n正在查询，请稍后…………\n查询完毕，具体信息如下：\n公司组织名是".$val['ic_company']."。\n该单据读取失败，错误信息如下：\n".$val['ic_info'];
            		}
            	}
            	}else{
            		$contentStr="查询暂无数据，请确认输入的单据编号。";
            	}
            	$msSqlHelper->close_connect();
            }else if(substr($keyword,0,4)=="DO20"){
            	$sql="select * from ic_erp005_rc_0 where ic_billcode='$keyword'";
            	$res=$msSqlHelper->excute_dql2($sql);
           		if(!empty($res)){
            	foreach ($res as $key=>$val){
            	if($val['ic_flag']==1){
            			$contentStr="您输入的单据编号是：".$keyword."。\n正在查询，请稍后……查询完毕，具体信息如下：公司组织名是".$val['ic_company'];
            		}
            		else{
            			$contentStr="您输入的单据编号是：".$keyword."。\n正在查询，请稍后…………\n查询完毕，具体信息如下：\n公司组织名是".$val['ic_company']."。\n该单据读取失败，错误信息如下：\n".$val['ic_info'];
            		}
            	}
            	}else{
            		$contentStr="查询暂无数据，请确认输入的单据编号。";
            	}
            	$msSqlHelper->close_connect();
            }else 
            {
            	$contentStr="查询有误，请输入正确单据编号";
            }
            $resultStr = sprintf($textTpl, $FromUserName, $ToUserName, $time, $MsgType, $contentStr);
            break;
            
            case "image":
            $resultStr = sprintf($newsTpl, $FromUserName, $ToUserName, $time, $msgType, $contentStr);	
            break;
            
            default:
            $contentStr="您好，其他基础功能尚未开发完善，敬请期待！";
            $resultStr = sprintf($textTpl, $FromUserName, $ToUserName, $time, "text", $contentStr);
            break;
        }    
////******************第三方发送消息给公众平台（回复用户的消息进行加密）//******************

    $sEncryptMsg = "";//xml格式的密文
    $errCode = $wxcpt->encryptMsg($resultStr, $timestamp, $nonce, $sEncryptMsg);
    echo $sEncryptMsg;
    exit;
    }
}
?>
