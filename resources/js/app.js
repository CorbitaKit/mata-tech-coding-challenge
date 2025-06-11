import { createApp } from 'vue';
import App from './App.vue';
import PrimeVue from 'primevue/config';
import Button from "primevue/button"
import { router } from './router/routes'
import Aura from '@primeuix/themes/aura';
import InputText from 'primevue/inputtext'
import Password from 'primevue/password'

import Toast from 'primevue/toast';
import ToastService from 'primevue/toastservice';

const app = createApp(App)
app.use(PrimeVue, {
    theme: {
        preset: Aura,
         options: {
            darkModeSelector: false || 'none',
        }
    }
})
app.use(router)
app.use(ToastService)
app.component('p-input-text', InputText)
app.component('p-password', Password)
app.component('p-button', Button)
app.component('p-toast', Toast)

app.mount('#app')
