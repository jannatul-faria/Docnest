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


            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home')}}"
                    class="text-sm font-bold text-slate-500 hover:text-primary transition-colors">
                    Home
                </a>
                <div class="relative group">
                    <button
                        class="flex items-center text-sm font-bold text-slate-500 hover:text-primary transition-colors py-3">
                        Specialties
                        <svg class="w-4 h-4 ml-1 group-hover:rotate-180 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div
                        class="absolute top-full left-0 w-64 bg-white border border-slate-100 rounded-2xl shadow-xl py-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all transform translate-y-2 group-hover:translate-y-0 z-50">
                        @foreach(\App\Models\Department::where('status', 1)->take(8)->get() as $dept)
                            <a href="{{ route('home') }}?department={{ $dept->slug }}"
                                class="block px-6 py-2.5 text-sm font-medium text-slate-600 hover:text-primary hover:bg-slate-50 transition-all">
                                {{ $dept->name }}
                            </a>
                        @endforeach
                        <div class="border-t border-slate-50 mt-2 pt-2">
                            <a href="{{ route('home') }}"
                                class="block px-6 py-2 text-xs font-bold text-primary uppercase tracking-widest hover:underline">View
                                All Specialties</a>
                        </div>
                    </div>
                </div>
                <a href="{{ route('doctors.index')}}"
                    class="text-sm font-bold text-slate-500 hover:text-primary transition-colors">
                    Doctors</a>

            </div>

            <div class="flex items-center space-x-4">
                @auth
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('wishlist.index') }}"
                            class="relative p-2 text-slate-500 hover:text-rose-500 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                            <span
                                class="absolute top-0 right-0 h-4 w-4 bg-rose-500 text-white text-[10px] font-black rounded-full flex items-center justify-center border-2 border-white">{{ Auth::user()->wishlists()->count() }}</span>
                        </a>
                        <a href="{{ route('dashboard') }}"
                            class="px-5 py-2.5 rounded-xl text-sm font-bold bg-primary/10 text-primary hover:bg-primary/20 transition-all">Dashboard</a>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-bold text-slate-600 hover:text-primary transition-colors px-4">Sign In</a>
                    <a href="{{ route('register') }}"
                        class="px-6 py-2.5 bg-primary text-white rounded-xl text-sm font-bold hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">Get
                        Started</a>
                @endauth
            </div>
        </div>
    </div>
</nav>