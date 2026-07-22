<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Services\RoleService;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private RoleService $roleService) {}

    public function index()
    {
        try {
            $roles = $this->roleService->getRoles();

            return $this->success($roles);
        } catch (\Throwable $th) {
            Log::error('Error fetching roles', [
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
            ]);

            return $this->error('Error fetching roles');
        }
    }

    public function store(RoleStoreRequest $request)
    {
        try {
            $role = $this->roleService->addNewRole($request->validated());

            return $this->success($role, 'Role created successfully', 201);
        } catch (\Throwable $th) {
            Log::error('Error creating role', [
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
            ]);

            return $this->error('Error creating role');
        }
    }

    public function edit(int $id)
    {
        try {
            $role = $this->roleService->getRoleWithId($id);

            return $this->success($role, 'Role fetched successfully');
        } catch (\Throwable $th) {
            Log::error('Role edit error', [
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
            ]);

            return $this->error('Something went wrong');
        }
    }

    // ✅ ADD THIS
    public function update(RoleUpdateRequest $request, int $id)
    {
        try {
            $role = $this->roleService->updateRole($id, $request->validated());

            return $this->success($role, 'Role updated successfully');
        } catch (\Throwable $th) {
            Log::error('Role update error', [
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
            ]);

            return $this->error('Error updating role');
        }
    }

    public function destroy($id)
    {
        try {
            $this->roleService->deleleRoleById($id);

            return $this->success('Role Deleted Successfully', 200);
        } catch (\Throwable $th) {
            Log::error('Error in deleting role'.$th->getMessage());

            return $this->error('Error deleting role'); // ✅ Added error response
        }
    }
}
