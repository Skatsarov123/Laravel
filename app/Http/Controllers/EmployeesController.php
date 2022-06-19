<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function all_employees(){
        $employees = Employees::all();
        return response()->json([
            'employees' =>$employees
        ],200);

    }

    public function add_employee(Request $request){

        $employee = new Employees();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->phone = $request->phone;
        $employee->department = $request->department;
        $employee->position = $request->position;
        $employee->salary = $request->salary;

        $employee->save();
    }

    public function get_edit_employee($id){
        $employee = Employees::find($id);
        return response()->json([
            'employee' =>$employee
        ],200);
    }

    public function update_employee(Request $request, $id){
        $employee = Employees::find($id);

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->phone = $request->phone;
        $employee->department = $request->department;
        $employee->position = $request->position;
        $employee->salary = $request->salary;

        $employee->save();
    }

    public function delete_employee($id){
        $employee = Employees::findOrFail($id);
        $employee->delete();
    }
}
