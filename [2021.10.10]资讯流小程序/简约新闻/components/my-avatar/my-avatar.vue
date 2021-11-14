<template>
	<view>
		<!-- 我的-头像 -->
		<view class="tou">
			<image :src="strongData.avatar!=null?strongData.avatar:'../../static/images/my_avatar/my_default.png'"
				@click="login"></image>
			<text class="uname" @click="login">{{strongData.name!=null?strongData.name:"游客"}}</text>
			<view class="tap" @click="exit()">
				<!-- 退出登录 -->
				<image src="../../static/images/my_avatar/exit.svg"></image>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		name: "my-avatar",
		data() {
			return {
				strongData:[]
			};
		},
		/* props:{
			strongData:{
				type:Array,
				default:()=>[]
			}
		}, */
		mounted() {
			this.strongData=uni.getStorageSync("userInfo")
			console.log(this.strongData)
		},
		watch:{
			
		},
		methods: {
			login() {
				/* 登录事件 */
				var that = this
				if (this.strongData.avatar==null) {
					/* 用户未登录时 */
					uni.getUserProfile({
						desc: "weixin",
						success(userRes) {
							//console.log(userRes.userInfo)

							/* 获取用户openid */
							uni.login({
								provider: "weixin",
								success(res) {
									uni.request({
										url: getApp().globalData.dataURL + "/api/login.php",
										method: "POST",
										data: {
											jscode: res.code,
											avatar:userRes.userInfo.avatarUrl,
											gender:userRes.userInfo.gender
										},
										header:{
											'content-type':'application/x-www-form-urlencoded'
										},
										success(obj) {
											if(obj.data.status){
												/* 请求openid成功并保存到数据库时 */
												uni.showToast({
													title:"登录成功！",
													icon:"success",
													duration:1500
												})
												/* 将用户信息保存到本地 */
												uni.setStorage({
													key:"userInfo",
													data:{
														name:obj.data.name,
														avatar:obj.data.avatar,
														gender:obj.data.gender,
														openid:obj.data.openid,
														mail:obj.data.mail,
														uid:obj.data.uid
													}
												})
												/* 设置用户信息 */
												that.strongData=uni.getStorageSync("userInfo")
											}
											else{
												console.log(obj)
												uni.showToast({
													title:"数据异常！",
													icon:"none",
													duration:1500
												})
											}
											console.log(obj)
										}
									})
								}
							})
							
						},
						fail(e) {
							console.log(e)
							uni.showToast({
								title: "用户取消登录",
								icon: "none",
								duration: 1500
							})
						}
					})
				}
				else{
					/* 用户已登录时 */
					uni.redirectTo({
						url:"../../pages/my/user-edit/user-edit"
					})
				}
			},
			exit(){
				/* 退出登录（将本地用户数据清除） */
				var that = this
				if(this.strongData.name!=null){
					uni.showModal({
						title:"退出登录",
						content:"确定退出吗？",
						showCancel:true,
						success(res) {
							/* 用户点击确认时 */
							if(res.confirm){
								uni.removeStorage({
									key:"userInfo",
									success() {
										that.strongData=uni.getStorageSync("userInfo")
										//console.log("登录信息已清除")
									}
								})
							}
						}
					})
				}
				
			}

		},
	}
</script>

<style lang="scss">
	.tou {
		position: relative;
		top: 40rpx;
		width: 98%;
		height: 200rpx;
		margin: auto;
		/* text-align: center; */
		line-height: 150rpx;
		border-bottom: 1rpx solid rgba($color: #808080, $alpha: 0.3);

		image {
			width: 150rpx;
			height: 150rpx;
			border-radius: 50%;
			float: left;
			position: relative;
			left: 3%;
		}
		.uname{
			position: relative;
			left: 10%;
		}
		.tap{
			color: #808080;
			float: right;
			position: relative;
			right: 4%;
			width: 50rpx;
			height: 50rpx;
			top: 50rpx;
			image{
				width: 50rpx;
				height: 50rpx;
			}
		}
	}
</style>
