import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import Toast from "vue-toastification";
import VueFileAgent from 'vue-file-agent';
import 'vue-file-agent/dist/vue-file-agent.css';
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import vresponse from './assets/js/validation_response/index'
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

Vue.use(DatePicker)
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueFileAgent)
Vue.mixin(vresponse)
import './assets/css/style.css'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import "vue-toastification/dist/index.css";
import 'bootstrap-icons/font/bootstrap-icons.css'

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.use(Toast, {
    position: "bottom-right",
    timeout: 3000,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    showCloseButtonOnHover: false,
    hideProgressBar: true,
    closeButton: false,
    icon: true,
    rtl: false,
    maxToasts: 4,
    transition: "Vue-Toastification__fade",
    newestOnTop: true
});

Vue.config.productionTip = false

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')