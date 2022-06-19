<script setup>


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

        })
}

</script>
<template id="login-form">
    <div class="login-wrapper">
        <form class="login-right" @submit.prevent>
            <div class="h2">Login</div>
            <div class="form-group">
                <input type="text" id="email" placeholder="email" v-model="form.email">
                <label for="email">email</label>
            </div>
            <div class="form-group">
                <input type="password" id="Password" placeholder="Password" v-model="form.password">
                <label for="Password">Password</label>
            </div>
            <div class="form-group">
                <input type="password" id="password_confirmation" placeholder="password_confirmation" v-model="form.password_confirmation">
                <label for="password_confirmation">Confirm password</label>
            </div>
            <div class="button-area">
                <button class="btn btn-primary pull-right" @click="login()" >Already have account</button>
            </div>
            <div class="button-area">
                <button class="btn btn-primary pull-right" @click="register()" >Register</button>
            </div>
        </form>
    </div>
</template>
