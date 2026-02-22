<nav class="border-b border-border px-6">
    <div class="container mx-auto flex items-center justify-between h-16">
        <a href="/" class="text-lg font-bold">Idea</a>
        <div class="flex gap-6 items-center">

            @auth
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" data-testId="logout-button" class="text-sm text-foreground/70 hover:text-foreground transition">Logout</button>
                </form>
            @endauth

            @guest
                <a href="/login" class="text-sm text-foreground/70 hover:text-foreground transition">Login</a>
                <a href="/register" class="btn">Register</a>
            @endguest
        </div>
    </div>
</nav>
