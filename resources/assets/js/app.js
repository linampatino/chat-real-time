
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueChatScroll from 'vue-chat-scroll'
import VueKonva from 'vue-konva'

Vue.use(VueChatScroll)
Vue.use(VueKonva)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('message-component', require('./components/MessageComponent.vue'));
Vue.component('chat-component', require('./components/ChatComponent.vue'));
Vue.component('board-component', require('./components/BoardComponent.vue'));

const app = new Vue({
    el: '#app'

});
