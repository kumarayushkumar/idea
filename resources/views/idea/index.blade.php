<x-layout>
    <div class="max-w-4xl mx-auto">
        <div class="space-y-3">
            <h1 class="text-3xl font-bold">Your Ideas</h1>
        </div>

        <x-card x-data @click="$dispatch('open-model','create-idea')" type="button" is="button"
            class="mt-10 cursor-pointer w-full text-lg hover:bg-primary/20 transition duration-300"
            data-testId="create-idea-button">What's the
            Idea?</x-card>

        <div class="mt-10">
            <a href="/ideas" class="btn {{ request('status') === null ? '' : 'btn-outlined' }}">All Ideas</a>
            @foreach (App\IdeaStatus::cases() as $status)
                <a href="/ideas?status={{ $status->value }}"
                    class="btn {{ request('status') === $status->value ? '' : 'btn-outlined' }}">{{ $status->label() }}
                    <span class="text-xs pl-2">{{ $statusCounts->get($status->value) }}</span></a>
            @endforeach

        </div>

        <div class="mt-6 text-muted-foreground">
            <div class="grid md:grid-cols-2 gap-6">
                @forelse ($ideas as $idea)
                    <x-card href="{{ route('idea.show', $idea) }}">

                        @if ($idea->image_path)
                            <div class="rounded-t-lg overflow-hidden -mx-4 -mt-4">
                                <img src="{{ asset('storage/' . $idea->image_path) }}" alt="Idea Image"
                                    class="w-full h-48 object-cover">
                            </div>
                        @endif

                        <h3 class="text-foreground font-bold text-lg mt-4"> {{ $idea->title }}</h3>
                        <p class="mt-1 ">{{ $idea->description }}</p>

                        <x-idea.status-label class="mt-2"
                            status="{{ $idea->status }}">{{ $idea->status->label() }}</x-idea.status-label>

                        <p class="text-xs mt-2">{{ $idea->created_at->diffForHumans() }}</p>
                    </x-card>
                @empty
                    <div class="flex items-center justify-center">
                        <p class="text-xl">You don't have any ideas yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- modal --}}
       <x-idea.modal />
    </div>
</x-layout>
