<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\DB;

class CreateIdea
{
    public function __construct(#[CurrentUser] protected User $user)
    {
        //
    }

    public function handle(array $attributes): void
    {

        $data = collect($attributes)->except(['steps', 'image'])->toArray();

        if ($attributes['image'] ?? false) {
            $data['image_path'] = $attributes['image']->store('idea', 'public');
        }

        DB::transaction(function () use ($data, $attributes): void {
            $idea = $this->user->ideas()->create($data);
            $idea->steps()->createMany($attributes['steps'] ?? []);

        });

    }
}
