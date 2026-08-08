<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository
{
    public function getRoles()
    {
        return Role::select('id', 'name', 'created_at')
            ->where('slug', '!=', 'superadmin')
            ->with('permissions:id,name,module')
            ->withCount('users')
            ->get();
    }

    public function addRole(array $data)
    {
        $role = Role::create($data);

        if (! empty($data['permissions'])) {
            $pivotData = collect($data['permissions'])->mapWithKeys(fn ($id) => [
                $id => ['assigned_by' => auth()->id()],
            ])->all();

            $role->permissions()->attach($pivotData);
        }

        return $role;
    }

    public function getRoleById($id)
    {
        return Role::select('id', 'name')->with('permissions:id,name,module')
            ->findOrFail($id);
    }

    public function updateRoleById($id, $data)
    {
        $role = Role::findOrFail($id);

        // update role name
        $role->name = $data['name'];
        $role->save();

        // sync permissions (replace old with new)
        if (! empty($data['permissions'])) {
            $pivotData = collect($data['permissions'])->mapWithKeys(fn ($id) => [
                $id => ['assigned_by' => auth()->id()],
            ])->all();

            $role->permissions()->sync($pivotData);
        } else {
            // if no permissions sent, detach all
            $role->permissions()->detach();
        }

        return $role->load('permissions:id,name,module');
    }

    public function deleleRoleById($id)
    {
        $role = Role::findOrfail($id);
        $role->delete();
    }
}
