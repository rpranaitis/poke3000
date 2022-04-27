<script setup>
import Datepicker from 'vue3-datepicker';
import { lt } from 'date-fns/esm/locale';
import { reactive, ref } from 'vue';
import { usePokeStore } from 'stores/poke';

const pokeStore = usePokeStore();

const dateFrom = ref(null);
const dateTo = ref(null);
const name = ref(null);
const history = reactive([]);

function getHistory() {
	let result = history;

	if (name.value) {
		result = result.filter(x => x.sender_first_name.startsWith(name.value) || x.recipient_first_name.startsWith(name.value));
	}

	if (dateFrom.value) {
		result = result.filter(x => (new Date(x.date)).getTime() >= (new Date(dateFrom.value.toLocaleDateString())).getTime());
	}

	if (dateTo.value) {
		result = result.filter(x => (new Date(x.date)).getTime() <= (new Date(dateTo.value.toLocaleDateString())).getTime());
	}


	return result;
}

pokeStore.loadHistory().then(response => {
	if (response) {
		response = response.data;

		if (response.success) {
			Object.assign(history, response.data);
		}
	}
});
</script>
<template>
	<div class="bg-white d-flex flex-column py-5 px-3 p-sm-5 col-12 col-xl-10 b-shadow">
		<h4 class="text-center">POKE ISTORIJA</h4>
		<div class="filters d-flex flex-column flex-md-row my-4 gap-2 gap-md-0">
			<div class="input-group w-md-50">
				<span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
				<input v-model="name" type="text" class="form-control bl-none" placeholder="Ieškoti pagal vardą">
			</div>
			<div class="date-wrapper d-flex w-md-50">
				<div class="input-group d-contents">
					<span class="input-group-text bl-md-none"><i class="fa-solid fa-calendar-days"></i></span>
					<Datepicker v-model="dateFrom" class="form-control bl-none bg-white" :locale="lt" placeholder="Data nuo"/>
				</div>
				<div class="input-group d-contents">
					<span class="input-group-text bl-none"><i class="fa-solid fa-calendar-days"></i></span>
					<Datepicker v-model="dateTo" class="form-control bl-none bg-white" :locale="lt" placeholder="Data iki"/>
				</div>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table history-table text-start fs-m">
				<thead>
				<tr>
					<th scope="col" style="width: 200px;">Data</th>
					<th scope="col" style="width: 150px;">Siuntėjas</th>
					<th scope="col" style="width: 70px;"></th>
					<th scope="col" style="width: 150px;">Gavėjas</th>
					<th scope="col" style="width: 300px;"></th>
				</tr>
				</thead>
				<tbody>
				<tr v-for="history in getHistory()" :key="history">
					<td>{{ history.date }}</td>
					<td>{{ history.sender_first_name }} {{ history.sender_last_name }}</td>
					<td><i class="fa-solid fa-chevron-right text-silver fs-5"></i></td>
					<td>{{ history.recipient_first_name }} {{ history.recipient_last_name }}</td>
					<td></td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>