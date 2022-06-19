import {createRouter, createWebHistory} from 'vue-router'


import login from '../components/User/login'
import register from '../components/User/register'
import employeeIndex from '../components/employees/index'
import notFound from '../components/notFound'
import employeeNew from '../components/employees/new'
import employeeEdit from '../components/employees/edit'

const routes = [

    {
        path: '/',
        component: login
    },
    {
        path: '/register',
        component: register
    },
    {
        path: '/dashboard',
        component: employeeIndex
    },
    {
        path: '/employee/new',
        component: employeeNew
    },
    {
        path: '/employee/edit/:id',
        component:employeeEdit,
        props:true

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
