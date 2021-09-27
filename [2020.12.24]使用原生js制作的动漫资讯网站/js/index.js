//网页的补充说明
console.log("右下角的眼珠子是按照整个窗口(window)来的，似乎把整个页面算进去了。转起来没有我预想的好。"+
    "能力有限，能转我就感觉就很不错了(×\n鼠标放在页面左上角可以查看正常的效果");
console.log("主页(index)的公告栏有文字滚动效果，如果发现没动，可能是浏览器的问题"+
    "(似乎我的写法对浏览器支持不太好)，换个浏览器或者升级到新版就行了")

//cover区
var search=document.getElementById("search");
search.onmousemove=function(){ //鼠标移入
    search.style.opacity="0.7";
}
search.onmouseout=function(){ //鼠标移出
    search.style.opacity="0.5";
}
var sub=document.getElementById("sub"); //获取表单
sub.action="https://bing.com"; //设置表单搜索信息
sub.target="_blank";
sub.method="GET";
var imgsub=document.getElementById("send");//获取搜索图片
imgsub.onmousedown=function(){
    sub.submit();
}
imgsub.onmousemove=function(){
    imgsub.style.backgroundImage="url('../images/search-in.png')";
}
imgsub.onmouseout=function(){
    imgsub.style.backgroundImage="url('../images/search.png')";
}


//nav区
var navli=document.getElementById("list").children; //获取ul所有子节点
var urlLocal=location.pathname; //获取当前页的相对路径

if(urlLocal.match(/index.html/)){ //通过识别当前所在页改变字体颜色
    navli[0].style.color="orange";
}
else if(urlLocal.match(/laofan.html/)){
    navli[1].style.color="orange";
}
else if(urlLocal.match(/juchang.html/)){
    navli[2].style.color="orange";
}
else if(urlLocal.match(/juji.html/)){
    navli[3].style.color="orange";
}
else if(urlLocal.match(/movie.html/)){
    navli[4].style.color="orange";
}
navli[0].onmousedown=function(){  //代替html5的a:href
    location.assign("index.html");
}
navli[1].onmousedown=function(){
    location.assign("laofan.html");
}
navli[2].onmousedown=function(){
    location.assign("juchang.html");
}
navli[3].onmousedown=function(){
    location.assign("juji.html");
}
navli[4].onmousedown=function(){
    location.assign("movie.html");
}

//轮播区
var imgArr=new Array("./images/banner/魔女之旅.jpg","./images/banner/此花亭.jpg",
                    "./images/banner/东京食尸鬼.jpg","./images/banner/狼与香辛料.jpg");
