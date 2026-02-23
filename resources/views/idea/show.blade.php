<x-layout>
    <div class="py-8 mx-auto max-w-4xl">
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('idea.index') }}"
                class="flex items-center gap-x-2 text-sm font-medium text-foreground hover:text-gray-300">
                <x-icons.arrow-back />
                Back to all ideas
            </a>

            <div class="flex items-center gap-2">
                <button class="btn btn-outlined flex items-center">
                    <x-icons.edit />
                    Edit
                </button>

                <form action="{{ route('idea.destroy', $idea->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="btn btn-outlined flex text-red-500 border-red-900 hover:bg-red-600/20 items-center">
                        Delete
                    </button>
            </div>
        </div>

        <h1 class="font bold text-3xl mt-5">{{ $idea->title }}</h1>

        <div class="mt-4 flex items-center gap-4">
            <x-idea.status-label status="{{ $idea->status }}">{{ $idea->status->label() }}</x-idea.status-label>
            <p class="text-sm text-muted-foreground">{{ $idea->created_at->diffForHumans() }}</p>

        </div>
        <x-card class="mt-6">
            <p class="text-lg">{{ $idea->description }}</p>
        </x-card>

        @if ($idea->links->count())

            <div class="mt-10">
                <h3 class="font-semibold text-xl">Links</h3>
                <div class="space-y-2 mt-4">
                    @foreach ($idea->links as $link)
                        <x-card href="{{ $link }}" class="text-primary"
                            target="_blank">{{ $link }}</x-card>
                    @endforeach
                </div>
            </div>

        @endif
    </div>
</x-layout>
