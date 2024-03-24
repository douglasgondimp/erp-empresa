import './style.css'
import 'primeicons/primeicons.css'
import 'primevue/resources/themes/aura-light-teal/theme.css';

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import PrimeVue from 'primevue/config';
import Toast from 'primevue/toast';


const app = createApp(App)

app.use(router)
app.use(store)
app.use(PrimeVue)
app.use(Toast)
app.mount('#app')
