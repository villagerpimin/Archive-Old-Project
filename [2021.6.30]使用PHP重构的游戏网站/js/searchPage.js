/* 用于处理分页 */
$(function(){

    //提交搜索
    $("#serachsub").click(function(){
        $(".navbar-form").submit()
    })

    var userid=$("#loging").data("userid"); //用户id
    console.log(userid!=null?"已登陆":"未登录");

    //退出登录
    $("#exituser").click(function(){
        document.cookie="id=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
        document.cookie="username=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
        document.cookie="password=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
        location.reload();
    })

    /* 热销分页 */
    var spage=$("#hot_page").data("page"); //当前页数
    var page_num=$("#hot_page").data("pagenum"); //页面总数
    var search=$("#hot_page").data("search"); //查询的内容

    //默认上一页和第一页按钮禁用
    $("[name=startPage]").attr("disabled",true);
    $("[name=prePage]").attr("disabled",true);

    if(page_num<=1){ //总页数只有一页时，按钮全部禁用
        $("[name=startPage]").attr("disabled",true);
        $("[name=prePage]").attr("disabled",true);
        $("[name=nextPage]").attr("disabled",true);
        $("[name=endPage]").attr("disabled",true);
    }
    
    //点击第一页时
    $('[name=startPage]').on('click',function(){
        spage=1; //传递的页数
        $("#inppage").val(spage);
        //调整四个按钮的状态
        $("[name=startPage]").attr("disabled",true);
        $("[name=prePage]").attr("disabled",true);
        $("[name=nextPage]").attr("disabled",false);
        $("[name=endPage]").attr("disabled",false);

        $.post('./data/getSearchPage.php',{page:spage,nr:search},function(res){
            $("#hot_item").html(res);
        })
    })

    //点击最后一页时
    $('[name=endPage]').on('click',function(){
        spage=page_num;
        $("#inppage").val(spage);
        //调整四个按钮的状态
        $("[name=nextPage]").attr("disabled",true);
        $("[name=endPage]").attr("disabled",true);
        $("[name=startPage]").attr("disabled",false);
        $("[name=prePage]").attr("disabled",false);

        $.post('./data/getSearchPage.php',{page:spage,nr:search},function(res){
            $("#hot_item").html(res);
        })
    })

    //点击上一页时
    $("[name=prePage]").on('click',function(){
        --spage;
        $("#inppage").val(spage);

        if(spage===1){
            $("[name=nextPage]").attr("disabled",false);
            $("[name=endPage]").attr("disabled",false);
            $("[name=startPage]").attr("disabled",true);
            $("[name=prePage]").attr("disabled",true);
        }
        else if(spage===page_num){
            $("[name=nextPage]").attr("disabled",true);
            $("[name=endPage]").attr("disabled",true);
            $("[name=startPage]").attr("disabled",false);
            $("[name=prePage]").attr("disabled",false);
        }
        else{
            $("[name=nextPage]").attr("disabled",false);
            $("[name=endPage]").attr("disabled",false);
            $("[name=startPage]").attr("disabled",false);
            $("[name=prePage]").attr("disabled",false);
        }

        $.post('./data/getSearchPage.php',{page:spage,nr:search},function(res){
            $("#hot_item").html(res);
        })
    })

    //点击下一页时
    $("[name=nextPage]").on('click',function(){
        ++spage;
        $("#inppage").val(spage);

        if(spage===page_num){
            $("[name=nextPage]").attr("disabled",true);
            $("[name=endPage]").attr("disabled",true);
            $("[name=startPage]").attr("disabled",false);
            $("[name=prePage]").attr("disabled",false);
        }
        else if(spage===1){
            $("[name=nextPage]").attr("disabled",false);
            $("[name=endPage]").attr("disabled",false);
            $("[name=startPage]").attr("disabled",true);
            $("[name=prePage]").attr("disabled",true);
        }
        else{
            $("[name=nextPage]").attr("disabled",false);
            $("[name=endPage]").attr("disabled",false);
            $("[name=startPage]").attr("disabled",false);
            $("[name=prePage]").attr("disabled",false);
        }

        $.post('./data/getSearchPage.php',{page:spage,nr:search},function(res){
            $("#hot_item").html(res);
        })
    });

    /* 加入购物车 */
    $(document).on("click","[name=addcar]",function(){
        console.log($(this).data("gameid")); //游戏id
        console.log(userid); //用户id
        var gameid=$(this).data("gameid"); //获得要添加的游戏id
        if(userid==null){
            //未登录时
            confirm("还没有登录，暂时不可加入购物车！是否登录？")?location.href="./jie/login/login.php":""
        }
        else{
            //已登录时
            $.post("./data/addGameCar.php",{uid:userid,gid:gameid},function(res){
                if(res=="ok"){
                    alert("加购成功！");
                }
                else{
                    alert("加购失败！");
                    console.log(res)
                }
            })
        }
    });

})