const Vue = require('vue')

import System from './components/System.vue'
import Processor from './components/Processor.vue'

const app = Vue.createApp({
	components: {
		appSystem: System,
		appProcessor: Processor,
	}
}).mount('#app');
