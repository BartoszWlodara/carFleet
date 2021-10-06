import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import middleware from './middleware'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
    beforeEnter: middleware.user
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue'),
    beforeEnter: middleware.user
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import(/* webpackChunkName: "loginView" */ '../views/LoginView.vue'),
    beforeEnter: middleware.guest
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
