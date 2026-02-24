<x-layout>
    <x-form title="Edit Profile" description="Update your profile information">
        <form action={{ route('profile.edit') }} method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            <x-form.field label="Name" name="name" type="text" :value="old('name', $user->name)" placeholder="John Doe" />

            <x-form.field label="Email" name="email" type="email" :value="old('email', $user->email)" placeholder="john@gmail.com" />

            <x-form.field label="New password" name="password" type="password" placeholder="********" />

            <button type="submit" data-testId="edit-profile-button" class="btn mt-2 h-10 w-full">Update Profile
            </button>

        </form>
    </x-form>
</x-layout>
