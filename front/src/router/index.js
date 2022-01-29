import Vue from 'vue'
import VueRouter from 'vue-router';
import Jwt from '../api/jwt'

Vue.use(VueRouter)

function guardMyroute(to, from, next) {
  let isAuthenticated = false

  if (Jwt.getToken()) {
    isAuthenticated = true
  } else {
    isAuthenticated = false
  }
  if (isAuthenticated) {
    next() // allow to enter route
  } else {
    next('/login') // go to '/login'
  }
}

const routes = [
  {
    path: '/',
    redirect: '/login',
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('@/modules/auth/_components/Login.vue'),
    meta: {
      layout: 'blank',
    },
  },
  {
    path: '/register',
    name: 'register',
    component: () => import('@/modules/auth/_components/Register.vue'),
    meta: {
      layout: 'blank',
    },
  },
  {
    path: '/inicio',
    name: 'inicio',
    beforeEnter: guardMyroute,
    component: () => import('@/layouts/Dashboard.vue'),
  },
  {
    path: '/usuario',
    name: 'usuario.index',
    beforeEnter: guardMyroute,
    component: () => import('@/modules/user/_components/Inicio.vue'),
  },
  {
    path: '/usuario/editar/:id',
    name: 'usuario.editar',
    beforeEnter: guardMyroute,
    component: () => import('@/modules/user/_components/Form.vue'),
  },
  {
    path: '/usuario/visualizar/:id',
    name: 'usuario.visualizar',
    beforeEnter: guardMyroute,
    component: () => import('@/modules/user/_components/Form.vue'),
  },
  {
    path: '/usuario/adicionar/',
    name: 'usuario.adicionar',
    beforeEnter: guardMyroute,
    component: () => import('@/modules/user/_components/Form.vue'),
  },
  {
    path: '/error-404',
    name: 'error-404',
    component: () => import('@/views/Error.vue'),
    meta: {
      layout: 'blank',
    },
  },
  {
    path: '*',
    redirect: 'error-404',
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
})

export default router
