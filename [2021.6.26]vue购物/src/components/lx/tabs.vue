<template>
    <div id="lx">
        <!-- 分类（选项卡） -->
        <div>
            <ul style="width: 120px;list-style: none;float: left;">
                <!-- 利用v-show，循环下标实现选项卡 -->
                <li v-for="(val,index) in list" :key="index" @click="showTab(index)"
                    :class="{active:index==showNum}" class="leftitem">
                    {{val}}
                </li>
            </ul>
        </div>
        

        <div class="rightdiv" v-for="(val,index) in list" :key="index" v-show="showNum==index">
            <ul class="tab-con">
                <!-- 循环列表数据（二维数组） -->
                <li v-for="item in tab_list[index]" :key="item.name">
                    <a href="#" :title="item.name">
                        <img :src="item.img">
                        {{item.name}}
                    </a>
                    
                </li>
            </ul>
        </div>

    </div>
</template>

<script>
export default {
    data(){
        return{
            list:[
                "家庭安防","安全路由","智能手表","汽车用品","扫地机器人",
                "影音生活","生态产品"
            ],
            showNum:0, //默认显示第一个选项卡
            tab_list:[
                [ //家庭安防
                    {name:"摄像机",img:require("@/assets/lx/af1.jpg")},
                    {name:"门铃",img:require("@/assets/lx/af2.jpg")},
                    {name:"存储卡",img:require("@/assets/lx/af3.jpg")},
                    {name:"云录卡",img:require("@/assets/lx/af4.jpg")},
                    {name:"配件",img:require("@/assets/lx/af5.jpg")},
                ],
                [ //安全路由
                    {name:"路由器",img:require("@/assets/lx/ly1.jpg")}
                ],
                [ //智能手表
                    {name:"智能手表",img:require("@/assets/lx/sb1.jpg")},
                    {name:"配件",img:require("@/assets/lx/sb2.jpg")}
                ],
                [ //汽车用品
                    {name:"记录仪",img:require("@/assets/lx/qc1.jpg")},
                    {name:"安全座椅",img:require("@/assets/lx/qc2.jpg")},
                    {name:"胎压监测",img:require("@/assets/lx/qc3.jpg")},
                    {name:"存储卡",img:require("@/assets/lx/qc4.jpg")},
                    {name:"配件",img:require("@/assets/lx/qc5.jpg")},
                ],
                [ //扫地机器人
                    {name:"X95礼盒版",img:require("@/assets/lx/sd1.jpg")},
                    {name:"C50",img:require("@/assets/lx/sd2.jpg")},
                    {name:"X100 MAX",img:require("@/assets/lx/sd3.jpg")}
                ],
                [ //影音生活
                    {name:"无线耳机",img:require("@/assets/lx/sh1.jpg")},
                    {name:"运动耳机",img:require("@/assets/lx/sh2.jpg")}
                ],
                [ //生态产品
                    {name:"平衡车",img:require("@/assets/lx/st1.jpg")},
                    {name:"手写板",img:require("@/assets/lx/st2.jpg")},
                    {name:"其他",img:require("@/assets/lx/st3.jpg")}
                ]
            ]
        }
    },
    methods:{
        showTab(index){
            this.showNum=index;
        }
    }
}
</script>

<style scoped>
#lx{
    width: 95%;
    margin: auto;
}

.leftitem{
    width: 100%;
    height: 50px;
    line-height: 50px;
    cursor: pointer;
    margin-bottom: 20px;
    text-align: center;
    border-radius: 5px;
    transition: .4s;
}
.leftitem:hover{
    background-color: #c0bebe;
}
.active{background-color: #b9b9b9;}/* 活动时显示背景 */
.rightdiv{
    width: 900px;
    float: left;
    margin-top: 20px;
    margin-left: 60px;
    animation: flipInX .6s; /* 用了App.vue导入的全局动画库 */
}
.rightdiv li{
    height: 55px;
    width: 150px;
    list-style: none;
    font-size: 18px;
    float: left;
}
.rightdiv img{
    width: 50px;
    height: 50px;
}
.rightdiv a{
    text-decoration: none;
    color: #2c3e50;
    line-height: 50px;
}
</style>