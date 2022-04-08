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
				<tr>
					<td>Температура</td>
					<td>{{ temperature }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				model: 'N.A.',
				frequency: 'N.A.',
				cache: 'N.A.',
				temperature: 'N.A.'
			}
		},
		beforeMount() {
			this.update();
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
					this.temperature = result.temperature ? result.temperature : 'N.A.';

					if(result.temperature) {
						setTimeout(this.update, 10000);
					}
				});
			}
		}
	}
</script>
