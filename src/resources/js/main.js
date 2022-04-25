import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import router from './router';

import Popper from 'vue3-popper';

const app = createApp(App).use(createPinia()).use(router);

app.component('popper-component', Popper);

app.mount('#app');

require('./bootstrap');