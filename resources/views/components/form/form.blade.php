@props(['title', 'description'])

<div class="container mx-auto py-16">
    <div class="max-w-md w-full mx-auto space-y-12">

        <div class="text-center space-y-2">
            <h1 class="font-bold text-3xl">{{ $title }}</h1>
            <p class="text-muted-foreground">{{ $description }}</p>
        </div>

        {{ $slot }}
    </div>
</div>
