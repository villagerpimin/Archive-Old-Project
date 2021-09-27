<template>
    <div id="login">
        <!-- 用户注册登录 -->
        <div class="bg">
            <img src="@/assets/login.png" alt="">
            <div class="loginmain">
                <ul class="tab">
                    <li @click="touch(1)">登录</li>
                    <li @click="touch(2)">注册</li>
                </ul>

                <div v-show="touchnum==1" class="tabcon">
                    账&nbsp;&nbsp;号：<input type="text" v-model="logname" placeholder="admin"><br><br><br>
                    密&nbsp;&nbsp;码：<input type="password" v-model="logpwd" placeholder="admin"><br><br><br>
                    <button @click="login()">登录</button>
                </div>

                <div v-show="touchnum==2" class="tabcon">
                    账&nbsp;&nbsp;号：<input type="text" v-model="regname"><br><br><br>
                    密&nbsp;&nbsp;码：<input type="password" v-model="regpwd"><br><br><br>
                    确认密码：<input type="password" v-model="reregpwd"><br><br><br>
                    <button @click="reg()">注册</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            touchnum:1,
            logname:"",
            logpwd:"",

            regname:"",
            regpwd:"",
            reregpwd:"",
        }
    },
    methods:{
        touch(num){
            this.touchnum=num
        },
        login(){
            if(this.logname=="admin" && this.logpwd=="admin"){
                alert('登录成功')
            }else{
                alert('登录失败')
            }
        },
        reg(){
            if(this.regpwd==this.reregpwd){
                alert('注册成功！')
            }
            else{
                alert('两次密码输入不一致！')
            }
        }
    }
}
</script>

<style scoped>
.bg{
    width: 100%;
    height: 600px;
    background-color: rgb(0, 119, 255);
}
.bg img{
    z-index: -1;
    width: 100%;
    height: 100%;
}
.loginmain{
    z-index: 10;
    width: 400px;
    height: 400px;
    background-color: rgba(255, 255, 255, 0.573);
    border-radius: 10px;
    position: relative;
    left: 750px;
    top: -500px;
}
.loginmain ul{
    list-style: none;
    color: white;
    font-size: 18px;
    text-align: center;
}
.loginmain li{
    float: left;
    width: 70px;
    margin-top: 40px;
    cursor: pointer;
    border-radius: 5px;
}
.loginmain li:hover{
    background-color: #898989;
}
.tabcon{
    clear: both;
    position: relative;
    top: 30px;
    width: 80%;
    height: 260px;
    left: 40px;
}
.tabcon input{
    width: 200px;
    height: 30px;
    border-radius: 5px;
    border: none;
}
.tabcon button{
    float: right;
    margin-right: 80px;
    background: white;
    border: none;
    border-radius: 5px;
    width: 80px;
    height: 50px;
    cursor: pointer;
    font-size: 17px;
}
</style>