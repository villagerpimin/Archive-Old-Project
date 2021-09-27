<?php
    /* 用于返回首页请求的分页数据 */
    $page=$_POST["page"]; //要返回的页面页数
    include "../database.php";
    $startNum=($page-1)*10; //数据读取的开始位置        
    /* 获取十条数据 */
    $sql="select * from game where tag is not null and tag='热销' order by id limit $startNum,10";
    $res=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($res)){
?>
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
<?php
    }/* 热销列表循环结束 */
?>