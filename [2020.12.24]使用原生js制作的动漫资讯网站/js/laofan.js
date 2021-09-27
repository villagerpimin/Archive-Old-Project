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


//已选择的内容获取
var sled=document.getElementById("sled").children; //用于获取已选的条目(从1开始)
var assort=document.getElementById("assort").children; //分类，长度5
var typesOf=document.getElementById("typesOf").children; //类型,长度32
var season=document.getElementById("season").children; //季度，长度6
var years=document.getElementById("years").children; //年份，长度
typesOf[1].style.color="orange";  //默认选择全部
assort[1].style.color="orange";
season[1].style.color="orange";
years[1].style.color="orange";

function notes(i,name,index){  //设置方法用于记录选择的数据
    if(index==1){
        sled[i].innerHTML="";
    }
    else{
        sled[i].innerHTML=name[index].innerText; //获取设置好的内容
    }
    //name[index].style.color="orange";
}

for(var i=0;i<assort.length;i++){  //记录分类选择
    assort[i].index=i; //记录点击的坐标
    assort[i].onclick=function(){
        notes(1,assort,this.index);  //调用方法记录数据
    }
}
for(var i=0;i<typesOf.length;i++){  //记录类型选择
    typesOf[i].index=i; //记录点击的坐标
    typesOf[i].onclick=function(){
        notes(2,typesOf,this.index);
    }
}
for(var i=0;i<season.length;i++){  //记录季度选择
    season[i].index=i; //记录点击的坐标
    season[i].onclick=function(){
        notes(3,season,this.index);
    }
}
for(var i=0;i<years.length;i++){  //记录年份选择
    years[i].index=i; //记录点击的坐标
    years[i].onclick=function(){
        notes(4,years,this.index);
    }
}
