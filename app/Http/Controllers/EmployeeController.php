<?php

namespace App\Http\Controllers;

use App\DTOs\ApiResponse;
use App\Services\IEmployeeService;
use Illuminate\Http\Request;
use App\Constant\ApiResponseConstant;
use App\Constant\MessageConstant;
use App\Utils\ResponseUtilities;

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

    public function find($id) {
        $employee = $this->employeeService->findById($id);
        $response = new ApiResponse(
            ApiResponseConstant::HTTP_OK,
            MessageConstant::FIND_SUCCESS,
            $employee
        );
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

    public function delete(Request $request) {
        $this->employeeService->delete($request);
        $response = new ApiResponse(
            ApiResponseConstant::HTTP_NO_CONTENT,
            "Delete successful!",
            null
        );
        return response()->json($response->toResponse());
    }

    public function getGroup($id) {
        $groups = $this->employeeService->getGroupByEmployeeId($id);
        return response()->json(ResponseUtilities::returnResponse(
            ApiResponseConstant::HTTP_OK,
            MessageConstant::GET_ALL,
            $groups
        ));
    }
}
