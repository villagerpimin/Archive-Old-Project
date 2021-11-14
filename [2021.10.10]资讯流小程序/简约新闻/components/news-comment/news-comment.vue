<template>
	<view class="comment">
		<view class="comment-body">
			<view class="lm">
				<image src="../../static/images/news/comment.svg"></image>
				评论区
			</view>
			
			<!-- 评论的编辑区 -->
			<view class="comm-eidt">
				<form @submit="postComment()">
					<textarea :placeholder="login.placeholder"
						:disabled="login.disable" confirm-type="done" @blur="saveText"></textarea>
					<button form-type="submit" :disabled="login.disable">发布</button>
				</form>
			</view>
			
			<!-- 相关新闻的评论 -->
			<view class="comm" v-for="(item,index) in comments">
				<!-- 用户头像 -->
				<image class="cava" :src="item.avatar"></image>
				<text>{{item.name}}</text>
				<!-- 评论正文 -->
				<view class="comm-box">
					<view class="comm-left">
						{{item.content}}
					</view>
					<view class="comm-right">
						<text>{{item.date}}\n</text>
						{{item.good}}
						<image src="../../static/images/news/good.svg" @click="clickFinger(index,'good')"></image>
						<image src="../../static/images/news/bad.svg" @click="item.good>0?clickFinger(index,'bad'):''"></image>
					</view>
				</view>
			</view>
			
		</view>
	</view>
</template>

<script>
	export default {
		name:"news-comment",
		data() {
			return {
				comments:[],
				login:{
					disable:true,
					placeholder:"请先登录",
					val:null,
					nickName:null,
					openid:null
				}
			};
		},
		props:["nid"],
		mounted() {
			this.getComment(this.nid)
			this.checkIsLogin()
		},
		methods:{
			checkIsLogin(){
				/* 判断是否已经登录 */
				var userInfo = uni.getStorageSync("userInfo")
				if(userInfo!=""){
					this.login.disable=false
					this.login.placeholder="理智看待，文明交流"
					this.login.nickName=userInfo.name
					this.login.openid=userInfo.openid
				}
				console.log(this.login)
			},
			saveText(e){
				this.login.val=e.detail.value
			},
			postComment(){
				var that = this
				uni.request({
					url:getApp().globalData.dataURL+"/api/postComment.php",
					data:{
						val:that.login.val,
						openid:that.login.openid,
						newsid:that.nid
					},
					method:"POST",
					header:{
						'content-type':'application/x-www-form-urlencoded'
					},
					success(res) {
						//console.log(res.data)
						if(res.data==1){
							uni.showToast({
								title:"发表成功！",
								icon:"success",
								duration:1000
							})
							that.getComment(that.nid)  //成功后重新获取一次评论
						}
					}
				})
			},
			getComment(nid){
				/* 获取新闻评论 */
				var that = this
				uni.request({
					url:getApp().globalData.dataURL+"/api/getComments.php",
					data:{
						nid:that.nid
					},
					success(res) {
						that.comments=res.data
						console.log(res.data)
					}
				})
			},
			clickFinger(index,type){
				/* 点击了赞/踩按钮时 */
				var that=this
				uni.request({
					url:getApp().globalData.dataURL+"/api/updateCommentVote.php",
					data:{
						"pid":that.comments[index].pid,
						"type":type
					},
					method:"POST",
					header:{
						'content-type':'application/x-www-form-urlencoded'
					},
					success(res) {
						if(type=="good"){
							that.comments[index].good++
						}else{
							if(that.comments[index].good>=0){
								that.comments[index].good--
							}
						}
						//console.log(res.data)
					}
				})
			}
		}
	}
</script>

<style lang="scss">
.comment{
	width: 93%;
	margin: auto;
	.comment-body{
		width: 100%;
		margin-top: 50rpx;
		margin-bottom: 50rpx;
	}
}
.comm-eidt{
	width: 100%;
	height: 260rpx;
	margin-bottom: 55rpx;
	textarea{
		width: 100%;
		height: 200rpx;
		border: 1px solid rgba($color: #7e7e7e, $alpha: 0.1);
		border-radius: 10rpx;
	}
	button{
		margin-top: 10rpx;
	}
}
.lm{
	width: 100%;
	height: 100rpx;
	line-height: 50rpx;
	image{
		width: 50rpx;
		height: 50rpx;
		position: relative;
		left: 0;
		top: 15rpx;
		margin-right: 20rpx;
	}
}
.comm{
	width: 100%;
	margin-bottom: 20rpx;
	.cava{
		width: 70rpx;
		height: 70rpx;
		border-radius: 50%;
		position: relative;
		top: 30rpx;
		margin-right: 20rpx;
	}
	line-height: 75rpx;
	height: 250rpx;
	border-bottom: 1rpx solid rgba($color: #8e8e8e, $alpha: 0.3);
}
.comm-box{
	width: 100%;
	height: 120rpx;
	.comm-left{
		width: 70%;
		float: left;
	}
	.comm-right{
		float: left;
		width: 30%;
		image{
			width: 35rpx;
			height: 35rpx;
			margin-left: 35rpx;
		}
	}
}
</style>
