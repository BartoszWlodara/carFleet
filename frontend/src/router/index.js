import Vue from 'vue'
import VueRouter from 'vue-router'
import CarListView from '../views/CarListView.vue'
import middleware from './middleware'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'CarListView',
    component: CarListView,
    beforeEnter: middleware.user
  },
  {
    path: '/addCar',
    name: 'AddCar',
    component: () => import(/* webpackChunkName: "addCar" */ '../views/AddCarView.vue'),
    beforeEnter: middleware.user
  },
  {
    path: '/updateCar/:id',
    name: 'UpdateCar',
    component: () => import(/* webpackChunkName: "updateCar" */ '../views/UpdateCarView.vue'),
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
