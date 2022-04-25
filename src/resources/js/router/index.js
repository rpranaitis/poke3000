import { createRouter, createWebHistory } from 'vue-router';
import LoginView from '../views/pages/login/LoginView';
import RegisterView from '../views/pages/register/RegisterView';
import UsersView from '../views/pages/users/UsersView';
import HistoryView from '../views/pages/history/HistoryView';
import EditProfileView from '../views/pages/profile/edit/EditProfileView';

const router = createRouter({
	history: createWebHistory('/'),
	routes: [
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
			component: UsersView
		},
		{
			path: '/istorija',
			name: 'history',
			component: HistoryView
		},
		{
			path: '/profilis/redaguoti',
			name: 'edit_profile',
			component: EditProfileView
		}
	]
});

export default router;
