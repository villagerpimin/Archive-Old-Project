//皮肤切换
var skin=document.getElementById("skin");  //获取皮肤
var i=1; //用于判断点击次数
skin.onclick=function(){
    i++;
    if(i%2){  //点击次数为偶数时切换
        document.body.style.backgroundColor="rgb(255,255,255)"; //更改背景颜色
        document.body.style.color="#000"; //更改字体颜色
        document.getElementById("nav").style.backgroundColor="rgb(255,255,255)";
        skin.setAttribute("src","./images/skin1.png");
    }
    else{
        skin.setAttribute("src","./images/skin2.png");  //再次点击切换回来
        document.body.style.backgroundColor="rgb(0,0,0)";
        document.body.style.color="#888";
        document.getElementById("nav").style.backgroundColor="rgb(0,0,0)";
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
var menuList=document.getElementById("menu").children;
menuList[0].onclick=function(){
    location.reload(); //刷新页面
}
menuList[1].onclick=function(){
    location.replace("index.html");
}
menuList[2].onclick=function(){
    window.close(); //关闭窗口
}
menuList[3].onclick=function(){
    location.assign("#");
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
face.onclick=function(){  //点击返回顶部
    location.assign("#cover");
}
face.onmousemove=function(){
    mouth.style.borderRadius="10px";
    mouth.style.height="5px";
}
face.onmouseout=function(){
    mouth.style.borderRadius="0  0 100px 100px";
    mouth.style.height="25px";
}
//点击小脸事件
face.onclick=function(){
    location.href="#";
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
    //点击时显示时间
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

/* 页数背景色设置 */
var page=document.getElementById("page").children;
page[0].onclick=function(){
    location.assign("./index.html");
}
page[0].onmousemove=function(){
    page[0].style.backgroundColor="bisque";
}
page[0].onmouseout=function(){
    page[0].style.backgroundColor="white";
}
page[2].onclick=function(){
    location.assign("./juchang.html");
}
page[2].onmousemove=function(){
    page[2].style.backgroundColor="bisque";
}
page[2].onmouseout=function(){
    page[2].style.backgroundColor="white";
}

//获取所有具有boximg的元素
var imgs=document.getElementsByClassName("boximg");
//为每个子元素设置背景图和对应链接
imgs[0].style.backgroundImage="url('./images/juchang/乘浪之约.jpg')";
imgs[0].onclick=function(){location.assign("https://www.halitv.com/detail/1464.html");}
imgs[1].style.backgroundImage="url('./images/juchang/路人女主.jpg')";
imgs[1].onclick=function(){location.assign("https://www.halitv.com/detail/1522.html");}
imgs[2].style.backgroundImage="url('./images/juchang/知晓天空之蓝的人啊.jpg')";
imgs[2].onclick=function(){location.assign("https://www.halitv.com/detail/1234.html");}
imgs[3].style.backgroundImage="url('./images/juchang/鬼灭之宴.jpg')";
imgs[3].onclick=function(){location.assign("https://www.halitv.com/detail/1446.html");}
imgs[4].style.backgroundImage="url('./images/juchang/海兽之子.jpg')";
imgs[4].onclick=function(){location.assign("https://www.halitv.com/detail/1246.html");}
imgs[5].style.backgroundImage="url('./images/juchang/你好世界.jpg')";
imgs[5].onclick=function(){location.assign("https://www.halitv.com/detail/1078.html");}
imgs[6].style.backgroundImage="url('./images/juchang/七大罪.jpg')";
imgs[6].onclick=function(){location.assign("https://www.halitv.com/detail/313.html");}
imgs[7].style.backgroundImage="url('./images/juchang/胰脏.jpg')";
imgs[7].onclick=function(){location.assign("https://www.halitv.com/detail/197.html");}
imgs[8].style.backgroundImage="url('./images/juchang/朝花夕誓.jpg')";
imgs[8].onclick=function(){location.assign("https://www.halitv.com/detail/192.html");}
imgs[9].style.backgroundImage="url('./images/juchang/你的名字.jpg')";
imgs[9].onclick=function(){location.assign("https://www.halitv.com/detail/175.html");}
imgs[10].style.backgroundImage="url('./images/juchang/声之形.jpg')";
imgs[10].onclick=function(){location.assign("https://www.halitv.com/detail/174.html");}
imgs[11].style.backgroundImage="url('./images/juchang/在这世界的角落.jpg')";
imgs[11].onclick=function(){location.assign("https://www.halitv.com/detail/173.html");}
imgs[12].style.backgroundImage="url('./images/juchang/烟花.jpg')";
imgs[12].onclick=function(){location.assign("https://www.halitv.com/detail/186.html");}
imgs[13].style.backgroundImage="url('./images/juchang/奥特曼.jpg')";
imgs[13].onclick=function(){location.assign("https://www.halitv.com/detail/1448.html");}
imgs[14].style.backgroundImage="url('./images/juchang/时光沙漏.jpg')";
imgs[14].onclick=function(){location.assign("https://www.halitv.com/detail/1169.html");}