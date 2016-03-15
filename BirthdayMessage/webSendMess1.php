	<!--mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">  
	<!--[if lt IE 9]>     
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>   
	<![endif]-->
	<link rel="stylesheet" type="text/css"　media="screen and (max-device-width: 728px)" href="/style/mindex.css" />
	<link rel="stylesheet" type="text/css"　media="screen and (min-width: 729px) and (max-device-width: 1024px)"　href="/style/webs_index.css" />
	<link rel="stylesheet" type="text/css"　media="screen and (min-width: 1025px) "　href="/style/web_index.css" />
	<!--mobile end-->
	<title>发送消息</title>
	<style> 
		body {font-size:30px;} 
		a{color:#039;text-decoration:none;}
		select,input,table,text{font-size:20px;} 
		#page {width:600px;margin:0 auto;} 
	</style> 
<?php

	header("Content-type:text/html;charset=utf-8");
 //echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    Global $sUserid;
    Global $sUser;
    $sUserid = $_GET["userid"];
    $sUser = $_GET["user"];
//     print "<br />";
//     print $sUserid;
//     print $sUser;
    global $G_strNowYear;
    $G_strNowYear=date("Y",time());//今年年份
    //print $G_strNowYear;
    global $G_strNowMonth;
    $G_strNowMonth=date("m",time());
    global $G_strNowDay;
    $G_strNowDay=date("d",time());
    //print "今天日期". $G_strNowYear."-".$G_strNowMonth."-".$G_strNowDay;
    global $G_ChoMan;

    if(!empty($_POST['ok']))
    {
    	//print "下面OK";
     	$G_ChoMan=$_POST['man'];
     	$G_txtSend=$_POST['txtSend'];
     	$strAnswer="";
     	if ($G_ChoMan=="All"){
			$G_PostMan="@All";
			
		}else{
// 			print $G_ChoMan;
// 			$User=explode("|",$G_ChoMan);
			$G_PostMan=$G_ChoMan.'|';
		}
		//print "111". $G_PostMan;
		include_once 'SendMess.php';
		$strAnswer=SendMess($sUser,$sUserid,$G_PostMan,$G_txtSend);
		
     	
//      	var_dump($_POST);
    }else {
    	
    }
    //print $G_ChoYear.$G_ChoMonth;
/*
//print "<br />";
$sql1 = "select *
		from lkweixin.dbo.emp 
		 where empid<>'WXADMIN'
		 order by empname";
//join lkorder.dbo.dc_function n on t.empid=n.empid
//echo  $sql1;
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
		    	//echo "ok!";
		    }

			global $res;
		    $res=sqlsrv_query($conn,$sql1);

		    if( $res === false ) {
		    die( print_r( sqlsrv_errors(), true));
		    }

		    //var_dump($res);

		    $resEat="";
		    */
?>
<html>
<form action="SendMess.php" method="post">
<?php echo $sUser ?>欢迎你，请选择消息接收人和输入发送内容 	
<font color="red"><?php print "<br />".$strAnswer."<br />";?></font>
消息接收人：张之星
<br />
发送内容：
<br />
<input type="text" name="txtSend" id="txtSend" size="300" style="width:300px;" value=<?php echo $G_txtSend; ?> >
<br/>
<br/>
<input type="submit" name="ok" id="ok" value="发送" style="width:100px;height:40px" />
</form>
</html>