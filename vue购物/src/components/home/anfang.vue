<template>
    <div id="anfang">
        家庭安防
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
            pic_list:[ //家庭安防的加载数据
                {name:"360智能摄像机云台7P超清版  AP1PA3",price:299,imgpath:require("@/assets/anfang/af1.jpg"),
                    sname:"400万超清全景 一键呼叫家人 微光全彩夜视"},
                {name:"360智能摄像机云台7C超清版 AP2CA3",price:299,imgpath:require("@/assets/anfang/af2.jpg"),
                    sname:"声光主动防御 升级400万像素"},
                {name:"360 可视门铃D819 赠送两天循环永久云录",price:299,imgpath:require("@/assets/anfang/af3.jpg"),
                    sname:"手机远程随时查看 与门外人视频通话 逗留报警"},
                {name:"360智能摄像机云台乐享版标准款AP5L",price:169,imgpath:require("@/assets/anfang/af4.jpg"),
                    sname:"1080P画质 无扰增强夜视"},
                {name:"360 智能摄像机云台AI版 D916",price:249,imgpath:require("@/assets/anfang/af5.jpg"),
                    sname:"一键通话 微光全彩 360°全景视野 超清1080P"},
                {name:"360 TF存储卡 64GB  V30  TF64",price:69,imgpath:require("@/assets/anfang/af6.jpg"),
                    sname:"360摄像机及行车记录仪适用"}
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
#anfang{
    clear: both;
    font-size: 20px;
    width: 100%;
    margin-top: -10px;
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
    cursor: pointer;
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