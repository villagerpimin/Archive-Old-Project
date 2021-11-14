<template>
	<view class="frame">
		<view class="tips">
			<text>确认内容无误后，点击右下提交按钮等待审核即可\n</text>
		</view>
		<!-- 标题 -->
		<uni-group title="标题:" class="news_title">
			<textarea placeholder="新闻标题" v-model="title"></textarea>
		</uni-group>
		
		<!-- 分类标签 -->
		<uni-group title="分类:" class="tag">
			<picker mode="selector" :range="tags" @change="saveSelect">
				<view>{{selectTag}}</view>
			</picker>
		</uni-group>
		
		<!-- 头图 -->
		<uni-group title="新闻头图">
			<view class="uni-file-picker__header">
				<text class="file-title">最多上传{{img.limit}}张图片</text>
				<text class="file-count">{{ img.uplength }}/{{img.limit}}</text>
			</view>
			<button v-if="img.btn" type="default" @click="selectPic">选择图片</button>
			<image class="up_preview" v-if="!img.btn" :src="img.temp" mode=""/>
		</uni-group>

		<!-- 正文 -->
		<uni-group title="正文:" class="zheng">
			<textarea placeholder="正文" v-model="content" />
		</uni-group>

		<!-- 提交 -->
		<view class="send" @click="send_news()">
			<button>提交</button>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				tags:[],
				title:"",
				selectTag:"默认",
				content:"",
				fileupload:[],
				img:{
					"limit":1,
					"uplength":0,
					"temp":"",
					"btn":true
				}
			};
		},
		mounted() {
			this.getTags()
		},
		methods:{
			getTags(){
				var that = this
				uni.request({
					url:getApp().globalData.dataURL+"/api/getTags.php",
					success(res) {
						that.tags=res.data.splice(2)  //将最新和热门过滤
						that.tags.unshift("默认")  //在开头添加默认分类
						//console.log(that.tags)
					}
				})
			},
			saveSelect(e){
				this.selectTag=this.tags[e.target.value]
			},
			selectPic(){
				var that = this
				uni.chooseImage({
					success(res) {
						that.img.btn=false  //将上传按钮删除
						that.img.uplength++ //已上传图片数量
						that.img.temp=res.tempFilePaths[0]  //用于预览的图片
						//console.log(res)
					}
				})
			},
			send_news(){
				/* 提交新闻到审核区 */
				var that = this
				var userInfo = uni.getStorageSync("userInfo")
				uni.showModal({
					title:"提示",
					content:"确定提交吗？",
					cancelText:"手滑了",
					success(res) {
						if(res.confirm){
							/* confirm==true代表用户点击了确定 */
							var host = getApp().globalData.dataURL
							uni.uploadFile({
								url:host+"/api/uploadNews.php",
								filePath:that.img.temp,
								name:"img",
								header:{
									"Content-Type": "multipart/form-data"
								},
								formData:{
									/* 额外的数据 */
									"title":that.title,
									"tag":that.selectTag,
									"content":that.content,
									"author":userInfo.name,
									"uid":userInfo.uid
								},
								success:(res)=>{
									uni.showLoading({
										mask:true,
										title:"请稍后···"
									})
									setTimeout(()=>{
										uni.hideLoading()
										var tit=""
										if(res.data){
											tit="上传成功~"
										}else{
											tit="上传失败！"
										}
										uni.showToast({
											title:tit,
											icon:"success",
											duration:1500
										})
									},1500)
									console.log("后端返回的数据：",res)
								},
								fail(err) {
									console.log("出现错误",err)
									if(err.errMsg=="uploadFile:fail createUploadTask:fail file not found"){
										uni.showModal({
											title:"失败",
											content:"提交失败，请上传新闻头图！",
											showCancel:false
										})
									}
								}
							})  /* 上传到服务器 */
						}/* 用户确认的操作 */
					}
				}) /* 请求用户确认 */
			},/* 上传新闻 */
		},/* method */
	}
</script>

<style lang="scss">
.frame{
	width: 92%;
	margin: auto;
	textarea{
		width: 100%;
		border: solid 1rpx rgba($color: #808080, $alpha: 0.5);
		margin-top: 20rpx;
		border-radius: 10rpx;
	}
	uni-group{
		margin-bottom: 50rpx;
	}
}
.tips{
	border-radius: 20rpx;
	width: 100%;
	height: 80rpx;
	margin: auto;
	border: solid 1rpx rgba($color: #808080, $alpha: 0.4);
	line-height: 80rpx;
	text-align: center;
	position: relative;
	top: 20rpx;
	font-size: 26rpx;
}
.news_title{
	position: relative;
	top: 40rpx;
	textarea{
		height: 120rpx;
	}
}
.tag{
	picker{
		height: 80rpx;
		line-height: 80rpx;
	}
	margin-top: 30rpx;
}
.up_preview{
	width: 280rpx;
	height: 220rpx;
}
.send{
	width: 110rpx;
	height: 110rpx;
	text-align: center;
	position: fixed;
	right: 60rpx;
	bottom: 90rpx;
	button{
		width: 100%;
		height: 100%;
		border-radius: 50%;
		background-color: $uni-color-success;
		font-size: 26rpx;
		line-height: 110rpx;
		color: #FFFFFF;
	}
	z-index: 999;
}
.zheng{
	textarea{
		height: 520rpx;
	}
}
.uni-file-picker__header {
		padding-top: 5px;
		padding-bottom: 10px;
		/* #ifndef APP-NVUE */
		display: flex;
		/* #endif */
		justify-content: space-between;
}
</style>
