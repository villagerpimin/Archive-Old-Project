<template>
    <div id="carouselTime" @mousemove="mon" @mouseleave="mout">
        <!-- 轮播 -->
        <div class="pic-inner" @mouseenter="timerStop" @mouseleave="timerStart">
            <img  :src="pics[index]">
        </div>
        <!-- 上一张 -->
        <a class="prev" @click="index<=0?index=3:index--" v-show="prevFlag">&lt;</a>
        <!-- 下一张 -->
        <a class="next" @click="index>=0&&index<3?index++:index=0" v-show="nextFlag">&gt;</a>
    </div>
</template>

<script>
export default {
    data(){
        return{
            index:0,
            pics:[
                require("@/assets/carousel/1.jpg"),require("@/assets/carousel/2.jpg"),
                require("@/assets/carousel/3.jpg"),require("@/assets/carousel/4.jpg")
            ],
            prevFlag:false,
            nextFlag:false,
            timer:''//用于设置定时器
        }
    },
    methods:{
        mon(){
            //判断上一张箭头是否显示
            if(this.index==0){
                this.prevFlag=false
            }else{this.prevFlag=true}
            //判断下一张箭头是否显示
            if(this.index==3){
                this.nextFlag=false
            }else{this.nextFlag=true}
        },
        mout(){
            this.prevFlag=false;
            this.nextFlag=false;
        },
        timerStart(){
            this.timer=window.setInterval(()=>{
                if(this.index>=0 && this.index<3){
                    this.index++;
                }
                else{
                    this.index=0;
                }
            },2000);
        },
        timerStop(){
            window.clearInterval(this.timer);
            this.timer="";
        }
    },
    created(){
        this.index=0;
        this.timerStop(); //每次进入页面时先将定时器清空
        this.timerStart();
    }
}
</script>

<style scoped>
    #carouselTime{
        width: 100%;
        height: 400px;
    }
    .pic-inner{
        width: 1200px;
        height: 100%;
        overflow: hidden;
    }
    .pic-inner img{
        width: 135%;
        height: 100%;
        float: left;
        position: relative;
        left: -35%;
        z-index: -1;
    }
    .prev,.next{
        font-size: 36px;
        font-weight: bold;
        height: 40px;
        width: 30px;
        cursor: pointer;
        z-index: 5;
        position: relative;
        top: -60%;
        color: #898989;
        line-height: 40px;
    }
    .prev{float: left;left: 5%;}
    .next{float: right;right: 5%;}
</style>