<template>
	<view>
		<!-- 这个页面用于展示完整新闻 -->
		<view class="headpic" v-if="newsInf.img==null?false:true">
			<!-- 头图 -->
			<image :src="newsInf.img"></image>
		</view>
		
		<view class="frame">
			<view class="tit">
				<!-- 标题 -->
				<view class="big">{{newsInf.title}}</view>
				<!-- 副标题 -->
				<view class="lit">
					发布日期：{{newsInf.date}} &nbsp;&nbsp;&nbsp;&nbsp; 
					来源：{{newsInf.author}}
				</view>
			</view>
			
			<view class="content" v-for="text in splitContent">
				<!-- 正文 -->
				<text selectable="true">{{text}}\n\n</text>
			</view>
			
		</view>
		
		<!-- 评论区 -->
		<news-comment v-if="hasNetwork" :nid="newsId"></news-comment>
		
	</view>
</template>

<script>
	export default {
		data() {
			return {
				hasNetwork:false,
				newsId:0, /* 新闻id */
				newsInf:{
					img:"/static/images/banner/fly_banner.jpg",
					title:"示例新闻标题",
					content:"当前处于离线状态\ntest",
					author:"admin",
					date:"20xx-xx-xx"
				}, /* 新闻信息 */
				splitContent:[],   /* 将正文拆开 */
			};
		},
		onLoad(e) {
			this.newsId=e.nid
			console.log("获得的新闻id："+this.newsId)
			this.testNetwork()
			this.saveHistory(e.nid)  //存储浏览记录
		},
		methods:{
			testNetwork(){
				var that=this
				uni.request({
					url:"http://localhost:782/uni/api/test.php",
					method:"GET",
					timeout:1500,
					success(res) {
						console.log("阅读页同步成功！")
						that.hasNetwork=true
						/* 连接成功后获取新闻内容 */
						that.getNews(that.newsId)
					},
					fail() {
						console.log("阅读页处于离线！")
					}
				})
			},
			getNews(nid){
				/* 在连接成功的情况下获得新闻内容 */
				var that=this
				console.log(this.hasNetwork)
				if(this.hasNetwork){
					uni.request({
						url:getApp().globalData.dataURL+"/api/getNews.php",
						data:{"nid":nid},
						method:"POST",
						header:{
							'content-type':'application/x-www-form-urlencoded'
						},
						dataType:"json",
						success(res) {
							/* 获得成功后将数据展示 */
							that.newsInf=res.data
							that.splitContent=res.data.content.split("\n")
							/* 过滤空值 */
							that.splitContent=that.splitContent.filter(function(s){
								return s&&s.trim()
							})
							console.log(res.data)
							//console.log(that.splitContent)
						},
						fail() {
							/* 失败后的操作 */
						}
					})
				}
			},
			saveHistory(nid){
				/* 用于记录浏览历史 */
				var history=[]
				//uni.removeStorageSync("viewHistory")
				var cache=uni.getStorageSync("viewHistory")
				for(var i=0;i<cache.length;i++){
					history.push(cache[i])
				}
				/* 将已有的数据放入数组 */
				history.unshift(nid)
				history.splice(15)  //只保留15个数据
				//将元素去重
				history=Array.from(new Set(history))
				console.log(history)
				//将数据存到本地
				uni.setStorage({
					key:"viewHistory",
					data:history
				})
			}
		}
	}
</script>

<style lang="scss">
	.frame{
		width: 95%;
		margin: auto;
		position: relative;
		top: 15rpx;
		bottom: 30rpx;
		border-bottom: 1rpx solid rgba($color: #8e8e8e, $alpha: 0.3);
	}
.headpic{
	width: 100%;
	height: 330rpx;
	/* background-color: #007AFF; */
	margin-bottom: 30rpx;
	image{
		width: 100%;
		height: 100%;
	}
}
.tit{
	width: 100%;
	height: 240rpx;
	position: relative;
	top: 40rpx;
	.big{
		/* 大标题 */
		font-weight: 700;
		font-size: 36rpx;
		text-align: center;
		width: 100%;
		height: 120rpx;
	}
	.lit{
		/* 小标题 */
		width: 90%;
		height: 40rpx;
		color: #898989;
		font-size: 24rpx;
		margin: auto;
	}
}
.content{
	width: 90%;
	text-indent: 45rpx;
	margin: auto;
}
</style>
