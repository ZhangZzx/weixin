//创建ajax引擎
function getXmlHttpObject(){
		//不同的浏览器获取对象xmlhttprequest对象方法不一样
		var xmlHttpRequest;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlHttpRequest=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlHttpRequest=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		return xmlHttpRequest;
		}
		
		function $(id){
			return document.getElementById(id);
			}