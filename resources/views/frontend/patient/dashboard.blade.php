<x-frontend-layout>
    <x-slot:title>My Dashboard - DocNest</x-slot:title>

    <section class="py-12 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Sidebar -->
                <aside class="w-full md:w-80">
                    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm text-center">
                        <div class="h-24 w-24 bg-primary/10 text-primary rounded-full flex items-center justify-center font-black text-3xl mx-auto mb-6">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mb-1">{{ auth()->user()->name }}</h3>
                        <p class="text-xs font-bold text-slate-400 mb-8">{{ auth()->user()->email }}</p>
                        
                        <nav class="space-y-2">
                            <a href="{{ route('patient.dashboard') }}" class="block w-full py-4 px-6 bg-primary text-white rounded-2xl font-black text-xs uppercase tracking-widest text-center shadow-lg shadow-primary/20">
                                My Profile
                            </a>
                            <a href="{{ route('wishlist.index') }}" class="block w-full py-4 px-6 bg-slate-50 text-slate-600 rounded-2xl font-black text-xs uppercase tracking-widest text-center hover:bg-slate-100 transition-all">
                                My Wishlist
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full py-4 px-6 mt-4 text-rose-500 font-black text-xs uppercase tracking-widest hover:text-rose-600 transition-all">
                                    Logout
                                </button>
                            </form>
                        </nav>
                    </div>
                </aside>

                <!-- Main Content -->
                <div class="flex-1 space-y-8">
                    <div class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm">
                        <h2 class="text-2xl font-black text-slate-900 mb-8 tracking-tight">Profile Information</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2 block">Full Name</label>
                                <div class="p-4 bg-slate-50 rounded-2xl font-bold text-slate-700">{{ auth()->user()->name }}</div>
                            </div>
                            <div>
                                <label class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2 block">Email Address</label>
                                <div class="p-4 bg-slate-50 rounded-2xl font-bold text-slate-700">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm">
                        <h2 class="text-2xl font-black text-slate-900 mb-8 tracking-tight">Recent Activity</h2>
                        <div class="text-center py-12">
                            <div class="h-16 w-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <p class="text-slate-400 font-bold italic">No recent activity found.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-frontend-layout>
