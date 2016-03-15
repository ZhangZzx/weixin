<?php
include_once 'Common.php';
function getUserID(){
$sCode =$_GET["code"];
$sState=$_GET["state"];

$strAccess_Token=getAccessToken();

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
return $arrstrUserID['UserId'];
}
?>