var time; //用于关闭/开启定时器
clearInterval(time); //防止轮播速度异常
var banner=document.getElementById("banner"); //获取该容器
var index=0; //创建一个索引
var previous=document.getElementById("previous"); //获取上一张按钮
var next=document.getElementById("next"); //获取下一张按钮
var subscripts=document.getElementById("subscript").children;//获取角标元素
var tips=document.getElementById("tips");
function showTips(index){  //判断应该显示的提示
    switch(index){
        case 0:
            tips.style.color="beige";
            tips.innerHTML="魔女之旅";break;
        case 1:
            tips.style.color="white";
            tips.innerHTML="此花亭奇谭";break;
        case 2:
            tips.style.color="white";
            tips.innerHTML="东京食尸鬼";break;
        case 3:
            tips.style.color="#555";
            tips.innerHTML="狼与香辛料";break;
    }
}
function rev(){  //定义上一张方法
    if(index>0){
        index--;
    }
    else{
        index=0;
    }
    banner.style.backgroundImage="url('"+imgArr[index].toString()+"')";
    subscripts[index].style.backgroundColor="blue";
    for(var i=0;i<4;i++){ //用于清理其他下标
        if(i==index){
            continue;
        }
        else{
            subscripts[i].style.backgroundColor="white";
        }
    }
    showTips(index);
}
previous.onmousedown=function(){
    rev();
}
function nextPic(){ //定义下一张方法
    if(index<imgArr.length-1){
        index++;
    }
    else{
        index=0;
    }
    banner.style.backgroundImage="url('"+imgArr[index].toString()+"')";
    subscripts[index].style.backgroundColor="blue";
    for(var i=0;i<4;i++){
        if(i==index){
            continue;
        }
        else{
            subscripts[i].style.backgroundColor="white";
        }
    }
    showTips(index);
}
next.onmousedown=function(){ //下一张
    nextPic();
}
time=setInterval(nextPic,2000); //默认启动轮播
banner.onmousemove=function(){ //鼠标移入暂停定时器
    clearInterval(time);
    next.style.opacity="0.8";
    previous.style.opacity="0.8";
}
banner.onmouseout=function(){ //鼠标移开重启定时器
    time=setInterval(nextPic,2000);
    next.style.opacity="0";
    previous.style.opacity="0";
}
//下标点击事件
subscripts[0].onmousedown=function(){
    banner.style.backgroundImage="url('"+imgArr[0].toString()+"')";
    subscripts[0].style.backgroundColor="blue";
    for(var i=1;i<4;i++){
        subscripts[i].style.backgroundColor="white";
    }
    showTips(0);
}
subscripts[1].onmousedown=function(){
    banner.style.backgroundImage="url('"+imgArr[1].toString()+"')";
    subscripts[1].style.backgroundColor="blue";
    for(var i=0;i<4;i++){
        if(i==1){
            continue;
        }
        else{
            subscripts[i].style.backgroundColor="white";
        }
    }
    showTips(1);
}
subscripts[2].onmousedown=function(){
    banner.style.backgroundImage="url('"+imgArr[2].toString()+"')";
    subscripts[2].style.backgroundColor="blue";
    for(var i=0;i<4;i++){
        if(i==2){
            continue;
        }
        else{
            subscripts[i].style.backgroundColor="white";
        }
    }
    showTips(2);
}
subscripts[3].onmousedown=function(){
    banner.style.backgroundImage="url('"+imgArr[3].toString()+"')";
    subscripts[3].style.backgroundColor="blue";
    for(var i=0;i<3;i++){
        subscripts[i].style.backgroundColor="white";
    }
    showTips(3);
}


//右击菜单事件
window.oncontextmenu=function(e){
    //获取自定的右键菜单
    var menu=document.getElementById("menu");
    //获取鼠标点击时的相对位置
    menu.style.left=e.pageX+"px";
    menu.style.top=e.pageY+"px";
    //改变自定义菜单的宽，让其显示
    menu.style.width="100px";
    window.onclick=function(){ //触发点击事件即关闭菜单
        menu.style.width="0px";
    }
    return false; //取消浏览器自带的右键事件
}
var menuList=document.getElementById("menu").children; //获取菜单的所有元素
menuList[0].onclick=function(){
    location.reload(); //刷新页面
}
menuList[1].onclick=function(){
    location.replace("index.html"); //返回主页
}
menuList[2].onclick=function(){
    window.close(); //关闭窗口
}
menuList[3].onclick=function(){
    location.assign("#");
}


//公告滚动效果
var dd=document.getElementById("post");
var gd=document.getElementById("detail").children;
var tall=0;
function scroll(){
    /* if(gd.scrollTop>=50){ //scrollTop获取滚动条高度(顶端为0)，clientHeight获取元素高度 21
        gd.scrollTop=0;
    }
    else{
        gd.scrollTop++; //自动下拉
    } */
    if(tall++<63){
        for(var i=0;i<gd.length;i++){  //利用2d变形改变垂直高度实现
            gd[i].style.transform="translate(0,-"+tall+"px)";
        }
    }
    else{tall=0;}
}
var sc=setInterval(scroll,200);
dd.onmouseover=function(){ //鼠标移入div时(暂停计时器)
    clearInterval(sc);
}
dd.onmouseout=function(){ //鼠标移出div时(重启定时器)
    sc=setInterval(scroll,200);
}

