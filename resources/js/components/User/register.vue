<script setup>

import Dashboard from "../dashboard";
import {useRouter} from "vue-router"

import {ref} from "vue"

const login = () => {

    router.push('/login')
}

let form = ref({

    email: '',
    password: '',
})

const router = useRouter();

const register = () => {

    const formData = new FormData();

    formData.append('email', form.value.email)
    formData.append('password', form.value.password)
    formData.append('password_confirmation', form.value.password_confirmation)


    axios.post("/api/register", formData)
        .then((response) => {
            form.value.name = '',
                form.value.email = '',
                form.value.password = '',
                form.value.password_confirmation = '',


                router.push('/login')

            toast.fire({
                icon: "success",
                title: "Register successfully"
            })
        })
        .catch((error) => {
            toast.fire({
                icon: "warning",
                title:'Something went wrong'
        })
        })
}

</script>
<template id="login-form">
    <dashboard />
    <div class="flex flex-wrap w-full justify-center items-center pt-56">
        <div class="flex flex-wrap max-w-xl">
            <div class="p-2 text-2xl text-gray-800 font-semibold"><h1>Register an account</h1></div>
            <div class="p-2 w-full">
                <label for="email">Your e-mail</label>
                <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Email" type="email" v-model="form.email">

            </div>
            <div class="p-2 w-full">
                <label for="password">Password</label>
                <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Password" type="password" v-model="form.password" name="password">
            </div>
            <div class="p-2 w-full">
                <label for="confirm_password">Confirm Password</label>
                <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Confirm Password" type="password" v-model="form.password_confirmation" name="password_confirmation">
            </div>
            <div class="p-2 w-full mt-4">
                <button @click="register()" type="submit" class="flex text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Register</button>
            </div>
        </div>
    </div>
</template>
