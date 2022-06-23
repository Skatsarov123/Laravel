import './bootstrap';
import './../css/main.css'
import Swal from "sweetalert2";
import 'sweetalert2/dist/sweetalert2.css'
import { createApp } from "vue";
import router from "./router";
import App from "./components/App.vue"


window.Swal = Swal;
const toast = Swal.mixin({
    toast:true,
    position:'top-end',
    showConfirmButton:false,
    timer:3000,
    timeProgressBar:true,
});
window.toast = toast;

axios.defaults.withCredentials = true;
axios.defaults.headers.post['Content-Type'] ='application/json';
axios.defaults.headers.post['Accept'] ='application/json';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;

createApp(App).use(router).mount("#app")
