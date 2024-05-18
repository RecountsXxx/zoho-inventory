import { createApp } from 'vue'
import App from './App.vue'
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import { createPinia } from 'pinia';
import axios from 'axios';
const app = createApp(App);

const pinia = createPinia();


axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

app.use(pinia);
app.config.productionTip = false;
app.use(Toast, {
    transition: "Vue-Toastification__bounce",
    maxToasts: 20,
    newestOnTop: true
});
app.mount('#app');