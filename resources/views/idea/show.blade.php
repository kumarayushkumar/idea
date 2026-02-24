<x-layout>
    <div class="py-8 mx-auto max-w-4xl">
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('idea.index') }}"
                class="flex items-center gap-x-2 text-sm font-medium text-foreground hover:text-gray-300">
                <x-icons.arrow-back />
                Back to all ideas
            </a>

            <div class="flex items-center gap-2">
                <button x-data @click="$dispatch('open-model','edit-idea')" class="btn btn-outlined flex items-center"
                    data-testId="edit-idea-button">
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
                </form>
            </div>
        </div>

        @if ($idea->image_path)
            <div class="rounded-md overflow-hidden">
                <img src="{{ asset('storage/' . $idea->image_path) }}" alt="Idea Image"
                    class="w-full h-auto object-cover">
            </div>
        @endif

        <h1 class="font-bold text-3xl mt-5">{{ $idea->title }}</h1>

        <div class="mt-4 flex items-center gap-4">
            <x-idea.status-label status="{{ $idea->status }}">{{ $idea->status->label() }}</x-idea.status-label>
            <p class="text-sm text-muted-foreground">{{ $idea->created_at->diffForHumans() }}</p>

        </div>

        @if ($idea->description)
            <x-card class="mt-6">
                <p class="text-lg">{{ $idea->description }}</p>
            </x-card>
        @endif

        @if ($idea->steps)

            <div class="mt-10">
                <h3 class="font-semibold text-xl">Steps</h3>
                <div class="space-y-2 mt-4">
                    @foreach ($idea->steps as $step)
                        <x-card is="div" class="">

                            <form action="{{ route('step.update', $step) }}" method="POST"
                                class="flex items-center gap-3">
                                @csrf
                                @method('PATCH')

                                <button type="submit" role="checkbox"
                                    class="size-5 flex items-center justify-center rounded-md text-primary-foreground border-primary border {{ $step->is_completed ? 'bg-primary' : '' }} ">&check;</button>
                                <span
                                    class="{{ $step->is_completed ? 'line-through text-muted-foreground' : '' }}">{{ $step->description }}</span>

                            </form>
                        </x-card>
                    @endforeach
                </div>
            </div>

        @endif


        @if ($idea->links)

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

        <x-idea.modal :idea="$idea" />
    </div>
</x-layout>
