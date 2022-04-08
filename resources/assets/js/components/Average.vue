<template>
	<div class="card">
		<div class="card-header">
			<div class="card-title h3">Загрузка ЦПУ</div>
		</div>

		<div class="card-body">
			<label>1 минута</label>
			<div class="bar my-2">
				<div
					class="bar-item bg-error"
					role="progressbar"
					:style="{ width: percent[0] + '%'}"
				>{{ percent[0] + '%' }}</div>
			</div>
			<label>5 минут</label>
			<div class="bar my-2">
				<div
					class="bar-item bg-warning"
					role="progressbar"
					:style="{ width: percent[1] + '%'}"
				>{{ percent[1] + '%' }}</div>
			</div>
			<label>15 минут</label>
			<div class="bar my-2">
				<div
					class="bar-item bg-success"
					role="progressbar"
					:style="{ width: percent[2] + '%'}"
				>{{ percent[2] + '%' }}</div>
			</div>
		</div>
		<!--<table class="table table-striped table-hover my-1">
			<tbody>
				<tr class="active">
					<td>Система</td>
					<td>{{ model }}</td>
				</tr>
				<tr class="active">
					<td>Ядро</td>
					<td>{{ frequency }}</td>
				</tr>
				<tr class="active">
					<td>Время работы</td>
					<td>{{ cache }}</td>
				</tr>
				<tr class="active">
					<td>Время работы</td>
					<td>{{ temperature }}</td>
				</tr>
			</tbody>
		</table>-->
	</div>
</template>

<script>
	export default {
		data() {
			return {
				percent: [ 0, 0, 0 ]
			}
		},
		beforeMount() {
			this.update();
		},
		methods: {
			update() {
				fetch(
					'/api/load',
					{
						headers: {
							'Content-Type': 'application/json;charset=utf-8'
						}
					}
				)
				.then(response => response.json())
				.then(result => {
					this.value = result.value;
					this.percent = result.percent;

					setTimeout(this.update, 1000);
				});
			}
		}
	}
</script>
