<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>找回密码(2)</title>
<link href="./nextforget.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="fullcontent">
<div class="head"><a href="#"><img src="../loginimages/logo.png"></a></div>
<div id="middle">
<span id="registername">找回密码</span>
<div class="registername"><div>找回密码</div></div>
<form method="post">
<div id="formpos">
<div id="pos"><span>重置密码:</span><input type="password" name="psw" id="psw" /></div><br />
<div id="pos"><span>确认密码:</span><input type="password" name="repsw" id="repsw" /></div>


<input type="submit" value="确认" name="register" id="registerbutton" />
</div>
</form>
<div id="bottom">©我们是第二小组成员 小组成员有1930634朱腾飞 1930638许泽栋 1930630余创杰 </div>
</div>
</div>

<?php
$username=$_GET['name'];
include('../login/database.php');
if(!empty($_POST['register'])){
$password=$_POST['psw'];
$repassword=$_POST['repsw'];
$update="update user set password='$password' where username='$username' ";
if(!mysqli_query($conn,$update) ){
	if($repassword!=$password){
		echo "<script>alert('两次密码输入的不正确')</script>";
		}
	}else{echo "<script>alert('修改成功')</script>";}
}

?>
</body>
</html>