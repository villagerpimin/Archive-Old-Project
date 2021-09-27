window.onload = function () {
    var pic = document.getElementById("pic");
    var text = document.getElementById("showTag");
    pic.onmousemove = function () {
        text.style.opacity = 1;
        text.style.animation = "fadeIn 0.7s";
    }
    pic.onmouseout = function () {
        text.style.opacity = 0;
        text.style.animation = "fadeOut 0.7s";
    }

    var logo = document.getElementById("logo");
    logo.onclick = function () {
        location.assign("index.aspx");
    }
    document.getElementById("comm").placeholder = "文明评论，不要出现暴力词汇。";
}