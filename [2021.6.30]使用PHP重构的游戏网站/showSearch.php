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
    <script src="./js/searchPage.js"></script>

    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <!-- 用于展示搜索结果 -->
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
            <li>
                <a href="./index.php">首页</a>
            </li>
            <li><a href="./game.php">游戏</a></li>
            <li>主机</li>
            <li>周边</li>
        </ul>
    </div>


    <?php
        /* 处理搜索的内容 */
        $search=$_POST["search"];
        include "./database.php";
        $sql="select * from game where name like '%$search%' and tag is null";
        $res=mysqli_query($conn,$sql);
        $row_num=mysqli_num_rows($res); //获取得到的数据总数

        if($row_num!=0){ //有内容时
        ?>

            <?php
                /* 准备分页数据 */
                if($row_num>10){
                    $page=1; //默认为第一页
                    $page_num=ceil($row_num/10); //总页数
                    $startNum=($page-1)*10; //数据读取的开始位置
                    
                    /* 获取十条数据 */
                    $sql="select * from game where tag is null and name like '%$search%' order by id limit $startNum,10";
                    $res=mysqli_query($conn,$sql);
                }
                else{
                    $page_num=1; //数量过少则不分页
                    $page=1; //默认为第一页
                }
            ?>

            <div class="hot_pane" name="hot_pane" style="height: 1750px;">
        
            <div id="hotleft" class="hot_cont" style="width:90%;float:none;margin:auto;height:130px;">
                
                <div id="hot_item">

                <!-- 数据列表 -->
                <?php
                    while($row=mysqli_fetch_array($res)){ /* 循环开始 */
                ?>
                <a href="./detail.php?id=<?php echo $row["id"]; ?>">
                <div name="hot_list" class="hot_list" style="height:130px" data-id="<?php echo $row["id"] ?>">
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
                            <del style="margin-right: 30%;"><?php echo $row["price"]; ?></del>
                        </div>
                        
                        <a>
                        <div class="addcar" name="addcar" data-gameid="<?php echo $row["id"] ?>">
                            <!-- 加入购物车 -->
                            加入购物车
                        </div>
                        </a>
                    </div>
                </div>
                </a> <!-- 用于点击链接跳转 -->

                <?php } /* 列表循环结束 */ ?>

        <?php
        }/* if结束 */
            else{
                //没有查到内容时
                ?>
                <br><br>
                <p style="text-align: center;font-size:24px;color:#898989;">没有数据！</p>
                <?php
                    //没有数据时分页和总数为0
                    $page=0;
                    $page_num=0;
                ?>
        <?php
            }/* else结束 */
        ?>
        </div><!-- #hot_item用于ajax替换数据 -->

        <!-- 热销分页 -->
        <div id="hot_page" data-page="<?php echo $page; ?>"
            data-pagenum="<?php echo $page_num; ?>" data-search="<?php echo $search; ?>"
            style="display: <?php echo $page_num===0?"none":"block" ?>;"><!-- 没有数据时隐藏分页 -->
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

    </div><!-- 列表项 -->

</div><!-- 列表容器 -->

    <!-- 页脚 -->
    <div class="footer">
        小组成员：朱腾飞、许泽栋、余创杰
    </div>
</body>
</html>