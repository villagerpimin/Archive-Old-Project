<template>
	<view class="news-column">
		<view class="lan" v-for="(item,index) in col_inf" @click="postNewsId(item.nid)">
			<view class="left" :style="index===0?'margin-top:0':'margin-top:20rpx'">
				<view class="tit" v-if="item.title!=null">
					{{item.title}}
				</view>
				
				<view class="date" v-if="item.author!=null">
					{{item.author}}&nbsp;&nbsp;&nbsp;{{item.date}}
					<image src="../../static/images/news_column/watch.svg" 
						style="width: 24rpx;height: 24rpx;margin-left: 25rpx;margin-right: 8rpx;"/>
					{{item.watched}}
				</view>
			</view>
			<view class="right" :style="index===0?'margin-top:0':'margin-top:20rpx'" 
					v-if="item.cover!=null">
				<image :src="item.cover"></image>
			</view>
		</view>
		<!-- 加载更多时的提示 -->
		<uni-load-more iconType="auto" v-show="loadMore" :status="status"></uni-load-more>
	</view>
</template>

<script>
	export default {
		name:"news-column",
		data() {
			return {
				col_inf:[],
				status:"more"
			};
		},
		props:{
			tag:{
				type:String,
				default:"最新"
			},
			network:{
				type:Boolean,
				default:true
			},
			pageNum:{
				type:Number,
				default:1
			},
			loadMore:{
				type:Boolean,
				default:false
			},
			search:{
				type:String,
				default:""
			},
			refresh:{
				type:String,
				default:"0"
			}
		},
		mounted() {
			this.getNewsContent()
		},
		watch:{
			/* 监听点击的标签变化并调用方法重新获取栏目 */
			tag(){
				this.getNewsContent()
			},
			pageNum(){
				/* 页数发生变化时 */
				if(this.pageNum!=1){
					this.addNewsContent()
				}
			},
			/* 下拉刷新 */
			refresh(){
				this.getNewsContent()
			}
		},
		methods:{
			getNewsContent(){
				/* 后端连接成功时获取数据 */
				var that=this
				this.col_inf=null
				uni.request({
					url:getApp().globalData.dataURL+"/api/getNewsColumn.php",
					method:"GET",
					dataType:"json",
					data:{
						tag:that.tag,
						pageNum:that.pageNum,
						search:that.search
					},
					success(res) {
						/* 获取数据成功后的操作 */
						setTimeout(function(){
							that.col_inf=res.data
						},200)
						
						
						console.log(res.data)
					},
					fail() {
						/* 获取失败后的操作 */
						that.col_inf=[
							{
								cover:"/static/images/news_column/error.jpg",
								title:"后台请求失败，当前为离线状态",
								author:"admin",
								nid:0,
								date:"20xx-xx-xx"
							}
						]
					}
				})
				
				console.log("传递的新闻标签："+this.tag)
			},
			postNewsId(nid){
				/* 将新闻id传递到阅读页 */
				uni.navigateTo({
					url:"../../pages/readnews/readnews?nid="+nid
				})
			},
			async addNewsContent(){
				var that=this
				/* 加载更多新闻 */
				this.status="loading"  //将状态切换为加载中状态
				console.log("nowPage："+this.pageNum)
				
				uni.request({
					url:getApp().globalData.dataURL+"/api/getNewsColumn.php",
					data:{
						tag:that.tag,
						pageNum:that.pageNum,
						search:that.search
					},
					dataType:"json",
					success(res) {
						setTimeout(function(){
							if(res.data.status){
								/* 没有更多数据了 */
								that.status="nomore"
							}
							else{
								//将新增的数据追加到尾部
								for(var i=0;i<res.data.length;i++){
									that.col_inf.push({
										cover:res.data[i].cover,
										title:res.data[i].title,
										author:res.data[i].author,
										nid:res.data[i].nid,
										date:res.data[i].date,
										watched:res.data[i].watched
									})
								}
							}
						},500)
						//console.log(that.col_inf)
					},
					fail(e) {
						console.log(e)
					}
				})
			}
			
		},
		
		
	}
</script>

<style lang="scss">
.news-column{
	width: 100%;
	margin-top: 30rpx;
	margin-bottom: 30rpx;
}
.lan{
	width: 100%;
	height: 220rpx;
	border-bottom: 1rpx solid rgba($color: #959595, $alpha: 0.4);
	z-index: 600;
	.left{
		width: 55%;
		height: 180rpx;
		margin-right: 5%;
		font-size: 32rpx;
		float: left;
		.tit{
			width: 100%;
			height: 130rpx;
		}
		.date{
			font-size: 24rpx;
		}
	}
	.right{
		/* margin-top: 10rpx; */
		width: 40%;
		height: 180rpx;
		float: left;
		image{
			width: 100%;
			height: 100%;
			border-radius: 10rpx;
		}
	}
}
</style>
