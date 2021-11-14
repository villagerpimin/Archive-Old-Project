<template>
	<view class="frame">
		<!-- 展示搜索结果 -->
		<view class="result_count" v-if="list.count>0">
			<view>符合关键词“
				<text class="strong">{{input}}</text>
				”的结果有{{list.count}}个。
			</view>
		</view>
		
		<!-- 展示搜索结果 -->
		<news-column :search="input" :pageNum="pageNum" :loadMore="loadmore"
			class="show_result"></news-column>
		
		<!-- 如果没有数据时 -->
		<view v-if="list.count==0" class="nonews">
			<image src="../../static/images/news_column/nonews.jpg"></image>
			<view>很抱歉，暂时没有你想要的内容！</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				input:"",  /* 搜索内容 */
				list:[],  /* 后端返回的结果 */ 
				pageNum:1,
				status:"more",
				loadmore:false
			};
		},
		onLoad(e) {
			this.input=e.inp
			this.getRes(this.input)
		},
		onReachBottom() {
			this.pageNum++
			this.loadmore=true
		},
		methods:{
			getRes(input){
				var that=this
				
				uni.request({
					url:getApp().globalData.dataURL+"/api/search.php",
					data:{"inp":input},
					method:"POST",
					header:{
						'content-type':'application/x-www-form-urlencoded'
					},
					dataType:"json",
					success(res) {
						/* 成功请求时的操作 */
						that.list=res.data
						
						console.log(res.data)
					},
					fail(err) {
						/* 请求失败时的操作 */
						console.log("失败 "+err)
					}
				})
			}
		}
	}
</script>

<style lang="scss">
.frame{
	width: 92%;
	margin: auto;
}
.result_count{
	text-align: center;
	background-color: rgba($color: #17c0e5, $alpha: 0.1);
	border-radius: 20rpx;
	.strong{
		font-weight: bold;
	}
}
.show_result{
	position: relative;
	top: 40rpx;
}
.nonews{
	width: 600rpx;
	margin: auto;
	position: relative;
	top: 70rpx;
	image{
		width: 100%;
		height: 400rpx;
		border-radius: 30rpx;
		box-shadow: 10rpx 15rpx 10rpx #808080;
	}
	view{
		position: relative;
		top: 70rpx;
		font-size: 28rpx;
		text-align: center;
	}
}
</style>
