<x-frontend-layout>
    <x-slot:title>Find Best Doctors - DocNest Discovery</x-slot:title>

    <section class="py-12 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div>
                    <h2 class="text-sm font-black text-indigo-600 uppercase tracking-[0.3em] mb-3">Discovery</h2>
                    <h3 class="text-4xl font-black text-slate-900 tracking-tight">Find Your <span class="text-indigo-600">Specialist</span></h3>
                </div>
                <div class="w-full md:w-auto">
                    <select id="sort-select" onchange="applyFilters()" class="w-full md:w-64 bg-white border-slate-100 rounded-2xl font-bold text-slate-600 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                        <option value="latest">Sort by: Newest</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="experience">Experience: High to Low</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar Filters -->
                <aside class="w-full lg:w-80 space-y-6">
                    <!-- Search -->
                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                        <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-4">Search Name</h4>
                        <div class="relative">
                            <input type="text" id="search-input" oninput="debounce(applyFilters, 500)()" placeholder="Doctor name..." value="{{ $filters['search'] ?? '' }}" class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-indigo-500 font-medium text-slate-700">
                            <svg class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>

                    <!-- Department -->
                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                        <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-4">Specialty</h4>
                        <select id="dept-select" onchange="applyFilters()" class="w-full bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-indigo-500 font-medium text-slate-700">
                            <option value="">All Specialties</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ ($filters['department_id'] ?? '') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Location -->
                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                        <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-2">Location</h4>
                        
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase mb-1 block">Division</label>
                            <select id="division-select" onchange="updateDistricts(); applyFilters()" class="w-full bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-indigo-500 font-medium text-slate-700">
                                <option value="">All Divisions</option>
                                @foreach($divisions as $div)
                                    <option value="{{ $div->id }}" {{ ($filters['division_id'] ?? '') == $div->id ? 'selected' : '' }}>{{ $div->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase mb-1 block">District</label>
                            <select id="district-select" onchange="updateAreas(); applyFilters()" class="w-full bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-indigo-500 font-medium text-slate-700">
                                <option value="">All Districts</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase mb-1 block">Area</label>
                            <select id="area-select" onchange="applyFilters()" class="w-full bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-indigo-500 font-medium text-slate-700">
                                <option value="">All Areas</option>
                            </select>
                        </div>
                    </div>

                    <!-- Fee Range -->
                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                        <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-4">Fee Range</h4>
                        <div class="grid grid-cols-2 gap-3">
                            <input type="number" id="min-fee" onchange="applyFilters()" placeholder="Min" class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-indigo-500 font-medium text-slate-700">
                            <input type="number" id="max-fee" onchange="applyFilters()" placeholder="Max" class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-indigo-500 font-medium text-slate-700">
                        </div>
                    </div>

                    <!-- Reset -->
                    <button onclick="resetFilters()" class="w-full py-4 bg-slate-100 text-slate-600 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-slate-200 transition-all">
                        Clear All Filters
                    </button>
                </aside>

                <!-- Results -->
                <div class="flex-1">
                    <div id="doctors-list">
                        @include('frontend.doctors._list')
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        function applyFilters() {
            const filters = {
                search: document.getElementById('search-input').value,
                department_id: document.getElementById('dept-select').value,
                division_id: document.getElementById('division-select').value,
                district_id: document.getElementById('district-select').value,
                area_id: document.getElementById('area-select').value,
                min_fee: document.getElementById('min-fee').value,
                max_fee: document.getElementById('max-fee').value,
                sort: document.getElementById('sort-select').value
            };

            const queryString = new URLSearchParams(filters).toString();
            const url = `{{ route('doctors.index') }}?${queryString}`;

            // Update URL without reload
            window.history.pushState({}, '', url);

            // Fetch results via AJAX
            fetch(url, {
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            })
            .then(res => res.text())
            .then(html => {
                document.getElementById('doctors-list').innerHTML = html;
            });
        }

        function updateDistricts() {
            const divId = document.getElementById('division-select').value;
            const distSelect = document.getElementById('district-select');
            const areaSelect = document.getElementById('area-select');
            
            distSelect.innerHTML = '<option value="">All Districts</option>';
            areaSelect.innerHTML = '<option value="">All Areas</option>';

            if (!divId) return;

            fetch(`/api/districts?division_id=${divId}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(dist => {
                        distSelect.innerHTML += `<option value="${dist.id}">${dist.name}</option>`;
                    });
                });
        }

        function updateAreas() {
            const distId = document.getElementById('district-select').value;
            const areaSelect = document.getElementById('area-select');
            
            areaSelect.innerHTML = '<option value="">All Areas</option>';

            if (!distId) return;

            fetch(`/api/areas?district_id=${distId}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(area => {
                        areaSelect.innerHTML += `<option value="${area.id}">${area.name}</option>`;
                    });
                });
        }

        function resetFilters() {
            document.getElementById('search-input').value = '';
            document.getElementById('dept-select').value = '';
            document.getElementById('division-select').value = '';
            document.getElementById('district-select').innerHTML = '<option value="">All Districts</option>';
            document.getElementById('area-select').innerHTML = '<option value="">All Areas</option>';
            document.getElementById('min-fee').value = '';
            document.getElementById('max-fee').value = '';
            document.getElementById('sort-select').value = 'latest';
            applyFilters();
        }

        function debounce(func, wait) {
            let timeout;
            return function() {
                const context = this, args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }

        // Wishlist Toggle Logic (Reuse from home or global)
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
            });
        }
    </script>
    @endpush
</x-frontend-layout>
