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

//显示当前时间
setInterval(function(){
    var today=new Date();
    var tt=document.getElementById("tt");
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
        hello="早上好！<br>";
    }
    else if(today.getHours()>9 && today.getHours()<=12){
        hello="中午好！<br>";
    }
    else if(today.getHours()>12 && today.getHours()<=18){
        hello="下午好！<br>";
    }
    else if(today.getHours()>18 && today.getHours()<=23){
        hello="晚上好！<br>";
    }
    var hour=today.getHours();
    if(hour<10){
        hour="0"+today.getHours();
    }
    var min=today.getMinutes();
    if(min<10){
        min="0"+today.getMinutes();
    }
    tt.innerHTML=hello+text+today.toLocaleDateString()+"&nbsp"+week+"&nbsp&nbsp"+hour+
    ":"+min+":"+today.getSeconds();
},100);

//计时器返回主页
var times=5;
setInterval(refer,1000);
function refer(){
    if(times==0){
        location.href="index.html"; //倒计时结束后返回
    }
    document.getElementById("time").innerHTML=times;
    times--;
}