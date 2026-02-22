<?php

use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;

test('registers a user', function (): void {
    visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'john@example.com')
        ->fill('password', 'password')
        ->click('[data-testid="register-button"]')
        ->assertPathIs('/');

    assertAuthenticated();
    expect(Auth::user())->toMatchArray([
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
});

test('require a valid email', function (): void {
    visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'invalid-email')
        ->fill('password', 'password')
        ->click('[data-testid="register-button"]')
        ->assertPathIs('/register');

    assertGuest();
});
