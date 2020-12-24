require('./bootstrap');

window.Vue = require('vue');

Vue.config.ignoredElements = ['video-js']
require('./components/subscribe-button').default
require('./components/channel-uploads').default

const app = new Vue({
    el: '#app',
});
