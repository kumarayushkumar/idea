<?php

use App\Models\Idea;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

test('it belongs to a user', function (): void {
    $idea = Idea::factory()->create();
    expect($idea->user)->toBeInstanceOf(User::class);
});

test('it can have steps', function (): void {
    $idea = Idea::factory()->create();
    // expect($idea->steps)->toBeInstanceOf(Collection::class);
    expect($idea->steps)->toBeEMpty();

    $idea->steps()->createMany([
        ['description' => 'Step 1'],
        ['description' => 'Step 2'],
    ]);
    expect($idea->fresh()->steps)->toHaveCount(2); // have to refresh the model to get the updated relationship
});
