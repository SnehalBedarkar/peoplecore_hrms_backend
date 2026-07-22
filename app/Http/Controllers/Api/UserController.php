<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {}

    public function index(): JsonResponse
    {
        try {
            $users = $this->userService->getAllUsers();

            return response()->json([
                'success' => true,
                'data' => $users,
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error fetching users: '.$th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error fetching users.',
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        // dd($request->all());
        try {
            $user = $this->userService->createUser($request->all());

            return response()->json([
                'success' => true,
                'data' => $user,
            ], 201);
        } catch (\Throwable $th) {
            Log::error('Error creating user: '.$th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error creating user.',
            ], 500);
        }
    }
}
