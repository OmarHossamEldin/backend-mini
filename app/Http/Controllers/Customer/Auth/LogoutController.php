<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Customer\AuthRepository;
use App\Helpers\JsonResponse;
use Lang;

class LogoutController extends Controller
{
    /**
     * Destroy the token and logout.
     * @return JsonResponse
     */
    public function logout(AuthRepository $authRepository)
    {
        $user = auth()->user();

        return $authRepository->signOut($user) ? JsonResponse::response(message: Lang::get('auth.logout'), statusCode: 200) :
            JsonResponse::response(message: Lang::get('db.failed'), statusCode: 500);
    }
}
