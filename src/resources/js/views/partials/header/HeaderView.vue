<script setup>
import Popper from 'vue3-popper';
import { notify } from '@kyvg/vue3-notification';

function test() {
	notify({
		title: 'Vue 3 notification 🎉',
	});
}
</script>
<template>
	<header class="bg-primary text-white p-4 d-flex justify-content-between align-items-center b-shadow">
		<div class="title">
			<p class="m-0">BAKSNOTOJAS 3000</p>
		</div>
		<div class="menu d-flex gap-5">
			<Popper arrow>
				<button class="button-icon poke-list-icon fa-solid fa-hand-point-right fs-4"></button>
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
						<li @click="test" class="text-end mt-3">VISI POKE <i class="fa-solid fa-chevron-right"></i></li>
					</ul>
				</template>
			</Popper>
			<i class="fa-solid fa-circle-user fs-4"></i>
			<i class="fa-solid fa-right-from-bracket fs-4"></i>
		</div>
	</header>
</template>