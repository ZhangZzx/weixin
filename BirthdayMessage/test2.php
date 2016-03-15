<?php
header("cache-control:no-cache,must-revalidate");  
header("Content-Type:text/html;charset=utf-8");  
include_once 'msSqlHelper.class.php';
/*require_once 'sendMessage2.php';
include_once 'getUserID.php';
require_once 'SqlHelper.class.php';
$now_time=date("m-d",time());
$sqlHelper=new SqlHelper();
$sql="select emp_name,emp_id from empinfo where birthday like '%$now_time'";
$res=$sqlHelper->excute_dql2($sql);

foreach($res as $k=>$val){
	//echo $val['emp_id']."-".$val['weixin_id']."-".$val['emp_name'];
	//$now_time=date("Y-m-d H:i:s",time());
	echo date("北京时间Y年m月d日H:i:s")."+".sendMessage($val['emp_id'],"【中国龙工】".$val['emp_name']."贤才：公司的发展离不开您的辛勤和智慧，离不开您家人的支持和奉献，在此表示衷心的感谢！在您生日之际送上最诚挚的祝福，祝您生日快乐、万事如意！中国龙工控股有限公司董事局主席 李新炎");
}*/
$showtime = date("北京时间Y年m月d日H:i:s");
//$showtime = date("Y:m:d H:i:s");
echo $showtime;
?>
