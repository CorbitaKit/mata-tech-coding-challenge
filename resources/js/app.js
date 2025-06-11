import { createApp } from 'vue';
import App from './App.vue';
import PrimeVue from 'primevue/config';
import Button from "primevue/button"
import { router } from './router/routes'
import Aura from '@primeuix/themes/aura';
import InputText from 'primevue/inputtext'
import Password from 'primevue/password'
import Card from 'primevue/card';
import Chart from 'primevue/chart';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Toast from 'primevue/toast';
import ToastService from 'primevue/toastservice';
import Select from 'primevue/dropdown'
import DatePicker from 'primevue/calendar'

import 'primeicons/primeicons.css'

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
app.component('Card', Card)
app.component('Chart', Chart)
app.component('Column', Column)
app.component('DataTable', DataTable)
app.component('Dropdown', Select)
app.component('Calendar', DatePicker)
app.mount('#app')
