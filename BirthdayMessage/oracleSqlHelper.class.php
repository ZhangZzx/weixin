<?
echo "1";
$dbconn = oci_connect('qiujing','qj',"(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=lkplmnew)(PORT=1521))(CONNECT_DATA=(SID=sid)))");
if ($dbconn) {
    echo '连接成功';
}else {
    echo '连接失败';
}
?>