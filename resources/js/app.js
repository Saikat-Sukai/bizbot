import './bootstrap';
// import './bootstrap-components'; // Include the Vue components bootstrap file


import { createApp } from 'vue';
import { loadComponents } from './bootstrap-components';

import App from './App.vue';
const app = createApp(App);

// Load and register components
const components = loadComponents();
for (const [name, component] of Object.entries(components)) {
    app.component(name, component);
}

app.mount('#app_root');



// import {createApp} from 'vue';
// const app = createApp(App);
// app.mount('#app_root');

// const vue = createApp(App)
// vue.mount("#app_root")
