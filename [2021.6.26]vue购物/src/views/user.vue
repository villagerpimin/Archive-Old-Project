<template>
    <div id="user">
        <!-- 账号密码都是admin -->
        <login v-show="flag"></login>
    </div>
</template>

<script>
import login from "@/components/user/login.vue"

export default {
    name:"我的账号",
    components:{
        login
    },
    data(){
        return{
            flag:true
        }
    }
}
</script>