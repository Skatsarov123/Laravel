<script setup>
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'


const router = useRouter()
let employees = ref([])


onMounted(async () => {
   await getEmployees()
})

const newEmployee = () =>{
    router.push ('/employee/new')
}

const getEmployees = async () => {
    let response = await axios.get("/api/all_employees")
    employees.value = response.data.employees

}
const onEdit = (id) => {
    router.push('/employee/edit/'+id)
}

const deleteEmployee = (id) =>{
    Swal.fire({
        title:'Are you Sure?',
        text:"You can't go back",
        icon:"warning",
        showCancelButton:true,
        confirmButtonColor:'#3085d6',
        cancelButtonText:'No!',
        confirmButtonText:'Yes, delete it!',
    })
    .then((result) =>{
        if(result.value){
            axios.get('/api/delete_employee/'+id)
                .then(()=>{
                    Swal.fire(
                        'Delete',
                        'Employee delete successfully',
                        'success'
                    )
                    getEmployees()

                })
                .catch(()=>{
                    Swal.fire("Failed!","There something wrong.","warning")
                })
        }
    })
}

</script>
<template>
    <div class="container">

        <div class="products__list table  my-3">

            <div class="customers__titlebar dflex justify-content-between align-items-center">
                <div class="customers__titlebar--item">
                    <h1 class="my-1">Employees</h1>
                </div>
                <div class="customers__titlebar--item">
                    <button class="btn btn-secondary my-1" @click="newEmployee">
                        Add Employee
                    </button>
                </div>
            </div>

            <div class="table--heading " style="padding-top: 20px;background:#FFF">
                <!-- <p class="table--heading--col1">&#32;</p> -->
                <p class="table--heading--col1">id</p>
                <p class="table--heading--col1">name</p>
                <p class="table--heading--col1">email</p>
                <p class="table--heading--col1">address</p>
                <p class="table--heading--col1">phone</p>
                <p class="table--heading--col1">department</p>
                <p class="table--heading--col1">position</p>
                <p class="table--heading--col1">salary</p>
                <!-- <p class="table--heading--col5">&#32;</p> -->
                <p class="table--heading--col9">actions</p>
            </div>


            <div class="table--items products__list__item" v-for="item in employees" :key="item.id"
                 v-if="employees.length > 0 ">


            <p class="table--items--col1">
                {{ item.id }}
            </p>
            <p class="table--items--col1">
                {{ item.name }}
            </p>
            <p class="table--items--col1">
                {{ item.email }}
            </p>
            <p class="table--items--col1">
                {{ item.address }}
            </p>
            <p class="table--items--col1">
                {{ item.phone }}
            </p>
            <p class="table--items--col1">
                {{ item.department }}
            </p>
            <p class="table--items--col1">
                {{ item.position }}
            </p>
            <p class="table--items--col1">
                {{ item.salary }}
            </p>
            <div>
                <button class="btn-icon btn-icon-success" @click="onEdit(item.id)">
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <button class="btn-icon btn-icon-danger" @click="deleteEmployee(item.id)">
                    <i class="far fa-trash-alt"></i>
                </button>
            </div>
        </div>

        <div class="table--items products__list__item" v-else>
            <p>No Employees add</p>
        </div>
    </div>
    </div>
</template>
