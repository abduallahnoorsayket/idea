<x-layout>
    <x-form title="Register form" description="register from here">
        <form action="/register" method="POST" class="mt-10 space-y-4">
            @csrf
            <x-form.field label="Name" name="name" />
            <x-form.field label="Email" name="email" type="email" />
            <x-form.field label="Password" name="password" type="password" />

            <button type="submit" class="w-full btn btn-primary mt-4 h-10" data-test="register-btn">
                Register
            </button>
        </form>
    </x-form>
</x-layout>
