<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;

it('login in user', function (): void {
    $user = User::factory()->create([
        'password' => 'password',
    ]);

    visit('/login')
        ->fill('email', $user->email)
        ->fill('password', 'password')
        ->click('@login-button')
        ->assertPathIs('/ideas');

    assertAuthenticated();

});

it('logout a user', function (): void {
    $user = User::factory()->create();

    Auth::login($user);
    assertAuthenticated();

    visit('/')
        ->click('@logout-button');

    assertGuest();

});
