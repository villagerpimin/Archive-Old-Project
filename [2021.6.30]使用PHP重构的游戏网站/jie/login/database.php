<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>这是数据库</title>
</head>

<body>
<?php
$conn=mysqli_connect("localhost","root","")or die("连接失败".mysqli_connect_error());
mysqli_select_db($conn,"fhyx")or die("选择失败".mysqli_error());
MYSQLI_SET_charset($conn,"utf8");
?>
</body>
</html>