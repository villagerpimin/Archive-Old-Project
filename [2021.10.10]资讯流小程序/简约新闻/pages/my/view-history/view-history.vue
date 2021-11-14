<template>
	<view class="frame">
		<view class="tip">
			浏览历史（仅显示最后15条）
		</view>
		
		<view class="show_item">
			<view class="item" v-for="item in list" @click="gotoRead(item.id)">
				{{item.title}}
			</view>
		</view>
		
		<view class="clear" @click="removeHistory()">
			清除记录
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				history:[],
				list:[]
			};
		},
		onLoad() {
			this.history=uni.getStorageSync("viewHistory")
			this.getNewsTitle(this.history)
		},
		methods:{
			getNewsTitle(list){
				/* 从新闻id中获得标题 */
				var that=this
				uni.request({
					url:getApp().globalData.dataURL+"/api/getHistoryTitle.php",
					data:{
						ids:JSON.stringify(that.history)
					},
					method:"POST",
					header:{
						'content-type':'application/x-www-form-urlencoded'
					},
					success(res) {
						that.list=res.data
						console.log(res.data)
					}
				})
			},
			gotoRead(nid){
				uni.navigateTo({
					url:"../../readnews/readnews?nid="+nid
				})
			},
			removeHistory(){
				var that = this
				uni.showModal({
					showCancel:true,
					title:"提示",
					content:"确定清除吗？",
					success(res){
						if(res.confirm){
							uni.removeStorage({
								key:"viewHistory",
								success() {
									uni.showToast({
										title:"清除成功",
										icon:"success",
										duration:1000
									})
									that.history=[]
									that.list=[]
								}
							})
						}
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
.tip{
	position: relative;
	top: 40rpx;
	width: 80%;
	height: 100rpx;
	border: 1rpx solid rgba($color: #808080, $alpha: 0.3);
	border-radius: 20rpx;
	margin: auto;
	text-align: center;
	line-height: 90rpx;
}
.show_item{
	position: relative;
	top: 70rpx;
	width: 100%;
	.item{
		width: 100%;
		height: 100rpx;
		border-radius: 20rpx;
		background-color: rgba($color: #a5a5a5, $alpha: 0.1);
		line-height: 100rpx;
		margin-bottom: 40rpx;
		overflow: hidden;
		text-align: center;
	}
}
.clear{
	position: fixed;
	left: 30%;
	bottom: 20rpx;
	width: 40%;
	height: 80rpx;
	line-height: 80rpx;
	color: #FFFFFF;
	background-color: $uni-color-success;
	border-radius: 50rpx;
	text-align: center;
}
</style>
