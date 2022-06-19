<script setup>

import '../../../sass/login.scss'
import {useRouter} from "vue-router"

import {ref} from "vue"



let form = ref({

    email: '',
    password: '',
})

const router = useRouter();

const register = () =>{
    router.push ('/api/register')
}


const login = () => {
    const formData = new FormData();
    formData.append('email', form.value.email)
    formData.append('password', form.value.password)

    axios.post('/api/login', formData)
        .then(() => {
            router.push('/dashboard')
        }).catch((error) => {

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
            <div class="button-area">
                <button class="btn btn-primary pull-right" @click="login()" >Login</button>
            </div>
            <div class="button-area">
                <button class="btn btn-primary pull-right" @click="register()" >Don't have account</button>
            </div>
        </form>
    </div>
</template>


