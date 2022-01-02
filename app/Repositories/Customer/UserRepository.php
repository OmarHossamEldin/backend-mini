<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Saves the resource in the database
     *
     * @param array $validatedData
     * @return object
     */
    public function create(array $validatedData): object
    {
        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);
        return $user;
    }
}
