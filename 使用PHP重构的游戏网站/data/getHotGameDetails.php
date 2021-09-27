<?php
    /* 用于返回鼠标指向的游戏详情 */
    include "../database.php";
    $gameid=$_POST['gameid'];
    $sql="select * from game where id=$gameid";
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($res);
?>
<div class="hot_inner">
    <p><?php echo $row["name"] ?></p>
    <span><?php echo $row["nametitle"] ?></span><br>
    <span>发售时间：<?php echo $row["date"] ?></span><br>
    <span>游戏类型：<?php echo $row["typename"] ?></span>
    <img src="<?php echo $row["img"] ?>" alt="<?php echo $row['name']; ?>">
</div>