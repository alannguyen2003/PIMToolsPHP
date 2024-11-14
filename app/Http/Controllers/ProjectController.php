<?php

namespace App\Http\Controllers;

use App\Services\IProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private $projectService;

    public function __construct(IProjectService $projectService) {
        $this->projectService = $projectService;
    }
    public function index() {
        return response()->json($this->projectService->findAll());
    }

    public function store(Request $request) {
        return response()->json(
            $this->projectService->create($request)
        );
    }

    public function update(Request $request) {
        return response()->json(
            $this->projectService->update($request)
        );
    }

    public function addEmployeesToProject(Request $request) {
        return response()->json($this->projectService->addMultipleEmployeesToProject($request));
    }

    public function getAllEmployeesOfProject($projectId) {
        return response()->json($this->projectService->getAllEmployeesOfProject($projectId));
    }

    public function deleteEmployeesOfProject(Request $request) {
        return response()->json(
            $this->projectService->deleteMultipleEmployeesOfProject($request)
        );
    }
    
    public function getProjectOfEmployeeHandles($employeeId) {
        return response()->json(
            $this->projectService->getAllProjectsEmployeeHandles($employeeId)
        );
    }

    public function getGroupHandle($id) {
        return response()->json(
            $this->projectService->getGroupHandle($id)
        );
    }
}
