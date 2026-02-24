@props(['idea' => new App\Models\Idea()])

<x-modal name="{{ $idea->exists ? 'edit-idea' : 'create-idea' }}"
    title="{{ $idea->exists ? 'Edit Idea' : 'Create New Idea' }}">
    <form x-data="{ status: @js(old('status', $idea->status?->value)), newLink: '', links: @js(old('links', $idea->links) ?? []), newStep: '', steps: @js(old('steps', $idea->steps->map->only(['id', 'description', 'is_completed']))), hasImage: false }" action="{{ $idea->exists ? route('idea.update', $idea) : route('idea.store') }}"
        method="POST" class="space-y-6"
        x-bind:enctype="hasImage ? 'multipart/form-data' : 'application/x-www-form-urlencoded'">
        @csrf

        @if ($idea->exists)
            @method('PATCH')
        @endif

        <x-form.field label="Title" name="title" :value="$idea->title" placeholder="Enter an Idea title" autofocus
            required />

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

        <x-form.field label="Description" type="textarea" :value="$idea->description" name="description"
            placeholder="Describe your idea" />

        <div class="space-y-2">
            <label for="image" class="label">Featured Image</label>


            @if ($idea->image_path)
                <div class="space-y-2">
                    <img src="{{ asset('storage/' . $idea->image_path) }}" alt="Idea Image"
                        class="w-full h-auto object-cover rounded-lg">

                    <button form="delete-image-form" class="btn btn-outlined w-full"
                        @click="hasImage = false">Remove</button>
                </div>
            @endif

            <input type="file" name="image" class="label" accept="image/*"
                @change="hasImage = $event.target.files.length > 0">
            <x-form.error name="image" />
        </div>

        <div>
            <fieldset class="space-y-3">
                <legend class="label">Steps</legend>

                <template x-for="(step, index) in steps" :key="index">
                    <div class="flex gap-2 items-center">
                        <input type="text" :name="`steps[${index}][description]`" x-model="step.description"
                            class="input" readonly>
                        <input type="hidden" :name="`steps[${index}][is_completed]`"
                            x-model="step.is_completed ? '1' : '0'" class="input">
                        <button @click="steps.splice(index, 1)" type="button"
                            data-testId="create-idea-modal-remove-step-button" aria-label="remove step">
                            <x-icons.add class="rotate-45" />
                        </button>
                    </div>
                </template>

                <div class="flex gap-2 items-center">
                    <input x-model="newStep" id="new-step" spellcheck="false" class="input flex-1"
                        placeholder="What need to be done?" data-testId="create-idea-modal-step-input">
                    <button
                        @click="
                    steps.push({ description: newStep.trim(), is_completed: false}),
                    newStep = ''
                    "
                        type="button" :disabled="newStep.trim().length === 0"
                        data-testId="create-idea-modal-add-step-button" aria-label="add new step button">
                        <x-icons.add ::class="newStep.trim().length === 0 ? 'opacity-50' : ''" />
                    </button>
                </div>

                {{-- <pre x-text="JSON.stringify(links, null, 2)"></pre> --}}
            </fieldset>
        </div>

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
                    <input x-model="newLink" type="url" id="new-link" autocomplete="url" spellcheck="false"
                        placeholder="http://example.com" class="input flex-1"
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
            <button type="submit" data-testId="create-idea-modal-submit-button"
                class="btn">{{ $idea->exists ? 'Update Idea' : 'Create Idea' }}</button>
        </div>
    </form>

    @if ($idea->image_path)
        <form action="{{ route('ideas.image.destroy', $idea) }}" method="post" id="delete-image-form">
            @csrf
            @method('DELETE')
        </form>
    @endif
</x-modal>
