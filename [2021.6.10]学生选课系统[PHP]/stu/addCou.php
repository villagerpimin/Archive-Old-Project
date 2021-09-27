<?php
    /* 用于增加学生选课数据 */
    $couArr=$_POST['selectedCou']; //获得已选课程号
    $sno=$_POST['sid']; //获得学号
    include("../connect.php");
    /* 对数据排序的处理 */
    $order=array(); //选课排序 
    $seacOrder="select WillOrder from stucou where StuNo=$sno"; //用于查询已选课程的顺序
    $ReOrder=mysqli_query($conn,$seacOrder);
    while($orderRow=mysqli_fetch_array($ReOrder)){
        array_push($order,$orderRow[0]); //向数组添加查询到的顺序
    }
    //var_dump($order);
    for($f=0;$f<5;$f++){ //过滤已有数据
        if(in_array($f+1,$order)){ //判断是否含有数据
            $order[$f+1]=null; //有数据则置空
        }
        else{
            array_push($order,$f+1); //没有则添加
        }
    }
    //var_dump($order);
    $oarr=array(); //用于存放处理好的数据
    for($s=0;$s<6;$s++){ //将处理的数组
        if(!is_string(@$order[$s]) && @$order[$s]!=null){
            array_push($oarr,@$order[$s]);
        }
    }
    //var_dump($oarr);
    
    /* 向数据库新增已选课程 */
    for($i=0;$i<count($couArr);$i++){
        $res=mysqli_query($conn,"insert into stucou(StuNo,CouNo,WillOrder,State) values(
            '$sno','$couArr[$i]',$oarr[$i],'报名')");
        if($res){
            echo 1;
        }
        else{echo "error";echo mysqli_error($conn);}
    }
    
?>