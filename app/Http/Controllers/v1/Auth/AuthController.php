<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\AuthRequest;
use App\Services\API\v1\Auth\AuthService;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService){}
    public function login(AuthRequest $request)
    {
        return $this->authService->login($request->only(['email', 'password']));
    }
}
