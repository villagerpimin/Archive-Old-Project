window.onload=function(){
    /*点击右下角箭头时返回顶部*/
    var totop = document.getElementById("totop");
    totop.onclick = function () {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
}