<template>
	<div class="card">
		<div class="card-header">
			<div class="card-title h3">Система</div>
		</div>
		<table class="table table-striped table-hover">
			<tbody>
				<tr>
					<td>Система</td>
					<td>{{ system }}</td>
				</tr>
				<tr>
					<td>Ядро</td>
					<td>{{ kernel }}</td>
				</tr>
				<tr>
					<td>Время работы</td>
					<td>{{ uptime }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				system: 'N.A.',
				kernel: 'N.A.',
				lastBoot: 'N.A.',
				uptime: 'N.A',
			}
		},
		beforeMount() {
			this.update();
		},
		methods: {
			update() {
				fetch(
					'/api/system',
					{
						//method: 'get',
						headers: {
							'Content-Type': 'application/json;charset=utf-8'
						}
					}
				)
				.then(response => response.json())
				.then(result => {
					this.system = result.system;
					this.kernel = result.kernel;
					this.uptime = result.uptime;

					setTimeout(this.update, 30000);
				});
			}
		}
	}
</script>
