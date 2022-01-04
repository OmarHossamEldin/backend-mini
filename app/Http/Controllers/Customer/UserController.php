<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\User\UpdateRequest;
use App\Repositories\UserRepository;
use App\Helpers\JsonResponse;
use Lang;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return JsonResponse
     */
    public function show()
    {
        $user = auth()->user();
        return JsonResponse::response(data: ['user' => $user], statusCode: 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest $request
     * @param  UserRepository $userRepository
     * @return JsonResponse
     */
    public function update(UpdateRequest  $request, UserRepository $userRepository)
    {
        $user = auth()->user();
        $user = $userRepository->update($user, $request->validated());

        return JsonResponse::response(message: Lang::get('db.success'), data: ['user' => $user], statusCode: 206);
    }
}
