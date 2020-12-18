require('./bootstrap');

window.Vue = require('vue');

require('./components/subscribe-button').default

const app = new Vue({
    el: '#app',
});
