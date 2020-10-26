import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import Snackbar from 'vuejs-snackbar';

Vue.config.productionTip = false

require('./assets/scss/app.scss')

Vue.prototype.$http = axios

Vue.component('snackbar', Snackbar);

new Vue({
    router,
    store,
    render: function (h) { return h(App) }
}).$mount('#app')