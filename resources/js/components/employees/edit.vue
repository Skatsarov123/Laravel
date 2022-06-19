<script setup>

import {onMounted, ref} from "vue"
import {useRouter} from "vue-router"

let form = ref({

    id: '',
    name: '',
    email: '',
    address: '',
    phone: '',
    department: '',
    position: '',
    salary: ''
})

const router = useRouter();

onMounted(async () => {
    await getSingleEmployee()
})

const props = defineProps({
    id: {
        type: String,
        default: ''
    }
})

const getSingleEmployee = async () => {
    let response = await axios.get(`/api/get_edit_employee/${props.id}`)
    console.log(response.data.employee)
    form.value = response.data.employee
}

const updateEmployee = () => {

    const formData = new FormData();
    formData.append('name', form.value.name)
    formData.append('email', form.value.email)
    formData.append('address', form.value.address)
    formData.append('phone', form.value.phone)
    formData.append('department', form.value.department)
    formData.append('position', form.value.position)
    formData.append('salary', form.value.salary)

    axios.post(`/api/update_employee/${form.value.id}`, formData)
        .then((response) => {
                form.value.name = '',
                form.value.email = '',
                form.value.address = '',
                form.value.phone = '',
                form.value.department = '',
                form.value.position = '',
                form.value.salary = '',

                router.push('/')

            toast.fire({
                icon: "success",
                title: "Employee update successfully"
            })
        })
        .catch((error) => {

        })
}

</script>
<template>
    <div class="container">
        <div class="container">
            <div class="products__create ">
                <div class="products__create__titlebar dflex justify-content-between align-items-center">
                    <div class="products__create__titlebar--item">
                        <h1 class="my-1">Edit Employee</h1>
                    </div>
                </div>

                <div class="products__create__cardWrapper mt-2">
                    <div class="products__create__main">
                        <div class="products__create__main--addInfo card py-2 px-2 bg-white">

                            <p class="mb-1">Name</p>
                            <input type="text" class="input" v-model="form.name">

                            <p class="mb-1">Email</p>
                            <input type="text" class="input" v-model="form.email">

                            <p class="my-1">Address</p>
                            <textarea cols="10" rows="5" class="textarea" v-model="form.address"></textarea>
                        </div>

                    </div>

                    <div class="products__create__sidebar">
                        <!-- Product Organization -->
                        <div class="card py-2 px-2 bg-white">
                            <div class="my-3">
                                <p>Phone</p>
                                <input type="text" class="input" v-model="form.phone">
                            </div>

                            <div class="my-3">
                                <p>Department</p>
                                <input type="text" class="input" v-model="form.department">
                            </div>
                            <div class="my-3">
                                <p>Position</p>
                                <input type="text" class="input" v-model="form.position">
                            </div>

                            <div class="my-3">
                                <p>Salary</p>
                                <input type="text" class="input" v-model="form.salary">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer Bar -->
            <div class="dflex justify-content-between align-items-center my-3">
                <p></p>
                <button class="btn btn-secondary" @click="updateEmployee()">Update</button>
            </div>
        </div>
    </div>
</template>
