<?php
session_start();
@$loginName=$_SESSION["name"];
if(empty($loginName)){
    echo "<script>alert('未登录！');location.href='./index.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理页</title>
    <link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script src="./js/manager.js"></script>
    <link href="./css/public.css" rel="stylesheet">

</head>
<body>
    <!-- 导航条 -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#gncollapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">简约新闻</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="gncollapse">
                <ul class="nav navbar-nav" id="func">
                    <li class="active"><a href="./news.php" target="frame">新闻</a></li>
                    <li><a href="./user.php" target="frame">用户</a></li>
                    <li><a href="./tag.php" target="frame">标签</a></li>
                    <li><a href="./banner_manager.php" target="frame">轮播图</a></li>
                    <li><a href="./news_audit.php" target="frame">审核</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>

    <div class="container-fluid">
        <!-- 默认新闻管理页 -->
        <iframe src="news.php" name="frame" style="width:100%;height: 700px;" frameborder="0"></iframe>
    </div>
</body>
</html>