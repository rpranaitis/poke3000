import { usePokeStore } from 'stores/poke';

const pokeStore = usePokeStore();
const axios = require('axios');

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let errorTimeout = null;

axios.interceptors.request.use((config) => {
	pokeStore.spinner = true;
	pokeStore.error_message = null;

	clearTimeout(errorTimeout);

	return config;
});

axios.interceptors.response.use((response) => {
	pokeStore.spinner = false;

	return response;
}, (error) => {
	pokeStore.spinner = false;

	let response = error.response;

	if (response?.status === 422) {
		pokeStore.error_message = response.data.message.split(' (and')[0];

		errorTimeout = setTimeout(() => {
			pokeStore.error_message = null;
		}, 7000);

		return;
	}

	return Promise.reject(error);
});