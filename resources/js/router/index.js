import {createRouter, createWebHistory} from 'vue-router'


import login from '../components/User/login.vue'
import register from '../components/User/register.vue'
import employeeIndex from '../components/employees/index.vue'
import notFound from '../components/notFound.vue'
import employeeNew from '../components/employees/new.vue'
import employeeEdit from '../components/employees/edit.vue'
import dashboard from '../components/dashboard.vue';


const routes = [
    {
        path: '/login',
        component: login,
        name: 'Login'
    },

    {
        path: '/register',
        component: register
    },


    {
        path: '/',
        component: employeeIndex,
        name:dashboard,

    },
    {
        path: '/employee/new',
        component: employeeNew,
        name:employeeNew,

    },
    {
        path: '/employee/edit/:id',
        component:employeeEdit,
        props:true,

    },
    {
        path: "/logout",
        name: "logout",
        component: {

        }
    },
    {
        path: '/:pathMatch(.*)*',
        component: notFound
    }
]

const router =createRouter({
    history:createWebHistory(process.env.BASE_URL),
    routes,
})

export default router
