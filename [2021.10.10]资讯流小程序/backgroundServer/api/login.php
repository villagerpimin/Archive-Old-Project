<?php
//appid
$appid = "wxc5abcbceec621535";
//secret
$secret = "1f968112627656fdc4e8e8fca948f48c";
//前端返回的code
$jscode = $_POST["jscode"];
//用户头像
$avatar = $_POST["avatar"];
//性别
$gender = $_POST["gender"];

function http_get($url)
{
    /* 通过curl请求数据 */
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);  //设置要请求的url
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //设置返回字符串
    curl_setopt($ch, CURLOPT_TIMEOUT, 35);  //设置超时时间
    curl_setopt($ch, CURLOPT_POST, false);  //true为post请求
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  //false允许http请求
    $result = curl_exec($ch);  //执行请求
    $err = curl_error($ch);

    curl_close($ch);  //释放资源
    return $err?null:$result;
}

$result = http_get("https://api.weixin.qq.com/sns/jscode2session?appid=$appid&secret=$secret&js_code=$jscode&grant_type=authorization_code");
if($result == null) {
    echo false;
}

$data = json_decode($result);
//var_dump($data);

if(!empty($data->openid)){
    $openid = $data->openid;
    //echo $openid;
    $ret = array();

    include_once("database.php");
    $find="select * from user where openid=:openid";
    /* 查找是否存在该微信用户 */
    $findRes=$conn->prepare($find);
    $findRes->execute(array(
        ":openid"=>$openid
    ));
    //写入状态
    $d = $findRes->fetch();
    $ret["status"]=!empty($d["openid"]);  //empty($d["openid"])?false:true

    /* 没有该用户时插入数据 */
    if(!$ret["status"]){
        /* 生成一个昵称 */
        $nickName=generateName();
        
        $insert="insert into user(openid,wxname,avatar,gender) values(:openid,:name,:avatar,:gender)";
        $sth = $conn->prepare($insert);
        $sth->execute(array(
            ":openid"=>$openid,
            ":name"=>$nickName,
            ":avatar"=>$avatar,
            ":gender"=>$gender
        ));
        //echo $sth->rowCount();
        if($sth->rowCount()>=1){
            $ret["status"]=true;
            $ret["name"]=$nickName;
        }
    }else{
        $ret["name"]=$d["wxname"];
    }
    $ret["avatar"]=$avatar;
    $ret["openid"]=$openid;
    $ret["gender"]=$d["gender"];
    $ret["mail"]=$d["mail"];
    $ret["uid"]=$d["id"];
    
    echo json_encode($ret);
}


/* 随机生成一个昵称 */
function generateName(){
    $name="用户";
    for($i=0;$i<5;$i++){
        /* 在ASCII码33~126中随机生成 */
        $name.=chr(mt_rand(33,126));
    }
    return $name;
}

?>
