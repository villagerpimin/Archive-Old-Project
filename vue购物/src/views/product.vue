<template>
    <div id="product">
        <!-- 商品详情 -->
        <div class="left">
            <img :src="getData.imgpath" style="width:100%;height:100%;">
        </div>
        <div class="right">
            <h3>{{getData.name}}</h3>
            <p>{{getData.sname}}</p>
            <div class="bg">
                <div class="ht"></div>
                <div class="cont">
                    价&nbsp;&nbsp;格：<span style="color:red;font-size:24px;">￥{{getData.price}}</span>
                </div>
            </div>
            <div class="cont">
                数&nbsp;&nbsp;量：
                <!-- 数量加减 -->
                <button @click="byNum--" :disabled="byNum==1">-</button>
                <input type="number" v-model="byNum" name="" id="">
                <button @click="byNum++" :disabled="byNum==99">+</button>
            </div>
            <!-- 购买和加入购物车是不可用的 -->
            <div class="money">
                <div @click="nomore">
                    立即购买
                </div>
                <div @click="nomore">
                    加入购物车
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            getData:JSON.parse(this.$route.params.shopData), //获得上个页面传递的商品信息
            byNum:1, //购买数量
        }
    },
    watch:{ //监听购买数量
        byNum:1
    },
    methods:{
        nomore(){
            alert('deal late no more\n交易不能推迟');
        }
    }
}
</script>

<style scoped>
#product{
    margin-top: 50px;
    height: 550px;
    width: 100%;
}
.left{
    float: left;
    margin-right: 50px;
    width: 500px;
}
.right{
    width: 600px;
    float: left;
}
h3{
    font-weight: 500;
    font-size: 24px;
}
p{
    color: red;
    font-size: 14px;
}
.bg{
    width: 100%;
    height: 100px;
    background-color: #f1f0f0;
}
.ht{
    z-index: 1;
    width: 100%;
    height: 10px;
    background-color: #e7e6e6;
}
.cont{
    margin: 20px 20px;
    font-size: 18px;
}
input{
    width: 50px;
    text-align: center;
}
input:focus{outline: none;}
.money div{
    width: 120px;
    height: 40px;
    border-radius: 15px;
    border: 1px solid red;
    text-align: center;
    line-height: 40px;
    background-color: rgb(253, 211, 211);
    float: left;
    margin-right: 30px;
    margin-left: 30px;
    cursor: pointer;
    margin-top: 40px;
    font-weight: 600;
}
</style>