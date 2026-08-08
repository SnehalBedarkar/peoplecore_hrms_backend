<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreRequest;
use App\Models\Permission;
use App\Services\RoleService;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    public function __construct(
        protected RoleService $roleService
    ) {}

    public function index()
    {
        $roles = $this->roleService->getRoles();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::orderBy('module')
            ->orderBy('name')
            ->get();

        return view('admin.roles.create', compact('permissions'));
    }

    public function store(RoleStoreRequest $request)
    {
        try {

            $this->roleService->addNewRole($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Role Added Successfully',
            ]);

        } catch (\Throwable $th) {

            Log::error('Error adding role: '.$th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error adding role.',
            ], 500);
        }
    }

    public function view($id)
    {
        try {

            $role = $this->roleService->getRoleWithId($id);

            return response()->json([
                'success' => true,
                'data' => $role,
            ]);

        } catch (\Throwable $th) {

            Log::error('Error fetching role: '.$th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Role not found.',
            ], 404);
        }
    }

    public function update(RoleStoreRequest $request, $id)
    {
        try {

            $role = $this->roleService->updateRole($id, $request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Role Updated Successfully.',
                'data' => $role,
            ]);

        } catch (\Throwable $th) {

            Log::error('Error updating role: '.$th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error updating role.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {

            $this->roleService->deleteRoleById($id);

            return response()->json([
                'success' => true,
                'message' => 'Role Deleted Successfully.',
            ]);

        } catch (\Throwable $th) {

            Log::error('Error deleting role: '.$th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error deleting role.',
            ], 500);
        }
    }
}
