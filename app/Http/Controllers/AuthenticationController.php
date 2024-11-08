<?php

namespace App\Http\Controllers;

use App\Constant\ApiResponseConstant;
use App\Constant\MessageConstant;
use App\DTOs\ApiResponse;
use App\DTOs\Request\Authenticate\LoginAuthenticate;
use App\Http\Requests\AuthenticationRequest;
use App\Services\IHelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationController extends Controller
{
    private $helperService;
    public function __construct(IHelperService $helperService) {
        $this->middleware('auth');
        $this->helperService = $helperService;
    }
    public function login(Request $request) {
        $rules = LoginAuthenticate::rules;
        $validator = LoginAuthenticate::validator;

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
            $this->createNewToken($token)
        );
        return response()->json($response->toResponse());
    }

    protected function createNewToken($token) {
        return [
            'access_token' => $token, 
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ];
    }

    public function getProfile() {
        $this->middleware('auth');
        $user = auth()->user()->role;
        return response()->json($user);
    }
}
