<?php

use App\Contracts\Telegram\TokenGetterInterface;
use App\Livewire\Telegram\Authenticator;
use App\Services\Telegram\Token\TokenGetterFake;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Mockery\MockInterface;
use Symfony\Component\HttpFoundation\Response;

uses(RefreshDatabase::class);

it('should render', function () {
    Livewire::test(Authenticator::class)
        ->assertStatus(Response::HTTP_OK);
});

it('should authenticate', function () {
    $initData = 'auth_date=1712603287&query_id=QoCJwq2LEOltYeZ0&user=%7B%22id%22%3A3453455%2C%22first_name%22%3A%22John%22%2C%22last_name%22%3A%22Doe%22%2C%22username%22%3A%22johndoe%22%2C%22language_code%22%3A%22en%22%2C%22allows_write_to_pm%22%3Atrue%7D&hash=a572c00d30c1407ec9d7357241b1558c6ec5fcc41cffe6484d0efca54423511b';
    $token = 'a3c8f1bd39c3666a18a92a8d290dc167d71be95e2df899a4b30526a48b9b0a67';

    $this->instance(
        TokenGetterInterface::class,
        Mockery::mock(TokenGetterFake::class, function (MockInterface $mock) use ($token) {
            $mock->shouldReceive('get')
                ->andReturn($token);
        }),
    );

    Livewire::test(Authenticator::class)
        ->call('authenticate', $initData);

    expect(Auth::check())->toBeTrue();
});

it('should throw unauthorized: invalid init data', function () {
    $initData = 'auth_date=1712603287&query_id=QoCJwq2LEOltYeZ0&user=%7B%22id%22%3A3453455%2C%22first_name%22%3A%22John%22%2C%22last_name%22%3A%22Doe%22%2C%22username%22%3A%22john%22%2C%22language_code%22%3A%22en%22%2C%22allows_write_to_pm%22%3Atrue%7D&hash=a572c00d30c1407ec9d7357241b1558c6ec5fcc41cffe6484d0efca54423511b';
    $token = 'a3c8f1bd39c3666a18a92a8d290dc167d71be95e2df899a4b30526a48b9b0a67';

    $this->instance(
        TokenGetterInterface::class,
        Mockery::mock(TokenGetterFake::class, function (MockInterface $mock) use ($token) {
            $mock->shouldReceive('get')
                ->andReturn($token);
        }),
    );

    Livewire::test(Authenticator::class)
        ->call('authenticate', $initData);

    expect(Auth::check())->toBeFalse();
});

it('should throw unauthorized: invalid token', function () {
    $initData = 'auth_date=1712603287&query_id=QoCJwq2LEOltYeZ0&user=%7B%22id%22%3A3453455%2C%22first_name%22%3A%22John%22%2C%22last_name%22%3A%22Doe%22%2C%22username%22%3A%22johndoe%22%2C%22language_code%22%3A%22en%22%2C%22allows_write_to_pm%22%3Atrue%7D&hash=a572c00d30c1407ec9d7357241b1558c6ec5fcc41cffe6484d0efca54423511b';
    $token = 'a3c8f1bd39c3666a8a92a8d290dc167d71be95e2df899a4b30526a48b9b0a67';

    $this->instance(
        TokenGetterInterface::class,
        Mockery::mock(TokenGetterFake::class, function (MockInterface $mock) use ($token) {
            $mock->shouldReceive('get')
                ->andReturn($token);
        }),
    );

    Livewire::test(Authenticator::class)
        ->call('authenticate', $initData);

    expect(Auth::check())->toBeFalse();
});
