<template>
	<!-- 搜索框 -->
	<view class="search-input-box dis-flex">
		<view class="search-input dis-flex flex-y-center"   :style="{background:background,borderRadius:radius}">
			<icon type="search" class="icon iconfont2 icon-searchfor col-9"></icon>

			<input :disabled="disabled" v-model="keyword"  :placeholder="placeholder"
				:placeholderStyle="placeStyle" type="text" confirm-type="搜索" @confirm="search(keyword)"/>
				
			<!-- <button @click="search(keyword)" :disabled="disabled">搜索</button> -->
			<slot name="right"></slot>
		</view>
	</view>
</template>

<script>
	export default {
		name: 'search',
		props: {
			/* // 是否禁止输入
			disabled: {
				type: Boolean,
				default: true
			}, */
			// 输入框值
			value: {
				type: [Number, String],
				default: ''
			},
			/* // 搜索栏Placeholder
			placeholder: {
				type: String,
				default: '离线状态'
			}, */
			// 搜索栏Placeholder样式
			placeStyle: {
				type: String,
				default: 'color:#999;font-size:24rpx;'
			},
			// 输入框背景颜色
			background: {
				type: String,
				default: ''
			},
			// 搜索栏圆角
			radius: {
				type: [Number, String],
			},
			
		},
		watch: {
			value: {
				immediate: true,
				handler(newVal) {
					this.keyword = newVal
				}
			},
		},
		data() {
			return {
				keyword: '',
				disabled: true,
				placeholder:"离线状态"
			};
		},
		mounted() {
			/* 测试连接 */
			this.networkTest()
		},
		methods: {
			//测试后端连接
			networkTest(){
				var that=this /* 将data中的数据继承 */
				uni.request({
					url:getApp().globalData.dataURL+"/api/test.php",
					success(data) {
						that.disabled=false,
						that.placeholder="搜索新闻"
						console.log("后端连接成功！")
					},
					timeout:3000,
					dataType:"text",
					fail() {
						that.disabled=true,
						that.placeholder="离线状态"
						console.log("后端连接失败！")
					}
				})
				/* console.log("组件被创建！") */
			},
			/* 搜索 */
			search(input){
				var that=this
				
				if(input!=""){
					uni.navigateTo({
						url:"../../pages/search-result/search-result?inp="+input
					})
				}else{
					/* 没有输入内容时提示 */
					uni.showToast({
						title:"没有输入搜索内容！",
						icon:"none",
						duration:3000
					})
				}
				
			},
			
			
		},
	}
</script>

<style lang="scss">
	/* 搜索框 */
	$searchbar-height: 60rpx;
	.dis-flex{
		display: flex;
	}
	.flex-y-center{
		align-items: center;
	}
	.col-9{color: #999;}
	.search-input-box {
		height: $searchbar-height;
		overflow: hidden;
		margin-bottom: 25rpx;
	}
	.search-input {
		width: 100%;
		background: #F5F5F5;
		border-radius: 30rpx;
		padding: 0 26rpx;
		text-align: left;
		box-sizing: border-box;
		overflow: hidden;
		.icon{
			margin-right: 24rpx;
		}
		button{
			height: 85%;
			top: 2%;
			line-height: 45rpx;
			font-size: 24rpx;
		}
	}
	.search-input input {
		flex: 1;
		font-size: 24rpx;
		height: $searchbar-height;
		line-height: $searchbar-height;
	}
</style>
