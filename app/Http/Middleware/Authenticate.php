<?php

namespace App\Http\Middleware;

use App\Constant\ApiResponseConstant;
use App\Constant\MessageConstant;
use App\DTOs\ApiResponse;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            $response = new ApiResponse(
                ApiResponseConstant::HTTP_UNAUTHORIZED,
                MessageConstant::UNAUTHORIZED,
                "Unauthorized!!!"
            );
            return response()->json($response->toResponse());
        }
        return $next($request);
    }
}
