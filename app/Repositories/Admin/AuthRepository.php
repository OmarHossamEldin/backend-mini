<?php

namespace App\Repositories\Admin;

use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    /**
     * authentication method
     * jwt token for more security and stateless apps
     * @param array $validatedData
     * @return object
     */
    public function signIn(array $validatedData): mixed
    {
        if (Auth::attempt($validatedData, request()->remember) && Auth::user()->is_admin === true) {
            $user = Auth::user();
            $user->token = $user->createToken('token')->plainTextToken;
        } else {
            $user = [];
        }
        return $user;
    }

    /**
     * token destroy 
     * @param object $user
     * @return bool
     */
    public function signOut(object $user): bool
    {
        $user->currentAccessToken()->delete();
        return true;
    }
}
