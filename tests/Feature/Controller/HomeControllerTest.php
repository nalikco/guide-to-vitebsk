<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('should show page for authenticated', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('home'))
        ->assertSeeText(sprintf('Hello, @%s', $user->username));
});

it('should redirect for guest', function () {
    $this->get(route('home'))
        ->assertRedirectToRoute('login');
});
