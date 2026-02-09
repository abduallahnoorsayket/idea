<nav class="border-b border-border px-6">
    <div class="max-w-7xl mx-auto h-16 flex items-center justify-between">
        <div>
            <a href="">
                <img src="/images/idea-logo.png" alt="Idea logo" width="100">
            </a>
        </div>
        <div class="flex gap-x-5 items-center">
            @guest
                <a href="/login">Sign In</a>
                <a href="/register" class="btn">Register</a>
            @endguest

            @auth
                <form action="/logout" method="POST" class="space-y-2">
                    @csrf
                    <button type="submit" class="w-full btn btn-primary h-10" data-test="logout">
                        Logout
                    </button>
                </form>

            @endauth

        </div>
    </div>
</nav>
