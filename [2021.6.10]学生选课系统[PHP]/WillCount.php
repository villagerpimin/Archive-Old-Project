<?php
    /* 用于更新每门课程已选修人数 */
    $conn=mysqli_connect('localhost','root','123','exam2') or die("数据库连接失败！");
    mysqli_set_charset($conn,'utf8');
    
    $getCouNo="select CouNo from course"; //用于获取课程号
    $couRes=mysqli_query($conn,$getCouNo);
    $couNoArr=array(); //作为键使用，保存课程号
    while($couRow=mysqli_fetch_array($couRes)){
        array_push($couNoArr,$couRow[0]); //将所有课程号保存
    }
    //var_dump($couNoArr);
    
    $willCount=array(); //用于记录每门课的选修人数
    for($i=0;$i<count($couNoArr);$i++){
        $getCount="select count(CouNo) from stucou where CouNo='".$couNoArr[$i]."'"; //用于获取选修人数
        $countRes=mysqli_query($conn,$getCount);
        $countRow=mysqli_fetch_array($countRes);
        $willCount[$couNoArr[$i]]=$countRow[0]; //键值对数据：couno->willcount
    }
    //var_dump($willCount);
    
    $errNum=0; //用于记录错误数量
    for($i=0;$i<count($couNoArr);$i++){
        $upWillCount="update course set WillNum=".$willCount[$couNoArr[$i]].
            " where CouNo='".$couNoArr[$i]."'"; //用于更新已选人数
        mysqli_query($conn,$upWillCount)? /* 成功时不增 */:$errNum++;
        //echo $upWillCount."<br>";
    }
    //向控制台打印结果
    echo "<script>console.log('已选人数更新完成，错误数：$errNum')</script>";
    
?>