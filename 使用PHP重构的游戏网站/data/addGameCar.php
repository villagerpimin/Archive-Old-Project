<?php
    //用于添加购物车
    $userid=$_POST["uid"]; //获得用户id
    $gameid=$_POST["gid"]; //获得游戏id
    include "../database.php";
    /* 先查询用户是否有添加过购物车 */
    $sql="select * from shop where userid=$userid and gameid=$gameid";
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0){ //如果有加入过购物车
        $sql="update shop set gamenum=gamenum+1 where userid=$userid and gameid=$gameid";
        $res=mysqli_query($conn,$sql);
        echo $res?"ok":"err";
    }
    else{
        //先查询该id的用户名
        $sql="select username from user where id=$userid";
        $res=mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($res);
        $username=$row["username"];

        $sql="insert into shop values(null,'$username',$userid,1,$gameid)";
        $res=mysqli_query($conn,$sql);
        echo $res?"ok":"err";
    }
?>