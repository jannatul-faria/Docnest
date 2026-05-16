<x-frontend-layout>
    <x-slot:title>DocNest - Find and Discovery Best Doctors</x-slot:title>

    <!-- Hero Section -->
    <section class="relative pt-20 pb-32 overflow-hidden hero-gradient">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto mb-16">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 border border-primary/20 mb-8 animate-bounce">
                    <span class="flex h-2 w-2 rounded-full bg-primary mr-3"></span>
                    <span class="text-xs font-black text-primary uppercase tracking-widest">Find your trusted doctor today</span>
                </div>
                <h1 class="text-5xl md:text-7xl font-black text-heading tracking-tight mb-8 leading-[1.1]">
                    Your Journey to <span class="text-primary">Better Health</span> Starts Here
                </h1>
                <p class="text-xl text-slate-500 font-medium leading-relaxed mb-12 max-w-2xl mx-auto">
                    Discover and save top-rated doctors across all specialties. Read reviews, check availability, and build your personalized healthcare network.
                </p>

                <!-- Search Box -->
                <form action="{{ route('doctors.index') }}" method="GET" class="max-w-3xl mx-auto p-2 bg-white rounded-[2rem] shadow-2xl shadow-primary/10 border border-slate-100 flex flex-col md:flex-row items-center gap-2">
                    <div class="flex-1 w-full flex items-center px-6 py-4">
                        <svg class="w-5 h-5 text-slate-300 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" name="search" placeholder="Search Doctor, Specialty..." class="w-full border-none focus:ring-0 font-bold text-slate-700 placeholder-slate-300">
                    </div>
                    <div class="hidden md:block w-px h-10 bg-slate-100"></div>
                    <div class="flex-[1.5] w-full flex flex-col relative">
                        <div class="flex items-center px-6 py-4 h-full">
                            <svg class="w-5 h-5 text-slate-300 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <input type="text" id="location-search" placeholder="Enter Location (City, Area...)" class="w-full border-none focus:ring-0 font-bold text-slate-700 placeholder-slate-300 bg-transparent" autocomplete="off">
                            <input type="hidden" name="division_id" id="hidden-division-id">
                            <input type="hidden" name="district_id" id="hidden-district-id">
                            <input type="hidden" name="area_id" id="hidden-area-id">
                        </div>
                        
                        <!-- Suggestions Dropdown -->
                        <div id="location-suggestions" class="absolute top-full left-0 right-0 mt-4 bg-white rounded-[1.5rem] shadow-2xl border border-slate-50 overflow-hidden hidden z-50 max-h-80 overflow-y-auto">
                            <!-- Results will be injected here -->
                        </div>
                    </div>
                    <button type="submit" class="w-full md:w-auto px-10 py-4 bg-primary text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">
                        Search
                    </button>
                </form>
            </div>

            <!-- Trusted Badges -->
            <div class="flex flex-wrap justify-center gap-8 md:gap-16 opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
                <div class="flex items-center space-x-2">
                    <div class="font-black text-slate-400 text-xl tracking-tighter">TRUST<span class="text-indigo-400">MED</span></div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="font-black text-slate-400 text-xl tracking-tighter">HEALTH<span class="text-indigo-400">CORE</span></div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="font-black text-slate-400 text-xl tracking-tighter">VITAL<span class="text-indigo-400">SCAN</span></div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="font-black text-slate-400 text-xl tracking-tighter">OMNI<span class="text-indigo-400">DOC</span></div>
                </div>
            </div>
        </div>

        <!-- Abstract Shapes -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-indigo-100/50 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 -right-24 w-64 h-64 bg-blue-100/30 rounded-full blur-3xl"></div>
    </section>

    <!-- Departments Section -->
    <section id="departments" class="py-20 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16">
                <div class="max-w-2xl">
                    <h2 class="text-sm font-black text-primary uppercase tracking-[0.3em] mb-2">Top Specialties</h2>
                    <h3 class="text-3xl md:text-4xl font-black text-heading tracking-tight leading-tight">
                        Explore Doctors by <span class="text-primary">Department</span>
                    </h3>
                </div>
                <a href="#" class="mt-6 md:mt-0 inline-flex items-center text-sm font-bold text-slate-400 hover:text-primary transition-colors group">
                    View All Specializations
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($departments as $dept)
                    <a href="{{ route('doctors.index', ['department_id' => $dept->id]) }}" class="group p-6 bg-slate-50 hover:bg-primary rounded-2xl transition-all duration-500 border border-slate-100 hover:border-primary hover:translate-y-[-8px] hover:shadow-2xl hover:shadow-primary/20">
                        <div class="h-14 w-14 bg-white group-hover:bg-primary/80 rounded-2xl flex items-center justify-center mb-4 shadow-sm transition-colors">
                            <svg class="w-6 h-6 text-primary group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <h4 class="text-lg font-black text-heading group-hover:text-white transition-colors tracking-tight">{{ $dept->name }}</h4>
                        <p class="text-[13px] font-bold text-slate-400 group-hover:text-primary-light transition-colors mt-1">{{ $dept->doctors_count }} Doctors</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Doctors Section -->
    <section id="featured" class="py-20 bg-slate-50/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <h2 class="text-sm font-black text-primary uppercase tracking-[0.3em] mb-2">Handpicked for you</h2>
                <h3 class="text-3xl md:text-4xl font-black text-heading tracking-tight leading-tight">
                    Discover Our <span class="text-primary">Top-Rated</span> Doctors
                </h3>
                <p class="text-slate-500 text-sm font-medium mt-4">
                    Highly experienced professionals recognized for their excellence in patient care and medical expertise.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredDoctors as $doctor)
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-primary/10 transition-all duration-500 border border-slate-100 flex flex-col">
                        <!-- Image Area -->
                        <div class="relative aspect-[4/3.5] overflow-hidden bg-slate-50">
                            @if($doctor->hasMedia('profile_image'))
                                <img src="{{ $doctor->getFirstMediaUrl('profile_image') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-200">
                                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"></path></svg>
                                </div>
                            @endif

                            <div onclick="toggleWishlist(this, {{ $doctor->id }})" class="absolute top-3 right-3 h-8 w-8 rounded-xl flex items-center justify-center shadow-lg cursor-pointer transition-all {{ in_array($doctor->id, $wishlistedIds) ? 'bg-rose-500 text-white' : 'bg-white/90 backdrop-blur-sm text-rose-500 hover:bg-rose-50' }}" title="Add to Wishlist">
                                <svg class="w-4 h-4 wishlist-icon" fill="{{ in_array($doctor->id, $wishlistedIds) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                            <div class="absolute bottom-3 left-3 px-3 py-1 bg-primary text-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-lg">
                                {{ $doctor->department->name }}
                            </div>
                        </div>

                        <!-- Content Area -->
                        <div class="p-4 flex-1 flex flex-col">
                            <h4 class="text-lg font-black text-slate-900 mb-0.5 tracking-tight leading-tight">
                                <a href="{{ route('doctors.show', $doctor->id) }}" class="hover:text-primary transition-colors">
                                    {{ $doctor->name }}
                                </a>
                            </h4>
                            <p class="text-[10px] font-black text-rose-500 uppercase tracking-widest mb-2">
                                {{ $doctor->department->name }}
                            </p>
                            
                            <p class="text-[13px] font-bold text-slate-500 leading-snug line-clamp-2 mb-4">
                                {{ $doctor->educations->pluck('degree')->implode(', ') }}
                                @if($doctor->specialization)
                                    - {{ $doctor->specialization }}
                                @endif
                            </p>

                            <div class="mt-auto">
                                <a href="{{ route('doctors.show', $doctor->id) }}" class="block w-full py-2.5 bg-slate-100 text-primary rounded-lg font-black text-[10px] uppercase tracking-widest text-center hover:bg-primary hover:text-white transition-all">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-16 text-center">
                <a href="{{ route('doctors.index') }}" class="inline-flex items-center px-10 py-4 border-2 border-slate-200 text-slate-600 rounded-2xl font-black text-sm uppercase tracking-widest hover:border-primary hover:text-primary transition-all">
                    Show All Doctors
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-24 bg-primary relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
                <div class="space-y-2">
                    <div class="text-4xl md:text-6xl font-black text-white tracking-tighter">500+</div>
                    <div class="text-white/60 text-xs font-black uppercase tracking-widest">Specialist Doctors</div>
                </div>
                <div class="space-y-2">
                    <div class="text-4xl md:text-6xl font-black text-white tracking-tighter">25+</div>
                    <div class="text-white/60 text-xs font-black uppercase tracking-widest">Medical Branches</div>
                </div>
                <div class="space-y-2">
                    <div class="text-4xl md:text-6xl font-black text-white tracking-tighter">10k+</div>
                    <div class="text-white/60 text-xs font-black uppercase tracking-widest">Satisfied Users</div>
                </div>
                <div class="space-y-2">
                    <div class="text-4xl md:text-6xl font-black text-white tracking-tighter">4.9</div>
                    <div class="text-white/60 text-xs font-black uppercase tracking-widest">Average Rating</div>
                </div>
            </div>
        </div>
        
        <!-- Decoration -->
        <div class="absolute top-0 right-0 w-1/3 h-full bg-indigo-500 skew-x-[-15deg] translate-x-1/2"></div>
    </section>

    <!-- CTA Section -->
    <section class="py-32 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-slate-900 rounded-[3rem] p-12 md:p-20 text-center relative overflow-hidden shadow-2xl">
                <div class="relative z-10">
                    <h3 class="text-4xl md:text-5xl font-black text-white mb-8 tracking-tight">Are You a <span class="text-primary/80">Professional</span> Doctor?</h3>
                    <p class="text-slate-400 text-lg mb-12 max-w-2xl mx-auto font-medium">
                        Join our network of healthcare providers and reach thousands of patients looking for your expertise.
                    </p>
                    <div class="flex flex-col md:flex-row justify-center gap-4">
                        <a href="{{ route('register') }}" class="px-12 py-5 bg-primary text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-primary/90 transition-all shadow-xl shadow-primary/20">
                            Apply as Doctor
                        </a>
                        <a href="#" class="px-12 py-5 bg-white text-heading rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-slate-50 transition-all">
                            Learn More
                        </a>
                    </div>
                </div>
                <!-- Abstract BG -->
                <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl"></div>
                <div class="absolute -top-24 -left-24 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl"></div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
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
                const icon = el.querySelector('.wishlist-icon');
                if (data.status === 'added') {
                    el.classList.remove('bg-white', 'text-rose-500', 'hover:bg-rose-50');
                    el.classList.add('bg-rose-500', 'text-white');
                    icon.setAttribute('fill', 'currentColor');
                } else {
                    el.classList.remove('bg-rose-500', 'text-white');
                    el.classList.add('bg-white', 'text-rose-500', 'hover:bg-rose-50');
                    icon.setAttribute('fill', 'none');
                }
            })
            .catch(err => {
                console.error("Wishlist toggle failed:", err);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const locationInput = document.getElementById('location-search');
            const suggestionsContainer = document.getElementById('location-suggestions');
            const hiddenDivision = document.getElementById('hidden-division-id');
            const hiddenDistrict = document.getElementById('hidden-district-id');
            const hiddenArea = document.getElementById('hidden-area-id');

            let debounceTimer;

            if (locationInput) {
                locationInput.addEventListener('input', function() {
                    const query = this.value;
                    
                    // Reset hiddens when user types
                    hiddenDivision.value = '';
                    hiddenDistrict.value = '';
                    hiddenArea.value = '';

                    clearTimeout(debounceTimer);
                    
                    if (query.length < 2) {
                        suggestionsContainer.classList.add('hidden');
                        return;
                    }

                    debounceTimer = setTimeout(() => {
                        fetch(`/api/locations/search?query=${encodeURIComponent(query)}`)
                            .then(res => res.json())
                            .then(data => {
                                if (data.length > 0) {
                                    suggestionsContainer.innerHTML = '';
                                    data.forEach(item => {
                                        const div = document.createElement('div');
                                        div.className = 'px-6 py-4 hover:bg-indigo-50 cursor-pointer transition-colors border-b border-slate-50 last:border-none flex items-center gap-3 group';
                                        
                                        let icon = '<svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>';
                                        
                                        div.innerHTML = `
                                            ${icon}
                                            <div>
                                                <div class="text-sm font-bold text-slate-700 group-hover:text-indigo-600">${item.display}</div>
                                            </div>
                                        `;
                                        
                                        div.addEventListener('click', () => {
                                            locationInput.value = item.name;
                                            
                                            // Reset hiddens
                                            hiddenDivision.value = '';
                                            hiddenDistrict.value = '';
                                            hiddenArea.value = '';
                                            
                                            // Set specific hidden
                                            if (item.type === 'division') hiddenDivision.value = item.id;
                                            if (item.type === 'district') hiddenDistrict.value = item.id;
                                            if (item.type === 'area') hiddenArea.value = item.id;
                                            
                                            suggestionsContainer.classList.add('hidden');
                                        });
                                        suggestionsContainer.appendChild(div);
                                    });
                                    suggestionsContainer.classList.remove('hidden');
                                } else {
                                    suggestionsContainer.classList.add('hidden');
                                }
                            });
                    }, 300);
                });

                // Close suggestions when clicking outside
                document.addEventListener('click', function(e) {
                    if (!locationInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
                        suggestionsContainer.classList.add('hidden');
                    }
                });
            }
        });
    </script>
    @endpush
</x-frontend-layout>
