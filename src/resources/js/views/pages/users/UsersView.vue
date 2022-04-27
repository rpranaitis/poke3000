<script setup>
import { usePokeStore } from 'stores/poke';
import { reactive, ref } from 'vue';

const pokeStore = usePokeStore();
const users = reactive([]);
const name = ref(null);

const pagination = reactive({
	page: 1,
	per_page: 10
});

function getUsers() {
	let result = {
		users
	};

	if (name.value) {
		result.users = result.users.filter(x => x.first_name.startsWith(name.value));
	}

	result.count = result.users.length;

	const from = pagination.page > 1 ? ((pagination.page - 1) * pagination.per_page) : 0;
	const to = pagination.page > 1 ? ((pagination.page - 1) * pagination.per_page) + pagination.per_page : pagination.per_page;

	result.users = result.users.slice(from, to);

	return result;
}

function clearFilter() {
	name.value = null;
}

function sendPoke(id) {
	pokeStore.poke(id).then(response => {
		if (response) {
			response = response.data;

			if (response.success) {
				users.find(x => x.id === id).poke_count++;
			}
		}
	});
}

pokeStore.loadUsers().then(response => {
	if (response) {
		response = response.data;

		if (response.success) {
			Object.assign(users, response.data);
		}
	}
});
</script>
<template>
	<div class="bg-white d-flex flex-column py-5 px-3 p-sm-5 col-12 col-xl-10 b-shadow">
		<h4 class="text-center">VARTOTOJAI</h4>
		<span @click="clearFilter" class="m-0 fs-m text-decoration-underline text-center cursor-pointer">Išvalyti filtrą</span>
		<div class="input-group my-4">
			<span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
			<input v-model="name" type="text" class="form-control bl-none" placeholder="Ieškoti pagal vardą">
		</div>
		<div class="table-responsive">
			<table class="table users-table text-center fs-m">
				<thead>
				<tr>
					<th scope="col" style="width: 230px;">Vardas</th>
					<th scope="col" style="width: 230px;">Pavardė</th>
					<th scope="col" style="width: 265px;">El. paštas</th>
					<th scope="col" style="width: 120px;">Poke skaičius</th>
					<th scope="col" style="width: 250px;"></th>
				</tr>
				</thead>
				<tbody>
				<tr v-for="user in getUsers().users" :key="user">
					<td>{{ user.first_name }}</td>
					<td>{{ user.last_name }}</td>
					<td>{{ user.email }}</td>
					<td>{{ user.poke_count }}</td>
					<td>
						<button @click="sendPoke(user.id)" class="btn btn-primary btn-poke d-flex justify-content-between w-100"><span
							class="d-flex justify-content-center w-100">Poke</span><i
							class="fa-solid fa-chevron-right mt-1"></i></button>
					</td>
				</tr>
				</tbody>
			</table>
			<div class="d-sm-flex justify-content-center text-center fs-m mt-4">
				<PaginationVue v-model="pagination.page" :records="getUsers().count" :per-page="pagination.per_page" @paginate="getUsers" :options="{ texts: { count: 'Rodoma nuo {from} iki {to} iš {count} vartotojų|Rasta vartotojų: {count}|Rasta vartotojų: 1' } }"/>
			</div>
		</div>
	</div>
</template>