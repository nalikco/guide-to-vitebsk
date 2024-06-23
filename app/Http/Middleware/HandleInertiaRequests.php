<?php

namespace App\Http\Middleware;

use App\DTO\Telegram\TelegramUserData;
use App\DTO\User\UserData;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Override;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    #[Override]
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    #[Override]
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth.user' => fn() => $request->user()
                ? UserData::from([
                    'id' => $request->user()->id,
                    'username' => $request->user()->username,
                    'telegramUser' => TelegramUserData::from($request->user()->telegramUser),
                    'createdAt' => $request->user()->created_at,
                    'updatedAt' => $request->user()->updated_at,
                ])
                : null,
        ]);
    }
}
