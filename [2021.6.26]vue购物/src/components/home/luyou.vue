<template>
    <div id="luyou">
        <!-- 安全路由 -->
        安全路由
        <ul>
            <li v-for="item in pic_list" :key="item.name" @click="tarProduct('商品详情',item)"
                :title="item.name">
                <img :src="item.imgpath">
                <p :title="item.name" class="tit">
                    <!-- 将过长的字符串截取，完整的商品名称在title中 -->
                    {{item.name.length>12?item.name.substr(0,12)+"...":item.name}}
                </p>
                <p :title="item.sname" class="smtit">
                    {{item.sname.length>18?item.sname.substr(0,18)+"...":item.sname}}
                </p>
                <p class="price">
                    ￥{{item.price}}
                </p>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data(){
        return{
            pic_list:[ //安全路由的加载数据
                {name:"360 WiFi6 路由器V6G",price:269,imgpath:require("@/assets/luyou/ly1.jpg"),
                    sname:"AX1800跑满千兆宽带"},
                {name:"360 家庭防火墙路由器V5",price:89,imgpath:require("@/assets/luyou/ly2.jpg"),
                    sname:"九重安全防护"},
                {name:"360 WiFi6 全屋路由V6 单只装",price:329,imgpath:require("@/assets/luyou/ly3.jpg"),
                    sname:"全千兆网口"},
                {name:"360 家庭防火墙路由器V5X",price:299,imgpath:require("@/assets/luyou/ly4.jpg"),
                    sname:"游戏加速 告别延迟卡顿"},
                {name:"360 家庭防火墙路由器V5S 增强版",price:139,imgpath:require("@/assets/luyou/ly5.jpg"),
                    sname:"双频全千兆 双核CPU"},
                {name:"360 家庭防火墙路由器5Pro",price:179,imgpath:require("@/assets/luyou/ly6.jpg"),
                    sname:"高增益六天线 双频CPU"},
            ]
        }
    },
    methods:{
        tarProduct(url,item){
            this.$router.push({
                name:url,
                params:{shopData:JSON.stringify(item)} //将整个数组作为json字符串传递
            })
        }
    }
}
</script>

<style scoped>
#luyou{
    clear: both;
    font-size: 20px;
    width: 100%;
    margin-top: 50px;
}
ul{
    list-style: none;
}
li{
    float: left;
    margin-left: 30px;
    margin-right: 30px;
    margin-bottom: 30px;
    width: 300px;
    text-align: center;
    transition: .3s;
}
li p{
    clear: both;
    width: 300px;
}
img{
    width: 300px;
    height: 300px;
    border-radius: 10px;
}
li:hover{
    box-shadow: 0 0 10px #898989;
    transform: scale(1.03);
    cursor: pointer;
}
.tit{ /* 商品名称 */
    font-size: 18px;
}
.smtit{ /* 商品介绍(小标题) */
    font-size: 14px;
    color: #898989;
}
.price{ /* 商品价格 */
    color: rgb(168, 2, 2);
}
</style>