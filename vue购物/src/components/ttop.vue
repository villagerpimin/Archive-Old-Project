<template>
    <div @click="backtop()" title="回到顶部">
        <!-- 用于回到顶部 -->
        ↑
    </div>
</template>

<script>
export default {
    methods: {
      /**
        * 回到顶部功能实现过程：
        * 1. 获取页面当前距离顶部的滚动距离（这个兼容IE）
        * 2. 计算出每次向上移动的距离，用负的滚动距离除以5，因为滚动的距离是一个正数，想向上移动就是做一个减法
        * 3. 用当前距离加上计算出的距离，然后赋值给当前距离，就可以达到向上移动的效果
        * 4. 最后在移动到顶部时，清除定时器
        * 5. 这是百度的
      */
      backtop(){
          var timer = setInterval(function(){
            let osTop = document.documentElement.scrollTop || document.body.scrollTop;
            let ispeed = Math.floor(-osTop / 5); 
            document.documentElement.scrollTop = document.body.scrollTop = osTop + ispeed;
            this.isTop = true;
            if(osTop === 0){
              clearInterval(timer);
            }
          },20)
      }
    }
}
</script>

<style scoped>
    div{
        width: 40px;
        height: 40px;
        border-radius: 50px;
        position: fixed;
        bottom: 30px;
        right: -20px;
        line-height: 40px;
        text-align: center;
        border: 1px solid black;
        cursor: pointer;
        transition: .8s;
    }
    div:hover{
        right: 5px;
        transition: .8s;
    }
</style>