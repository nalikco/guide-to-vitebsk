<?php

namespace App\Contracts\User;

use App\Dto\Telegram\UserDto;
use App\Models\User;

interface UserCreatorInterface
{
    /**
     * Creates or receives an already created user using Telegram ID.
     *
     * @param  UserDto  $dto  Telegram user data.
     * @return User Created or obtained user.
     */
    public function getOrCreate(UserDto $dto): User;
}
