<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/all_employees', [EmployeesController::class, 'all_employees']);
    Route::post('/add_employee', [EmployeesController::class, 'add_employee']);
    Route::get ('/get_edit_employee/{id}', [EmployeesController::class, 'get_edit_employee']);
    Route::post('/update_employee/{id}', [EmployeesController::class, 'update_employee']);
    Route::get ('/delete_employee/{id}', [EmployeesController::class, 'delete_employee']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);



