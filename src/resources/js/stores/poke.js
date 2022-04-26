import { defineStore } from 'pinia';
import axios from 'axios';
import qs from 'qs';
import router from '../router';

export const usePokeStore = defineStore('poke', {
	state: () => ({
		spinner: false
	}),

	getters: {
	},

	actions: {
		checkLogin() {
			return axios.get('/users/is-logged-in', { dontUseSpinner: true });
		},
		register(inputs) {
			axios.post('/users/register', qs.stringify(inputs)).then(response => {
				if (response) {
					response = response.data;

					if (response.success) {
						router.push({ name: 'login' });
					}
				}
			});
		},
		login(inputs) {
			axios.post('/users/login', qs.stringify(inputs)).then(response => {
				if (response) {
					response = response.data;

					if (response.success) {
						router.push({ name: 'main' });
					}
				}
			});
		},
		logout() {
			axios.post('/users/logout').then(response => {
				if (response) {
					response = response.data;

					if (response.success) {
						router.push({ name: 'main' });
					}
				}
			});
		}
	}
});