<template>
	<view class="frame">
		<!-- 用于更改文本资料 -->
		<view class="change">
			<text>{{changeType}}:\n</text>
			<input type="text" :value="showText" @blur="getText" :maxlength="maxlength"/>
			<view class="tips">注意：不可输入表情符号或者特殊字符</view>
		</view>
		
		<view class="save" @click="saveChange()">
			保存更改
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				changeType:"",
				strongData:[],
				showText:null,
				maxlength:15,
			};
		},
		onLoad(e) {
			this.changeType=e.changeType;
			this.strongData=uni.getStorageSync("userInfo")
			switch(this.changeType){
				case "昵称":{
					this.showText=this.strongData.name
					break
				}
				case "邮箱":{
					this.showText=this.strongData.mail
					this.maxlength=80
					break
				}
			}
		},
		methods:{
			getText(e){
				/* 获得输入的内容 */
				this.showText=e.detail.value
				//将emoji表情替换为空字符
				this.showText=this.showText.replace(/\uD83C[\uDF00-\uDFFF]|\uD83D[\uDC00-\uDE4F]/g, "")
				//存回数组
				switch(this.changeType){
					case "昵称":
						this.strongData.name=this.showText
						break
					case "邮箱":
						this.strongData.mail=this.showText
						break
				}
			},
			saveChange(){
				/* 将修改的数据存入本地缓存 */
				var that = this
				uni.setStorage({
					key:"userInfo",
					data:that.strongData,
					success() {
						/* 保存成功时 */
						uni.showToast({
							title:"保存成功！",
							icon:"success",
							duration:1500
						})
						uni.navigateBack()  //返回上一页
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
.change{
	position: relative;
	top: 50rpx;
	input{
		margin-top: 50rpx;
		border-bottom: 1rpx solid rgba($color: #808080, $alpha: 0.4);
	}
	.tips{
		font-weight: bold;
		margin-top: 35rpx;
		color: #808080;
		font-size: 20rpx;
	}
}
.save{
	position: relative;
	top: 150rpx;
	width: 35%;
	height: 60rpx;
	margin: auto;
	border-radius: 20rpx;
	background-color: $uni-color-success;
	color: #FFFFFF;
	text-align: center;
	line-height: 55rpx;
}
</style>
