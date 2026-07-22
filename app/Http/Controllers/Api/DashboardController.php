<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected DashboardService $dashboardService) {}

    public function index()
    {
        try {
            $data = $this->dashboardService->getSummary();

            return $this->success($data);
        } catch (\Throwable $th) {
            
            Log::error('Dashboard error: '.$th->getMessage());

            return $this->error('Something went wrong.');
        }
    }
}