//追番时间表
var rili=document.getElementById("rili").children;
var co=new Array(); //存放当天更新番剧的盒子
for(var i=0;i<7;i++){
    co.push(document.getElementById("co"+(i+1)));
}
function touchRili(d){  //定义时间表点击事件
    co[d].style.display="block"; //显示盒子
    rili[d].style.color="skyblue"; //字体变蓝
    for(var j=0;j<7;j++){ //将其他不相关的颜色/内容清除
        if(j==d){
            continue;
        }
        co[j].style.display="none";
        rili[j].style.color="#888";
    }
}
rili[0].onclick=function(){ //定义点击操作
    touchRili(0);
}
rili[1].onclick=function(){
    touchRili(1);
}
rili[2].onclick=function(){
    touchRili(2);
}
rili[3].onclick=function(){
    touchRili(3);
}
rili[4].onclick=function(){
    touchRili(4);
}
rili[5].onclick=function(){
    touchRili(5);
}
rili[6].onclick=function(){
    touchRili(6);
}

//番剧盒子定义
//星期一
var monday=document.getElementById("monday").children;
monday[0].style.backgroundImage="url('./images/time/水果挞.jpg')";
monday[0].onmousemove=function(){
    monday[0].style.color="skyblue";
    monday[0].onmousedown=function(){
        location.assign("https://www.bilibili.com/bangumi/media/md28229890/");
    }
}
monday[0].onmouseout=function(){
    monday[0].style.color="rgb(117, 117, 117)";
}

monday[1].style.backgroundImage="url('./images/time/进击的巨人.jpg')";
monday[1].onmousemove=function(){
    monday[1].style.color="skyblue";
    monday[1].onmousedown=function(){
        location.assign("https://www.zhenbuka.com/voddetail/77264/");
    }
}
monday[1].onmouseout=function(){
    monday[1].style.color="rgb(117, 117, 117)";
}

monday[2].style.backgroundImage="url('./images/time/黄金神威.jpg')";
monday[2].onmousemove=function(){
    monday[2].style.color="skyblue";
    monday[2].onmousedown=function(){
        location.assign("https://www.bilibili.com/bangumi/media/md28229888/");
    }
}
monday[2].onmouseout=function(){
    monday[2].style.color="rgb(117, 117, 117)";
}

monday[3].style.backgroundImage="url('./images/time/忍者.jpg')";
monday[3].onmousemove=function(){
    monday[3].style.color="skyblue";
    monday[3].onmousedown=function(){
        location.assign("https://www.zhenbuka.com/voddetail/72665/");
    }
}
monday[3].onmouseout=function(){
    monday[3].style.color="rgb(117, 117, 117)";
}


//星期二
var tuesday=document.getElementById("tuesday").children;
tuesday[0].style.backgroundImage="url('./images/time/结衣是我老婆.jpg')";
tuesday[0].onmousemove=function(){
    tuesday[0].style.color="skyblue";
    tuesday[0].onmousedown=function(){
        location.assign("https://www.bilibili.com/bangumi/media/md28230234/");
    }
}
tuesday[0].onmouseout=function(){
    tuesday[0].style.color="rgb(117, 117, 117)";
}

tuesday[1].style.backgroundImage="url('./images/time/嘶呀.jpg')";
tuesday[1].onmousemove=function(){
    tuesday[1].style.color="skyblue";
    tuesday[1].onmousedown=function(){
        location.assign("https://www.bilibili.com/bangumi/media/md28229876/");
    }
}
tuesday[1].onmouseout=function(){
    tuesday[1].style.color="rgb(117, 117, 117)";
}

