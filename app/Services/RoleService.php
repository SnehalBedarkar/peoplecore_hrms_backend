<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService
{
    public function __construct(private RoleRepository $roleRepository) {}

    public function getRoles()
    {
        return $this->roleRepository->getRoles();
    }

    public function addNewRole(array $data)
    {
        return $this->roleRepository->addRole($data);
    }

    public function getRoleWithId($id)
    {
        return $this->roleRepository->getRoleById($id);
    }

    public function updateRole($id, array $data)
    {
        return $this->roleRepository->updateRoleById($id, $data);
    }

    public function deleleRoleById($id)
    {
        return $this->roleRepository->deleleRoleById($id);
    }
}
