<?php

namespace App\Services\User;

use App\Models\User;

class UserService
{
    /**
     * Create a new user with the specified username.
     *
     * @param  string  $username  The username for the new user.
     * @return User The newly created user.
     */
    public function create(string $username): User
    {
        $userData = [
            'username' => $username,
        ];

        return User::query()->create($userData);
    }
}
