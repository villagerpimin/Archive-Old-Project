<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改管理员密码</title>
</head>

<body>
<?php

$id=$_GET['id'];
include("../login/database.php");
if(!empty($_POST['register'])){
$password=$_POST['password'];
$repassword=$_POST['repassword'];
$update="update user set password='$password' where id=$id";
$result=mysqli_query($conn,$update);
		if($repassword!=$password){
			echo "<script>alert('您的修改密码不一致')</script>";	
		}else{echo "<script>alert('修改成功！将退回登陆界面重新登陆！');window.location.href='../login/login.php';</script>";}
}	
?>
</body>
</html>