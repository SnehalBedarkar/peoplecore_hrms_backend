<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {

        try {
            $departments = Department::select('id', 'name', 'code', 'is_active')->get();

            return response()->json([
                'success' => true,
                'departments' => $departments,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => 'Error in fetching departments',
            ], 500);
        }
    }

    public function store(){
        
    }
}
