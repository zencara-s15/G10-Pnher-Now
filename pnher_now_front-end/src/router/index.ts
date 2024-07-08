import { createRouter, createWebHistory } from 'vue-router'
import axiosInstance from '@/plugins/axios'
import { useAuthStore } from '@/stores/auth-store'
import { createAcl, defineAclRules } from 'vue-simple-acl'

const simpleAcl = createAcl({})
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/admin/dashboard',
      name: 'dashboard',
      component: () => import('../views/Admin/DashboardView.vue'),
      meta: {
        requiresAuth: true,
        role: 'admin'
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
      component: () => import('../views/Web/User/ProductUser.vue')
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
      component: () => import('../views/Web/User/HistoryUser.vue')
    },
    {
      path: '/deliverer',
      name: 'deliverer',
      component: () => import('../views/Web/Deliver/DeliverView.vue')
    },
    {
      path: '/feedback',
      name: 'feedback',
      component: () => import('../views/Web/Feedback/FeedbackView.vue')
    },
    {
      path: '/history_deliverer',
      name: 'history_deliverer',
      component: () => import('../views/Web/History/HistoryView.vue')
    },
    
    {
      path: '/proccess',
      name: 'proccess',
      component: () => import('../views/Web/ProcessDeliver/ProcessDeliverView.vue')
    },
    {
      path: '/request',
      name: 'request',
      component: () => import('../views/Web/Request/RequestView.vue')
    },
    {
      path: '/average',
      name: 'average',
      component: () => import('../views/Web/Average/AverageView.vue')
    },
    {
      path: "/deliver",
      name: "deliver",
      component: () => import('../views/Web/Deliver/DeliverView.vue')
    },
    {
      path: "/history",
      name: "history",
      component: () => import('../views/Web/History/HistoryView.vue')
    },
    {
      path: "/average",
      name: "average",
      component: () => import('../views/Web/Average/AverageView.vue')
    },
    {
      path: "/processdeliver",
      name: "processdeliver",
      component: () => import('../views/Web/ProcessDeliver/ProcessDeliverView.vue')
    },
    {
      path: "/feedback",
      name: "feedback",
      component: () => import('../views/Web/Feedback/FeedbackView.vue')
    },
    {
      path: "/request",
      name: "request",
      component: () => import('../views/Web/Request/RequestView.vue')
    }
  ]
})

router.beforeEach(async (to, from, next) => {
  // const publicPages = ['/login']
  const publicPages = ['/login','/register',]
  const authRequired = !publicPages.includes(to.path)
  const store = useAuthStore()

  try {
    const { data } = await axiosInstance.get('/get_users')

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
  } catch (error) {
    /* empty */
  }

  if (authRequired && !store.isAuthenticated) {
    next('/login')
  } else {
    next()
  }
})

export default { router, simpleAcl }