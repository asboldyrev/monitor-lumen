<template>
	<div class="card" v-if="containers.length">
		<div class="card-header">
			<div class="card-title h3">Docker</div>
		</div>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Контайнер</th>
					<th>Статус</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(container, index) in containers" :key="index">
					<td>
						<span class="badge" :class="{ 'badge-error': container.state != 'running' }">
							{{ container.name }}
						</span>
					</td>
					<td>{{ container.status }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				containers: [],
			}
		},
		methods: {
			update() {
				fetch(
					'/api/docker',
					{
						headers: {
							'Content-Type': 'application/json;charset=utf-8'
						}
					}
				)
				.then(response => response.json())
				.then(result => {
					result
						.sort((curr) => {
							return curr.state == 'running' ? -1 : 1
						})
						.forEach((item) => {
						this.containers.push(item);
					});

					setTimeout(this.update, 300000);
				});
			}
		},
		beforeMount() {
			this.update();
		},
	}
</script>

<style scoped>
	.badge-error:after {
		background: #e85600;
	}
</style>
