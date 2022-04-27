import { createApp } from 'vue';
import { createPinia } from 'pinia';
import { usePokeStore } from 'stores/poke';
import App from './App.vue';
import router from './router';
import axios from 'axios';

import Pagination from 'v-pagination-3';
import Notifications from '@kyvg/vue3-notification';

function startTheApp(auth = null) {
	const app = createApp(App);
	app.use(createPinia());
	app.use(router);
	app.use(Notifications);

	app.component('PaginationVue', Pagination);

	const pokeStore = usePokeStore();
	pokeStore.auth = auth;

	if (auth) {
		pokeStore.loadUserInfo();
	}

	app.mount('#app');

	require('./bootstrap');
}

axios.get('/users/check-auth', { dontUseSpinner: true }).then((response) => {
	startTheApp(response.data.data);
}).catch(() => {
	startTheApp();
});