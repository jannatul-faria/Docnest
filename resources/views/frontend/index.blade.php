<x-frontend-layout>
    <x-slot:title>DocNest - Search The Best Doctors</x-slot:title>

    <!-- Hero Section -->
    <section class="relative pt-12 pb-20 overflow-hidden bg-slate-50/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="max-w-xl">
                    <div
                        class="inline-flex items-center px-4 py-1.5 rounded-full bg-primary/10 border border-primary/20 mb-6">
                        <span class="flex h-2 w-2 rounded-full bg-primary mr-2 animate-pulse"></span>
                        <span class="text-[10px] font-black text-primary uppercase tracking-[0.2em]">Leading Healthcare
                            Network</span>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-black text-[#0f172a] tracking-tight mb-6 leading-[1.1]">
                        Search The <br>
                        <span class="text-primary italic">Best Doctors</span>
                    </h1>
                    <p class="text-slate-500 font-medium leading-relaxed mb-10 text-sm max-w-md">
                        Experience world-class healthcare with our network of certified specialists. Read reviews, check
                        availability, and build your personalized healthcare network.
                    </p>

                    <!-- Search Box Grid -->
                    <form action="{{ route('doctors.index') }}" method="GET"
                        class="bg-white p-6 rounded-[2.5rem] shadow-2xl shadow-primary/5 border border-slate-100">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <!-- Division -->
                            <div class="relative group">
                                <label
                                    class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-4">Division</label>
                                <div class="relative">
                                    <select name="division_id" id="division-select"
                                        class="w-full pl-12 pr-6 py-3.5 bg-slate-50 border-none rounded-2xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-primary/20 appearance-none transition-all">
                                        <option value="">Select Division</option>
                                        @foreach($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-primary">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                        <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- District -->
                            <div class="relative group">
                                <label
                                    class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-4">District</label>
                                <div class="relative">
                                    <select name="district_id" id="district-select"
                                        class="w-full pl-12 pr-6 py-3.5 bg-slate-50 border-none rounded-2xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-primary/20 appearance-none transition-all">
                                        <option value="">Select District</option>
                                    </select>
                                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-primary">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                        <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Speciality -->
                            <div class="relative group">
                                <label
                                    class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-4">Speciality</label>
                                <div class="relative">
                                    <select name="department_id"
                                        class="w-full pl-12 pr-6 py-3.5 bg-slate-50 border-none rounded-2xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-primary/20 appearance-none transition-all">
                                        <option value="">Select Category</option>
                                        @foreach($departments as $dept)
                                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-primary">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                        <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Doctor -->
                            <div class="relative group">
                                <label
                                    class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-4">Doctor
                                    Name</label>
                                <div class="relative">
                                    <input type="text" name="search" placeholder="Search..."
                                        class="w-full pl-12 pr-6 py-3.5 bg-slate-50 border-none rounded-2xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-primary/20 transition-all placeholder-slate-300">
                                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-primary">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full py-4 bg-primary text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-primary/90 transition-all shadow-xl shadow-primary/20 flex items-center justify-center gap-3">
                            Search Available Doctors
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Right Image -->
                <div class="relative hidden lg:block">
                    <div class="relative z-10 rounded-[3rem] overflow-hidden shadow-2xl border-8 border-white">
                        <img src="{{ asset('assets/images/hero-doctor.png') }}" alt="Best Doctor" class="w-full h-auto">

                        <!-- Floating Stats -->
                        <div
                            class="absolute bottom-10 left-10 right-10 bg-white/80 backdrop-blur-md p-6 rounded-3xl border border-white/50 shadow-xl flex items-center gap-4 animate-bounce-slow">
                            <div
                                class="h-12 w-12 bg-primary/20 rounded-full flex items-center justify-center text-primary">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-black text-slate-900 leading-none">500+</h4>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Verified
                                    Doctors</p>
                            </div>
                        </div>
                    </div>

                    <!-- Background Shapes -->
                    <div class="absolute -top-10 -right-10 w-64 h-64 bg-primary/5 rounded-full blur-3xl -z-10"></div>
                    <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-blue-100/30 rounded-full blur-3xl -z-10">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Top Rated Doctors -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight mb-4">Our Top Rated Doctors
                </h2>
                <p class="text-slate-500 font-medium text-sm">Meet the world-class doctors, best known for
                    their clinical excellence.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredDoctors as $doctor)
                    <div
                        class="group bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 hover:shadow-2xl transition-all duration-500 flex flex-col">
                        <div class="relative aspect-[4/5] overflow-hidden bg-slate-50">
                            @if($doctor->hasMedia('profile_image'))
                                <img src="{{ $doctor->getFirstMediaUrl('profile_image') }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <img src="{{ asset('assets/images/default-doctor.png') }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-80">
                            @endif
                            <div class="absolute top-4 left-4">
                                <span
                                    class="px-4 py-1.5 bg-primary/90 backdrop-blur-sm text-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-lg">Featured</span>
                            </div>
                            <div onclick="toggleWishlist(this, {{ $doctor->id }})"
                                class="absolute top-4 right-4 h-10 w-10 bg-white/90 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-lg cursor-pointer hover:bg-rose-50 transition-all text-rose-500 {{ in_array($doctor->id, $wishlistedIds) ? 'bg-rose-50' : '' }}">
                                <svg class="w-5 h-5"
                                    fill="{{ in_array($doctor->id, $wishlistedIds) ? 'currentColor' : 'none' }}"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <p class="text-[10px] font-black text-primary uppercase tracking-widest mb-2">
                                {{ $doctor->department->name }}
                            </p>
                            <h4 class="text-xl font-black text-slate-900 mb-2 leading-tight">
                                <a href="{{ route('doctors.show', $doctor->id) }}"
                                    class="hover:text-primary transition-colors">{{ $doctor->name }}</a>
                            </h4>
                            <p class="text-xs font-bold text-slate-500 line-clamp-2 mb-6">
                                {{ $doctor->educations->pluck('degree')->implode(', ') }}
                            </p>
                            <a href="{{ route('doctors.show', $doctor->id) }}"
                                class="mt-auto w-full py-3.5 bg-primary text-white rounded-2xl font-black text-[10px] uppercase tracking-widest text-center hover:bg-primary/90 transition-all shadow-lg shadow-primary/10">
                                Book Appointment
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All Doctors Button -->
            @if($totalDoctorsCount > 8)
                <div class="mt-16 text-center">
                    <a href="{{ route('doctors.index') }}"
                        class="inline-flex items-center px-8 py-4 bg-primary text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-primary/90 transition-all shadow-xl shadow-primary/20 gap-3">
                        View All Doctors
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>
    <!-- Our Departments Section -->
    <section class="py-24 bg-slate-50/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16">
                <div class="max-w-2xl text-center md:text-left">
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight mb-4">Our Departments</h2>
                    <p class="text-slate-500 font-medium text-sm">Choose from more than 20 medical specialties focused
                        on your health.</p>
                </div>
                <a href="{{ route('departments.index') }}"
                    class="mt-8 md:mt-0 px-8 py-3 border-2 border-primary text-primary rounded-xl font-black text-xs uppercase tracking-widest hover:bg-primary hover:text-white transition-all">
                    View All Departments
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($departments as $dept)
                    <div
                        class="p-8 bg-slate-50 rounded-[2.5rem] border border-slate-100 hover:border-primary/30 transition-all group">
                        <div
                            class="h-16 w-16 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mb-4">{{ $dept->name }}</h3>
                        <p class="text-slate-500 text-[13px] leading-relaxed mb-6">Expert care in {{ $dept->name }} with
                            specialized doctors dedicated to your wellness and recovery.</p>
                        <a href="{{ route('doctors.index', ['department_id' => $dept->id]) }}"
                            class="inline-flex items-center text-xs font-black text-primary uppercase tracking-widest hover:underline gap-2 group/link">
                            Learn More
                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Our Services Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight mb-4">Our Services</h2>
                <p class="text-slate-500 font-medium text-sm">We offer a wide range of healthcare services to make your
                    life easier and healthier.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Doctors -->
                <div
                    class="p-8 bg-slate-50 rounded-[2.5rem] border border-slate-100 hover:border-primary/30 transition-all group">
                    <div
                        class="h-16 w-16 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Doctors</h3>
                    <p class="text-slate-500 text-[13px] leading-relaxed mb-6">Find the right specialist for your health
                        needs and book an appointment instantly.</p>
                    <!-- <a href="{{ route('doctors.index') }}"
                        class="inline-flex items-center text-xs font-black text-primary uppercase tracking-widest hover:underline gap-2 group/link">
                        Learn More
                        <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a> -->
                </div>

                <!-- Surgery Support -->
                <div
                    class="p-8 bg-slate-50 rounded-[2.5rem] border border-slate-100 hover:border-primary/30 transition-all group">
                    <div
                        class="h-16 w-16 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Surgery Support</h3>
                    <p class="text-slate-500 text-[13px] leading-relaxed mb-6">Expert guidance and support through your
                        surgical journey with top specialists.</p>
                    <!-- <a href="#"
                        class="inline-flex items-center text-xs font-black text-primary uppercase tracking-widest hover:underline gap-2 group/link">
                        Learn More
                        <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a> -->
                </div>

                <!-- Hospital & Diagnostic -->
                <div
                    class="p-8 bg-slate-50 rounded-[2.5rem] border border-slate-100 hover:border-primary/30 transition-all group">
                    <div
                        class="h-16 w-16 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a2 2 0 00-1.96 1.414l-.727 2.903a2 2 0 01-1.542 1.488 2.03 2.03 0 01-1.554-.158L8.13 18.13l-1.936-1.936 2.103-2.103a2.03 2.03 0 011.554-.158 2 2 0 011.488 1.542l.727 2.903a2 2 0 01-1.542 1.488 2.03 2.03 0 01-.158 1.554l-2.103 2.103-1.936-1.936-1.936-1.936 2.103-2.103a2.03 2.03 0 011.554-.158 2 2 0 011.488 1.542l.727 2.903a2 2 0 001.414 1.96l2.903.727a2 2 0 011.488 1.542 2.03 2.03 0 01-.158 1.554l-2.103 2.103">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Diagnostic</h3>
                    <p class="text-slate-500 text-[13px] leading-relaxed mb-6">Build access to leading diagnostic
                        centers and labs in local hospital facilities.</p>
                    <!-- <a href="#"
                        class="inline-flex items-center text-xs font-black text-primary uppercase tracking-widest hover:underline gap-2 group/link">
                        Learn More
                        <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a> -->
                </div>

                <!-- Home Health Service -->
                <div
                    class="p-8 bg-slate-50 rounded-[2.5rem] border border-slate-100 hover:border-primary/30 transition-all group">
                    <div
                        class="h-16 w-16 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Home Health</h3>
                    <p class="text-slate-500 text-[13px] leading-relaxed mb-6">Get professional medical care in the
                        comfort of your home with our mobile team.</p>
                    <!-- <a href="#"
                        class="inline-flex items-center text-xs font-black text-primary uppercase tracking-widest hover:underline gap-2 group/link">
                        Learn More
                        <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a> -->
                </div>
            </div>
        </div>
    </section>






    @push('scripts')
        <script>
            // Division to District AJAX
            document.getElementById('division-select').addEventListener('change', function () {
                const divisionId = this.value;
                const districtSelect = document.getElementById('district-select');

                districtSelect.innerHTML = '<option value="">Loading...</option>';

                if (!divisionId) {
                    districtSelect.innerHTML = '<option value="">Select District</option>';
                    return;
                }

                fetch(`/api/districts?division_id=${divisionId}`)
                    .then(res => res.json())
                    .then(data => {
                        districtSelect.innerHTML = '<option value="">Select District</option>';
                        data.forEach(district => {
                            const option = document.createElement('option');
                            option.value = district.id;
                            option.textContent = district.name;
                            districtSelect.appendChild(option);
                        });
                    })
                    .catch(err => {
                        districtSelect.innerHTML = '<option value="">Select District</option>';
                        console.error("Failed to fetch districts:", err);
                    });
            });

            function toggleWishlist(el, doctorId) {
                @guest
                    window.location.href = "{{ route('login') }}";
                    return;
                @endguest

                fetch("{{ route('wishlist.toggle') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ doctor_id: doctorId })
                })
                    .then(res => res.json())
                    .then(data => {
                        const icon = el.querySelector('svg');
                        const countEl = document.getElementById('wishlist-count');

                        if (data.status === 'added') {
                            el.classList.add('bg-rose-50');
                            icon.setAttribute('fill', 'currentColor');
                        } else {
                            el.classList.remove('bg-rose-50');
                            icon.setAttribute('fill', 'none');
                        }

                        if (countEl && data.count !== undefined) {
                            countEl.textContent = data.count;
                        }
                    });
            }
        </script>
    @endpush

    <style>
        .animate-bounce-slow {
            animation: bounce 3s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(-5%);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }

            50% {
                transform: translateY(0);
                animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
        }
    </style>
</x-frontend-layout>