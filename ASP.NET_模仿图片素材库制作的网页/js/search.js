/*用于获取查询字符串的值*/
function UrlSearch() {
    var name, value;
    var str = location.href; //取得整个地址栏
    var num = str.indexOf("?")
    str = str.substr(num + 1); //取得所有参数   stringvar.substr(start [, length ]

    var arr = str.split("&"); //各个参数放到数组里
    for (var i = 0; i < arr.length; i++) {
       num = arr[i].indexOf("=");
        if (num > 0) {
            name = arr[i].substring(0, num);
            value = arr[i].substr(num + 1);
            this[name] = value;
        }
    }
}
var info = new UrlSearch; //通过方法获取搜索内容
var neirong = info.q; //搜索内容
var pictype; //图片类型
switch (info.lx) {
    case ("pic"): { pictype = "photo"; break }
    case ("chahua"): { pictype = "illustration"; break }
    case ("shiliang"): { pictype = "vector";break }
}


//在页面加载完成时可触发
$(function(){
    //设置页数
    if(info.page!=null){
        $("#pager").val(info.page)
    }
    else{$("#pager").val(1)}
    /* 导航条中的搜索图标被点击时 */
    $("#insub").on('click',function(){
        $("#ins").submit();
    })
    /* 用户输入页数后回车跳转 */
    $("#pager").on('keypress',function(e){
        if(e.keyCode==13){
            var page=$("#pager").val();
            location.href="search.html?lang=zh&q="+info.q+
                "&page="+page;
        }
    })
    
    var searchAPI = "https://pixabay.com/api/?key=21629980-78ce9a824ba55b006edb1582c&lang=zh&q="+neirong
 + "&page=" + $("#pager").val();

    //获得服务器返回的json
    $.getJSON(searchAPI, function(result) {
        console.log(result)
        $("#num").text("查询到"+result.total+"条内容");
        $("#pgs").text(parseInt(result.total/20))
        $("#thumb").html("");
        for(var i=0;i<result.hits.length;i++){
            $("#thumb").append(`
            <div class="col-sm-3 col-xs-6 col-lg-3">
                <div class="thumbnail">
                    <img src="`+result.hits[i].webformatURL+`" alt="">
                    <div class="caption">
                        `+result.hits[i].tags+`
                    </div>
                </div>
            </div>
            `)
        }
    })/* getJSON */
})


/* 点击图片类型后显示不同类型页面（图片导航） */
var info=new UrlSearch()
function gohref(lx){
    leixing=lx;
    location.href="search.html?q="+info.q+"&lx="+leixing
}
function fangxiang(fx){
    fang=fx;
    location.href="search.html?q="+info.q+"&orientation="+fang;
}