tuesday[2].style.backgroundImage="url('./images/time/阿松.jpg')";
tuesday[2].onmousemove=function(){
    tuesday[2].style.color="skyblue";
    tuesday[2].onmousedown=function(){
        location.assign("https://www.bilibili.com/bangumi/media/md28229892/");
    }
}
tuesday[2].onmouseout=function(){
    tuesday[2].style.color="rgb(117, 117, 117)";
}

//星期三
var wednesday=document.getElementById("wednesday").children;
wednesday[0].style.backgroundImage="url('./images/time/三年血赚.jpg')";
wednesday[0].onmousemove=function(){
    wednesday[0].style.color="skyblue";
    wednesday[0].onmousedown=function(){
        location.assign("https://www.bilibili.com/bangumi/media/md28229879/");
    }
}
wednesday[0].onmouseout=function(){
    wednesday[0].style.color="rgb(117, 117, 117)";
}

//星期四
var thursday=document.getElementById("thursday").children;
thursday[0].style.backgroundImage="url('./images/time/放飞小高.jpg')";
thursday[0].onmousemove=function(){
    thursday[0].style.color="skyblue";
    thursday[0].onmousedown=function(){
        location.assign("https://www.bilibili.com/bangumi/media/md28229880/");
    }
}
thursday[0].onmouseout=function(){
    thursday[0].style.color="rgb(117, 117, 117)";
}

thursday[1].style.backgroundImage="url('./images/time/强袭魔女.jpg')";
thursday[1].onmousemove=function(){
    thursday[1].style.color="skyblue";
    thursday[1].onmousedown=function(){
        location.assign("https://www.zhenbuka.com/voddetail/75349/");
    }
}
thursday[1].onmouseout=function(){
    thursday[1].style.color="rgb(117, 117, 117)";
}

//星期五
var firday=document.getElementById("firday").children;
firday[0].style.backgroundImage="url('./images/time/魔女之旅.jpg')";
firday[0].onmousemove=function(){
    firday[0].style.color="skyblue";
    firday[0].onmousedown=function(){
        location.assign("https://www.bilibili.com/bangumi/media/md28229881/");
    }
}
firday[0].onmouseout=function(){
    firday[0].style.color="rgb(117, 117, 117)";
}

firday[1].style.backgroundImage="url('./images/time/灵笼.jpg')";
firday[1].onmousemove=function(){
    firday[1].style.color="skyblue";
    firday[1].onmousedown=function(){
        location.assign("https://www.bilibili.com/bangumi/media/md23432/");
    }
}
firday[1].onmouseout=function(){
    firday[1].style.color="rgb(117, 117, 117)";
}

firday[2].style.backgroundImage="url('./images/time/安达与岛村.jpg')";
firday[2].onmousemove=function(){
    firday[2].style.color="skyblue";
    firday[2].onmousedown=function(){
        location.assign("https://www.zhenbuka.com/voddetail/75380/");
    }
}
firday[2].onmouseout=function(){
    firday[2].style.color="rgb(117, 117, 117)";
}

//星期六
var saturday=document.getElementById("saturday").children;
saturday[0].style.backgroundImage="url('./images/time/炎炎消防队.jpg')";
saturday[0].onmousemove=function(){
    saturday[0].style.color="skyblue";
    saturday[0].onmousedown=function(){
        location.assign("https://www.bilibili.com/bangumi/media/md28229236/");
    }
}
saturday[0].onmouseout=function(){
    saturday[0].style.color="rgb(117, 117, 117)";
}

saturday[1].style.backgroundImage="url('./images/time/地下城.jpg')";
saturday[1].onmousemove=function(){
    saturday[1].style.color="skyblue";
    saturday[1].onmousedown=function(){
        location.assign("https://www.bilibili.com/bangumi/media/md28229869/");
    }
}
saturday[1].onmouseout=function(){
    saturday[1].style.color="rgb(117, 117, 117)";
}

