<?php

namespace App\Console\Commands\Telegram;

use App\Models\TelegraphBot;
use Illuminate\Console\Command;

use function Laravel\Prompts\outro;
use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

class MakeTelegramBotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:telegram-bot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets up the bot. Needed when setting up for the first time or after changing the token.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $token = password('Please, enter token:', required: true);
        $name = text('Please, enter name:');

        TelegraphBot::query()->firstOrCreate([
            'token' => $token,
        ], [
            'name' => $name,
        ]);

        outro('Bot successfully set up.');

        return self::SUCCESS;
    }
}
