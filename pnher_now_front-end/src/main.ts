import 'bootstrap/dist/css/bootstrap.min.css' // Import Bootstrap CSS
import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import axios from './plugins/axios'
import 'uno.css'
import { configure } from 'vee-validate'
// import { library } from '@fortawesome/fontawesome-free';
// import { FontAwesomeIcon } from '@fortawesome/fontawesome-free';
const app = createApp(App)

configure({
  validateOnInput: true
})

// library.add(...all)

app.use(createPinia())
app.use(router.router)
app.use(ElementPlus)
app.use(router.simpleAcl)

app.config.globalProperties.$axios = axios

app.mount('#app')
