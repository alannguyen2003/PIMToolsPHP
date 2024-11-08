<?php

namespace App\Http\Controllers;

use App\Constant\ApiResponseConstant;
use App\Constant\MessageConstant;
use App\DTOs\ApiResponse;
use App\DTOs\Request\Authenticate\LoginAuthenticate;
use App\DTOs\Request\Authenticate\RegisterAuthenticate;
use App\Http\Requests\AuthenticationRequest;
use App\Services\IHelperService;
use App\Services\IUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationController extends Controller
{
    private $helperService;
    private $userService;
    public function __construct(IHelperService $helperService, IUserService $userService) {
        $this->helperService = $helperService;
        $this->userService = $userService;
    }
    public function login(Request $request) {
        $validator = LoginAuthenticate::validator($request);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $response = new ApiResponse(
                ApiResponseConstant::HTTP_BAD_REQUEST,
                MessageConstant::BAD_REQUEST,
                $errors
            );
            return response()->json($response->toResponse());
        }
        $credentials = $request->only("username", "password");
        $token = null;
        
        if (!$token = JWTAuth::attempt($credentials)) {
            $response = new ApiResponse(
                ApiResponseConstant::HTTP_UNAUTHORIZED,
                MessageConstant::UNAUTHORIZED,
                "Wrong username or password!!"
            );
            return response()->json($response->toResponse());
        }
        $response = new ApiResponse(
            ApiResponseConstant::HTTP_OK,
            MessageConstant::SUCCESSFUL_AUTHENTICATION,
            $this->userService->createNewToken($token)
        );
        return response()->json($response->toResponse());
    }

    public function getProfile() {
        $this->middleware('auth');
        $user = auth()->user()->role;
        return response()->json($user);
    }

    public function register(Request $request) {
        $rules = RegisterAuthenticate::rules();
        $validator = RegisterAuthenticate::validator($request);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $response = new ApiResponse(
                ApiResponseConstant::HTTP_BAD_REQUEST,
                MessageConstant::BAD_REQUEST,
                $errors
            );
            return response()->json($response->toResponse());
        }
        $newUser = $this->userService->registerNewUser($request);
        if ($newUser === 0) {
            $response = new ApiResponse(
                ApiResponseConstant::HTTP_BAD_REQUEST,
                MessageConstant::BAD_REQUEST,
                MessageConstant::EXISTED
            );
            return response()->json($response->toResponse());
        }
        $response = new ApiResponse(
            ApiResponseConstant::HTTP_CREATED,
            MessageConstant::CREATED,
            $newUser
        );
        return response()->json(
            $response->toResponse()
        );
    }
}
