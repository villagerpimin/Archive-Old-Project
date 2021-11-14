<?php
/* 返回新闻列表 */
$tag=$_GET["tag"]; //新闻标签
$pageNum=$_GET["pageNum"]; //当前页面下标
$search=isset($_GET["search"])?$_GET["search"]:""; //搜索内容
include_once("database.php");

$pageSize=10;  //设置每页显示的条数

if($pageNum==1 && $search==""){
    newPage($tag,$pageSize,$conn);
}
else if($pageNum>1 && $search==""){
    pageAdd($tag,$pageSize,$conn,$pageNum);
}
else if($pageNum==1 && $search!=""){
    searchPage($search,$pageSize,$conn);
}
else if($pageNum>1 && $search!=""){
    addSearchPage($search,$pageSize,$conn,$pageNum);
}


function newPage($tag,$pageSize,$conn){
    /* 第一次加载时调用 */
    $str = "select * from news where tag='$tag' limit 0,$pageSize";  /* 按标签输出 */
    $new = "select * from news ORDER BY id DESC limit 0,$pageSize";  /* 最新，按时间排序 */
    $hot = "select * from news ORDER BY watched desc limit 0,$pageSize";  /* 按热度排序 */
    $res = null;  //接收数据库返回的数据
    switch($tag){
        case "最新":{
            $res = $conn->query($new);
            break;
        }
        case "热门":{
            $res = $conn->query($hot);
            break;
        }
        default:{
            $res = $conn->query($str);
            break;
        }
    }
    /* 将数据整理并输出 */
    $list = array();
    if($res){
        while($data = $res->fetch()){
            $little = array(
                "nid"=>$data["id"],
                "title"=>$data["title"],
                "content"=>$data["content"],
                "cover"=>$data["image"],
                "watched"=>$data["watched"],
                "author"=>$data["author"],
                "date"=>$data["news_date"]
            );
            array_push($list,$little);
        }
        echo json_encode($list);
    }
}

function pageAdd($tag,$pageSize,$conn,$page){
    /* 追加数据时调用 */
    $list = array();
    //计算总数
    $countStr="select count(id) from news";
    $res = $conn->query($countStr);
    $count = $res->fetch();
    $count = $count[0];
    //计算页数
    $pageNum= ceil($count/$pageSize);
    if($page>=$pageNum+1){
        /* 没有更多数据了 */
        $list["status"]=true;
        echo json_encode($list);
    }
    else{
        $start = $pageSize*($page-1);
        $str = "select * from news where tag=$tag limit $start,$pageSize";  /* 按标签输出 */
        $new = "select * from news ORDER BY news_date DESC limit $start,$pageSize";  /* 最新，按时间排序 */
        $hot = "select * from news ORDER BY watched desc limit $start,$pageSize";  /* 按热度排序 */
        $res = null;  //接收数据库返回的数据
        switch($tag){
            case "最新":
                $res = $conn->query($new);
                break;
            
            case "热门":
                $res = $conn->query($hot);
                break;
            
            default:
                $res = $conn->query($str);
                break;
        }
        /* 将数据整理并输出 */
        $list = array();
        if($res){
            while($data = $res->fetch()){
                $little = array(
                    "nid"=>$data["id"],
                    "title"=>$data["title"],
                    "content"=>$data["content"],
                    "cover"=>$data["image"],
                    "watched"=>$data["watched"],
                    "author"=>$data["author"],
                    "date"=>$data["news_date"]
                );
                array_push($list,$little);
            }
            echo json_encode($list);
        }
    }

}

function searchPage($search,$pageSize,$conn){
    /* 返回搜索数据时调用 */
    $str="select * from news where title like :search limit 0,$pageSize";
    $sth=$conn->prepare($str);
    $sth->execute(array(
        ":search"=>"%$search%"
    ));
    $list = array();
    if($sth){
        while($data = $sth->fetch()){
            $little = array(
                "nid"=>$data["id"],
                "title"=>$data["title"],
                "content"=>$data["content"],
                "cover"=>$data["image"],
                "watched"=>$data["watched"],
                "author"=>$data["author"],
                "date"=>$data["news_date"]
            );
            array_push($list,$little);
        }
        echo json_encode($list);
    }
}

function addSearchPage($search,$pageSize,$conn,$page){
    /* 返回搜索的追加数据时调用 */
    $list = array();
    //计算总数
    $countStr="select count(id) from news where title like :search";
    $res = $conn->prepare($countStr);
    $res->execute(array(":search"=>"%$search%"));
    $count = $res->fetch();
    $count = $count[0];
    //计算页数
    $pageNum= ceil($count/$pageSize);
    if($page>=$pageNum+1){
        /* 没有更多数据了 */
        $list["status"]=true;
        echo json_encode($list);
    }
    else{
        $start = $pageSize*($page-1);
        $str = "select * from news where title like :search limit $start,$pageSize";
        $res = null;  //接收数据库返回的数据
        $res = $conn->prepare($str);
        $res->execute(array(":search"=>"%$search%"));
        /* 将数据整理并输出 */
        $list = array();
        if($res){
            while($data = $res->fetch()){
                $little = array(
                    "nid"=>$data["id"],
                    "title"=>$data["title"],
                    "content"=>$data["content"],
                    "cover"=>$data["image"],
                    "watched"=>$data["watched"],
                    "author"=>$data["author"],
                    "date"=>$data["news_date"]
                );
                array_push($list,$little);
            }
            echo json_encode($list);
        }
    }
}

?>