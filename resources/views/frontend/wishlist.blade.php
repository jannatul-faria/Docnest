<x-frontend-layout>
    <x-slot:title>My Wishlist - DocNest</x-slot:title>

    <section class="py-24 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-16">
                <h2 class="text-sm font-black text-indigo-600 uppercase tracking-[0.3em] mb-4">Saved Doctors</h2>
                <h3 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                    My <span class="text-indigo-600">Wishlist</span>
                </h3>
                <p class="text-slate-500 font-medium mt-6">
                    Easily access and manage the profiles of doctors you've saved for future reference.
                </p>
            </div>

            @if($wishlists->isEmpty())
                <div class="bg-white rounded-[3rem] p-20 text-center border border-slate-100 shadow-sm">
                    <div class="h-24 w-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-8">
                        <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <h4 class="text-2xl font-black text-slate-900 mb-4">Your wishlist is empty</h4>
                    <p class="text-slate-500 font-medium mb-10 max-w-md mx-auto">Explore our directory and save your favorite doctors to find them quickly later.</p>
                    <a href="{{ route('home') }}#featured" class="inline-flex items-center px-10 py-4 bg-indigo-600 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-100">
                        Discover Doctors
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($wishlists as $wishlist)
                        @php $doctor = $wishlist->doctor; @endphp
                        <div class="group bg-white rounded-[3rem] p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-indigo-100 transition-all duration-500 hover:translate-y-[-8px]">
                            <div class="relative mb-8">
                                <div class="aspect-[4/3] rounded-[2rem] overflow-hidden bg-slate-100">
                                    @if($doctor->hasMedia('profile_image'))
                                        <img src="{{ $doctor->getFirstMediaUrl('profile_image') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-200">
                                            <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <div onclick="removeFromWishlist(this, {{ $doctor->id }})" class="absolute top-4 right-4 h-10 w-10 bg-rose-500 text-white rounded-xl flex items-center justify-center shadow-lg cursor-pointer transition-all hover:bg-rose-600" title="Remove from Wishlist">
                                    <svg class="w-6 h-6" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                </div>
                                <div class="absolute -bottom-4 left-6 px-4 py-2 bg-indigo-600 text-white text-[10px] font-black uppercase tracking-widest rounded-lg shadow-lg">
                                    {{ $doctor->department->name }}
                                </div>
                            </div>

                            <h4 class="text-2xl font-black text-slate-900 mb-2">{{ $doctor->user->name }}</h4>
                            <p class="text-sm font-bold text-slate-400 mb-6">{{ $doctor->specialization }}</p>
                            
                            <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                                <div class="flex items-center text-amber-400">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <span class="ml-1 text-slate-900 font-black text-sm">4.9</span>
                                </div>
                                <div class="text-slate-900 font-black text-sm">
                                    ${{ number_format($doctor->consultation_fee, 0) }}
                                </div>
                            </div>

                            <a href="#" class="mt-8 block w-full py-4 bg-slate-900 text-white rounded-2xl font-black text-sm uppercase tracking-widest text-center hover:bg-indigo-600 transition-all shadow-xl shadow-slate-200">
                                View Profile
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    @push('scripts')
    <script>
        function removeFromWishlist(el, doctorId) {
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
                if (data.status === 'removed') {
                    // Refresh the page to show updated list
                    window.location.reload();
                }
            });
        }
    </script>
    @endpush
</x-frontend-layout>
