<script setup>

import {useRouter} from "vue-router"
import {ref} from "vue"
import '../dashboard'
import Dashboard from "../dashboard";
let form = ref({
    email: '',
    password: '',
})
const router = useRouter();



const login = () => {
    const formData = new FormData();
    formData.append('email', form.value.email)
    formData.append('password', form.value.password)
    axios.get('/sanctum/csrf-cookie').then(response => {


    axios.post('/api/login',formData,{
        headers: {
            Accept: "application/json",
            "Access-Control-Allow-Origin": "*",
            "Content-Type": "application/json",

        },
        withCredentials: true,
    });
        router.push('/')
        }).catch((error) => {
        toast.fire({
            icon: "warning",
            title: "Email or password are incorrect"
        })
    })
}
</script>


<template id="login-form">
    <dashboard />
    <!-- component -->
    <!-- This is an example component -->
    <div class='bg-white h-screen w-screen flex justify-center items-center'>
        <div class="px-6 py-3 rounded border w-64">
            <div class="flex flex-col items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <h2 class="text-2xl font-bold">Login</h2>
            </div>
            <form >

                <div class="flex flex-col my-2">
                    <label class="text-xs text-gray-400">Email</label>
                    <div class="text-xs text-red-400 flex justify-between items-center" >
<!--                    <span>-->
<!--                    <b>Error: </b>-->
<!--                    wrong Email !-->
<!--                    </span>-->
<!--                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">-->
<!--                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />-->
<!--                        </svg>-->
                    </div>
                    <input class="border rounded px-3 py-1 mt-2" type="text" id="email" placeholder="email" v-model="form.email"/>
                </div>
                <div class="flex flex-col my-2">
                    <label class="text-xs text-gray-400">Password</label>
                    <input class="border rounded px-3 py-1 mt-2" type="password" id="Password" placeholder="Password" v-model="form.password"/>
                </div>
                <div class="flex flex-col items-center justify-center my-3">
                    <button class="my-3 py-1 w-full rounded bg-blue-600 text-blue-200" @click.prevent="login()">
                        Submit
                    </button>
                    <p class="text-xs text-gray-500">
                        Forgot password ?
                        <a href="#" class="font-bold text-gray-700">Click here</a>
                        to reset your password.
                    </p>
                </div>
            </form>
        </div>
    </div>
</template>
