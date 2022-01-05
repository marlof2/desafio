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
    path: '/inicio',
    name: 'inicio',
    beforeEnter: guardMyroute,
    component: () => import('@/layouts/Dashboard.vue'),
  },
  {
    path: '/usuario',
    name: 'usuario.index',
    beforeEnter: guardMyroute,
    component: () => import('@/modules/usuario/_components/Inicio.vue'),
  },
  {
    path: '/usuario/editar/:id',
    name: 'usuario.editar',
    beforeEnter: guardMyroute,
    component: () => import('@/modules/usuario/_components/Form.vue'),
  },
  {
    path: '/usuario/visualizar/:id',
    name: 'usuario.visualizar',
    beforeEnter: guardMyroute,
    component: () => import('@/modules/usuario/_components/Inicio.vue'),
  },
  {
    path: '/usuario/adicionar/',
    name: 'usuario.adicionar',
    beforeEnter: guardMyroute,
    component: () => import('@/modules/usuario/_components/Form.vue'),
  },
  {
    path: '/setor',
    name: 'setor.index',
    beforeEnter: guardMyroute,
    component: () => import('@/modules/setor/_components/Inicio.vue'),
  },
  {
    path: '/setor/adicionar',
    name: 'setor.adicionar',
    beforeEnter: guardMyroute,
    component: () => import('@/modules/setor/_components/Form.vue'),
  },
  {
    path: '/setor/editar/:id',
    name: 'setor.editar',
    beforeEnter: guardMyroute,
    component: () => import('@/modules/setor/_components/Form.vue'),
  },
  {
    path: '/setor/visualizar/:id',
    name: 'setor.visualizar',
    beforeEnter: guardMyroute,
    component: () => import('@/modules/setor/_components/Form.vue'),
  },


  {
    path: '/typography',
    name: 'typography',
    component: () => import('@/views/typography/Typography.vue'),
  },
  {
    path: '/icons',
    name: 'icons',
    component: () => import('@/views/icons/Icons.vue'),
  },
  {
    path: '/cards',
    name: 'cards',
    component: () => import('@/views/cards/Card.vue'),
  },
  {
    path: '/simple-table',
    name: 'simple-table',
    component: () => import('@/views/simple-table/SimpleTable.vue'),
  },
  {
    path: '/form-layouts',
    name: 'form-layouts',
    component: () => import('@/views/form-layouts/FormLayouts.vue'),
  },
  {
    path: '/pages/account-settings',
    name: 'pages-account-settings',
    component: () => import('@/views/pages/account-settings/AccountSettings.vue'),
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
    path: '/pages/register',
    name: 'pages-register',
    component: () => import('@/views/pages/Register.vue'),
    meta: {
      layout: 'blank',
    },
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
