<script setup>
import Popper from 'vue3-popper';
import { usePokeStore } from 'stores/poke';
import { ref } from 'vue';

const pokeStore = usePokeStore();

const pokeHistory = ref(null);

function loadPokeHistory() {
	pokeHistory.value = null;

	pokeStore.loadUserPokeHistory(7).then(response => {
		if (response) {
			response = response.data;

			if (response.success) {
				pokeHistory.value = response.data;
			}
		}
	});
}
</script>
<template>
	<Popper arrow :hover="true">
		<button @mouseenter="loadPokeHistory" class="button-icon default-cursor fa-solid fa-hand-point-right fs-4"></button>
		<template #content>
			<div class="user-pokes-width d-flex flex-column align-items-center">
				<div v-if="pokeHistory">
					<ul class="fs-m dots-none p-0 m-0 w-100">
						<li v-for="poke in pokeHistory" :key="poke">Poke nuo <span class="fw-bold">{{ poke.sender_first_name }} {{ poke.sender_last_name }}</span></li>
					</ul>
					<p v-if="!pokeHistory.length" class="fs-m my-1">Dar negavai nei vieno poke!</p>
					<div class="d-flex justify-content-end">
						<RouterLink class="router-link text-decoration-none mt-3 fs-m" :to="{ name: 'history' }">VISI POKE <i class="fa-solid fa-chevron-right"></i></RouterLink>
					</div>
				</div>
				<i v-else class="fa-solid fa-spinner fa-spin py-5 fs-1"></i>
			</div>
		</template>
	</Popper>
</template>