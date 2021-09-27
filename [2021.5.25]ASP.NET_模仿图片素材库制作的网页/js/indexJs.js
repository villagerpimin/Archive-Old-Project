window.onload = function () {
    //获取nav导航的li节点
    var navlist = document.getElementById("nav").children;
    //console.log("获取到导航有" + navlist.length + "个节点");
    //清除其他导航项的下标
    function clearxb(index) {
        for (var i = 0; i < navlist.length; i++) {
            if (i === index) { continue; }
            else { navlist[i].style.borderBottom = ""; }
        }
    }
    //设置点击事件
    navlist[0].onclick = function () {
        navlist[0].style.borderBottom = "solid 1px rgba(49, 55, 224, 0.78)";
        clearxb(0);
    }
    navlist[1].onclick = function () {
        navlist[1].style.borderBottom = "solid 1px rgba(49, 55, 224, 0.78)";
        clearxb(1);
    }
    navlist[2].onclick = function () {
        navlist[2].style.borderBottom = "solid 1px rgba(49, 55, 224, 0.78)";
        clearxb(2);
    }
    navlist[3].onclick = function () {
        navlist[3].style.borderBottom = "solid 1px rgba(49, 55, 224, 0.78)";
        clearxb(3);
    }
    navlist[4].onclick = function () {
        navlist[4].style.borderBottom = "solid 1px rgba(49, 55, 224, 0.78)";
        clearxb(4);
    }
    
    //登录注册点击事件
    var clo = document.getElementById("close");
    var userMain = document.getElementById("usermain");
    clo.onclick = function () { //点击关闭时
        userMain.style.display = "none";
    }
    //用户输入页面在下面

    //点击上传按钮时跳转
    var updata = document.getElementById("updata");
    updata.onclick = function () {
        location.assign("#");
    }

    //判断所在的网页切换搜索框后面的背景图，并将导航下划线修改
    //console.log(location.pathname);
    var url = location.pathname;
    switch (url) {
        case "/index.aspx": {
                document.getElementById("bg").style.backgroundImage = "url('../images/bg_picture.jpeg')";
                navlist[0].style.borderBottom = "solid 1px rgba(49, 55, 224, 0.78)";
                break;
            }
            
        case "/chahua.aspx": {
                document.getElementById("bg").style.backgroundImage = "url('../images/bg_chahua.jpeg')";
                navlist[1].style.borderBottom = "solid 1px rgba(49, 55, 224, 0.78)";
                break;
            }

        case "/shiliang.aspx": {
                document.getElementById("bg").style.backgroundImage = "url('../images/bg_chahua.jpeg')";
                navlist[2].style.borderBottom = "solid 1px rgba(49, 55, 224, 0.78)";
                break;
            }
            
        case "/video.aspx": {
                navlist[3].style.borderBottom = "solid 1px rgba(49, 55, 224, 0.78)";
                break;
            }
            
        case "/music.aspx": {
                navlist[4].style.borderBottom = "solid 1px rgba(49, 55, 224, 0.78)";
                break;
            }
        case "/admin.aspx": {
            document.getElementById("bg").style.backgroundImage = "url('../images/bg_chahua.jpeg')";
            break;
        }
    }

    /*为搜索框添加灰色文字提示*/
    var inptext = document.getElementById("inptext");
    //console.log(inptext.getAttribute("value"))
    if (inptext.getAttribute("value") == null) {  //输入框为空时显示提示语
        inptext.setAttribute("placeholder", "搜索图像、矢量图、视频...");
    }

    /*点击右下角箭头时返回顶部*/
    var totop = document.getElementById("totop");
    totop.onclick = function () {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
}
//用于显示用户输入界面
function openUserMain() {
    document.getElementById("usermain").style.display = "block"
}