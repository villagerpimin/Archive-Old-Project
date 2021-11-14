<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新闻管理</title>
    <script src="./js/jquery-3.6.0.min.js"></script>
    <link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script src="./js/manager.js"></script>
</head>
<body>
    <!-- 新闻管理页 -->
    <div class="container">
        <!-- 查询已有新闻 -->
        <?php
            include_once("../api/database.php");
            $str="select id,title,author,news_date from news order by id desc";
            $sth=$conn->prepare($str);
            $sth->execute();
        ?>
        <div class="alert alert-success" role="alert">目前正在管理<b>所有新闻</b></div>
        <ul class="nav nav-pills">
            <li role="presentation" class="active"><a href="./news.php">管理</a></li>
            <li role="presentation"><a href="./module/edit_news.php?type=add">新增</a></li>
        </ul>
        <!-- 展示新闻列表 -->
        <div class="list-group">
            <?php while($res = $sth->fetchObject()){ ?>
                <br>
                <a class="list-group-item" href="./module/edit_news.php?type=update&id=<?php echo $res->id; ?>">
                    <div class="badge" style="background-color: rgba(255, 255, 255, 0);">
                        <button class="btn btn-default" value="<?php echo $res->id; ?>" name="del_news">删除</button>
                    </div>
                    <h4 class="list-group-item-heading"><?php echo $res->title; ?></h4>
                    <p class="list-group-item-text">
                        <?php echo "作者：{$res->author}&nbsp;&nbsp;&nbsp;发布日期：{$res->news_date}"; ?>
                    </p>
                </a>
            <?php } ?>
        </div>
    </div>
</body>
</html>