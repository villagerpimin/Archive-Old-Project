<?php
/* 用于返回轮播列表 */
include_once("database.php");
$str = "select * from banner";
$res = $conn->prepare($str);
$res->execute();
$list = array();
while($data=$res->fetch()){
    $nlist=array(
        "text"=>$data["banner_title"],
        "img"=>$data["banner_image"],
        "id"=>$data["nid"]
    );
    /* array_push($nlist,$data["banner_title"],$data["banner_image"],
        $data["nid"]); */
    array_push($list,$nlist);
}
echo json_encode($list);
?>