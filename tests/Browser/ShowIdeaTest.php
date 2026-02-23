<?php

use App\Models\Idea;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('requires authentication to view an idea', function (): void {
    $idea = Idea::factory()->create();

    get(route('idea.show', $idea))
        ->assertRedirectToRoute('login');
});

it('disallows accessing an idea you did not create', function (): void {
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);

    $idea = Idea::factory()->create();

    get(route('idea.show', $idea))
        ->assertForbidden();
});
