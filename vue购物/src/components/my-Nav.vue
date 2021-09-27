<template>
    <nav id="top">
        <!-- 导航栏 -->
        <ul>
            <li style="background-color:white;font-weight:bold;font-size:20px;">低仿360商城</li>
            <router-link to="/"><li>首页</li></router-link>
            <router-link to="/lx"><li>商品分类</li></router-link>
            <router-link to="/shopCar"><li>购物车</li></router-link>
            <router-link to="/user"><li>我的账号</li></router-link>
            <router-link to="/about"><li>关于</li></router-link>
        </ul>
    </nav>
</template>

<style scoped>
nav{
    width: 100%;
    position: relative;
    top: 0;
    text-align: center;
}
nav ul{
    list-style: none;
    width: 100%;
    height: 50px;
}
nav li{
    width: 10%;
    height: 40px;
    line-height: 40px;
    float: left;
    border-radius: 10px;
    transition: .8s;
    cursor: pointer;
}
nav li:hover{
    background-color: #acacac;
    transition: .8s;
}

nav a {
    text-decoration: none;
    color: #2c3e50;
}

nav a.router-link-exact-active { /* 将活动的链接高亮 */
  color: green;
}
</style>