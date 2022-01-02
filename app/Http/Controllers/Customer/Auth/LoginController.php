<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Customer\AuthRepository;
use App\Helpers\JsonResponse;
use Lang;

class LoginController extends Controller
{
    /**
     * login to the app
     * @param LoginRequest $request
     * @param AuthRepository $authRepository
     * @return JsonResponse
     */
    public function login(LoginRequest $request, AuthRepository $authRepository)
    {
        $user = $authRepository->signIn($request->validated());

        return $user ? JsonResponse::response(message: Lang::get('auth.success'), data: ['user' => $user], statusCode: 201) :
            JsonResponse::response(errors: [Lang::get('auth.failed')], data: ['user' => []], statusCode: 200);
    }
}
