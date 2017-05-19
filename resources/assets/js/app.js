require('./bootstrap');

window.Vue = require('vue');

Vue.component('BuildBtn', require('./components/BuildBtn.vue'));

const app = new Vue({
    el: '#app'
});
