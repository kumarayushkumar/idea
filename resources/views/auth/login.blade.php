<x-layout>
    <x-form title="Login to your account" description="Continue tracking your Ideas">
        <form action="/login" method="POST" class="space-y-4">
            @csrf

            <x-form.field label="Email" name="email" type="email" placeholder="john@gmail.com" />

            <x-form.field label="Password" name="password" type="password" placeholder="********" />

            <button type="submit" class="btn mt-2 h-10 w-full">Login</button>

        </form>
    </x-form>
</x-layout>
