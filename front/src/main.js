import Vue from 'vue'
import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'
import App from './App.vue'
import '@/plugins/vue-composition-api'
import '@/styles/styles.scss'
import vuetify from './plugins/vuetify'
import router from './router'
import store from './store'
import Api from './api/index'
import { VueMaskDirective } from 'v-mask'
Vue.directive('mask', VueMaskDirective);

Vue.use(VueSweetalert2)
Api.init()

Vue.config.productionTip = false
new Vue({
  router,
  store,
  vuetify,
  render: h => h(App),
}).$mount('#app')
