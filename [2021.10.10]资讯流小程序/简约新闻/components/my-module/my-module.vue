<template>
	<view class="frame">
		<view class="module">
			<view class="box" v-for="item in funcMenu">
				<view @click="selectMod(item)">
					{{item}}
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		name:"my-module",
		data() {
			return {
				funcMenu:["浏览记录","投递新闻","功能3","功能4"],
			};
		},
		mounted() {
			
		},
		methods:{
			selectMod(mod){
				var cache=uni.getStorageSync("userInfo")
				/* 验证是否已经登录 */
				if(cache.avatar==null){
					/* 未登录时 */
					uni.showToast({
						title:"请先登录！",
						icon:"error",
						duration:2000
					})
				}else{
					/* 选择跳转的功能 */
					switch(mod){
						case "浏览记录":{
							uni.navigateTo({
								url:"../../pages/my/view-history/view-history"
							})
							break
						}
						case "投递新闻":{
							uni.navigateTo({
								url:"../../pages/my/send-news/send-news"
							})
							break
						}
						default:{
							console.log("点击了功能："+mod)
							break
						}
					}
				}
				
			}
			
		}
	}
</script>

<style lang="scss">
.frame{
	margin-top: 30rpx;
	width: 95%;
	margin: auto;
}
.module{
	width: 100%;
	display: flex;
	justify-content: space-between;
	flex-wrap: wrap;
	.box{
		width: 30%;
		height: 180rpx;
		margin-top: 50rpx;
		border: 5rpx solid rgba($color: #c5c5c5, $alpha: 0.5);
		text-align: center;
		line-height: 180rpx;
		border-radius: 15rpx;
	}
}
</style>
