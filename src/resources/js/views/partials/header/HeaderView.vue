<script setup>
import { usePokeStore } from 'stores/poke';
import UserPokeHistoryView from './partials/UserPokeHistoryView';

const pokeStore = usePokeStore();
</script>
<template>
	<header class="bg-primary text-white p-4 d-flex flex-column flex-sm-row justify-content-between align-items-center b-shadow">
		<div class="title mb-3 mb-sm-0">
			<RouterLink class="text-white text-decoration-none" :to="{ name: 'main' }">BAKSNOTOJAS 3000</RouterLink>
		</div>
		<div v-if="pokeStore.auth" class="menu d-flex gap-5">
			<UserPokeHistoryView/>
			<RouterLink class="button-icon" :to="{ name: 'edit_profile' }"><i class="fa-solid fa-circle-user fs-4"></i></RouterLink>
			<button @click="pokeStore.logout" class="button-icon fa-solid fa-right-from-bracket fs-4"></button>
		</div>
	</header>
</template>