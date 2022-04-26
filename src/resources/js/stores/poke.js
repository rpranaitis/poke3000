import { defineStore } from 'pinia';
import axios from 'axios';
import qs from 'qs';
import router from '../router';

export const usePokeStore = defineStore('poke', {
	state: () => ({
		spinner: false,
		auth: null,
		userInfo: null
	}),

	getters: {
	},

	actions: {
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
						this.auth = response.data;
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
						this.auth = null;
						router.push({ name: 'login' });
					}
				}
			});
		},
		editProfile(inputs) {
			axios.post(`/users/edit/${this.auth.user_id}`, qs.stringify(inputs)).then(response => {
				if (response) {
					response = response.data;

					if (response.success) {
						this.userInfo = response.data;
						router.push({ name: 'main' });
					}
				}
			});
		},
		loadUserInfo() {
			return axios.get(`/users/show/${this.auth.user_id}`).then(response => {
				if (response) {
					response = response.data;

					if (response.success) {
						this.userInfo = response.data;
					}
				}
			});
		}
	}
});