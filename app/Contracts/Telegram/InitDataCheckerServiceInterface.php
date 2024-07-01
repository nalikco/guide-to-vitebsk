<?php

namespace App\Contracts\Telegram;

use App\Dto\Telegram\InitDto;

interface InitDataCheckerServiceInterface
{
    /**
     * Check if the provided init data match the hash value.
     *
     * @param  string  $botToken  The Telegram Bot token.
     * @param  InitDto  $initData  An object containing data values to be checked.
     * @return bool Returns true if the hash matches the calculated hash from the data values, false otherwise.
     */
    public function check(string $botToken, InitDto $initData): bool;
}
