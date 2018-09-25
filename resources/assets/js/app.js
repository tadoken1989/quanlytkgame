import Vue from 'vue'

require('./bootstrap');

import $ from 'jquery';
import App from './App.vue'
import router from './router'

window.jQuery = window.$ = require("jquery");

const app = new Vue({
	el: '#root',
	template: `<app></app>`,
	components: { App },
	router,
    $
})
