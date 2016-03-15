<?php
include_once 'sendMessage.php';
$userId=$_REQUEST['getter'];
$message=$_REQUEST['message'];
sendMessage($userId,$message);
?>