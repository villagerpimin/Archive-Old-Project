<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>忘记密码</title>
<link href="./Forget.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="fullcontent">
<div class="head"><a href="#"><img src="../loginimages/logo.png"></a></div>
<div id="middle">
<span id="registername">找回密码</span>
<div class="registername"><div>找回密码</div></div>
<form method="post">
<div id="formpos">
<span>账号:</span><input type="text" name="username" id="username" required="required" placeholder="请输入您的账号:" /><br />
<span>邮箱:</span><input type="text" name="mailbox" id="mailbox" required="required" placeholder="请输入您的邮箱:"/><br />
<span class="yzm">验证码:</span><input type="text" placeholder="验证码" name="yzm" id="yzm2" ><img src="../login/code.php" onclick="this.src='../login/code.php?id='+Math.random()" id="yzm"/>
<div id="chpos"><input type="checkbox" name="checkbox" id="checkbox" value="1" required="required"/><span style="color:#000;">阅读已同意
<a href="#" style="color:#4C91C5;">《凤凰游戏账号用户服务协议》</a></span><br /></div>
<input type="submit" value="下一步" name="register" id="registerbutton" />
</div>
</form>
<div id="bottom">©我们是第二小组成员 小组成员有1930634朱腾飞 1930638许泽栋 1930630余创杰 </div>
</div>
</div>

<?php
include('Forgetconnect.php');

?>
</body>
</html>