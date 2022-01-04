<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\User\RegisterRequest;
use App\Repositories\UserRepository;
use App\Helpers\JsonResponse;
use Lang;

class RegisterController extends Controller
{
    /**
     * register to the app
     * @param RegisterRequest $request
     * @param UserRepository $userRepository
     * @return JsonResponse
     */
    public function register(RegisterRequest $request, UserRepository $userRepository)
    {
        $user = $userRepository->create($request->validated());
        return JsonResponse::response(message: Lang::get('db.success'), data: ['user' => $user], statusCode: 201);
    }
}
