import { createRouter, createWebHashHistory } from 'vue-router'
import Home from '../views/Home.vue'

const routes = [
  {
    path: '/',
    name: '首页',
    component: Home
  },
  {
    path: '/about',
    name: '关于',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
  {
    path:'/lx',
    name:"商品分类",
    component:()=>import('../views/lx.vue')
  },
  {
    path:"/shopCar",
    name:"购物车",
    component:()=>import('../views/shopCar.vue')
  },
  {
    path:"/user",
    name:"我的账号",
    component:()=>import('../views/user.vue')
  },
  {
    path:"/shop",
    name:"商品详情",
    component:()=>import('../views/product.vue')
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
