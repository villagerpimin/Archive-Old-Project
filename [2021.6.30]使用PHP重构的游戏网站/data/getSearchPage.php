<?php
    /* 用于返回搜索页请求的数据 */
    $page=$_POST["page"]; //要返回的页面页数
    $nr=$_POST['nr']; //获得查询的内容
    include "../database.php";
    $startNum=($page-1)*10; //数据读取的开始位置        
    /* 获取十条数据 */
    $sql="select * from game where tag is null and name like '%$nr%' order by id limit $startNum,10";
    $res=mysqli_query($conn,$sql);
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
<?php
    }/* 循环结束 */
?>