<script setup>
import Datepicker from 'vue3-datepicker';
import { lt } from 'date-fns/esm/locale';
import { ref } from 'vue';

const dateFrom = ref(null);
const dateTo = ref(null);
</script>
<template>
	<div class="bg-white d-flex flex-column py-5 px-3 p-sm-5 col-12 col-xl-10 b-shadow">
		<h4 class="text-center">POKE ISTORIJA</h4>
		<div class="filters d-flex flex-column flex-md-row my-4 gap-2 gap-md-0">
			<div class="input-group w-md-50">
				<span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
				<input type="text" class="form-control bl-none" placeholder="Ieškoti pagal vardą">
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
				<tr>
					<td>2022-04-25</td>
					<td>Vardenis Pavardenis</td>
					<td><i class="fa-solid fa-chevron-right text-silver fs-5"></i></td>
					<td>Petras Petraitis</td>
					<td></td>
				</tr>
				<tr>
					<td>2022-04-25</td>
					<td>Vardenis Pavardenis</td>
					<td><i class="fa-solid fa-chevron-right text-silver fs-5"></i></td>
					<td>Petras Petraitis</td>
					<td></td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>