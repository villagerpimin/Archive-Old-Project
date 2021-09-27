$(function(){

    //提交搜索
    $("#serachsub").click(function(){
        $(".navbar-form").submit()
    })

    /* 热销分页 */
    var spage=$("#hot_page").data("page"); //当前页数
    var page_num=$("#hot_page").data("pagenum"); //页面总数

    //默认上一页和第一页按钮禁用
    $("[name=startPage]").attr("disabled",true);
    $("[name=prePage]").attr("disabled",true);
    
    //点击第一页时
    $('[name=startPage]').on('click',function(){
        spage=1; //传递的页数
        $("#inppage").val(spage);
        //调整四个按钮的状态
        $("[name=startPage]").attr("disabled",true);
        $("[name=prePage]").attr("disabled",true);
        $("[name=nextPage]").attr("disabled",false);
        $("[name=endPage]").attr("disabled",false);

        $.post('./data/getHotGamesPage.php',{page:spage},function(res){
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

        $.post('./data/getHotGamesPage.php',{page:spage},function(res){
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

        $.post('./data/getHotGamesPage.php',{page:spage},function(res){
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

        $.post('./data/getHotGamesPage.php',{page:spage},function(res){
            $("#hot_item").html(res);
        })
    });

    //用户手动输入页码
    $("#inppage").on('keyup',function(event){
        if(event.keyCode==13){
            spage=$("#inppage").val();
            if(spage>page_num || spage<1){
                alert("没有该页！")
            }
            else{
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
                $.post('./data/getHotGamesPage.php',{page:spage},function(res){
                    $("#hot_item").html(res);
                })
            }
        }
    })

    //鼠标进入事件，用于向处理程序请求鼠标指向的游戏详情
    $(document).on('mouseenter','[name=hot_list]',function(){
        var id=$(this).data("id"); //获得鼠标指向的游戏id
        $.post('./data/getHotGameDetails.php',{gameid:id},function(res){
            $("#hotright").html(res);
        })
    })

    //热销列表项的跳转
    $(document).on('click',"[name=hot_list]",function(){
        var id=$(this).data("id");
        location.href="./detail.php?id="+id;
    })

})