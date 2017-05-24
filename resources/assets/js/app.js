require('./bootstrap');

window.Vue = require('vue');

Vue.component('BuildBtn', require('./components/BuildBtn.vue'));
Vue.component('ShowLogModal', require('./components/ShowLogModal.vue'));

const app = new Vue({
    el: '#app'
});
