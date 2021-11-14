<?php
session_start();
//调用方法getCode，$num为验证码位数、$width为生成图片宽度、$height为生成图片高度
getCode(4,75,20);

function getCode($num,$width,$height){
    $str="";
    /* 生成候选字符 */
    for($i=49;$i<=57;$i++){$str.=chr($i);}  //数字
    //for($i=65;$i<=90;$i++){$str.=chr($i);}  //大写字母
    for($i=97;$i<=122;$i++){$str.=chr($i);}  //小写字母
    $str = str_shuffle($str);  //将字符串打乱
    $code=""; //用于保存验证码
    //生成验证码
    for($i=0;$i<$num;$i++){
        $code.=substr($str,rand(0,strlen($str)),1);
    }
    //将生成的验证码写入session，用于验证
    $_SESSION["code_ver"]=$code;
    //创建图片
    header("Content-type: image/PNG"); //标识发送图片
    $image=imagecreate($width,$height);
    /*为图片分配颜色*/
    $black=imagecolorallocate($image,0,0,0);
    $gray=imagecolorallocate($image,200,200,200);
    $bgcolor=imagecolorallocate($image,255,255,255);
    /* 填充背景 */
    imagefill($image,0,0,$gray); //灰色背景
    /* 画一个矩形边框 */
    imagerectangle($image,0,0,$width-1,$height-1,$black); //黑色内边
    /* 随机绘制两条虚线，用于干扰 */
    $style=array($black,$black,$bgcolor,$black,$black,
        $gray,$gray,$bgcolor,$gray,$gray);
    imagesetstyle($image,$style); //设置画线风格
    //创建两个随机数，用于设置线的纵横开始/结束距离
    $x=$y=array();
    for($i=0;$i<4;$i++){
        $x[$i]=rand(0,$width);
        $y[$i]=rand(0,$height);
    }
    /* x1为横开始，y1为纵开始，x2为横结束，y2为纵结束，IMG_COLOR_STYLED为设置的画线风格 */
    imageline($image,$x[0],$y[0],$x[1],$y[1],IMG_COLOR_STYLED);
    imageline($image,$x[2],$y[2],$x[3],$y[3],IMG_COLOR_STYLED);
    /* 画点像素 */
    for($i=0;$i<50;$i++){ //画50个点像素
        imagesetpixel($image,rand(0,$width),rand(0,$height),$black);
    }
    /* 将生成的随机数画到图像上 */
    $strx=rand(4,15); //设置字符的随机水平间距
    for($i=0;$i<$num;$i++){
        $strpos=rand(1,4); //设置字符的位置波动
        imagestring($image,5,$strx,$strpos,substr($code,$i,1),$black);
        $strx+=rand(8,12); //将数字向右移动防止叠加
    }
    /* 输出图片 */
    imagepng($image);
    /* 释放图片所占内存 */
    imagedestroy($image);
}
?>