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
            <li style="border-bottom: 5px solid orange;font-weight: bold;">
                <a href="./index.php">首页</a>
            </li>
            <li><a href="./game.php">游戏</a></li>
            <li>主机</li>
            <li>周边</li>
        </ul>
    </div>

    <!-- 轮播图 -->
    <div class="carousel slide" id="carou" data-interval="2000"
        data-ride="carousel">
        <!-- 下标 -->
        <ul class="carousel-indicators">
            <li data-target="#carou" data-slide-to="0" class="active"></li>
            <li data-target="#carou" data-slide-to="1"></li>
            <li data-target="#carou" data-slide-to="2"></li>
            <li data-target="#carou" data-slide-to="3"></li>
        </ul>
        <!-- 图片 -->
        <div class="carousel-inner">
            <div class="item active" data-interval="2">
                <img src="./images/carousel/c1.jpg" alt="">
            </div>
            <div class="item">
                <img src="./images/carousel/c2.jpg" alt="">
            </div>
            <div class="item">
                <img src="./images/carousel/c3.jpg" alt="">
            </div>
            <div class="item">
                <img src="./images/carousel/c4.jpg" alt="">
            </div>
        </div>
        <!-- 控制器 -->
        <a class="left carousel-control" href="#carou" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carou" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
    <br>
    <div class="container">
        <!-- 系列展示 -->
        <h3>
            <img src="./images/lab.png" alt="">
            <strong>黎明杀机&nbsp;&nbsp;系列</strong>
        </h3>
        <hr>
        <ul class="xllist">
            <?php
                include "./database.php";
                $sql="select * from game where tag is not null and tag='黎明杀机 系列'";
                $res=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_array($res)){
            ?>

            <li title="<?php echo $row["name"] ?>">
            <a href="./detail.php?id=<?php echo $row["id"] ?>">
                <img src="<?php echo $row["cover"]; ?>" alt="<?php echo $row["name"] ?>">
                <div class="xleft">
                    <!-- 游戏名称 -->
                    <label>
                        <!-- 中文占3位 -->
                        <?php echo strlen($row["name"])>18?substr($row["name"],0,18)."...":$row["name"] ?>
                    </label> <br>
                    <span title="<?php echo $row["nametitle"] ?>">
                        <?php echo strlen($row["nametitle"])>12?substr($row["nametitle"],0,12)."...":
                            $row["nametitle"] ?>
                    </span>
                </div>
                <div class="xright">
                    <!-- 游戏价格 -->
                    <?php echo "￥".$row["daze"] ?>
                    <del><?php echo "￥".$row["price"] ?></del>
                </div>
            </a>
            </li>
            <?php 
                }/* 黎明杀机系列的数据循环 */
            ?>
        </ul>
        
        <!-- 冷笑黑妖 2折起 -->
        <h3>
            <img src="./images/lab.png" alt="">
            <strong>冷笑黑妖&nbsp;&nbsp;2折起</strong>
        </h3>
        <hr>
        <ul class="xllist">
            <?php
                include "./database.php";
                $sql="select * from game where tag is not null and tag='冷笑黑妖 2折起'";
                $res=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_array($res)){

            ?>
            <li title="<?php echo $row["name"] ?>">
            <a href="./detail.php?id=<?php echo $row["id"] ?>">
                <img src="<?php echo $row["cover"]; ?>" alt="<?php echo $row["name"] ?>">
                <div class="xleft">
                    <!-- 游戏名称 -->
                    <label>
                        <!-- 中文占3位 -->
                        <?php echo strlen($row["name"])>18?substr($row["name"],0,18)."...":$row["name"] ?>
                    </label> <br>
                    <span title="<?php echo $row["nametitle"] ?>">
                        <?php echo strlen($row["nametitle"])>12?substr($row["nametitle"],0,12)."...":
                            $row["nametitle"] ?>
                    </span>
                </div>
                <div class="xright">
                    <!-- 游戏价格 -->
                    <?php echo "￥".$row["daze"] ?>
                    <del><?php echo "￥".$row["price"] ?></del>
                </div>
            </a>
            </li>
            <?php 
                }/* 冷笑黑妖系列的数据循环 */
            ?>
        </ul>

        <!-- 即将上市 精选游戏 -->
        <h3>
            <img src="./images/lab.png" alt="">
            <strong>即将上市&nbsp;&nbsp;精选游戏</strong>
        </h3>

        <ul class="xllist">
            <?php
                include "./database.php";
                $sql="select * from game where tag is not null and tag='即将上市 精选游戏'";
                $res=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_array($res)){

            ?>
            <li title="<?php echo $row["name"] ?>">
            <a href="./detail.php?id=<?php echo $row["id"] ?>">
                <img src="<?php echo $row["cover"]; ?>" alt="<?php echo $row["name"] ?>">
                <div class="xleft">
                    <!-- 游戏名称 -->
                    <label>
                        <!-- 中文占3位 -->
                        <?php echo strlen($row["name"])>13?substr($row["name"],0,13)."...":$row["name"] ?>
                    </label> <br>
                    <span title="<?php echo $row["nametitle"] ?>">
                        <?php echo strlen($row["nametitle"])>12?substr($row["nametitle"],0,12)."...":
                            $row["nametitle"] ?>
                    </span>
                </div>
                <div class="xright">
                    <!-- 游戏价格 -->
                    <?php echo "￥".$row["daze"] ?>
                    <del><?php echo "￥".$row["price"] ?></del>
                </div>
            </a>
            </li>
            <?php 
                }/* 即将上市系列的数据循环 */
            ?>
        </ul>

        <!-- 主机也疯狂 -->
        <h3>
            <img src="./images/lab.png" alt="">
            <strong>主机也疯狂</strong>
        </h3>
        <ul class="xllist">
            <?php
                include "./database.php";
                $sql="select * from game where tag is not null and tag='主机也疯狂'";
                $res=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_array($res)){

            ?>
            <li title="<?php echo $row["name"] ?>">
            <a href="./detail.php?id=<?php echo $row["id"] ?>">
                <img src="<?php echo $row["cover"]; ?>" alt="<?php echo $row["name"] ?>">
                <div class="xleft">
                    <!-- 游戏名称 -->
                    <label>
                        <!-- 中文占3位 -->
                        <?php echo strlen($row["name"])>15?substr($row["name"],0,15)."...":$row["name"] ?>
                    </label> <br>
                    <span title="<?php echo $row["nametitle"] ?>">
                        <?php echo strlen($row["nametitle"])>12?substr($row["nametitle"],0,12)."...":
                            $row["nametitle"] ?>
                    </span>
                </div>
                <div class="xright">
                    <!-- 游戏价格 -->
                    <?php echo "￥".$row["daze"] ?>
                    <del><?php echo "￥".$row["price"] ?></del>
                </div>
            </a>
            </li>
            <?php 
                }/* 主机也疯狂系列的数据循环 */
            ?>
        </ul>



        <!-- 热销（分页） -->
        <h3 class="hotsale">
            <span>&nbsp;</span>
            <strong>热销</strong>
        </h3>
        
        <?php
            /* 准备分页数据 */
            $sql="select * from game where tag is not null and tag='热销'";
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

            <div id="hotright" class="hot_detail">
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
    <br>

    <!-- 页脚 -->
    <div class="footer">
        小组成员：朱腾飞、许泽栋、余创杰
    </div>
</body>
</html>