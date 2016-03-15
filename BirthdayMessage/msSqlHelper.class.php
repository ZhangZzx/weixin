<?php
header("Content-type:text/html;charset=utf-8");
//这是一个工具类，作用是完成对数据库的操作
class MsSqlHelper{
	public $conn; 
	public $serverName = "192.168.50.41"; //数据库服务器地址
	public $uid = "sa"; //数据库用户名
	public $pwd = "lonking"; //数据库密码
	public $db="db_u9v20_Data";//实体库名称
	
		public function __construct(){
		  $this->connectionInfo = array("UID"=>$this->uid, "PWD"=>$this->pwd, "Database"=>$this->db,"CharacterSet"=>"UTF-8");
			$this->conn=sqlsrv_connect( $this->serverName, $this->connectionInfo);
			if( !$this->conn)
			{
				//echo "false";
				die( "链接失败".print_r( sqlsrv_errors(), true));
			}
		}
		//执行dql语句
		public function excute_dql($sql){
		$res=sqlsrv_query($this->conn,$sql) or die( "操作dql失败".print_r( sqlsrv_errors(), true));
		
		return $res;
		}
		//执行dql语句，返回一个数组
		public function excute_dql2($sql){
			$arr=array();
			$res=sqlsrv_query($this->conn,$sql);// or die( "操作dql失败".print_r( sqlsrv_errors(), true));
			$i=0;
			//把$res=>$arr 把结果集内容转移到一个数组中
			while ($row=sqlsrv_fetch_array($res)){
				$arr[$i++]=$row;
			}
			//这里就可以马上把$res关闭
			sqlsrv_free_stmt($res);
			return $arr;
		}
		
		//执行dml语句
		public function execute_dml($sql){
		$b=sqlsrv_rows_affected(sqlsrv_query($this->conn,$sql));
		if(!$b){
			return 0;//失败
		}else{
			if(sqlsrv_rows_affected($b)>0){
				return 1;//成功
			}else{
				return 2;//表示没有影响
					 }
			}		
		}

		//关闭链接
		public function close_connect(){
		    if(!empty($this->conn)){
		    sqlsrv_close($this->conn);
		    }
		}		
		
	}
?>