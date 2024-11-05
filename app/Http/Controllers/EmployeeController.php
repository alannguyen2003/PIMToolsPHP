<?php

namespace App\Http\Controllers;

use App\DTOs\ApiResponse;
use App\Services\IEmployeeService;
use Illuminate\Http\Request;
use App\Constant\ApiResponseConstant;

class EmployeeController extends Controller
{
    private $employeeService;

    public function __construct(IEmployeeService $employeeService) {
        $this->employeeService = $employeeService;
    }

    public function index() {
        $employees = $this->employeeService->findAll();
        $response = new ApiResponse(200, "", $employees);
        return response()->json($response->toResponse());
    }

    public function store(Request $request) {
        $employee = $this->employeeService->create($request);
        $response = new ApiResponse(
            ApiResponseConstant::HTTP_CREATED,
                "Add successful!", 
                $employee);
        return response()->json($response->toResponse());
    }

    public function update(Request $request) {
        $employee = $this->employeeService->update($request);
        $response = new ApiResponse(
            ApiResponseConstant::HTTP_NO_CONTENT,
            "Updated successful!",
            $employee
        );
        return response()->json($response->toResponse());
    }

}
