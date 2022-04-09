<template>
	<div class="card">
		<div class="card-header">
			<div class="card-title h3">Файловая система</div>
		</div>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Диск</th>
					<th>Смонтирован</th>
					<th class="progressbar"></th>
					<th class="text-right">Всего</th>
					<th class="text-right">Использовано</th>
					<th class="text-right">Свободно</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(disk, index) in disks" :key="index">
					<td>{{ disk.filesystem }} <span class="label label-rounded label-primary">{{ disk.type }}</span></td>
					<td>{{ disk.mount }}</td>
					<td class="progressbar">
						<div class="bar my-2">
							<div
								class="bar-item"
								role="progressbar"

								:style="{ width: disk.percent + '%'}"
							>{{ disk.percent > 10 ? (disk.percent + '%') : '' }}</div>
						</div>
					</td>
					<td class="text-right">{{ disk.total }}</td>
					<td class="text-right">{{ disk.used }}</td>
					<td class="text-right">{{ disk.free }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				disks: []
			}
		},
		methods: {
			update() {
				fetch(
					'/api/file-systems',
					{
						headers: {
							'Content-Type': 'application/json;charset=utf-8'
						}
					}
				)
				.then(response => response.json())
				.then(result => {
					result.forEach((item) => {
						this.disks.push(item);
					});

					setTimeout(this.update, 600000);
				});
			}
		},
		beforeMount() {
			this.update();
		},
	}
</script>

<style scoped>
	table {
		display: inline-block;
		overflow-x: auto;
		white-space: nowrap;
	}
	td, th {
		width: 100%;
	}
	.progressbar {
		min-width: 100px;
	}
</style>
