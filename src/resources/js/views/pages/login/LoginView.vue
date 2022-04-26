<script setup>
import { usePokeStore } from 'stores/poke';
import { reactive } from 'vue';

const pokeStore = usePokeStore();

const inputs = reactive({
	username: null,
	password: null
});
</script>
<template>
	<div class="bg-white d-flex flex-column align-items-center p-5 col-12 col-lg-8 col-xl-5">
		<h4>PRISIJUNGIMAS</h4>
		<div class="mt-5 mb-3 w-100">
			<input v-model="inputs.username" type="text" class="form-control" placeholder="Prisijungimo vardas">
		</div>
		<div class="mb-5 w-100">
			<input v-model="inputs.password" type="password" class="form-control" placeholder="Slaptažodis">
		</div>
		<div class="w-100 d-flex gap-3">
			<button @click="pokeStore.login(inputs)" class="btn btn-success w-50">Prisijungti</button>
			<RouterLink class="btn btn-primary w-50 d-flex justify-content-between" :to="{ name: 'register' }"><span class="d-flex justify-content-center w-100">Registruotis</span><i class="fa-solid fa-chevron-right mt-1"></i></RouterLink>
		</div>
	</div>
</template>