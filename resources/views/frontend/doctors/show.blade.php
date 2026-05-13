<x-frontend-layout>
    <x-slot:title>{{ $doctor->user->name }} - {{ $doctor->specialization }} | DocNest</x-slot:title>

    <section class="py-12 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex mb-8 text-sm font-bold uppercase tracking-widest text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-indigo-600 transition-colors">Home</a>
                <span class="mx-3 text-slate-200">/</span>
                <a href="{{ route('doctors.index') }}" class="hover:text-indigo-600 transition-colors">Doctors</a>
                <span class="mx-3 text-slate-200">/</span>
                <span class="text-slate-900">{{ $doctor->user->name }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <!-- Left Column: Profile Card & Info -->
                <div class="lg:col-span-4 space-y-8">
                    <div class="bg-white rounded-[3rem] p-8 border border-slate-100 shadow-sm relative overflow-hidden">
                        <div class="relative z-10">
                            <div class="aspect-square rounded-[2.5rem] overflow-hidden bg-slate-100 mb-8 border-4 border-slate-50 shadow-inner">
                                @if($doctor->hasMedia('profile_image'))
                                    <img src="{{ $doctor->getFirstMediaUrl('profile_image') }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-200">
                                        <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"></path></svg>
                                    </div>
                                @endif
                            </div>

                            <div class="text-center mb-8">
                                <h1 class="text-3xl font-black text-slate-900 mb-2 leading-tight">{{ $doctor->user->name }}</h1>
                                <p class="text-sm font-black text-indigo-600 uppercase tracking-[0.2em] mb-3">{{ $doctor->department->name }}</p>
                                @php $firstChamber = $doctor->chambers->first(); @endphp
                                @if($firstChamber)
                                    <div class="flex items-center justify-center gap-1.5 mb-5">
                                        <svg class="w-3.5 h-3.5 text-indigo-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        <span class="text-xs font-bold text-slate-500">{{ $firstChamber->area->name }}, {{ $firstChamber->area->district->name }}, {{ $firstChamber->area->district->division->name }}</span>
                                    </div>
                                @else
                                    <div class="mb-5"></div>
                                @endif
                                
                                <div class="flex items-center justify-center space-x-1 text-amber-400 mb-6">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= round($doctor->average_rating) ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    @endfor
                                    <span class="ml-2 text-slate-900 font-black text-sm">{{ $doctor->average_rating }}</span>
                                    <span class="text-slate-400 font-bold text-xs">({{ $doctor->reviews_count }} Reviews)</span>
                                </div>

                                <div class="flex gap-3">
                                    <button onclick="toggleWishlist(this, {{ $doctor->id }})" class="flex-1 py-4 px-6 rounded-2xl font-black text-xs uppercase tracking-widest transition-all {{ in_array($doctor->id, $wishlistedIds) ? 'bg-rose-500 text-white shadow-xl shadow-rose-200' : 'bg-rose-50 text-rose-500 hover:bg-rose-100' }}">
                                        {{ in_array($doctor->id, $wishlistedIds) ? 'Saved' : 'Wishlist' }}
                                    </button>
                                    <a href="#appointment" class="flex-[2] py-4 px-6 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest text-center hover:bg-indigo-600 transition-all shadow-xl shadow-slate-200">
                                        Book Consultation
                                    </a>
                                </div>
                            </div>

                            <div class="space-y-4 pt-8 border-t border-slate-50">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Experience</span>
                                    <span class="text-sm font-black text-slate-900">{{ $doctor->experience_years }} Years</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Consultation Fee</span>
                                    <span class="text-sm font-black text-slate-900">${{ number_format($doctor->consultation_fee, 0) }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Specialization</span>
                                    <span class="text-sm font-black text-slate-900">{{ $doctor->specialization }}</span>
                                </div>
                                @if($firstChamber)
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Location</span>
                                    <span class="text-sm font-black text-slate-900 text-right">{{ $firstChamber->area->district->name }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- Decoration -->
                        <div class="absolute -top-12 -right-12 w-32 h-32 bg-indigo-50 rounded-full blur-2xl"></div>
                    </div>

                    <!-- Social & Contact Placeholder -->
                    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm">
                        <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-6">Connect with Doctor</h4>
                        <div class="flex space-x-4">
                            @php $socials = $doctor->social_links ?? []; @endphp
                            <a href="{{ $socials['facebook'] ?? '#' }}" class="h-12 w-12 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-indigo-600 hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                            </a>
                            <a href="{{ $socials['linkedin'] ?? '#' }}" class="h-12 w-12 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-indigo-600 hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Details, Chambers, Reviews -->
                <div class="lg:col-span-8 space-y-12">
                    <!-- About -->
                    <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm">
                        <h3 class="text-2xl font-black text-slate-900 mb-6 tracking-tight">Biography</h3>
                        <p class="text-slate-500 leading-relaxed font-medium">
                            {{ $doctor->bio ?? 'No biography provided yet.' }}
                        </p>
                    </div>

                    <!-- Chambers & Schedules -->
                    <div id="appointment">
                        <h3 class="text-2xl font-black text-slate-900 mb-8 tracking-tight px-4">Available Chambers</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($doctor->chambers as $chamber)
                                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-100/30 transition-all duration-500">
                                    <div class="flex items-start justify-between mb-6">
                                        <div>
                                            <h4 class="text-xl font-black text-slate-900 mb-1">{{ $chamber->name }}</h4>
                                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $chamber->area->name }}, {{ $chamber->area->district->name }}</p>
                                        </div>
                                        <div class="h-10 w-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                    </div>
                                    <p class="text-sm text-slate-500 font-medium mb-8 leading-relaxed">{{ $chamber->address }}</p>
                                    
                                    <div class="space-y-3">
                                        <h5 class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em] mb-3">Schedules</h5>
                                        @foreach($chamber->schedules as $schedule)
                                            <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                                                <span class="text-xs font-black text-slate-700">{{ $schedule->day }}</span>
                                                <span class="text-xs font-bold text-indigo-600">{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Education & Experience -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Education -->
                        <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm">
                            <h3 class="text-xl font-black text-slate-900 mb-8 tracking-tight flex items-center">
                                <span class="h-8 w-8 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                                </span>
                                Education
                            </h3>
                            <div class="space-y-8 relative before:absolute before:left-[15px] before:top-2 before:bottom-2 before:w-px before:bg-slate-100">
                                @foreach($doctor->educations as $edu)
                                    <div class="pl-10 relative">
                                        <div class="absolute left-0 top-1 h-8 w-8 bg-white border-2 border-indigo-600 rounded-full z-10"></div>
                                        <h4 class="text-sm font-black text-slate-900 mb-1">{{ $edu->degree }}</h4>
                                        <p class="text-xs font-bold text-slate-500 mb-2">{{ $edu->institution }}</p>
                                        <span class="inline-block px-2 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-black rounded">{{ $edu->passing_year }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Experience -->
                        <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm">
                            <h3 class="text-xl font-black text-slate-900 mb-8 tracking-tight flex items-center">
                                <span class="h-8 w-8 bg-rose-50 text-rose-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </span>
                                Experience
                            </h3>
                            <div class="space-y-8 relative before:absolute before:left-[15px] before:top-2 before:bottom-2 before:w-px before:bg-slate-100">
                                @foreach($doctor->experiences as $exp)
                                    <div class="pl-10 relative">
                                        <div class="absolute left-0 top-1 h-8 w-8 bg-white border-2 border-rose-500 rounded-full z-10"></div>
                                        <h4 class="text-sm font-black text-slate-900 mb-1">{{ $exp->designation }}</h4>
                                        <p class="text-xs font-bold text-slate-500 mb-2">{{ $exp->institution }}</p>
                                        <span class="inline-block px-2 py-1 bg-rose-50 text-rose-500 text-[10px] font-black rounded">{{ $exp->start_date }} - {{ $exp->end_date ?? 'Present' }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Reviews -->
                    <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm">
                        <div class="flex justify-between items-center mb-10">
                            <h3 class="text-2xl font-black text-slate-900 tracking-tight">Patient Reviews</h3>
                            @auth
                                <button onclick="document.getElementById('review-form').classList.toggle('hidden')" class="px-6 py-2.5 bg-indigo-600 text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-indigo-700 transition-all">Write a Review</button>
                            @endauth
                        </div>

                        <!-- Review Form -->
                        <div id="review-form" class="hidden mb-12 p-8 bg-slate-50 rounded-[2.5rem] border border-slate-100">
                            <form action="{{ route('reviews.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                <div class="mb-6">
                                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest mb-3 block">Your Rating</label>
                                    <div class="flex space-x-2 star-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" class="hidden" required>
                                            <label for="star{{ $i }}" class="cursor-pointer text-slate-300 hover:text-amber-400 transition-colors">
                                                <svg class="w-8 h-8 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            </label>
                                        @endfor
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest mb-3 block">Your Experience</label>
                                    <textarea name="comment" rows="4" placeholder="Share your experience with this doctor..." class="w-full bg-white border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-medium text-slate-700 p-4" required></textarea>
                                </div>
                                <button type="submit" class="w-full py-4 bg-indigo-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">Submit Review</button>
                            </form>
                        </div>

                        <div class="space-y-8">
                            @forelse($doctor->reviews->where('status', true) as $review)
                                <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-black text-xs mr-3">
                                                {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <h5 class="text-sm font-black text-slate-900">{{ $review->user->name }}</h5>
                                                <span class="text-[10px] font-bold text-slate-400">{{ $review->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <div class="flex text-amber-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-sm text-slate-600 font-medium leading-relaxed">
                                        {{ $review->comment }}
                                    </p>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <p class="text-slate-400 font-bold italic">No reviews yet. Be the first to share your experience!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        // Star Rating Selection
        const starLabels = document.querySelectorAll('.star-rating label');
        starLabels.forEach((label, index) => {
            label.addEventListener('click', () => {
                starLabels.forEach((l, i) => {
                    if (i <= index) {
                        l.classList.remove('text-slate-300');
                        l.classList.add('text-amber-400');
                    } else {
                        l.classList.remove('text-amber-400');
                        l.classList.add('text-slate-300');
                    }
                });
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
                if (data.status === 'added') {
                    el.classList.remove('bg-rose-50', 'text-rose-500', 'hover:bg-rose-100');
                    el.classList.add('bg-rose-500', 'text-white', 'shadow-xl', 'shadow-rose-200');
                    el.innerText = 'Saved';
                } else {
                    el.classList.remove('bg-rose-500', 'text-white', 'shadow-xl', 'shadow-rose-200');
                    el.classList.add('bg-rose-50', 'text-rose-500', 'hover:bg-rose-100');
                    el.innerText = 'Wishlist';
                }
            });
        }
    </script>
    @endpush
</x-frontend-layout>
