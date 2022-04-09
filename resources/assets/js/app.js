const Vue = require('vue')

import System from './components/System.vue'
import Processor from './components/Processor.vue'
import Memory from './components/Memory.vue'
import Average from './components/Average.vue'
import Filesystem from './components/Filesystem.vue'

const app = Vue.createApp({
	components: {
		appSystem: System,
		appProcessor: Processor,
		appAverage: Average,
		appMemory: Memory,
		appFilesystem: Filesystem,
	}
}).mount('#app');
