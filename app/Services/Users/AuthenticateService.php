<?php

declare(strict_types=1);

namespace App\Services\Users;

use App\Contracts\Users\AuthenticateServiceContract;
use App\Models\User;
use Illuminate\Auth\AuthManager;

readonly class AuthenticateService implements AuthenticateServiceContract
{
    public function __construct(
        private AuthManager $authManager,
    ) {}

    #[\Override]
    public function authenticate(User $user): void
    {
        $this->authManager->login($user, true);
    }
}
