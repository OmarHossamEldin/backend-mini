<?php

namespace App\Repositories\Customer;

use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    /**
     * authentication method
     * we need to replace later to convert,
     * jwt token for more security and statless apps
     * @param array $validatedData
     * @return object
     */
    public function signIn(array $validatedData): mixed
    {
        if (Auth::attempt($validatedData, request()->remember)) {
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
