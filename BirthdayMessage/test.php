<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>无刷新显示时间</title>
<script src="my.js"  type="text/javascript"></script>
<script type="text/javascript">
/*function time(){
var today=new Date();
var mytime=today.toLocaleString();
document.write(mytime);
}
time();*/

//循环执行，每隔3秒钟执行一次showalert（） 
/*window.setInterval(showalert, 3000); 
function showalert() 
{ 
alert("bbb"); 
window.location.href="http://wx.lonking.cn/zzx/BirthdayMessage/test2.php";
} */
var myXmlHttpRequest;

function sendMessage(){
	myXmlHttpRequest=getXmlHttpObject();
	if(myXmlHttpRequest){
		//document.write("成功");
		//创建ajax成功
		var url="test2.php";
		//var data="";

		myXmlHttpRequest.open("post",url,true);
		myXmlHttpRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		
		//指定回调函数
		myXmlHttpRequest.onreadystatechange=function chuli(){
			//接收数据json
			//window.alert("2");
			if(myXmlHttpRequest.readyState==4){
				if(myXmlHttpRequest.status==200){
					//取出数据
					document.getElementById("showtime").innerText = myXmlHttpRequest.responseText;
					}
			}
		}
		//发送数据
		myXmlHttpRequest.send(null);
	}
}
window.setInterval("sendMessage()",1000);
//使用定时器

</script>
</head>
<body>  
<h1>Ajax动态显示时间</h1>  
<input type="button" value="开始显示时间" id="go"/>  
<p>当前时间：<font color="red"><span id="showtime"></span></font></p>  
</body>  
</html>