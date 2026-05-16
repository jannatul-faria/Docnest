<x-frontend-layout>
    <x-slot:title>{{ $doctor->name }} - {{ $doctor->department->name }} | DocNest</x-slot:title>

    <div class="py-6 bg-[#f0f5f9] min-h-screen font-outfit">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Top Doctor Profile Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6 border border-slate-100">
                <div class="p-5 md:p-6">
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Profile Image -->
                        <div class="w-full md:w-64 flex-shrink-0">
                            <div class="aspect-[4/4.5] rounded-xl overflow-hidden border-4 border-white shadow-md">
                                @if($doctor->hasMedia('profile_image'))
                                    <img src="{{ $doctor->getFirstMediaUrl('profile_image') }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('assets/images/default-doctor.png') }}"
                                        class="w-full h-full object-cover opacity-80">
                                @endif
                            </div>
                        </div>

                        <!-- Doctor Info -->
                        <div class="flex-grow flex flex-col justify-between">
                            <div>
                                <h1 class="text-2xl font-bold text-[#008a44] mb-1">{{ $doctor->name }}</h1>

                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-4 h-4 text-[#008a44]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                    <span
                                        class="text-lg font-semibold text-[#1e293b]">{{ $doctor->department->name }}</span>
                                </div>

                                <div class="text-[#64748b] text-sm leading-relaxed mb-4 max-w-2xl">
                                    <p class="font-medium">{{ $doctor->specialization }}</p>
                                    <p class="mt-0.5">{{ $doctor->hospital_name }}</p>
                                </div>

                                <div
                                    class="flex flex-wrap items-center gap-x-6 gap-y-3 mb-4 py-3 border-y border-slate-100">
                                    <div class="flex items-center gap-2">
                                        <span class="text-[#94a3b8] font-medium text-sm">Consultation Fee:</span>
                                        <span
                                            class="text-rose-600 font-black text-xl">{{ number_format($doctor->consultation_fee, 0) }}
                                            BDT</span>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 mb-6">
                                    <div class="flex text-amber-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5 {{ $i <= round($doctor->average_rating) ? 'fill-current' : 'text-slate-200' }}"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="text-[#3b82f6] font-bold text-sm">Rating:
                                        {{ $doctor->average_rating }}/5</span>
                                </div>
                            </div>

                            <div class="flex flex-col items-end gap-3">
                                <div class="text-right">
                                    <a href="tel:{{ get_setting('contact_phone') ?? '' }}"
                                        class="flex items-center gap-2 justify-end text-[#2b66f2] hover:underline">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                            </path>
                                        </svg>
                                        <span
                                            class="text-2xl font-black tracking-tight">+{{ get_setting('contact_phone') ?? '8801700-000000' }}</span>
                                    </a>
                                    <div class="flex items-center gap-3 justify-end mt-3">
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', get_setting('contact_phone') ?? '') }}"
                                            target="_blank"
                                            class="flex items-center gap-2 px-4 py-2 bg-[#25D366] text-white rounded-full text-xs font-bold hover:bg-[#128C7E] transition-all">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.438 9.889-9.886.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.149-.174.198-.298.297-.497.099-.198.05-.372-.025-.521-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z" />
                                            </svg>
                                            Chat on WhatsApp
                                        </a>
                                        <a href="tel:{{ get_setting('contact_phone') ?? '' }}"
                                            class="flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 rounded-full text-xs font-bold hover:bg-slate-200 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                </path>
                                            </svg>
                                            Call Now
                                        </a>
                                    </div>
                                    @php
                                        $firstSchedule = $doctor->chambers->first()?->schedules->first();
                                    @endphp
                                    <p class="text-[#64748b] text-sm mt-2">
                                        @if($firstSchedule)
                                            {{ \Carbon\Carbon::parse($firstSchedule->start_time)->format('h:i A') }} to
                                            {{ \Carbon\Carbon::parse($firstSchedule->end_time)->format('h:i A') }} (Friday
                                            Off)
                                        @else
                                            {{ __('')}}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                <!-- Chamber Schedule (Left) -->
                <div class="lg:col-span-4 bg-white rounded-xl shadow-sm overflow-hidden border border-slate-100">
                    <div class="bg-primary text-white p-3 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="font-bold text-sm tracking-wider uppercase text-white">Chamber Schedule</p>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @php
                            $days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                            $schedules = $doctor->chambers->first()?->schedules->groupBy('day') ?? collect();
                        @endphp
                        @foreach($days as $day)
                            <div class="p-4 hover:bg-slate-50 transition-colors">
                                <div class="flex items-start gap-2">
                                    <svg class="w-3.5 h-3.5 text-[#008a44] mt-0.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <div>
                                        <h3 class="font-bold text-[#1e293b] text-xs">{{ $day }}</h3>
                                        <p class="text-[#64748b] text-[11px] mt-0.5">
                                            @if($schedules->has($day))
                                                @foreach($schedules->get($day) as $sch)
                                                    {{ \Carbon\Carbon::parse($sch->start_time)->format('h:i A') }} to
                                                    {{ \Carbon\Carbon::parse($sch->end_time)->format('h:i A') }}
                                                    @if(!$loop->last), @endif
                                                @endforeach
                                            @else
                                                Closed
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Diseases and Address (Right) -->
                <div class="lg:col-span-8 space-y-6">

                    <!-- Diseases Treated -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-slate-100">
                        <div class="bg-primary text-white p-3 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="font-bold text-sm tracking-wider uppercase text-white">The Diseases That Are
                                Treated</p>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                                @php
                                    // Split bio by commas or newlines if it looks like a list, otherwise use defaults for visual fidelity
                                    $diseases = [];
                                    if ($doctor->bio) {
                                        $diseases = preg_split('/[,\n]/', $doctor->bio, -1, PREG_SPLIT_NO_EMPTY);
                                    }

                                    // If no diseases found in bio, use some relevant placeholders matching the specialty
                                    if (count($diseases) < 2) {
                                        $diseases = [
                                            'General Consultations',
                                            'Routine Health Checkups',
                                            'Disease Management',
                                            'Patient Counseling',
                                            'Diagnostic Reviews',
                                            'Treatment Planning'
                                        ];
                                    }
                                @endphp
                                @foreach($diseases as $disease)
                                    <div class="flex items-start gap-3">
                                        <div
                                            class="mt-0.5 flex-shrink-0 w-5 h-5 rounded bg-green-50 flex items-center justify-center border border-green-100">
                                            <svg class="w-3 h-3 text-[#008a44]" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span
                                            class="text-[#334155] text-sm font-semibold leading-snug">{{ trim($disease) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Chamber Address -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-slate-100">
                        <div class="bg-primary text-white p-3 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p class="font-bold text-sm tracking-wider uppercase text-white">Chamber Address</p>
                        </div>
                        <div class="p-5">
                            @php $firstChamber = $doctor->chambers->first(); @endphp
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center border border-slate-100">
                                    <svg class="w-6 h-6 text-[#008a44]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-[#1e293b] mb-1">
                                        {{ $firstChamber->name ?? 'No Chamber Added' }}
                                    </h3>
                                    <p class="text-[#64748b] text-sm font-medium leading-relaxed mb-2">
                                        {{ $firstChamber->address ?? 'Address not available' }}
                                        @if($firstChamber && $firstChamber->area)
                                            , {{ $firstChamber->area->name }}, {{ $firstChamber->area->district->name }}
                                        @endif
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Other Sections (Bio, Experience, etc.) -->
            <div class="mt-8 space-y-6">
                @if($doctor->reviews_count > 0)
                    <div class="bg-white rounded-xl shadow-sm p-5 border border-slate-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-[#1e293b]">Patient Reviews</h3>
                            <a href="#book" class="text-[#008a44] text-sm font-bold hover:underline">Write a Review</a>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($doctor->reviews->where('status', true)->take(4) as $review)
                                <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 relative">
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-xs font-bold">
                                                {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <h5 class="font-bold text-[#1e293b] text-sm">{{ $review->user->name }}</h5>
                                                <span
                                                    class="text-[10px] text-slate-400 font-medium">{{ $review->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <div class="flex text-amber-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-slate-200' }}"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                    </path>
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-slate-600 font-medium text-sm italic leading-relaxed">
                                        "{{ $review->comment }}"</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>

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