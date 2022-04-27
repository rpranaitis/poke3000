<script setup>
import { usePokeStore } from 'stores/poke';
import { reactive, ref } from 'vue';

const pokeStore = usePokeStore();
const users = reactive([]);
const name = ref(null);

function getUsers() {
	if (name.value) {
		return users.filter(x => x.first_name.startsWith(name.value));
	}

	return users;
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
		<div class="input-group my-4">
			<span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
			<input v-model="name" type="text" class="form-control bl-none" placeholder="Ieškoti pagal vardą">
		</div>
		<div class="table-responsive">
			<table class="table users-table text-center fs-m">
				<thead>
				<tr>
					<th scope="col">Vardas</th>
					<th scope="col">Pavardė</th>
					<th scope="col">El. paštas</th>
					<th scope="col">Poke skaičius</th>
					<th scope="col"></th>
				</tr>
				</thead>
				<tbody>
				<tr v-for="user in getUsers()" :key="user">
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
		</div>
	</div>
</template>