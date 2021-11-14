<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新闻审核</title>
    <script src="./js/jquery-3.6.0.min.js"></script>
    <link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="alert alert-success" role="alert">目前正在管理<b>审核新闻</b></div>

        <!-- 展示新闻列表 -->
        <div class="list-group">
            <?php
                include_once("../api/database.php");
                $str = "select * from news_cache";
                $sth = $conn->prepare($str);
                $sth->execute();
            ?>
            
            <?php while($res = $sth->fetchObject()){ ?>
                <div class="row">
                    <a class="list-group-item" href="./module/edit_news.php?type=audit&id=<?php echo $res->id; ?>">
                        <span class="badge"><?php echo $res->status; ?></span>
                        <h4 class="list-group-item-heading"><?php echo $res->title; ?></h4>
                        <p class="list-group-item-text">
                            <?php echo "作者：{$res->author}&nbsp;&nbsp;&nbsp;发布日期：{$res->news_date}"; ?>
                        </p>
                    </a>
                </div><br>
            <?php } ?>
        </div> <!-- 展示新闻列表 -->
    </div>
</body>
</html>