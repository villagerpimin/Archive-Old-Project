<template>
	<view class="frame">
		<!-- 头像昵称&登录 -->
		<my-avatar></my-avatar>
		
		<text>\n\n\n&nbsp;&nbsp;&nbsp;&nbsp;用户功能:</text>
		
		<!-- 用户功能模块 -->
		<my-module></my-module>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				
			}
		},
		methods: {
			
		}/* ,
		onShow() {
			this.strongData=uni.getStorageSync("userInfo")
		},
		onLoad() {
			this.strongData=uni.getStorageSync("userInfo")
		} */
	}
</script>

<style>
	.frame{
		width: 95%;
		margin: auto;
		position: relative;
		top: 15rpx;
	}
</style>
