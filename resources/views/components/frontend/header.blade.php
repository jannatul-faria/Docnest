<!-- Navbar -->
<nav class="glass-nav sticky top-0 z-50 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center group">
                    @if(get_setting('logo'))
                        <img src="{{ asset('storage/' . get_setting('logo')) }}"
                            alt="{{ get_setting('site_name', 'DocNest') }}" class="h-10 w-auto">
                    @else
                        <div
                            class="h-10 w-10 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-primary/20 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <span
                            class="ml-3 text-2xl font-black tracking-tight text-heading">{{ get_setting('site_name', 'DocNest') }}</span>
                    @endif
                </a>
            </div>


            <div class="hidden md:flex flex-grow justify-center items-center space-x-8">
                <a href="{{ route('home') }}"
                    class="text-sm font-bold {{ request()->routeIs('home') ? 'text-primary' : 'text-slate-500' }} hover:text-primary transition-colors">Home</a>
                <a href="{{ route('doctors.index') }}"
                    class="text-sm font-bold {{ request()->routeIs('doctors.index') ? 'text-primary' : 'text-slate-500' }} hover:text-primary transition-colors">Doctors</a>
                <a href="{{ route('departments.index') }}"
                    class="text-sm font-bold {{ request()->routeIs('departments.index') ? 'text-primary' : 'text-slate-500' }} hover:text-primary transition-colors">Departments</a>
                <a href="{{ route('about') }}"
                    class="text-sm font-bold {{ request()->routeIs('about') ? 'text-primary' : 'text-slate-500' }} hover:text-primary transition-colors">About Us</a>
            </div>

            <div class="flex items-center space-x-4">
                <a href="tel:{{ get_setting('contact_phone') }}"
                    class="hidden lg:flex items-center space-x-2 px-6 py-2.5 bg-primary text-white rounded-full text-sm font-bold hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">
                    <div class="h-6 w-6 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M6.176 1.106c2.196-.516 4.463.805 4.978 3.001l.611 2.608c.241 1.026-.145 2.101-.986 2.684l-1.742 1.206c1.173 2.456 3.161 4.444 5.617 5.617l1.206-1.742c.583-.841 1.658-1.227 2.684-.986l2.608.611c2.196.516 3.517 2.782 3.001 4.978l-1.015 4.318c-.407 1.733-1.954 2.946-3.737 2.946-12.015 0-21.751-9.736-21.751-21.751 0-1.783 1.213-3.33 2.946-3.737l4.318-1.015z" />
                        </svg>
                    </div>
                    <span>Emergency: {{ get_setting('contact_phone') }}</span>
                </a>

                @auth
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('wishlist.index') }}"
                            class="relative p-2 text-slate-500 hover:text-rose-500 transition-colors group">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                            <span id="wishlist-count"
                                class="absolute top-0 right-0 h-4 w-4 bg-rose-500 text-white text-[10px] font-black rounded-full flex items-center justify-center border-2 border-white">{{ Auth::user()->wishlists()->count() }}</span>
                        </a>
                        <a href="{{ route('dashboard') }}" class="p-2 text-slate-500 hover:text-primary transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </a>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-bold text-slate-600 hover:text-primary transition-colors px-2">Sign In</a>
                @endauth
            </div>
        </div>
    </div>
</nav>