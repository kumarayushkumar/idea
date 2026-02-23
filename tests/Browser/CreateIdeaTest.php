<?php

use App\Models\User;

use function Pest\Laravel\actingAs;

it('create a new idea', function () {
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);

    visit('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'My First Idea')
        ->click('@button-status-completed')
        ->fill('description', 'This is my first idea description')
        ->fill('@create-idea-modal-link-input', 'https://example.com')
        ->click('@create-idea-modal-add-link-button')
        ->fill('@create-idea-modal-link-input', 'https://example2.com')
        ->click('@create-idea-modal-add-link-button')
        ->click('@create-idea-modal-submit-button')
        ->assertPathIs('/ideas');

    expect($user->ideas()->first())->toMatchArray([
        'title' => 'My First Idea',
        'description' => 'This is my first idea description',
        'status' => 'completed',
        'user_id' => $user->id,
        'links' => ['https://example.com', 'https://example2.com'],
    ]);
});
