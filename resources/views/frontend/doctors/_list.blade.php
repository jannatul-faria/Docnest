<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
    @forelse($doctors as $doctor)
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

                <!-- Wishlist Toggle -->
                <div onclick="toggleWishlist(this, {{ $doctor->id }})" class="absolute top-3 right-3 h-8 w-8 rounded-xl flex items-center justify-center shadow-lg cursor-pointer transition-all {{ in_array($doctor->id, $wishlistedIds) ? 'bg-rose-500 text-white' : 'bg-white/90 backdrop-blur-sm text-rose-500 hover:bg-rose-50' }}">
                    <svg class="w-4 h-4 wishlist-icon" fill="{{ in_array($doctor->id, $wishlistedIds) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
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
    @empty
        <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-dashed border-slate-200">
            <div class="h-12 w-12 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <h4 class="text-lg font-black text-slate-900 mb-1">No doctors found</h4>
            <p class="text-slate-500 text-xs font-medium">Try adjusting your filters to find what you're looking for.</p>
        </div>
    @endforelse
</div>

<div class="mt-12">
    {{ $doctors->links() }}
</div>
