<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
session_start();
include('../login/database.php');
if(!empty($_POST['register'])){
$yzm=$_POST['yzm'];//这是验证码表单
$vcode=$_SESSION['vcode']; //获取服务器的密码
$username=$_POST['username'];
$email=$_POST['mailbox'];
$select="select * from user where username='$username' and email='$email'";
$result=mysqli_query($conn,$select);

    //返回他的行数
	$row=mysqli_num_rows($result);
    $c=mysqli_fetch_object($result);//执行结果集
	if(loginyzm($yzm,$vcode)){
		 if($row>0){
			 echo "<script>window.location.href='nextforget?name=$username'</script>";
			 }else{echo "<script>alert('你的账号邮箱错误')</script>";}
		}
	
}

//判断验证码是否有没有正确
function loginyzm($yzm,$vcode){
	if($yzm==$vcode){return true;}
	else{echo "<script>alert('您的验证码错误请仔细看');window.location.href='Forget.php';</script>";}
}
?>
</body>
</html>