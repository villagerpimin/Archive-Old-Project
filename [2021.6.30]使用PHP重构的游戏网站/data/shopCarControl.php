<?php
    /* 用于控制购物车的购买数量增减和删除 */
    $code=$_POST["code"]; //执行码，用于判断应该执行哪个方法
    $userid=$_POST["uid"]; //用户id
    $gameid=isset($_POST["gid"])?$_POST["gid"]:0; //游戏id
    $xiugai=isset($_POST["xg"])?$_POST["xg"]:1; //修改购买数量
    $gameidarr=isset($_POST["garr"])?$_POST["garr"]:[]; //获得前端已选中游戏

    include "../database.php";

    switch($code){
        case 1: //执行增加方法
            zengjia($userid,$gameid,$conn);
            break;
        case 2: //执行减少方法
            jianshao($userid,$gameid,$conn);
            break;
        case 3: //执行修改方法
            xiugai($userid,$gameid,$conn,$xiugai);
            break;
        case 4: //执行删除方法
            delgame($userid,$gameid,$conn);
            break;
        case 5: //执行计算已节省价钱方法
            jiesheng($userid,$gameidarr,$conn);
            break;
        case 6: //执行计算总价方法
            zongjia($userid,$gameidarr,$conn);
            break;
    }

    //增加数量
    function zengjia($userid,$gameid,$conn){
        $sql="update shop set gamenum=gamenum+1 where userid=$userid and gameid=$gameid";
        $res=mysqli_query($conn,$sql);
        echo $res?"ok":"err";
    }

    //减少数量
    function jianshao($userid,$gameid,$conn){
        $sql="update shop set gamenum=gamenum-1 where userid=$userid and gameid=$gameid";
        $res=mysqli_query($conn,$sql);
        echo $res?"ok":"err";
    }

    //修改数量
    function xiugai($userid,$gameid,$conn,$xiugai){
        $sql="update shop set gamenum=$xiugai where userid=$userid and gameid=$gameid";
        $res=mysqli_query($conn,$sql);
        echo $res?"ok":"err";
    }

    //删除商品
    function delgame($userid,$gameid,$conn){
        $sql="delete from shop where userid=$userid and gameid=$gameid";
        $res=mysqli_query($conn,$sql);
        echo $res?"ok":"err";
    }

    //计算节省的钱
    function jiesheng($userid,$gameidarr,$conn){
        $jiesheng=0;
        $buynum=0;

        for($i=0;$i<count($gameidarr);$i++){
            $sql="select * from shop where userid=$userid and gameid={$gameidarr[$i]}"; //用于查询加购数量
            $res=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($res);
            $buynum=$row["gamenum"]; //获得该游戏加购数量

            $sql="select * from game where id={$gameidarr[$i]}"; //用于获得原价和打折后的价格
            $res=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($res);
            $yuan=$row["price"]; //获得商品原价
            $zhe=$row["daze"]; //获得商品折扣价
            $jiesheng+=floatval(($yuan-$zhe)*$buynum);
        }
        echo $jiesheng;
    }

    //计算总价
    function zongjia($userid,$gameidarr,$conn){
        $zongjia=0;
        $buynum=0;

        for($i=0;$i<count($gameidarr);$i++){
            $sql="select * from shop where userid=$userid and gameid={$gameidarr[$i]}"; //用于查询加购数量
            $res=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($res);
            $buynum=$row["gamenum"]; //获得该游戏加购数量

            $sql="select * from game where id={$gameidarr[$i]}"; //用于获得原价和打折后的价格
            $res=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($res);
            //$yuan=$row["price"]; //获得商品原价
            $zhe=$row["daze"]; //获得商品折扣价
            $zongjia+=floatval($zhe*$buynum);
        }
        echo $zongjia;
    }
?>