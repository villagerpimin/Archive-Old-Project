<template>
	<view class="tags">
		<scroll-view scroll-x="true" show-scrollbar="true" enable-flex="true">
			<view v-for="(item,index) in tags" @click="touchTag(item,index)" :key="index" 
				class="item" :class="{'item_on':index===poi}">
				{{item}}
			</view>
		</scroll-view>
		
	</view>
</template>

<script>
	export default {
		name:"news-tag",
		data() {
			return {
				tags:[],
				nowTag:"最新",
				hasNetwork:false,
				poi:0,
			};
		},
		mounted() {
			this.networkTest()
		},
		methods:{
			//测试后端连接
			networkTest(){
				var that=this /* 将数据继承 */
				
				uni.request({
					url:getApp().globalData.dataURL+"/api/getTags.php",
					dataType:"json",
					success(res) {
						that.hasNetwork=true
						that.tags=res.data  //将返回的标签保存
						
						console.log("新闻标签同步成功！")
						//console.log(res.data)
					},
					fail() {
						/* 离线状态时 */
						that.hasNetwork=false
						that.tags=[
							"最新","热门","科技"
						]
						console.log("新闻标签同步失败！")
					}
				})
			},
			touchTag(tag,index){
				/* 标签被点击时应显示相关的新闻 */
				this.$emit("touchTag",tag)
				//this.nowTag=tag
				this.poi=index
			},
		}
	}
</script>

<style lang="scss">
.tags{
	width: 100%;
	height: 70rpx;
	border-bottom: 1px solid rgba($color: #888888, $alpha: 0.3);
	scroll-view{
		width: 100%;
		height: 100%;
		text-align: center;
		/* 不换行 */
		white-space: nowrap;
		view{
			width: 25%;
			height: 50rpx;
			line-height: 50rpx;
			margin-right: 25rpx;
			border: 1px solid rgba($color: #a5a5a5, $alpha: 0.4);
			border-radius: 15rpx;
			/* 行内块 */
			display: inline-block;
		}
		.item{
			color: #000000;
		}
		.item_on{
			color: #DD524D;
		}
	}
}
</style>
