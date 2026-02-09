<x-layout>
    <x-form title="Login form" description="Login from here">
        <form action="/login" method="POST" class="mt-10 space-y-4">
            @csrf
            <x-form.field label="Email" name="email" type="email" />
            <x-form.field label="Password" name="password" type="password" />

            <button type="submit" class="w-full btn btn-primary mt-4 h-10" data-test="login-btn">
                Login
            </button>
        </form>
    </x-form>
</x-layout>
