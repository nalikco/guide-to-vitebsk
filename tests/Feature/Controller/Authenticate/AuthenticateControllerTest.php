<?php

use App\Livewire\Telegram\Authenticator;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('should show livewire component for guest', function () {
    $this->get(route('login'))
        ->assertSeeLivewire(Authenticator::class);
});

it('should redirect for authenticated', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('login'))
        ->assertRedirectToRoute('home');
});
