<?php

declare(strict_types=1);

namespace App\Contracts\Users;

use App\DTO\Telegram\UserData;
use App\Models\User;

interface UserServiceContract
{
    public function firstOrCreate(UserData $data): User;
}
