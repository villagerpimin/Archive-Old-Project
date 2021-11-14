<template>
	<view class="banner">
		<swiper indicator-dots="true" autoplay="true" interval="1500" duration="500">
			<!-- 将数据循环输出 -->
			<swiper-item v-for="(item,index) in list" :key="index">
				<view @click="postNewsId(item.id)">
					<image :src="item.img"></image>
					{{item.text}}
				</view>
			</swiper-item>
		</swiper>
	</view>
</template>

<script>
	export default {
		name:"banner",
		data() {
			return {
				hasNetwork:false,
				list:[]
			};
		},
		props:{
			refresh:{
				type:String,
				default:"0"
			}
		},
		watch:{
			/* 刷新属性发生变化时向后端重新请求 */
			refresh(){
				this.testNetwork()
			}
		},
		mounted() {
			/* 测试网络 */
			this.testNetwork()
		},
		methods:{
			testNetwork(){
				var that=this
				uni.request({
					url:getApp().globalData.dataURL+"/api/getBanner.php",
					success(res) {
						that.hasNetwork = true
						console.log("轮播图同步成功！")
						/* 请求成功后继续向服务器请求数据 */
						that.list=res.data
						//console.log(res.data)
					},
					fail() {
						that.hasNetwork = false
						/* 失败后返回本地数据 */
						that.list = [
							{
								img:"/static/images/banner/fly_banner.jpg",
								text:"“八一”飞行表演队亮灯拉彩烟",
								id:1
							},
							{
								img:"/static/images/banner/sch_banner.jpg",
								text:"探访阿富汗赫拉特省学校 女学生在校上课",
								id:2
							}
						]
						console.log("轮播图同步失败！")
					}
				})
			},
			postNewsId(id){
				/* 将点击的新闻id传递 */
				uni.navigateTo({
					url:"../../pages/readnews/readnews?nid="+id
				})
			},
			
		},
	}
</script>

<style lang="scss">
.banner{
	height: 400rpx;
	width: 100%;
	margin-bottom: 25rpx;
	swiper{
		width: 100%;
		height: 400rpx;
	}
	image{
		width: 100%;
		height: 300rpx;
		border-radius: 15rpx;
	}
}
</style>
