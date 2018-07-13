import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './vuex/store'

import Login from './components/TheLogin'
import Dashboard from './components/TheDashboard'
import DashboardHome from './components/Dashboard/DashboardHome'
import DashboardNotebook from './components/Dashboard/DashboardNotebook'

import { AUTH_LOGGED_OUT } from './vuex/mutation-types'

Vue.use(VueRouter)

function requireAuth (to, from, next) {
  store.dispatch('me').then(() => {
    next()
  }).catch(() => {
    next({path: '/login'})
  })
}

const routes = [
  {path: '/', name: 'home', redirect: '/login', beforeEnter: requireAuth},
  {path: '/login', name: 'login', component: Login},
  {
    path: '/dashboard',
    component: Dashboard,
    beforeEnter: requireAuth,
    children: [
      {path: '', name: 'dashboard', component: DashboardHome},
      {path: 'notebook/:notebookId', name: 'notebook', component: DashboardNotebook},
      {path: 'notebook/:notebookId/note/:noteId', name: 'note', component: DashboardNotebook}
    ]
  },
  {
    path: '/logout',
    name: 'logout',
    beforeEnter: function (to, from, next) {
      store.commit(AUTH_LOGGED_OUT)
      next('/login')
    }
  },
  {path: '/*', redirect: '/'}
]

export default new VueRouter({
  routes,
  linkExactActiveClass: 'active',
  saveScrollPosition: true
})