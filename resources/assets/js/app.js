const Vue = require('vue')

import System from './components/System.vue'

const app = Vue.createApp({
	components: {
		appsystem: System
	}
}).mount('#app');
