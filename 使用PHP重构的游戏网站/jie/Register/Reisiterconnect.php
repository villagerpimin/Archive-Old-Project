<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>这是注册的</title>
</head>

<body>
<?php
include("../login/database.php");
if(!empty($_POST['register'])){
$username=$_POST['username'];
$password=$_POST['password'];
$email=$_POST['mailbox'];
$repassword=$_POST['repassword'];
$checkbox=isset($_POST['checkbox'])?1:0;
$insert="insert into user(username,password,email) values('$username','$password','$email')";
$c=mysqli_fetch_object();
if($checkbox===1){
  if(!mysqli_query($conn,$insert)){
	   if($username=$c->username){
		echo "<script>alert('你的账号相同,注册失败')</script>";}
		}else if($password!=$repassword)
		{echo "<script>alert('您的两次密码不一致')</script>";}
		else{echo "<script>alert('注册成功')</script>";
		echo "<script>window.location.href='../login/login.php'</script>";}
       }
	   else{echo "<script>alert('请勾选注册服务！')</script>";}
	}

?>
</body>
</html>