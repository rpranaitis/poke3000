<script setup>
import {usePokeStore} from 'stores/poke';
import SpinnerView from './views/partials/SpinnerView';
import HeaderView from './views/partials/header/HeaderView';
import Notifications from '@kyvg/vue3-notification';

const pokeStore = usePokeStore();
</script>
<template>
	<SpinnerView v-if="pokeStore.spinner"/>
	<HeaderView/>
	<Notifications>
		<template>
			<div class="my-notification">
				xxx
			</div>
		</template>
	</Notifications>
	<div class="container py-5 d-flex flex-column align-items-center">
		<RouterView/>
	</div>
</template>
