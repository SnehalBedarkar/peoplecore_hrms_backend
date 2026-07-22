<?php

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\MasterDataController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    Route::get('/get-permissions', [MasterDataController::class, 'getPermissions']);
    Route::get('/get-roles', [MasterDataController::class, 'getRoles']);
    Route::get('/get-departments', [MasterDataController::class, 'getDepartments']);
    Route::get('/get-designations', [MasterDataController::class, 'getDesignations']);

    Route::get('/departments', [DepartmentController::class, 'index']);
    Route::post('/departmens', [DepartmentController::class, 'store']);
    Route::get('/departments/edit/{id}', [DepartmentController::class, 'edit']);
    Route::put('/departments/update/{id}', [DepartmentController::class, 'update']);

    // Roles Routes
    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/roles/store', [RoleController::class, 'store']);
    Route::get('/roles/view/{id}', [RoleController::class, 'view']);
    Route::get('/roles/edit/{id}', [RoleController::class, 'edit']);
    Route::put('/roles/update/{id}', [RoleController::class, 'update']);
    Route::delete('/roles/destroy/{id}', [RoleController::class, 'destroy']);

    // Users routes
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users/store', [UserController::class, 'store']);
    Route::get('/users/edit/{id}', [UserController::class, 'edit']);
    Route::post('/users/update/{id}', [UserController::class, 'update']);
    Route::delete('/users/destroy/{id}', [UserController::class, 'destroy']);

    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::post('/employees/store', [EmployeeController::class, 'store']);
    Route::get('/employees/edit/{id}', [EmployeeController::class, 'edit']);
    Route::get('/employees/show/{id}', [EmployeeController::class, 'show']);
    Route::put('/employees/update/{id}', [EmployeeController::class, 'update']);
    Route::delete('/employees/destroy/{id}', [EmployeeController::class, 'destroy']);
});
