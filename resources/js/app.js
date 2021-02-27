require('./bootstrap');
import Vue from 'vue';
window.Vue = require('vue');
import VueMaterial from 'vue-material'
Vue.component('signup-form', require('./components/SignupForm.vue').default);
Vue.component('users', require('./components/Users.vue').default);
import { MdButton, MdContent, MdTabs, MdCard, MdField, MdMenu, MdList, MdSnackbar, MdCheckbox, MdRipple, MdIcon, MdSwitch} from 'vue-material/dist/components'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'

Vue.use(VueMaterial)
Vue.use(MdButton)
Vue.use(MdContent)
Vue.use(MdTabs)
Vue.use(MdCard)
Vue.use(MdField)
Vue.use(MdMenu)
Vue.use(MdList)
Vue.use(MdSnackbar)
Vue.use(MdCheckbox)
Vue.use(MdRipple)
Vue.use(MdIcon)
Vue.use(MdSwitch)

const app = new Vue({
    el: '#app'
});
