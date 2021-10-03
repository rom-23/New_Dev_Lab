import './styles/app.scss';
import './bootstrap.js';
import Vue from 'vue';
import App from './App.vue';
import vuetify from './plugins/vuetify';
import router from './router/router';
import store from './store';
import vSelect from 'vue-select';
import { BootstrapVue } from 'bootstrap-vue';
import './plugins/select2';
import './plugins/tom-select';

Vue.config.productionTip = false;
Vue.component('v-select', vSelect);
Vue.use(BootstrapVue);

new Vue({
    router,
    vuetify,
    store,
    render: h => {
        return h(App);
    }
}).$mount('#app');
