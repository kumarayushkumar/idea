<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Idea</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-background text-foreground">
    <x-layout.nav />
    <main class="container mx-auto py-8">{{ $slot }}</main>

    @session('success')
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition.opacity.duration.300ms
            class="bg-primary absolute bottom-4 right-4 text-sm text-white px-4 py-2 rounded-md">
            {{ session('success') }}
        </div>
    @endsession
</body>

</html>
