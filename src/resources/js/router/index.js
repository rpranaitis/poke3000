import { createRouter, createWebHistory } from 'vue-router';
import { usePokeStore } from 'stores/poke';
import LoginView from '../views/pages/login/LoginView';
import RegisterView from '../views/pages/register/RegisterView';
import UsersView from '../views/pages/users/UsersView';
import HistoryView from '../views/pages/history/HistoryView';
import EditProfileView from '../views/pages/profile/edit/EditProfileView';

const router = createRouter({
	history: createWebHistory('/'),
	routes: [
		{
			path: '/',
			name: 'main',
			component: UsersView,
			meta: { requiresAuth: true }
		},
		{
			path: '/prisijungti',
			name: 'login',
			component: LoginView
		},
		{
			path: '/registruotis',
			name: 'register',
			component: RegisterView
		},
		{
			path: '/vartotojai',
			name: 'users',
			component: UsersView,
			meta: { requiresAuth: true }
		},
		{
			path: '/istorija',
			name: 'history',
			component: HistoryView,
			meta: { requiresAuth: true }
		},
		{
			path: '/profilis/redaguoti',
			name: 'edit_profile',
			component: EditProfileView,
			meta: { requiresAuth: true }
		}
	]
});

router.beforeEach((to) => {
	const pokeStore = usePokeStore();

	if (to.meta.requiresAuth && !pokeStore.auth) {
		return {
			path: '/prisijungti'
		};
	}
});

export default router;
