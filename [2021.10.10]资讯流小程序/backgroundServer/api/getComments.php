<?php
/* 用于获得请求新闻id的评论 */
include_once("./database.php");
$nid = $_GET["nid"];
$str = "select * from comment where newsid=:nid order by id desc";  //用于查询当前新闻的评论
$sth = $conn->prepare($str);
$sth->execute(array(
    ":nid"=>$nid
));
$list = array();
while($res = $sth->fetchObject()){
    $openid = $res->openid;
    $user = "select * from user where openid=:openid";  //通过openid查询用户头像昵称等信息
    $userdata = $conn->prepare($user);
    $userdata->execute(array(
        ":openid"=>$openid
    ));
    $userdata = $userdata->fetchObject();
    /* 通过openid和新闻id和评论内容查询当前评论id，以便于后期进行按赞和按踩操作 */
    $pid = $conn->prepare("select id from comment where openid=:openid and content=:content and newsid=:newsid");
    $pid->execute(array(
        ":openid"=>$userdata->openid,
        ":content"=>$res->content,
        ":newsid"=>$nid
    ));
    $pid = $pid->fetch();  //评论id：$pic["id"]
    $little = array(
        "avatar"=>$userdata->avatar,
        "name"=>$userdata->wxname,
        "content"=>$res->content,
        "date"=>$res->post_date,
        "good"=>$res->good,
        "openid"=>$userdata->openid,
        "pid"=>$pid["id"]
    );
    array_push($list,$little);
    //var_dump($list);
}
echo json_encode($list);
?>