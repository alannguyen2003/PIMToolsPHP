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
}
