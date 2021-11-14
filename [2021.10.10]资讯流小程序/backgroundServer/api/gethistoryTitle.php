<?php
/* 用于返回历史记录中的新闻标题 */
$idlist=json_decode($_POST["ids"]);
include_once("database.php");
$str="select title from news where id=:id";
$arr = array();
/* 将每个id的标题循环到数组 */
if($idlist!=""){
    for($i=0;$i<count($idlist);$i++){
        $little = array();
        $sth = $conn->prepare($str);
        $sth->execute(array(
            ":id"=>$idlist[$i]
        ));
        $res = $sth->fetch();
        $little["id"]=$idlist[$i];
        $little["title"]=$res[0];
        array_push($arr,$little);
    }
}

echo json_encode($arr);
?>