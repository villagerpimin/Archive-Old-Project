<?php
    /* 用于插入数据 */
    include('../connect.php');
    //cno 课程号,cname 课程名,credit 学时,ctea 任课教师
    //ctime 上课时间,climt 限制人数,ckind 课程类型,cdepart 所属院系
    $insertSql=sprintf("insert into course values('%s','%s','%s',%s,'%s',
        '%s','%s',%s,0,0)",$_POST['cno'],$_POST['cname'],$_POST['ckind'],
        $_POST['credit'],$_POST['ctea'],$_POST['cdepart'],$_POST['ctime'],
        $_POST['climt']);
    $insertRes=mysqli_query($conn,$insertSql);
    if($insertRes){ //成功时返回success
        echo "success";
    }
    else{
        echo "添加失败，可能表中含有相同数据";
        echo mysqli_error($conn);
    }
?>