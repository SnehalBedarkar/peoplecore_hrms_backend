<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation; // ← add this
use App\Models\Permission;
use App\Models\Role;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;

class MasterDataController extends Controller
{
    use ApiResponseTrait;

    public function getPermissions()
    {
        try {
            $permissions = Permission::select('id', 'name', 'module')->get();

            return $this->success($permissions);
        } catch (\Throwable $th) {
            Log::error('Error in fetching permissions '.$th->getMessage());

            return $this->error('Something went wrong. Please try again later.');
        }
    }

    public function getRoles()
    {
        try {
            $roles = Role::select('id', 'name')->get();

            return $this->success($roles);
        } catch (\Throwable $th) {
            Log::error('Error in fetching roles '.$th->getMessage());

            return $this->error('Something went wrong. Please try again later.');
        }
    }

    public function getDepartments()
    {
        try {
            $departments = Department::select('id', 'name')->get();

            return $this->success($departments);
        } catch (\Throwable $th) {
            Log::error('Error in fetching departments '.$th->getMessage());

            return $this->error('Something went wrong. Please try again later.');
        }
    }

    public function getDesignations()
    {
        try {
            $designations = Designation::select('id', 'name')->get();

            return $this->success($designations);
        } catch (\Throwable $th) {
            Log::error('Error in fetching designations '.$th->getMessage());

            return $this->error('Something went wrong. Please try again later.');
        }
    }
}
