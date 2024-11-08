<?php

namespace App\Http\Controllers;

use App\Constant\ApiResponseConstant;
use App\Constant\MessageConstant;
use App\DTOs\ApiResponse;
use App\Services\IGroupService;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    private $groupService;

    public function __construct(IGroupService $groupService) {
        $this->groupService = $groupService;
    }

    public function index() {
        $groups = $this->groupService->findAll();
        $response = $groups->count() > 0 ? new ApiResponse(
            ApiResponseConstant::HTTP_OK,
            MessageConstant::GET_ALL,
            $groups
        ) : new ApiResponse(
            ApiResponseConstant::HTTP_OK,
            MessageConstant::FIND_SUCCESS,
            $groups
        ); 
        
        return response()->json($response->toResponse());
    }

    public function findById($id) {
        $group = $this->groupService->findById($id);
        $response = new ApiResponse(
            ApiResponseConstant::HTTP_OK,
            MessageConstant::FIND_SUCCESS,
            $group
        );
        return response()->json($response->toResponse());
    }

    public function getGroupLeader($id) {
        $leader = $this->groupService->getGroupLeader($id);
        $response = new ApiResponse(
            ApiResponseConstant::HTTP_OK,
            MessageConstant::FIND_SUCCESS,
            $leader
        );
        return response()->json($response->toResponse());
    }

    public function store(Request $request) {
        $group = $this->groupService->create($request);
        $response = new ApiResponse(
            ApiResponseConstant::HTTP_CREATED,
            MessageConstant::CREATED,
            $group
        );
        return response()->json($response->toResponse());
    }

    public function update(Request $request) {
        $group = $this->groupService->update($request);

        $response = $group > 0 ? new ApiResponse(
            ApiResponseConstant::HTTP_NO_CONTENT,
            MessageConstant::UPDATED,
            $group
        ) : new ApiResponse(
            ApiResponseConstant::HTTP_BAD_REQUEST,
            MessageConstant::BAD_REQUEST,
            $group
        );
        return response()->json($response->toResponse());
    }

    public function delete(Request $request) {

    }
}
