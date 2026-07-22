<header class="border-b border-bg-600 bg-bg-900/80 backdrop-blur sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg bg-accent flex items-center justify-center text-white font-bold text-sm">
                PC
            </div>
            <span class="text-white font-semibold text-lg">PeopleCore</span>
        </a>

        <!-- Nav links -->
        <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
            <a href="#" class="hover:text-white transition">Features</a>
            <a href="{{ route('pricing') }}" class="hover:text-white transition">Pricing</a>
            <a href="#" class="hover:text-white transition">Contact</a>
        </nav>

        <!-- Auth CTAs -->
        <div class="flex items-center gap-3">
            <a href="#" class="text-sm font-medium text-gray-300 hover:text-white transition">
                Log in
            </a>
            <a href="#"
                class="bg-accent hover:bg-accent-light transition text-white text-sm font-medium px-4 py-2 rounded-lg">
                Get Started
            </a>
        </div>

    </div>
</header>
