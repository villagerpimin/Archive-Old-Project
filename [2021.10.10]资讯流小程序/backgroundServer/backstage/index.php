<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理员登录</title>
    <link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <link href="./css/public.css" rel="stylesheet"/>
    <script src="./js/sessionCode.js"></script>
    
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <h1>简约新闻管理员面板</h1>
            <p>您需要先进行登录后才能进入后台开始管理工作</p>
        </div>

        <br>

        <form action="" method="post" class="formSty" id="loginForm">
            <!-- 管理员账号 -->
            <label for="name" class="form-label">账号：</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-user"></i>
                </span>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
                <br><br>
            <!-- 管理员密码 -->
            <label for="pwd" class="form-label">密码：</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-lock"></i>
                </span>
                <input type="password" name="pwd" id="pwd" class="form-control" required>
            </div>
                <br><br>
            <!-- 验证码 -->
            <label for="code">验证码：</label>
            <div class="input-group">
                <input type="text" id="code" class="form-control">
                <span class="input-group-addon">
                    <img src="./js/code_num.php" title="看不清？换一张" id="codePic">
                </span>
            </div>
                <br><br>

            <div class="row">
                <div class="col-sm-9"></div>
                <div class="col-sm-3">
                    <input type="button" name="send" class="btn btn-primary" 
                        value="登录">
                </div>
            </div>
           
        </form>
    </div>
</body>
</html>