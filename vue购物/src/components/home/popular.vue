<template>
    <div id="popular">
        热门活动
        <ul>
            <li>
                <img src="@/assets/popular/pop1.jpg" alt="">
            </li>
            <li>
                <img src="@/assets/popular/pop2.jpg" alt="">
            </li>
            <li>
                <img src="@/assets/popular/pop3.jpg" alt="">
            </li>
            <li>
                <img src="@/assets/popular/pop4.jpg" alt="">
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    
}
</script>

<style scoped>
    #popular{
        clear: both;
        margin-top: 50px;
        font-size: 20px;
        width: 100%;
        height: 400px;
    }
    ul{
        list-style: none;
    }
    li{
        float: left;
        margin-left: 20px;
        margin-right: 20px;
    }
    img{
        width: 250px;
        height: 250px;
        border-radius: 10px;
        transition: .3s;
    }
    img:hover{
        box-shadow: 5px 5px 6px #898989;
    }
</style>