<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>凤凰游戏</title>
    <link rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/game.css">
    <script src="./js/index.js"></script>
</head>
<body>
    <div class="container-fluid">
        <!-- 导航 -->
        <nav class="navbar navbg">
            <div class="navbar-header">
                <a class="navbar-brand" href="./index.php">
                    <img src="./images/logo.png" alt="">
                </a>
            </div>
            <!-- 搜索游戏 -->
            <form method="POST" action="./showSearch.php" class="navbar-form navbar-left martop">
                <div class="input-group input-group-lg">
                    <input type="text" name="search" class="form-control" placeholder="请输入关键词">
                    <span class="input-group-addon" id="serachsub">
                        <i class="glyphicon glyphicon-search"></i>
                    </span>
                </div>
            </form>
            <!-- 导航项 -->
            <ul class="nav navbar-nav navbar-left martop">
                <li>
                    <a href="./shopCar.php" class="btn-lg">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        &nbsp;&nbsp;购物车
                    </a>
                </li>
                <li>
                    <a href="#" class="btn-lg">
                        <span class="glyphicon glyphicon-send"></span>
                        &nbsp;&nbsp;问题反馈
                    </a>
                </li>
            </ul>
            <!-- 登录 -->
            <?php include "./user.php"; ?>
        </nav>
    </div>
    
    <!-- 伪选项卡 -->
    <div class="mtab">
        <ul>
            <li><a href="./index.php">首页</a></li>
            <li style="border-bottom: 5px solid orange;font-weight: bold;">
                <a href="./game.php">游戏</a>
            </li>
            <li>主机</li>
            <li>周边</li>
        </ul>
    </div>


    <div class="container">
    <!-- 热销（分页） -->
    <h3 class="hotsale hotsale_add">
        <span>&nbsp;</span>
        <strong>热销</strong>
    </h3>
        <?php
            include "./database.php";
            /* 准备分页数据 */
            $sql="select * from game where tag is null";
            $res=mysqli_query($conn,$sql);
            $row_num=mysqli_num_rows($res); //获得行数
            $page=1; //默认为第一页
            $page_num=ceil($row_num/10); //总页数
            $startNum=($page-1)*10; //数据读取的开始位置
            
            /* 获取十条数据 */
            $sql="select * from game where tag is not null and tag='热销' order by id limit $startNum,10";
            $res=mysqli_query($conn,$sql);
        ?>
        
        <div class="hot_pane" name="hot_pane">
            <div id="hotleft" class="hot_cont">
                
                <div id="hot_item">

                <!-- 热销的左列表 -->
                <?php
                    while($row=mysqli_fetch_array($res)){ /* 热销列表循环开始 */
                ?>
                <!-- 列表项的跳转在js中 -->

                <div name="hot_list" class="hot_list" data-id="<?php echo $row["id"] ?>">
                    <img src="<?php echo $row["cover"] ?>" alt="<?php echo $row["name"] ?>">
                    <p>
                        <?php echo $row["name"]; ?><br>
                        <span><?php echo $row["nametitle"]; ?></span>
                    </p>
                    
                    <div class="hot_list_right">
                        <!-- 降价幅度 -->
                        <span>
                            <?php
                                $dazhe=floatval($row["daze"]); //打折后价格
                                $pri=floatval($row["price"]); //原价
                                $fd=$dazhe/$pri;
                                $bfb=floor(100-($fd*100));
                                echo "-".$bfb."%";
                            ?>
                        </span>
                        <!-- 售价 -->
                        <div class="sale">
                            <p><?php echo $row["daze"]; ?></p>
                            <del><?php echo $row["price"]; ?></del>
                        </div>
                        
                    </div>
                </div>

                <?php } /* 热销列表循环结束 */ ?>
                
                </div><!-- 用于ajax替换数据 -->

                <!-- 热销分页 -->
                <div id="hot_page" data-page="<?php echo $page; ?>"
                    data-pagenum="<?php echo $page_num; ?>">
                    <button class="btn btn-default" name="startPage">第一页</button>
                    <button class="btn btn-default" name="prePage">上一页</button>
                    <button class="btn btn-default" name="nextPage">下一页</button>
                    <button class="btn btn-default" name="endPage">最后一页</button>

                    <div class="input-group" style="width:25%;float:right;">
                        <input type="number" id="inppage" class="form-control"
                            value="1">
                        <span class="input-group-addon">
                            /&nbsp;<?php echo $page_num; ?>
                        </span>
                    </div>
                </div>

            </div>

            <div id="hotright" class="hot_detail hot_detail_add">
                <!-- 热销的右侧列表 -->
                <div class="hot_inner">
                    <p>凶手不是我</p>
                    <span>Perfect Crime</span><br>
                    <span>发售时间：2020-10-01</span><br>
                    <span>游戏类型：角色扮演RPG</span>
                    <img src="./images/img_box/img/img (21).jpg" alt="凶手不是我">
                </div>
            </div>
        </div>
    </div>
</body>
</html>