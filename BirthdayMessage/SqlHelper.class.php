<?php
header("Content-type:text/html;charset=utf-8");
//这是一个工具类，作用是完成对数据库的操作
class SqlHelper{
	public $conn;
	public $host='127.0.0.1';
	public $user='root';
	public $password='';    
	public $db='empinfo';
	
	public function __construct(){
		$this->conn=mysql_connect($this->host,$this->user,$this->password);
		
		if(!$this->conn){
			die("链接失败".mysql_error());
			}
			mysql_select_db($this->db,$this->conn);
			mysql_query("set names utf8");
		}
		//执行dql语句
	public function excute_dql($sql){
		$res=mysql_query($sql,$this->conn) or die("操作dql失败".mysql_error());
		
		return $res;
		}
		//执行dql语句返回一个数组
	public function excute_dql2($sql){
	    $arr=array();
		$res=mysql_query($sql,$this->conn) or die("操作dql失败".mysql_error());
		$i=0;
		//把$res=>$arr 把结果集内容转移到一个数组中
		while ($row=mysql_fetch_assoc($res)){
		    $arr[$i++]=$row;
		}		
		//这里就可以马上把$res关闭
		mysql_free_result($res);
		return $arr;
		}
		//考虑分页情况的查询
		//$sql1="slect * from 表名 limit 0,6";
		//$sql2="select count(id) from 表名";
		public function execute_dql_fenye($sql,$sql2,$fenyePage){
		    //查询了分页显示的数据
		    $res=mysql_query($sql,$this->conn) or die(mysql_error());
		    $arr=array();
		    //把res转移到$arr
		    while ($row=mysql_fetch_assoc($res)){
		        $arr[]=$row;
		    }
		    mysql_free_result($res);
		    
		    $res2=mysql_query($sql2,$this->conn) or die(mysql_error());
		    if($row=mysql_fetch_row($res2)){
		        $fenyePage->pageCount=ceil($row[0]/$fenyePage->pageSize);
		        $fenyePage->rowCount=$row[0];
		    }
		    mysql_free_result($res2);
		   
		    //把导航信息也封装到fenyePage对象中
		    $navigate="";
		    if($fenyePage->pageNow>1){
		        $prePage=$fenyePage->pageNow-1;
		        $navigate.="<a href='{$fenyePage->gotoUrl}?pageNow=$prePage'>上一页</a>&nbsp;";
		    }
		    if ($fenyePage->pageNow<$fenyePage->pageCount){
		        $nextPage=$fenyePage->pageNow+1;
		        $navigate.="<a href='{$fenyePage->gotoUrl}?pageNow=$nextPage'>下一页</a>&nbsp;";
		    }
		    
            $page_whole=10;
             $start=floor(($fenyePage->pageNow-1)/$page_whole)*$page_whole+1;
             $index=$start;
             //当前pageNow是在1-10页数，就没有向前翻动的超链接
             if($fenyePage->pageNow>$page_whole){
             $navigate.="<a href='{$fenyePage->gotoUrl}?pageNow=".($start-1)."'><<</a>&nbsp;";
             }
             //定$start 1-->10 11-->20
             for(;$start<$index+$page_whole;$start++){
             $navigate.="<a href='{$fenyePage->gotoUrl}?pageNow=$start'>[$start]</a>";
             }
             //整体每10页向后翻动
             $navigate.="&nbsp;<a href='{$fenyePage->gotoUrl}?pageNow=$start'>>></a>&nbsp;&nbsp;";
             //显示当前页和共有多少页
             $navigate.="当前页{$fenyePage->pageNow}/共{$fenyePage->pageCount}页";
		    
		    //把$arr赋给$fenyePage
		    $fenyePage->res_array=$arr;
		    $fenyePage->navigate=$navigate;
		    
		}
		//执行dml语句
	public function excute_dml($sql){
		$res=mysql_query($sql,$this->conn) or die("操作dml失败".mysql_error());
		if(!$res){
			return 0;//失败
		}else{
			if(mysql_affected_rows($this->conn)>0){
				return 1;//表示成功
			}else{
				return 2;//表示没有行受到影响
				}
			}
		}
		//关闭链接
		public function close_connect(){
		    if(!empty($this->conn)){
		    mysql_close($this->conn);
		    }
		}
	}
?>