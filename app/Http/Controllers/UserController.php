<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {}

    public function index()
    {
        $users = $this->userService->getAllUsers(request()->only(['search', 'role', 'status']));

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::select('id', 'name')->get();

        return view('admin.users.create', compact('roles'));
    }

    public function store(UserStoreRequest $request)
    {
        $this->userService->createUser($request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(int $id)
    {
        $user = $this->userService->getUserById($id);
        $roles = Role::select('id', 'name')->get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(UserUpdateRequest $request, int $id)
    {
        $user = $this->userService->getUserById($id);

        $this->userService->updateUser($user, $request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(int $id)
    {
        $user = $this->userService->getUserById($id);

        $this->userService->deleteUser($user);

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
