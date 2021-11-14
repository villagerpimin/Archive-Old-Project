<template>
	<view class="frame">
		<view class="out" v-for="(item,index) in changeList">
			<view class="outin">
				<view>{{item}}：</view>
				<view>
					<image v-if="index==0" :src="userInfo.avatar" @click="changeAvatar"></image>
					<view v-if="index==1" @click="changeText('昵称')">{{userInfo.name}}     ></view>
					<picker v-if="index==2" :range="sex" :value="userInfo.gender" @change="getSex">
						{{sex[userInfo.gender]}}     >
					</picker>
					<view v-if="index==3" @click="changeText('邮箱')">{{userInfo.mail==null?"未绑定":userInfo.mail}}     ></view>
				</view>
			</view>
			
		</view>
		
		<!-- 保存更改 -->
		<view class="save" v-show="saveFlag">
			<view class="in" @click="saveChange()">保存更改</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				userInfo:[],
				saveFlag:false,
				changeList:["头像","昵称","性别","邮箱"],
				sex:["女","男"],
			};
		},
		mounted() {
			this.userInfo=uni.getStorageSync("userInfo")
			console.log(this.userInfo)
		},
		onShow() {
			this.userInfo=uni.getStorageSync("userInfo")
		},
		watch:{
			userInfo(){
				/* 用户信息发生变化时显示保存按钮 */
				this.saveFlag=true
				//console.log(this.userInfo)
			}
		},
		methods:{
			saveChange(){
				var that = this
				uni.request({
					url:getApp().globalData.dataURL+"/api/updateUserinfo.php",
					method:"POST",
					header:{
						'content-type':'application/x-www-form-urlencoded'
					},
					data:{
						update:JSON.stringify(that.userInfo)  /* 将修改的数据转换为json */
					},
					dataType:"json",
					success(res) {
						console.log(res)
						if(res.data){
							/* 更新成功时 */
							uni.showToast({
								title:"更新成功！",
								icon:"success",
								duration:1500
							})
							uni.setStorage({
								key:"userInfo",
								data:that.userInfo
							})
						}
					},
					fail() {
						uni.showToast({
							title:"更新失败！",
							icon:"error",
							duration:1500
						})
					}
				})
			},
			getSex(e){
				//获取并设置更改的性别
				this.userInfo.gender=e.target.value
			},
			changeAvatar(){
				/* 更换头像 */
				var that = this
				uni.chooseImage({
					success(img) {
						var temp = img.tempFilePaths
						that.userInfo.avatar=temp[0]
						/* 将头像上传到服务器 */
						var host = getApp().globalData.dataURL
						uni.uploadFile({
							url:host+"/api/updateUserHeader.php",
							filePath:temp[0],
							name:"img",
							header:{
								"Content-Type": "multipart/form-data"
							},
							formData:{
								"openid":that.userInfo.openid
							},
							success:(res)=>{
								if(!res.data){
									uni.showToast({
										title:"头像更新失败！",
										icon:"error",
										duration:1500
									})
								}else{
									uni.setStorageSync("userInfo",that.userInfo)
								}
								console.log(res)
							},fail(err) {
								console.log("出现错误",err)
								console.log(host+"/api/updateUserHeader.php")
							}
						})
					}
				})
			},
			changeText(str){
				/* 用于跳转到文本资料修改页 */
				uni.navigateTo({
					url:"changeText?changeType="+str
				})
			}
		}
	}
</script>

<style lang="scss">
	.frame{
		width: 92%;
		margin: auto;
		.out{
			position: relative;
			top: 30rpx;
			width: 100%;
			height: 150rpx;
			margin: auto;
			border-bottom: 1px solid rgba($color: #808080, $alpha: 0.2);
			.outin{
				width: 90%;
				height: 100%;
				margin: auto;
				display: flex;
				justify-content: space-between;
				line-height: 130rpx;
				.name{
					font-size: 18rpx;
				}
			}
			image{
				width: 95rpx;
				height: 95rpx;
				border-radius: 50%;
				border: 1px solid rgba($color: #808080, $alpha: 0.1);
				margin-right: 60rpx;
			}
		}
	}
.save{
	position: fixed;
	bottom: 25rpx;
	width: 100%;
	height: 70rpx;
	text-align: center;
	.in{
		width: 50%;
		height: 100%;
		background-color: $uni-color-success;
		border-radius: 20rpx;
		line-height: 60rpx;
		color: #FFFFFF;
		margin: auto;
	}
}
</style>
