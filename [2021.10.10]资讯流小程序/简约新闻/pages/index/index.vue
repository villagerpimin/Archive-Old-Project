<template>
	<view class="frame">
		<!-- 搜索框 -->
		<sui-search />
		
		<!-- 轮播图 -->
		<banner :refresh="refresh"/>
		
		<!-- 新闻标签 -->
		<news-tag @touchTag="touchTag" />
		
		<!-- 新闻栏 -->
		<news-column :tag="nowTag" :pageNum="pageNum" :loadMore="loadMore" :refresh="refresh "/>

	</view>
</template>

<script>
	export default {
		data() {
			return {
				pageNum:1,  //用于滑动到底部加载更多内容
				nowTag:"最新",  //当前新闻tag
				loadMore:false,
				refresh:0
			}
		},
		onLoad(e) {
		},
		onReachBottom() {
			this.pageNum++
			this.loadMore=true
		},
		onPullDownRefresh() {
			/* 下拉刷新 */
			this.refresh++
			this.pageNum=1
			setTimeout(function(){
				uni.stopPullDownRefresh()
			},500)
		},
		methods: {
			/* 用于接收当前页面（0开始） */
			tabChange(index){
				if(index===1){
					/* 我的 */
					uni.navigateTo({
						url:"../my/my",
					})
				}
			},
			touchTag(e){
				/* 用于获取当前tag */
				this.nowTag=e
				console.log("当前tag："+this.nowTag)
				/* 将页数还原 */
				this.pageNum=1
			}
			
			
		},
	}
</script>

<style lang="scss">
	.frame{
		width: 92%;
		margin: auto;
		position: relative;
		top: 15rpx;
	}
</style>
