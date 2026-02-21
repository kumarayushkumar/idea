<x-layout>
    <x-form title="Register an account" description="Start tracking your Ideas">
        <form action="/register" method="POST" class="space-y-4">
            @csrf

            <x-form.field label="Name" name="name" type="text" placeholder="John Doe" />

            <x-form.field label="Email" name="email" type="email" placeholder="john@gmail.com" />

            <x-form.field label="Password" name="password" type="password" placeholder="********" />

            <button type="submit" class="btn mt-2 h-10 w-full">Create Account</button>

        </form>
    </x-form>
</x-layout>
