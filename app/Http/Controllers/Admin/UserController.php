<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreAdminRequest;
use App\Http\Requests\Admin\User\UpdateAdminRequest;
use App\Repositories\UserRepository;
use App\Helpers\JsonResponse;
use App\Models\User;
use Lang;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param UserRepository $userRepository
     * @return JsonResponse
     */
    public function index(UserRepository $userRepository)
    {
        $users = $userRepository->list();
        return JsonResponse::response(data: ['users' => $users], statusCode: 200);
    }

    /**
     *  create user
     * 
     * @param StoreAdminRequest $request
     * @param UserRepository $userRepository
     * @return JsonResponse
     */
    public function store(StoreAdminRequest $request, UserRepository $userRepository)
    {
        $user = $userRepository->create($request->validated());
        return JsonResponse::response(message: Lang::get('db.success'), data: ['user' => $user], statusCode: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return JsonResponse
     */
    public function show(User $user)
    {
        return JsonResponse::response(data: ['user' => $user], statusCode: 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateAdminRequest $request
     * @param  User $user
     * @param  UserRepository $userRepository
     * @return JsonResponse
     */
    public function update(UpdateAdminRequest  $request, User $user, UserRepository $userRepository)
    {
        $user = $userRepository->update($user, $request->validated());

        return JsonResponse::response(message: Lang::get('db.success'), data: ['user' => $user], statusCode: 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @param  UserRepository $userRepository
     * @return JsonResponse
     */
    public function destroy(User $user, UserRepository $userRepository)
    {
        $result = $userRepository->delete($user);
        return $result ? JsonResponse::response(message: Lang::get('db.success'), data: [], statusCode: 200) : 'error';
    }
}
