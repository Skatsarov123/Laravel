<script setup>
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import Dashboard from "../dashboard";

const router = useRouter()
let employees = ref([])


onMounted(async () => {
   await getEmployees()
})

const newEmployee = () =>{
    router.push ('/employee/new')
}

const getEmployees = async () => {

    let response = await axios.get("/api/all_employees",{
        headers: {
            Authorization: 'Bearer ' + localStorage.getItem('Authorization'),
            "Content-type": "application/json"
        }
    })
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
 <dashboard />
    <table class="min-w-full border-collapse block mt-32 md:table">
        <thead class="block md:table-header-group">
        <tr class="border border-grey-500 md:border-none block   md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
            <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Name</th>
            <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Email</th>
            <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Address</th>
            <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Phone</th>
            <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Department</th>
            <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Position</th>
            <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Salary</th>
            <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Actions</th>
        </tr>
        </thead>



        <tbody class="block md:table-row-group">

        <tr class="bg-gray-300 border border-grey-500 md:border-none block md:table-row" v-for="item in employees" :key="item.id"
            v-if="employees.length > 0 ">
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">Name</span> {{ item.name }}</td>
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">User Name</span> {{ item.email }}</td>
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">Email Address</span> {{ item.address }}</td>
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">Phone</span> {{ item.phone }}</td>
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">Department</span> {{ item.department }}</td>
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">Position</span> {{ item.position }}</td>
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">Salary</span> {{ item.salary }}</td>
            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                <span class="inline-block w-1/3 md:hidden font-bold">Actions</span>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-500 rounded" @click="onEdit(item.id)">Edit</button>
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border border-red-500 rounded" @click="deleteEmployee(item.id)">Delete</button>
            </td>

        </tr>


        <tr class="bg-gray-300 border border-grey-500 md:border-none block md:table-row"  v-else>
            <span>No Employees add</span>
        </tr>
        </tbody>
    </table>
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-500 rounded mt-6" @click="newEmployee">
        Add Employee
    </button>
</template>
