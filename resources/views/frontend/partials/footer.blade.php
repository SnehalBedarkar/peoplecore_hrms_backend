<footer class="border-t border-bg-600 bg-bg-800 mt-20">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-10">

            <div class="col-span-2">
                <div class="flex items-center gap-2.5 mb-3">
                    <div
                        class="w-8 h-8 rounded-lg bg-accent flex items-center justify-center text-white font-bold text-sm">
                        PC
                    </div>
                    <span class="text-white font-semibold text-lg">PeopleCore</span>
                </div>
                <p class="text-sm text-gray-500 max-w-xs">
                    Modern HR management built for growing teams — attendance, leave, payroll, all in one place.
                </p>
            </div>

            <div>
                <p class="text-white font-medium text-sm mb-3">Product</p>
                <div class="space-y-2 text-sm text-gray-500">
                    <a href="#" class="block hover:text-gray-300 transition">Features</a>
                    <a href="{{ route('pricing') }}" class="block hover:text-gray-300 transition">Pricing</a>
                </div>
            </div>

            <div>
                <p class="text-white font-medium text-sm mb-3">Company</p>
                <div class="space-y-2 text-sm text-gray-500">
                    <a href="#" class="block hover:text-gray-300 transition">Contact</a>
                    <a href="#" class="block hover:text-gray-300 transition">Privacy Policy</a>
                </div>
            </div>

        </div>

        <div class="border-t border-bg-600 pt-6 text-center text-xs text-gray-600">
            &copy; {{ date('Y') }} PeopleCore HRMS. All rights reserved.
        </div>
    </div>
</footer>
