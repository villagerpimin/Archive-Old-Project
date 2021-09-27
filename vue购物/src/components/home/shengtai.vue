<template>
    <div id="shengtai">
        生态互联
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
                {name:"360 平衡车P1",price:1899,imgpath:require("@/assets/shengtai/st1.jpg"),
                    sname:"超长里程续航 多重安全防护"},
                {name:"360 平衡车V1 耀岩黑",price:499,imgpath:require("@/assets/shengtai/st2.jpg"),
                    sname:"主动防颠系统 真人语音播报"},
                {name:"360 PlayBuds Pro 真无线耳机",price:279,imgpath:require("@/assets/shengtai/st3.jpg"),
                    sname:"ENC双麦降噪 闹市通话也清晰"},
                {name:"360 液晶手写绘板8.5寸 经典款",price:35,imgpath:require("@/assets/shengtai/st4.jpg"),
                    sname:"轻薄便携 护眼液晶屏 一键清除"},
                {name:"360 运动蓝牙耳机SNE1",price:119,imgpath:require("@/assets/shengtai/st5.jpg"),
                    sname:"舒适佩戴 稀土永磁动圈"},
                {name:"【包邮】360 泡沫洗手液 3瓶装",price:19.9,imgpath:require("@/assets/shengtai/st6.jpg"),
                    sname:"自动泡沫洗手机适用 3瓶装"}
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
#shengtai{
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