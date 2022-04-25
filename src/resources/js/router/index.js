import { createRouter, createWebHistory } from 'vue-router';
import LoginView from '../views/pages/login/LoginView';
import RegisterView from '../views/pages/register/RegisterView';
import UsersView from '../views/pages/users/UsersView';
import HistoryView from '../views/pages/history/HistoryView';

const router = createRouter({
	history: createWebHistory('/'),
	routes: [
		{
			path: '/prisijungimas',
			name: 'login',
			component: LoginView
		},
		{
			path: '/registracija',
			name: 'register',
			component: RegisterView
		},
		{
			path: '/vartotojai',
			name: 'users',
			component: UsersView
		},
		{
			path: '/istorija',
			name: 'history',
			component: HistoryView
		}
	]
});

export default router;
