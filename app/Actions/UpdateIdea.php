<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Idea;
use Illuminate\Support\Facades\DB;

class UpdateIdea
{
    public function handle(array $attributes, Idea $idea): void
    {

        $data = collect($attributes)->except(['steps', 'image'])->toArray();

        if ($attributes['image'] ?? false) {
            $data['image_path'] = $attributes['image']->store('idea', 'public');
        }

        DB::transaction(function () use ($data, $attributes, $idea): void {
            $idea->update($data);
            $idea->steps()->delete();
            $idea->steps()->createMany(collect($attributes['steps'] ?? []));

        });

    }
}
