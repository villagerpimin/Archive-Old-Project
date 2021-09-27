<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录</title>
    <link href="./login.css" rel="stylesheet" type="text/css">
    <script src="../JQ/jquery-3.6.0.min.js"></script>
 
</head>
<body>
    <div id="fullcontent">
        <div class="head"><a href="../../index.php"><img src="../loginimages/logo.png"></a></div>
          <div class="middle">
            <div class="middleform">
              <div class="formtext"></div>
              
        <form method="post" >
        <div id="fieldusername">
        <label class="iconfont">|</label>	
        <input type="text" placeholder="手机号/用户名/邮箱" name="username" >
        </div>
        
        <div id="fieldusername">
        <label class="iconfont">|</label>	
        <input type="text" placeholder="密码" name="password">
        </div>
        
        <div id="fieldusername">
        <label class="iconfont">|</label>	
        <input type="text" placeholder="确认密码" name="repassword">
        </div>
        
        <div id="fieldusername">
        <label class="iconfont">|</label>	
        <input type="text" placeholder="验证码" name="yzm" >
        <div id="yzm">
        <img src="code.php" onclick="this.src='code.php?id='+Math.random()" >	
        <a href="login.php">看不清<br>换一张</a></div>
        </div>
        
        <div id="radio">
        <p><input type="checkbox" value="1" class="ckbname" name="autologin"><span>下次自动登录</span></p>
        <a href="../Register/Forget.php" id="forgetpsw">忘记密码？</a>
        </div>
        
        <div class="login">
        <input type="submit" value="登录" id="login" name="login">
        <div id="lab">送优惠券</div>
        <input type="submit" value="注册" id="register" name="register"  >
        </div>
        </form>
        
             </div>
        <a href="#"><img src="../loginimages/backgroundlogin.png" width="100%" height="100%"></a>
          </div>
        <div id="bottom">我们是第二小组成员 小组成员有1930634朱腾飞 1930638许泽栋 1930630余创杰 </div>
    </div>
<?php
include('loginconnect.php');
if(!empty($_POST['register'])){
	echo "<script>window.location.href='../Register/Register.php'</script>";
	}

?>
  
</body>
</html>