<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
//启动全局变量session
session_start();
include("database.php");

if(!empty($_POST['login'])){
	$username=$_POST['username'];
	$password=$_POST['password'];
	$repassword=$_POST['repassword'];
	
	//这是多选按钮的
    $autologin=isset($_POST['autologin'])?1:0;  //1是选中了0是没选中
	
	$yzm=$_POST['yzm'];//这是验证码表单
	$vcode=$_SESSION['vcode']; //获取服务器的密码
	
	$select="select * from user where username='$username' and password='$password'";
	$result=mysqli_query($conn,$select);
	
	//返回他的行数
	$row=mysqli_num_rows($result);
    $c=mysqli_fetch_object($result);//执行结果集
	$admin=$c->admin;
	
	//这是执行他们有没有为空调用函数
	if($admin==0){
	if (loginempty($username,$password,$repassword,$vcode)){
		//执行验证码有没有正确
		if(loginyzm($yzm,$vcode)){
	       if($row>0){
	
	    if($autologin===1)
		{
			//如果选中了免登陆7天可以免登录
			setcookie("username",$username,time()+3600*24*7,'/');
			setcookie("password",$password,time()+3600*24*7,'/');
			setcookie("id",$c->id,time()+3600*24*7,'/');	
		}
		else
		{
			//如果没有选中就一小时之后消失
			setcookie("username",$username,time()+3600,'/');
			setcookie("password",$password,time()+3600,'/');
			setcookie("id",$c->id,time()+3600,'/');
		}
		//全部通过就成功
		$_SESSION['username']=$username;//保存登录成功的用户名	
		echo "<script>alert('登录成功');window.location.href='../../index.php';</script>";	
	   }
	  else{echo "<script>alert('您的账号密码错误')</script>";}
	}
  }
}
      else if($admin==1){echo "<script>location.href='../admin/admin.php?id=$c->id & name=$username'</script>";}
}

//判断他有没有空的方法
function loginempty($username,$password,$repassword,$vcode){
	if($username==null || $password==null || $repassword==null)
	{
		echo "<script>alert('用户或密码为空');</script>";
	}
	else if($vcode==null)
	    {echo"<script>alert('你的验证码为空');</script>";}
	else{ return true;}
}

//判断验证码是否有没有正确
function loginyzm($yzm,$vcode){
	if($yzm==$vcode){return true;}
	else{echo "<script>alert('您的验证码错误请仔细看');window.location.href='login.php';</script>";}
}

?>
</body>
</html>