<script setup>
import Popper from 'vue3-popper';
import { usePokeStore } from 'stores/poke';

const pokeStore = usePokeStore();
</script>
<template>
	<header class="bg-primary text-white p-4 d-flex flex-column flex-sm-row justify-content-between align-items-center b-shadow">
		<div class="title mb-3 mb-sm-0">
			<RouterLink class="text-white text-decoration-none" :to="{ name: 'main' }">BAKSNOTOJAS 3000</RouterLink>
		</div>
		<div v-if="pokeStore.auth" class="menu d-flex gap-5">
			<Popper arrow :hover="true">
				<button class="button-icon default-cursor fa-solid fa-hand-point-right fs-4"></button>
				<template #content>
					<ul class="fs-m dots-none p-0 m-0">
						<li>Poke nuo <span class="fw-bold">Petras Petraitis</span></li>
						<hr class="my-2">
						<li>Poke nuo <span class="fw-bold">Petras Petraitis</span></li>
						<hr class="my-2">
						<li>Poke nuo <span class="fw-bold">Petras Petraitis</span></li>
						<hr class="my-2">
						<li>Poke nuo <span class="fw-bold">Petras Petraitis</span></li>
						<hr class="my-2">
						<li>Poke nuo <span class="fw-bold">Petras Petraitis</span></li>
						<hr class="my-2">
						<li>Poke nuo <span class="fw-bold">Petras Petraitis</span></li>
						<hr class="my-2">
						<li>Poke nuo <span class="fw-bold">Petras Petraitis</span></li>
						<hr class="my-2">
						<div class="d-flex justify-content-end">
							<RouterLink class="router-link text-decoration-none mt-3" :to="{ name: 'history' }">VISI POKE <i class="fa-solid fa-chevron-right"></i></RouterLink>
						</div>
					</ul>
				</template>
			</Popper>
			<RouterLink class="button-icon" :to="{ name: 'edit_profile' }"><i class="fa-solid fa-circle-user fs-4"></i></RouterLink>
			<button @click="pokeStore.logout" class="button-icon fa-solid fa-right-from-bracket fs-4"></button>
		</div>
	</header>
</template>