<template>
  <div>
    <myNav><!-- 导航栏 --></myNav>
    <ttop><!-- 返回顶部 --></ttop>
    <router-view/>
    <myfooter></myfooter>
  </div>
</template>

<style src="@/assets/animate.min.css"></style>
<style>
body{margin: 0;padding: 0;}
#app {
  width: 1200px;
  margin: auto;
  color: #2c3e50;
}
</style>

<script>
import myNav from '@/components/my-Nav.vue' /* 导航栏 */
import ttop from '@/components/ttop.vue' /* 回到顶部箭头 */
import myfooter from '@/components/footer.vue' /* 页脚 */

export default {
  components: {
    myNav,
    ttop,
    myfooter
  },
  data(){
    return{
      //这里存放公共数据
      shopData:this.$route.params.shopData!=null?JSON.parse(this.$route.params.shopData):""
    }
  }
}
</script>
