<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($doctors as $doctor)
        <div class="group bg-white rounded-[2.5rem] p-6 border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-100/50 transition-all duration-500">
            <div class="relative mb-6">
                <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-slate-100">
                    @if($doctor->hasMedia('profile_image'))
                        <img src="{{ $doctor->getFirstMediaUrl('profile_image') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-200">
                            <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"></path></svg>
                        </div>
                    @endif
                </div>
                <div onclick="toggleWishlist(this, {{ $doctor->id }})" class="absolute top-3 right-3 h-9 w-9 rounded-xl flex items-center justify-center shadow-lg cursor-pointer transition-all {{ in_array($doctor->id, $wishlistedIds) ? 'bg-rose-500 text-white' : 'bg-white text-rose-500 hover:bg-rose-50' }}">
                    <svg class="w-5 h-5 wishlist-icon" fill="{{ in_array($doctor->id, $wishlistedIds) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <div class="absolute -bottom-3 left-4 px-3 py-1.5 bg-indigo-600 text-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-lg">
                    {{ $doctor->department->name }}
                </div>
            </div>

            <h4 class="text-xl font-black text-slate-900 mb-1 leading-tight"><a href="{{ route('doctors.show', $doctor->id) }}" class="hover:text-indigo-600 transition-colors">{{ $doctor->user->name }}</a></h4>
            <p class="text-xs font-bold text-slate-400 mb-3">{{ $doctor->specialization }}</p>
            @php $firstChamber = $doctor->chambers->first(); @endphp
            @if($firstChamber)
                <div class="flex items-center gap-1.5 mb-4">
                    <svg class="w-3.5 h-3.5 text-indigo-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="text-[11px] font-bold text-slate-500">{{ $firstChamber->area->name }}, {{ $firstChamber->area->district->name }}</span>
                </div>
            @else
                <div class="mb-4"></div>
            @endif
            
            <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                <div class="flex items-center text-amber-400">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <span class="ml-1 text-slate-900 font-black text-xs">{{ $doctor->average_rating }}</span>
                    <span class="ml-1 text-slate-400 font-bold text-[10px]">({{ $doctor->reviews_count }})</span>
                </div>
                <div class="text-slate-900 font-black text-xs">
                    ${{ number_format($doctor->consultation_fee, 0) }}
                </div>
            </div>

            <a href="{{ route('doctors.show', $doctor->id) }}" class="mt-6 block w-full py-3 bg-slate-900 text-white rounded-xl font-black text-xs uppercase tracking-widest text-center hover:bg-indigo-600 transition-all">
                View Profile
            </a>
        </div>
    @empty
        <div class="col-span-full py-20 text-center bg-white rounded-[2.5rem] border border-dashed border-slate-200">
            <div class="h-16 w-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <h4 class="text-xl font-black text-slate-900 mb-2">No doctors found</h4>
            <p class="text-slate-500 text-sm font-medium">Try adjusting your filters to find what you're looking for.</p>
        </div>
    @endforelse
</div>

<div class="mt-12">
    {{ $doctors->links() }}
</div>
