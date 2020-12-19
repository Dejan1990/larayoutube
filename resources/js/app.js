require('./bootstrap');

window.Vue = require('vue');

require('./components/subscribe-button').default
require('./components/channel-uploads').default

const app = new Vue({
    el: '#app',
});