saturday[2].style.backgroundImage="url('./images/time/我好酸.jpg')";
saturday[2].onmousemove=function(){
    saturday[2].style.color="skyblue";
    saturday[2].onmousedown=function(){
        location.assign("https://www.bilibili.com/bangumi/media/md28229676/");
    }
}
saturday[2].onmouseout=function(){
    saturday[2].style.color="rgb(117, 117, 117)";
}

saturday[3].style.backgroundImage="url('./images/time/鬼灭.jpg')";
saturday[3].onmousemove=function(){
    saturday[3].style.color="skyblue";
    saturday[3].onmousedown=function(){
        location.assign("https://www.bilibili.com/bangumi/media/md28229443/");
    }
}
saturday[3].onmouseout=function(){
    saturday[3].style.color="rgb(117, 117, 117)";
}

//星期天
var sunday=document.getElementById("sunday").children;
sunday[0].style.backgroundImage="url('./images/time/假面骑士.jpg')";
sunday[0].onmousemove=function(){
    sunday[0].style.color="skyblue";
    sunday[0].onmousedown=function(){
        location.assign("https://www.zhenbuka.com/voddetail/74178/");
    }
}
sunday[0].onmouseout=function(){
    sunday[0].style.color="rgb(117, 117, 117)";
}

sunday[1].style.backgroundImage="url('./images/time/火车娘.jpg')";
sunday[1].onmousemove=function(){
    sunday[1].style.color="skyblue";
    sunday[1].onmousedown=function(){
        location.assign("https://www.zhenbuka.com/voddetail/74994/");
    }
}
sunday[1].onmouseout=function(){
    sunday[1].style.color="rgb(117, 117, 117)";
}


//热播系列
var boxs=document.getElementById("box").children; //用于重定向小盒子
boxs[0].onclick=function(){
    location.assign("https://www.zhenbuka.com/topicdetail-20/");
}
boxs[1].onclick=function(){
    location.assign("https://www.zhenbuka.com/topicdetail-16/");
}
boxs[2].onclick=function(){
    location.assign("https://www.zhenbuka.com/topicdetail-11/");
}
boxs[3].onclick=function(){
    location.assign("https://www.zhenbuka.com/topicdetail-15/");
}
boxs[4].onclick=function(){
    location.assign("https://www.zhenbuka.com/topicdetail-10/");
}
boxs[5].onclick=function(){
    location.assign("https://www.zhenbuka.com/topicdetail-5/");
}
boxs[6].onclick=function(){
    location.assign("https://www.zhenbuka.com/topicdetail-3/");
}
boxs[7].onclick=function(){
    location.assign("https://www.zhenbuka.com/topicdetail-1/");
}


//关于弹窗设置
var popup=document.getElementById("popup"); //主容器
setTimeout(function(){  //网站加载1秒后弹窗
    popup.style.top="10%";
},1000);
var clo=document.getElementById("clo"); //关闭按钮
clo.onclick=function(){
    popup.style.top="-90%";
}

//使眼珠子跟着鼠标动
var eyes = document.getElementsByClassName("eyes");
    window.onmousemove = function(event){  //文档鼠标移动事件
        for(var i=0;i<eyes.length;i++){
            var x = eyes[i].offsetLeft + eyes[0].clientWidth/2; //眼睛的x坐标
            var y = eyes[i].offsetTop + eyes[0].clientHeight/2; //眼睛的y坐标
            var rad = Math.atan2(event.pageX-x, event.pageY-y); //鼠标和眼睛的坐标距离，然后用atan2函数计算出该点与(0, 0)点之间的弧度
            var rot = (rad * (180 / Math.PI) *-1) + 180; // 转换成角度
            eyes[i].style.transform = 'rotate(' + rot + 'deg)';
        }
    }
