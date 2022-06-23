<script setup>

import {ref} from "vue"
import {useRouter} from "vue-router"
import Dashboard from "../dashboard";

let form = ref({

    name: '',
    email: '',
    address: '',
    phone: '',
    department: '',
    position: '',
    salary: ''
})

const router = useRouter();
const saveEmployee = () => {

    const formData = new FormData();
    formData.append('name', form.value.name)
    formData.append('email', form.value.email)
    formData.append('address', form.value.address)
    formData.append('phone', form.value.phone)
    formData.append('department', form.value.department)
    formData.append('position', form.value.position)
    formData.append('salary', form.value.salary)

    axios.post("/api/add_employee", formData)
        .then((response) => {
            form.value.name = '',
                form.value.email = '',
                form.value.address = '',
                form.value.phone = '',
                form.value.department = '',
                form.value.position = '',
                form.value.salary = '',

                router.push('/dashboard')

            toast.fire({
                icon: "success",
                title: "Employee add successfully"
            })
        })
        .catch((error) => {
            toast.fire({
                icon: "warning",
                title:`${error}`
            })
        })
}

</script>
<template>
    <dashboard />
    <div class="flex justify-center items-center w-full mt-32 ">
        <div class="w-1/2 bg-white rounded shadow-2xl p-8 m-4">
            <h1 class="block w-full text-center text-gray-800 text-2xl font-bold mb-6">Add Employee</h1>
            <form>
                <div class="flex flex-col mb-4">
                    <label class="mb-2 font-bold text-lg text-gray-900" >Name</label>
                    <input class="border py-2 px-3 text-grey-800" type="text"  v-model="form.name">
                </div>
                <div class="flex flex-col mb-4">
                    <label class="mb-2 font-bold text-lg text-gray-900" >Email</label>
                    <input class="border py-2 px-3 text-grey-800" type="email"  v-model="form.email">
                </div>
                <div class="flex flex-col mb-4">
                    <label class="mb-2 font-bold text-lg text-gray-900" >Address</label>
                    <textarea class="border py-2 px-3 text-grey-800" type="text"  v-model="form.address"></textarea>
                </div>
                <div class="flex flex-col mb-4">
                    <label class="mb-2 font-bold text-lg text-gray-900" >phone</label>
                    <input class="border py-2 px-3 text-grey-800" type="text"  v-model="form.phone">
                </div>
                <div class="flex flex-col mb-4">
                    <label class="mb-2 font-bold text-lg text-gray-900" >Department</label>
                    <input class="border py-2 px-3 text-grey-800" type="text" v-model="form.department">
                </div>
                <div class="flex flex-col mb-4">
                    <label class="mb-2 font-bold text-lg text-gray-900" >Position</label>
                    <input class="border py-2 px-3 text-grey-800" type="text" v-model="form.position">
                </div>
                <div class="flex flex-col mb-4">
                    <label class="mb-2 font-bold text-lg text-gray-900" >Salary</label>
                    <input class="border py-2 px-3 text-grey-800" type="text"  v-model="form.salary">
                </div>

                <button class="block bg-green-400 hover:bg-green-600 text-white uppercase text-lg mx-auto p-4 rounded"  @click.prevent="saveEmployee()">Save</button>
            </form>
        </div>
    </div>


</template>
