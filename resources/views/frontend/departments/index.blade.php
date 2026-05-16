<x-frontend-layout>
    <x-slot:title>Medical Departments - DocNest</x-slot:title>

    <section class="py-24 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-16 text-center max-w-3xl mx-auto">
                <h2 class="text-sm font-black text-primary uppercase tracking-[0.3em] mb-4">DocNest Specialities</h2>
                <h3 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                    Our Medical <span class="text-primary italic">Departments</span>
                </h3>
                <p class="text-slate-500 font-medium mt-6 leading-relaxed">
                    Explore our specialized medical departments. Each department is equipped with modern facilities and
                    world-class doctors dedicated to your health and recovery.
                </p>
            </div>

            <!-- Departments Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($departments as $dept)
                    <div
                        class="p-8 bg-white rounded-[2.5rem] border border-slate-100 hover:border-primary/30 transition-all group shadow-sm hover:shadow-2xl hover:shadow-primary/5">
                        <div
                            class="h-16 w-16 bg-slate-50 rounded-2xl flex items-center justify-center shadow-sm mb-6 group-hover:scale-110 group-hover:bg-primary/5 transition-all">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mb-4">{{ $dept->name }}</h3>
                        <p class="text-slate-500 text-[13px] leading-relaxed mb-8">
                            {{ $dept->description ?? 'Expert care in ' . $dept->name . ' with specialized doctors dedicated to your wellness and recovery.' }}
                        </p>

                        <div class="flex items-center justify-between mt-auto pt-6 border-t border-slate-50">
                            <div class="flex items-center gap-2">
                                <div class="h-2 w-2 rounded-full bg-primary animate-pulse"></div>
                                <span
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $dept->doctors_count }}
                                    Doctors</span>
                            </div>
                            <a href="{{ route('doctors.index', ['department_id' => $dept->id]) }}"
                                class="inline-flex items-center text-xs font-black text-primary uppercase tracking-widest hover:underline gap-2 group/link">
                                Explore
                                <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Call to Action -->
            <div
                class="mt-20 p-12 bg-primary rounded-[3rem] text-center relative overflow-hidden shadow-2xl shadow-primary/20">
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-64 h-64 bg-black/5 rounded-full translate-y-1/2 -translate-x-1/2 blur-3xl">
                </div>

                <p class="text-3xl md:text-3xl font-black text-white mb-4 relative z-10">Can't find a specific
                    department?</h4>
                <p class="text-white/80 font-medium mb-10 max-w-xl mx-auto relative z-10 text-sm">Our medical support
                    team is available 24/7 to help you find the right specialist for your specific healthcare needs.</p>
                <div class="flex flex-wrap items-center justify-center gap-4 relative z-10">
                    <a href="tel:{{ get_setting('contact_phone') }}"
                        class="px-8 py-4 bg-white text-primary rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-50 transition-all shadow-xl">
                        Call Support
                    </a>
                    <a href="{{ route('doctors.index') }}"
                        class="px-8 py-4 bg-primary-dark text-white rounded-2xl font-black text-xs uppercase tracking-widest border border-white/20 hover:bg-white/10 transition-all">
                        Search All Doctors
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-frontend-layout>