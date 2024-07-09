import { createRouter, createWebHistory } from 'vue-router'
import axiosInstance from '@/plugins/axios'
import { useAuthStore } from '@/stores/auth-store'
import { createAcl, defineAclRules } from 'vue-simple-acl'

const simpleAcl = createAcl({})
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/dashboard',
      name: 'dashboard',
      component: () => import('../views/Admin/DashboardView.vue'),
      meta: {
        requiresAuth: true,
        role: ['user', 'deliverer'],
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
        role: ['user', 'admin']
      }
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
// >>>>>>> 2f9a8494ca5795ab5b7908b8f9e38a36c1773720
    }
// <<<<<<< HEAD
// >>>>>>> d443dd952d8fa459df9a4882ce9bbaaa3b6be6d3
// =======
// >>>>>>> 7579aed6997ad97de4a98af2b4c3572b00efe5b3
  ]
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
