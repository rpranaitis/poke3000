<script setup>
import SpinnerView from './views/partials/SpinnerView';
import HeaderView from './views/partials/header/HeaderView';
import { usePokeStore } from 'stores/poke';

const pokeStore = usePokeStore();
</script>
<template>
	<SpinnerView v-if="pokeStore.spinner"/>
	<HeaderView/>
	<div class="container py-5 d-flex flex-column align-items-center">
		<RouterView/>
	</div>
</template>
