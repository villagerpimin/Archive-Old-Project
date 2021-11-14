<?php
/* 用于修改审核新闻的状态 */
$nid = @$_POST["nid"];
$audit = @$_POST["audit"];
include_once("../../api/database.php");

if($audit=="fail"){
    /* 审核不通过 */
    $str = "update news_cache set status='不通过' where id=$nid";
    $sth = $conn->prepare($str);
    $sth->execute();
    echo $sth->rowCount();
}else if($audit="pass"){
    /* 审核通过 */
    $str = "select * from news_cache where id=$nid";
    $sth = $conn->prepare($str);
    $sth->execute();
    $res = $sth->fetchObject();
    $data = array(
        ":tag"=>$res->tag,
        ":title"=>$res->title,
        ":content"=>$res->content,
        ":img"=>$res->image,
        ":author"=>$res->author,
        ":date"=>$res->news_date
    );

    $str = "delete from news_cache where id=$nid";
    $sth = $conn->prepare($str);
    $sth->execute();

    $str = "insert into news(tag,title,content,image,author,news_date) values(:tag,:title,:content,:img,:author,:date)";
    $sth = $conn->prepare($str);
    $sth->execute($data);
    echo $sth->rowCount();
}
?>