var face=document.getElementById("face");
var mouth=document.getElementsByClassName("mouth")[0];
face.onmousemove=function(){
    mouth.style.borderRadius="10px";
    mouth.style.height="5px";
}
face.onmouseout=function(){
    mouth.style.borderRadius="0  0 100px 100px";
    mouth.style.height="25px";
}
//点击小脸显示当前时间
face.onclick=function(){
    var smile=null;  //用于在鼠标移入时间区域使暂停计时器
    var touchTime=document.getElementById("touchTime");
    var today=new Date(); //获取当前时间
    var text="当前时间：";
    var week=today.getDay(); //0星期天，1~6星期一到星期六
switch(week){
    case 0:week="星期天";break;
    case 1:week="星期一";break;
    case 2:week="星期二";break;
    case 3:week="星期三";break;
    case 4:week="星期四";break;
    case 5:week="星期五";break;
    case 6:week="星期六";break;
}
    var hello=null; //问候
if(today.getHours()<=9 && today.getHours()>=0){
    hello="早上好！";
}
else if(today.getHours()>9 && today.getHours()<=12){
    hello="中午好！";
}
else if(today.getHours()>12 && today.getHours()<=18){
    hello="下午好！";
}
else if(today.getHours()>18 && today.getHours()<=23){
    hello="晚上好！";
}
    touchTime.style.opacity="0.8";
    //点击时显示
    var hour=today.getHours();
    if(hour<10){
        hour="0"+today.getHours();
    }
    var min=today.getMinutes();
    if(min<10){
        min="0"+today.getMinutes();
    }
    touchTime.innerHTML=hello+text+today.toLocaleDateString()+"&nbsp"+week+"&nbsp&nbsp"+hour+
    ":"+min;
    //设置定时器，隔3秒后重新隐藏
    smile=setTimeout(function(){
        touchTime.style.opacity="0";
    },3000);
    touchTime.onmousemove=function(){clearTimeout(smile);}
    touchTime.onmouseout=function(){ //鼠标松开后1秒隐藏
        smile=setTimeout(function(){
            touchTime.style.opacity="0";
        },1000);
    }
}


//皮肤切换
var skin=document.getElementById("skin");  //获取皮肤
var i=1; //用于判断点击次数
skin.onclick=function(){
    i++;
    if(i%2){  //点击次数为偶数时切换
        document.body.style.backgroundColor="rgb(255,255,255)"; //更改背景颜色
        document.body.style.color="#000"; //更改字体颜色
        document.getElementById("nav").style.backgroundColor="rgb(255,255,255)";
        var boxspan=document.getElementsByClassName("boxspan"); //又是一个小细节
        for(var j=0;j<boxspan.length;j++){boxspan[j].style.backgroundColor="rgb(255,255,255)";}
        skin.setAttribute("src","./images/skin1.png");
    }
    else{
        skin.setAttribute("src","./images/skin2.png");  //再次点击切换回来
        document.body.style.backgroundColor="rgb(0,0,0)";
        document.body.style.color="#888";
        document.getElementById("nav").style.backgroundColor="rgb(0,0,0)";
        var boxspan=document.getElementsByClassName("boxspan");
        for(var j=0;j<boxspan.length;j++){boxspan[j].style.backgroundColor="rgb(0,0,0)";}
        skin.title="切换日间";
    }
}

//登录界面
var user=document.getElementById("user");  //获取登录小图标
var login=document.getElementById("login"); //获取登录界面
var cloo=document.getElementById("cloo");  //获取关闭按钮
var usname=document.getElementById("usname");  //用于获取账号值
var uspwd=document.getElementById("uspwd"); //用于获取密码值
var su=document.getElementById("su"); //获取登录键
user.onclick=function(){
    login.style.width="400px";
    login.style.height="400px";
}
cloo.onclick=function(){
    login.style.width="0px";
    login.style.height="0px";
}
su.onclick=function(){
    var username=usname.value; //账号
    var userpwd=uspwd.value; //密码
    if(username=="1930634" && userpwd=="123"){
        alert("登录成功！");
        location.reload();  //登录成功刷新页面
    }
    else{alert("登录失败！")}
}