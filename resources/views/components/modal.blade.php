@props(['name', 'title'])

<div x-data="{ show: false, name: @js($name) }" x-show="show" @open-model.window="show = $event.detail === name"
@close-model.window="show = $event.detail === name ? false : show"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs"
    @keydown.escape.window="show = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" style="display:none" role="dialog" aria-modal="true"
    aria-labelledby="modal-{{ $name }}" tabindex="-1" :aria-hidden="!show">
    <x-card @click.away="show = false" class="max-w-2xl w-full max-h-[80vh] overflow-auto shadow-xl">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl" id="modal-{{ $name }}">{{ $title }}</h2>

            <button @click="show = false" aria-label="close modal">
                <x-icons.close />
            </button>
        </div>
        <div class="mt-6">
            {{ $slot }}
        </div>
    </x-card>
</div>
