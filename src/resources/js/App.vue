<script setup>
import { usePokeStore } from 'stores/poke';
import SpinnerView from './views/partials/SpinnerView';
import HeaderView from './views/partials/header/HeaderView';

const pokeStore = usePokeStore();
</script>
<template>
	<SpinnerView v-if="pokeStore.spinner"/>
	<HeaderView/>
	<notifications position="bottom right" classes="my-1 p-3 fs-m text-white"/>
	<div class="container py-5 d-flex flex-column align-items-center">
		<RouterView/>
	</div>
</template>
