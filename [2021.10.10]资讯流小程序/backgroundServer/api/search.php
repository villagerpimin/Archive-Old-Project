<?php
/* 用于查询新闻 */
$inptext = $_POST["inp"];
include_once("database.php");

//echo "接收到的输入：$inptext";
$str = "select * from news where title like :inptext";
$str2 = "select count(id) from news where title like :inptext";  //查询结果数

/* 获得结果数count */
$count = $conn->prepare($str2);
$count->execute(array(
    ":inptext"=>"%$inptext%"
));
$count = $count->fetch();
$count = $count[0];

$res = $conn->prepare($str);
$res -> execute(array(
    ":inptext"=>"%$inptext%"
));

$list = array(
    "count"=>$count
);


/* 将结果放到数组中 */
/* while($data=$res->fetchObject()){
    $little=array(
        "nid"=>$data->id,
        "title"=>$data->title,
        "content"=>$data->content,
        "cover"=>$data->image,
        "watched"=>$data->watched,
        "author"=>$data->author
    );
    
    array_push($list,$little);
} */

echo json_encode($list);
?>