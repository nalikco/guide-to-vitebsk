<?php

declare(strict_types=1);

namespace App\Contracts\Users;

use App\Models\User;

interface AuthenticateServiceContract
{
    /**
     * Authenticate the user.
     *
     * @param  User  $user  The user to authenticate.
     */
    public function authenticate(User $user): void;
}
