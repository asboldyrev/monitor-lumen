const Vue = require('vue')

import System from './components/System.vue'
import Processor from './components/Processor.vue'
import Average from './components/Average.vue'

const app = Vue.createApp({
	components: {
		appSystem: System,
		appProcessor: Processor,
		appAverage: Average,
	}
}).mount('#app');
