<template>
  <div class="home">
    <carousel><!-- 轮播图 --></carousel>
    <popular><!-- 热门活动 --></popular>
    <anfang><!-- 家庭安防 --></anfang>
    <luyou><!-- 安全路由 --></luyou>
    <shengtai><!-- 生态互联 --></shengtai>
    <div id="end">
      <hr>
      <p>已经到底了</p>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import carousel from "@/components/home/carousel.vue"
import popular from "@/components/home/popular.vue"
import anfang from "@/components/home/anfang.vue"
import luyou from "@/components/home/luyou.vue"
import shengtai from "@/components/home/shengtai.vue"

export default {
  name: '首页',
  components: {
    carousel,
    popular,
    anfang,
    luyou,
    shengtai
  }
}
</script>

<style scoped>
#end{
  width: 300px;
  margin: auto;
  text-align: center;
  clear: both;
  margin-bottom: 50px;
}
#end hr{z-index: -1;}
#end p{
  width: 120px;
  z-index: 5;
  position: relative;
  bottom: 20px;
  background-color: white;
  margin: auto;
}
</style>
