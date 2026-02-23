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
                        <h3 class="text-foreground font-bold text-lg"> {{ $idea->title }}</h3>
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
        <x-modal name="create-idea" title="Create New Idea" data-testId="create-idea-modal">
            <form x-data="{ status: 'pending', newLink: '', links: [] }" action="{{ route('idea.store') }}" method="POST" class="space-y-6">
                @csrf

                <x-form.field label="Title" name="title" placeholder="Enter an Idea title" autofocus required />

                <div class="space-y-2">
                    <label for="status" class="label">Status</label>

                    <div class="flex gap-3 py-2">
                        @foreach (App\IdeaStatus::cases() as $status)
                            <button data-testId="button-status-{{ $status->value }}" class="btn flex-1" type="button"
                                @click="status = '{{ $status->value }}'"
                                :class="status === '{{ $status->value }}' ? '' : 'btn-outlined'">{{ $status->label() }}</button>
                        @endforeach
                        <input type="text" name="status" id="status" class="hidden" :value="status">
                    </div>
                    <x-form.error name="status" />
                </div>

                <x-form.field label="Description" type="textarea" name="description" placeholder="Describe your idea" />


                <div>
                    <fieldset class="space-y-3">
                        <legend class="label">Links</legend>

                        <template x-for="(link,index) in links" :key="link">
                            <div class="flex gap-2 items-center">
                                <input type="text" name="links[]" x-model="link" class="input">
                                <button @click="links.splice(index, 1)" type="button"
                                    data-testId="create-idea-modal-remove-link-button" aria-label="remove link">
                                    <x-icons.add class="rotate-45" />
                                </button>
                            </div>
                        </template>

                        <div class="flex gap-2 items-center">
                            <input x-model="newLink" type="url" name="links[]" id="new-link" autocomplete="url"
                                spellcheck="false" placeholder="http://example.com" class="input flex-1"
                                data-testId="create-idea-modal-link-input">
                            <button @click="links.push(newLink), newLink = ''" type="button"
                                :disabled="newLink.trim().length === 0" data-testId="create-idea-modal-add-link-button"
                                aria-label="add new link button">
                                <x-icons.add ::class="newLink.trim().length === 0 ? 'opacity-50' : ''" />
                            </button>
                        </div>

                        {{-- <pre x-text="JSON.stringify(links, null, 2)"></pre> --}}
                    </fieldset>
                </div>
                <div class="flex justify-end gap-5">
                    <button type="button" class="btn btn-outlined"
                        @click="$dispatch('close-model','create-idea')">Cancel</button>
                    <button type="submit" data-testId="create-idea-modal-submit-button" class="btn">Create
                        Idea</button>
                </div>
            </form>
        </x-modal>

    </div>
</x-layout>
