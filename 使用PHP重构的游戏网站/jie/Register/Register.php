<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>注册页面</title>
<link href="./Register.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="fullcontent">
<div class="head"><a href="#"><img src="../loginimages/logo.png"></a></div>
<div id="middle">
<span id="registername">注册新用户</span>
<div class="registername"><div>游戏账号注册</div></div>
<form method="post">
<div id="formpos">
<span>账号:</span><input type="text" name="username" id="username" required="required" placeholder="请输入您的账号:" /><br />
<span>邮箱:</span><input type="text" name="mailbox" id="mailbox" required="required" placeholder="请输入您的邮箱:"/><br />
<span>密码:</span><input type="password" name="password" id="password" required="required" placeholder="请输入您的密码:" /><br />
<span>重复:</span><input type="password" name="repassword" id="repassword" required="required" placeholder="再一次输入您的密码:" /><br />
<div id="chpos"><input type="checkbox" name="checkbox" id="checkbox" value="1" required /><span style="color:#000;">阅读已同意
<a href="#" style="color:#4C91C5;">《凤凰游戏用户注册协议》</a></span><br /></div>
<input type="submit" value="确定" name="register" id="registerbutton" />
</div>
</form>
<div id="bottom">©我们是第二小组成员 小组成员有1930634朱腾飞 1930638许泽栋 1930630余创杰 </div>
</div>
</div>

<?php
include('Reisiterconnect.php');

?>
</body>
</html>