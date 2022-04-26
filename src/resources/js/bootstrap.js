import { usePokeStore } from 'stores/poke';
import { notify } from '@kyvg/vue3-notification';

const pokeStore = usePokeStore();
const axios = require('axios');

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

axios.interceptors.request.use((config) => {
	if (!config.dontUseSpinner) {
		pokeStore.spinner = true;
	}

	return config;
});

axios.interceptors.response.use((response) => {
	if (!response.config.dontUseSpinner) {
		pokeStore.spinner = false;

		notify({
			title: 'Operacija sėkminga',
			text: response.data.message,
			type: 'bg-success'
		});
	}

	return response;
}, (error) => {
	if (!error.response.config.dontUseSpinner) {
		pokeStore.spinner = false;

		let response = error.response;

		if (response?.status === 422) {
			notify({
				title: 'Klaida',
				text: response.data.message,
				type: 'bg-danger'
			});

			return;
		}
	}

	return Promise.reject(error);
});