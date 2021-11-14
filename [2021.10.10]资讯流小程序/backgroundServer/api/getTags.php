<?php
/* 用于返回新闻标签 */
include("database.php");
$str = "select tag from tags"; 
$data = $conn->query("select * from tags");
$list=array();
foreach($data as $row){
    array_push($list,$row["tag"]);
}
/* 将标签以json的形式返回 */
echo json_encode($list);
?>