<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'DocNest - Find the Best Doctors Near You' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        outfit: ['Outfit', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .hero-gradient {
            background: radial-gradient(circle at top right, rgba(79, 70, 229, 0.08), transparent 40%),
                        radial-gradient(circle at bottom left, rgba(59, 130, 246, 0.05), transparent 40%);
        }
    </style>
</head>
<body class="antialiased bg-slate-50/50 text-slate-900">
    <!-- Navbar -->
    <nav class="glass-nav sticky top-0 z-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center group">
                        <div class="h-10 w-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <span class="ml-3 text-2xl font-black tracking-tight text-slate-900">Doc<span class="text-indigo-600">Nest</span></span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#departments" class="text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors">Specialties</a>
                    <a href="#featured" class="text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors">Top Doctors</a>
                    <a href="#" class="text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors">How it Works</a>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('wishlist.index') }}" class="relative p-2 text-slate-500 hover:text-rose-500 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                <span class="absolute top-0 right-0 h-4 w-4 bg-rose-500 text-white text-[10px] font-black rounded-full flex items-center justify-center border-2 border-white">{{ Auth::user()->wishlists()->count() }}</span>
                            </a>
                            <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition-all">Dashboard</a>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition-colors px-4">Sign In</a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">Get Started</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-100 pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-1">
                    <a href="#" class="flex items-center mb-6">
                        <div class="h-8 w-8 bg-indigo-600 rounded-lg flex items-center justify-center shadow-md">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <span class="ml-2 text-xl font-black text-slate-900">DocNest</span>
                    </a>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">
                        Empowering patients to find the best healthcare providers with ease and confidence.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="h-10 w-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-indigo-600 hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="h-10 w-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-indigo-600 hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-6">Quick Links</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-slate-500 hover:text-indigo-600 text-sm font-medium transition-colors">Search Doctors</a></li>
                        <li><a href="#" class="text-slate-500 hover:text-indigo-600 text-sm font-medium transition-colors">Departments</a></li>
                        <li><a href="#" class="text-slate-500 hover:text-indigo-600 text-sm font-medium transition-colors">How it Works</a></li>
                        <li><a href="#" class="text-slate-500 hover:text-indigo-600 text-sm font-medium transition-colors">FAQs</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-6">Support</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-slate-500 hover:text-indigo-600 text-sm font-medium transition-colors">Help Center</a></li>
                        <li><a href="#" class="text-slate-500 hover:text-indigo-600 text-sm font-medium transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="text-slate-500 hover:text-indigo-600 text-sm font-medium transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="text-slate-500 hover:text-indigo-600 text-sm font-medium transition-colors">Contact Us</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-6">Download App</h4>
                    <p class="text-slate-500 text-sm mb-6">Access healthcare on the go. Available soon on all platforms.</p>
                    <div class="flex flex-col space-y-3">
                        <div class="h-10 w-32 bg-slate-900 rounded-lg flex items-center justify-center text-white text-[10px] space-x-2">
                             <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.523 15.341c-.551 0-1 .449-1 1 0 .552.449 1 1 1 .552 0 1-.448 1-1 0-.551-.448-1-1-1zm-11.046 0c-.551 0-1 .449-1 1 0 .552.449 1 1 1 .552 0 1-.448 1-1 0-.551-.448-1-1-1zm14.477-4.102c-.313-.427-.751-.734-1.258-.887l-.463-.138c-.377-.113-.679-.408-.809-.789l-.164-.486c-.235-.694-.85-1.168-1.554-1.168-.184 0-.363.031-.532.091l-.101.037c-.365.133-.77.104-1.112-.08l-.442-.238c-.643-.347-1.423-.347-2.066 0l-.442.238c-.342.184-.747.213-1.112.08l-.101-.037c-.169-.06-.348-.091-.532-.091-.704 0-1.319.474-1.554 1.168l-.164.486c-.13.381-.432.676-.809.789l-.463.138c-.507.153-.945.46-1.258.887l-.286.388c-.232.316-.312.715-.221 1.1l.123.518c.094.394.043.806-.145 1.16l-.234.44c-.337.635-.337 1.396 0 2.031l.234.44c.188.354.239.766.145 1.16l-.123.518c-.091.385-.011.784.221 1.1l.286.388c.313.427.751.734 1.258.887l.463.138c.377.113.679.408.809.789l.164.486c.235.694.85 1.168 1.554 1.168.184 0 .363-.031.532-.091l.101-.037c.365-.133.77-.104 1.112.08l.442.238c.322.173.693.261 1.033.261s.711-.088 1.033-.261l.442-.238c.342-.184.747-.213 1.112-.08l.101.037c.169.06.348.091.532.091.704 0 1.319-.474 1.554-1.168l.164-.486c.13-.381.432-.676.809-.789l.463-.138c.507-.153.945-.46 1.258-.887l.286-.388c.232-.316.312-.715.221-1.1l-.123-.518c-.094-.394-.043-.806.145-1.16l.234-.44c.337-.635.337-1.396 0-2.031l-.234-.44c-.188-.354-.239-.766-.145-1.16l.123-.518c.091-.385.011-.784-.221-1.1l-.286-.388zm-2.023 6.659c-.551 0-1-.449-1-1 0-.552.449-1 1-1 .552 0 1 .448 1-1 0-.551-.448-1-1-1zm-6.046 0c-.551 0-1-.449-1-1 0-.552.449-1 1-1 .552 0 1 .448 1-1 0-.551-.448-1-1-1z"/></svg>
                             <span>App Store</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-slate-50 pt-10 flex flex-col md:flex-row justify-between items-center">
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">&copy; {{ date('Y') }} DocNest. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <span class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Built with Love for Healthcare</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
