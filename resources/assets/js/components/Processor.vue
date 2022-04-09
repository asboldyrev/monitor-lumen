<template>
	<div class="card">
		<div class="card-header">
			<div class="card-title h3">Процессор</div>
		</div>
		<table class="table table-striped table-hover">
			<tbody>
				<tr>
					<td>Модель</td>
					<td>{{ model }}</td>
				</tr>
				<tr>
					<td>Частота</td>
					<td>{{ frequency }}</td>
				</tr>
				<tr>
					<td>Размер кеша</td>
					<td>{{ cache }}</td>
				</tr>
				<tr v-if="temperature">
					<td>Температура</td>
					<td>{{ temperature }}</td>
				</tr>
			</tbody>
		</table>
		<div class="card-body">
			<div class="bar my-2">
				<div
					class="bar-item"
					role="progressbar"
					:class="classBarUtilization()"
					:style="{ width: utilization + '%'}"
				><span v-if="roundUtilization > 10">{{ roundUtilization }} %</span></div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				model: 'N.A.',
				frequency: 'N.A.',
				cache: 'N.A.',
				temperature: 'N.A.',
				utilization: 0,
			}
		},
		computed: {
			roundUtilization() {
				return Math.round(this.utilization);
			}
		},
		methods: {
			update() {
				fetch(
					'/api/processor',
					{
						headers: {
							'Content-Type': 'application/json;charset=utf-8'
						}
					}
				)
				.then(response => response.json())
				.then(result => {
					this.model = result.model;
					this.frequency = result.frequency;
					this.cache = result.cache;
					this.temperature = result.temperature ? result.temperature : 0;

					if(result.temperature) {
						setTimeout(this.update, 10000);
					}
				});


			},
			updateUtilization() {
				fetch(
					'/api/utilization',
					{
						headers: {
							'Content-Type': 'application/json;charset=utf-8'
						}
					}
				)
				.then(response => response.json())
				.then(result => {
					this.utilization = result.utilization;

					setTimeout(this.updateUtilization, 1000);
				});
			},
			classBarUtilization() {
				if(this.roundUtilization < 50) {
					return 'bg-success';
				}

				if(this.roundUtilization < 75) {
					return 'bg-warning';
				}

				return 'bg-error';
			}
		},
		beforeMount() {
			this.update();
			this.updateUtilization();
		},
	}
</script>
