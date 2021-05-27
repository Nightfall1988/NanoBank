require('./bootstrap');
import Vue from 'vue'
Vue.component('two-factor-auth', require('./components/TwoFactorAuth.vue').default)
Vue.component('create-account', require('./components/CreateAccount.vue').default)
Vue.component('account-info', require('./components/AccountInformation.vue').default)
Vue.component('account-balance', require('./components/Account.vue').default)
Vue.component('sell-stock-button', require('./components/SellStockButton.vue').default)

window.app = new Vue({
    el: '#app',
})
