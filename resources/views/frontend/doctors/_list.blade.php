<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-5">
    @forelse($doctors as $doctor)
        <div
            class="group bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 hover:shadow-2xl transition-all duration-500 flex flex-col">
            <!-- Image Area -->
            <div class="relative aspect-[4/5] overflow-hidden bg-slate-50">
                @if($doctor->hasMedia('profile_image'))
                    <img src="{{ $doctor->getFirstMediaUrl('profile_image') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                @else
                    <img src="{{ asset('assets/images/default-doctor.png') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-80">
                @endif

                <!-- Wishlist Toggle -->
                <div onclick="toggleWishlist(this, {{ $doctor->id }})"
                    class="absolute top-4 right-4 h-10 w-10 bg-white/90 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-lg cursor-pointer hover:bg-rose-50 transition-all text-rose-500 {{ in_array($doctor->id, $wishlistedIds) ? 'bg-rose-50' : '' }}">
                    <svg class="w-5 h-5 wishlist-icon"
                        fill="{{ in_array($doctor->id, $wishlistedIds) ? 'currentColor' : 'none' }}" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                    </svg>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-6 flex-1 flex flex-col">
                <p class="text-[10px] font-black text-primary uppercase tracking-widest mb-2">
                    {{ $doctor->department->name }}
                </p>
                <h4 class="text-xl font-black text-slate-900 mb-2 leading-tight">
                    <a href="{{ route('doctors.show', $doctor->id) }}" class="hover:text-primary transition-colors">
                        {{ $doctor->name }}
                    </a>
                </h4>

                <p class="text-xs font-bold text-slate-500 line-clamp-2 mb-6">
                    {{ $doctor->educations->pluck('degree')->implode(', ') }}
                    @if($doctor->specialization)
                        - {{ $doctor->specialization }}
                    @endif
                </p>

                <div class="mt-auto">
                    <a href="{{ route('doctors.show', $doctor->id) }}"
                        class="block w-full py-3.5 bg-primary text-white rounded-2xl font-black text-[10px] uppercase tracking-widest text-center hover:bg-primary/90 transition-all shadow-lg shadow-primary/10">
                        View Profile
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-dashed border-slate-200">
            <div class="h-12 w-12 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <h4 class="text-lg font-black text-slate-900 mb-1">No doctors found</h4>
            <p class="text-slate-500 text-xs font-medium">Try adjusting your filters to find what you're looking for.</p>
        </div>
    @endforelse
</div>

<div class="mt-12">
    {{ $doctors->links() }}
</div>