<template>
    <div id="copy">
        <table id="tab">
            <tr align="left">
                <th><input type="checkbox" v-model="select" @click="selectAll">全选</th>
                <th>序号</th>
                <th>ID</th>
                <th>商品名称</th>
                <th>单价</th>
                <th>数量</th>
                <th>金额</th>
                <th>操作</th>
            </tr>

            <tr v-for="(book,index) in books" :key="index" :style="bgcol(index)">
                <td><input type="checkbox" :value="index" v-model="select"></td>
                <td>{{index}}</td>
                <td>{{book.isbm}}</td>
                <td>{{book.name}}</td>
                <td>{{book.price}}</td>
                <td>
                    <button @click="book.buyNum--" :disabled="book.buyNum===0">-</button>
                    {{book.buyNum}}
                    <button @click="book.buyNum++">+</button>
                </td>
                <td>{{pay(index)}}</td>
                <td><button @click="books.splice(index,1);">删除</button></td>
            </tr>

            <tr>
                <td colspan="5"></td>
                <td>总数：{{buySum}}</td>
                <td><button @click="delSelect(select)">删除所选项</button></td>
            </tr>
        </table>
    </div>
</template>

<script>
function getIsbm(){return parseInt(Math.random()*100000+1000)} //获得随机的id

export default {
    data(){
        return{
            books:[
                    {isbm:getIsbm(),name:"360 WiFi6 路由器V6G",price:269,buyNum:0,payNum:0},
                    {isbm:getIsbm(),name:"360 TF存储卡 64GB  V30  TF64",price:69,buyNum:0,payNum:0},
                    {isbm:getIsbm(),name:"Android从入门到放弃",price:73,buyNum:0,payNum:0},
                    {isbm:getIsbm(),name:"360 PlayBuds Pro 真无线耳机",price:279,buyNum:0,payNum:0},
                    {isbm:getIsbm(),name:"360 泡沫洗手液 3瓶装",price:19.9,buyNum:0,payNum:0},
                ],
                select:[],
                touchNum:0, //用于计算点击次数
                danStyle:"backgroundColor:#cacaca91;", //行为单数时背景色
                shuangStyle:"backgroundColor:#ff999991;",  //行为双数时背景色
        }
    },
    computed:{
        pay(){
            //使用js闭包的方式进行计算
            return function(index){
                this.books[index].payNum=this.books[index].price*this.books[index].buyNum
                return this.books[index].payNum
            }
        },
        //自动选择背景色
        bgcol(){
            return function(index){
                if(index%2!=0){
                    return this.danStyle
                }
                else{return this.shuangStyle}
            }
        },
        //计算购买总数
        buySum(){
            var sum=0;
            for(var i=0;i<this.books.length;i++){
                sum+=this.books[i].buyNum
            }
            return sum;
        }
    },
    methods:{
        //全选
        selectAll(){
            this.touchNum++; //用于判断是否已经是全选状态
            if(this.touchNum%2!=0){
                for(var i=0;i<this.books.length;i++){
                    this.select.push(i);
                }
            }
            else{this.select=[];}
        },
        //删除选中项
        delSelect(select){
            if(confirm("确定删除吗？")){
                for(var i=0;i<select.length;i++){
                    this.books.splice(select[i],1);
                }
                this.select=[];
            }
        }
    },
    watch:{
    }
}
</script>

<style scoped>
#copy{
    width: 1000px;
    height: 300px;
    margin: auto;
}
#tab{
    width: 100%;
}
</style>