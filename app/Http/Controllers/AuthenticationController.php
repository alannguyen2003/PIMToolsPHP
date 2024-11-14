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
use App\Utils\AuthorizationUtilities;
use App\Utils\ResponseUtilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Constant\RoleConstant;
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
        if (!AuthorizationUtilities::isAbleToManage(auth()->user()->id, RoleConstant::MANAGER)) {
            return response()->json(ResponseUtilities::returnResponse(
                ApiResponseConstant::HTTP_FORBIDDEN,
                MessageConstant::FORBIDDEN,
                null
            ));
        } else {
            return response()->json(ResponseUtilities::returnResponse(
                ApiResponseConstant::HTTP_OK,
                MessageConstant::FIND_SUCCESS,
                auth()->user()
            ));
        }
        // $response = new ApiResponse(
        //     ApiResponseConstant::HTTP_OK,
        //     MessageConstant::SUCCESSFUL_AUTHENTICATION,
        //     $user
        // );
        // return response()->json($response->toResponse());
        // return response()->json("hehe");
        // return response()->json(AuthorizationUtilities::isAbleToManage(auth()->user()->id,
        //                                                                         RoleConstant::MANAGER));
        // return response()->json(AuthorizationUtilities::isAbleToManage(auth()->user()->id,
        //                                                                         RoleConstant::MANAGER));
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
