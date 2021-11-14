<?php
/* 上传轮播图 */
$img = $_FILES["bannerpic"];
/* 成功拿到图片时上传到本地 */
if($img["size"]>0){
    $path = $img["tmp_name"];
    $type = substr($img["type"],6,strlen($img["type"]));
    $name = time();  //当前时间戳
    $file_path="../img/banner/$name.$type";
    move_uploaded_file($path,"../$file_path");
    $list = array();
    $list["status"]=true;
    $list["path"]=$file_path;
    $filename="$name.$type";  //文件名称
    $list["filename"]=$filename;
    echo json_encode($list);
}
?>