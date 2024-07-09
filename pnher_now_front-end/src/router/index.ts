import { createRouter, createWebHistory } from 'vue-router'
import axiosInstance from '@/plugins/axios'
import { useAuthStore } from '@/stores/auth-store'
import { createAcl, defineAclRules } from 'vue-simple-acl'

const simpleAcl = createAcl({})
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/user_dashboard',
      name: 'user_dashboard',
      component: () => import('../views/User/DashboardUserView.vue'),
      meta: {
        requiresAuth: true,
        role: 'user'
      }
    },
    {
      path: '/deliverer_dashboard',
      name: 'deliverer_dashboard',
      component: () => import('../views/Deliverer/DelivererDashboardView.vue'),
      meta: {
        requiresAuth: true,
        role: 'deliverer'
      }
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/Admin/Auth/LoginView.vue')
    },
    {
      path: '/home',
      name: 'home',
      component: () => import('../views/Web/User/ProductUser.vue'),
      meta: {
        requiresAuth: true,
        role: 'user'
      }
    },
    {
      path: '/logout',
      name: 'logout',
      component: () => import('../views/Admin/Auth/LoginView.vue')
    },

    {
      path: '/register',
      name: 'register',
      component: () => import('../views/Admin/Auth/RegisterUserView.vue')
    },

    {
      path: '/history',
      name: 'history',
      component: () => import('../views/Web/User/HistoryUser.vue'),
      meta: {
        requiresAuth: true,
        role: 'user'
      }
    },

    {
      path: '/deliverer',
      name: 'deliverer',
      component: () => import('../views/Web/Deliver/DeliverView.vue'),
      meta: {
        requiresAuth: true,
        role:['deliverer','user']
      }
    },
    {
      path: '/feedback',
      name: 'feedback',
      component: () => import('../views/Web/Feedback/FeedbackView.vue'),
      meta: {
        requiresAuth: true,
        role: 'deliverer'
      }
    },
    {
      path: '/history_deliverer',
      name: 'history_deliverer',
      component: () => import('../views/Web/History/HistoryView.vue'),
      meta: {
        requiresAuth: true,
        role: 'deliverer'
      }
    },
    {
      path: '/process',
      name: 'process',
      component: () => import('../views/Web/ProcessDeliver/ProcessDeliverView.vue'),
      meta: {
        requiresAuth: true,
        role: 'deliverer'
      }
    },
    {
      path: '/request',
      name: 'request',
      component: () => import('../views/Web/Request/RequestView.vue'),
      meta: {
        requiresAuth: true,
        role: 'deliverer'
      }
    },
    {
      path: '/average',
      name: 'average',
      component: () => import('../views/Web/Average/AverageView.vue'),
      meta: {
        requiresAuth: true,
        role: 'deliverer'
      }
    },
    {
      path: '/deliver',
      name: 'deliver',
      component: () => import('../views/Web/Deliver/DeliverView.vue'),
      meta: {
        requiresAuth: true,
        role: 'deliverer'
      }
    },
  ],
})

router.beforeEach(async (to, from, next) => {
  const publicPages = ['/login', '/register']
  const authRequired = !publicPages.includes(to.path)
  const store = useAuthStore()

  try {
    const { data } = await axiosInstance.get('/me')
    
    store.isAuthenticated = true
    store.user = data.data
    
    store.permissions = data.data.permissions.map((item: any) => item.name)
    store.roles = data.data.roles.map((item: any) => item.name)
    
    const rules = () =>
      defineAclRules((setRule) => {
        store.permissions.forEach((permission: string) => {
          setRule(permission, () => true)
        })
      })
      
    simpleAcl.rules = rules()

    if (to.path === '/login' && store.isAuthenticated) {
      if (store.roles.includes('user')) {
        return next('/user_dashboard')
      }
      if (store.roles.includes('deliverer')) {
        return next('/deliverer_dashboard')
      }
    }
  } catch (error) {
    store.isAuthenticated = false
    store.user = null
    store.permissions = []
    store.roles = []
  }
    
  if (authRequired && !store.isAuthenticated) {
    return next('/login')
  }

  if (to.meta.role && !store.roles.some(role => to.meta.role.includes(role))) {
    return next('/login')
  }

  next()
})

export default { router, simpleAcl }
