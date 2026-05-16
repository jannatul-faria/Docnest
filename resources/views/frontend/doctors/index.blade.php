<x-frontend-layout>
    <x-slot:title>Find Best Doctors - DocNest Discovery</x-slot:title>

    <section class="py-10 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Main Title -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-black text-primary tracking-tight">Search The Best Doctors</h1>
            </div>

            <!-- Top Search Bar -->
            <div class="bg-slate-100/50 p-3 rounded-2xl mb-8 shadow-sm border border-slate-100">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-center">
                    <div class="relative">
                        <select id="division-select" onchange="updateDistricts(); applyFilters()"
                            class="w-full bg-white border-none rounded-xl py-2.5 px-4 text-sm font-bold text-slate-600 focus:ring-2 focus:ring-primary/20 appearance-none shadow-sm cursor-pointer">
                            <option value="">Select Division</option>
                            @foreach($divisions as $div)
                                <option value="{{ $div->id }}" {{ ($filters['division_id'] ?? '') == $div->id ? 'selected' : '' }}>{{ $div->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="relative">
                        <select id="district-select" onchange="updateAreas(); applyFilters()"
                            class="w-full bg-white border-none rounded-xl py-2.5 px-4 text-sm font-bold text-slate-600 focus:ring-2 focus:ring-primary/20 appearance-none shadow-sm cursor-pointer">
                            <option value="">Select District</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="relative">
                        <select id="area-select" onchange="applyFilters()"
                            class="w-full bg-white border-none rounded-xl py-2.5 px-4 text-sm font-bold text-slate-600 focus:ring-2 focus:ring-primary/20 appearance-none shadow-sm cursor-pointer">
                            <option value="">Select Area</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="relative">
                        <select id="dept-select" onchange="applyFilters()"
                            class="w-full bg-white border-none rounded-xl py-2.5 px-4 text-sm font-bold text-slate-600 focus:ring-2 focus:ring-primary/20 appearance-none shadow-sm cursor-pointer">
                            <option value="">Select Department</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ ($filters['department_id'] ?? '') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="relative flex items-center gap-2">
                        <div class="relative flex-1">
                            <input type="text" id="search-input" oninput="debouncedApplyFilters()"
                                placeholder="Doctor name (optional)" value="{{ $filters['search'] ?? '' }}"
                                class="w-full bg-white border-none rounded-xl py-2.5 px-4 text-sm font-bold text-slate-600 focus:ring-2 focus:ring-primary/20 shadow-sm">
                        </div>
                        <button onclick="applyFilters()"
                            class="h-12 w-12 bg-primary flex items-center justify-center text-white rounded-xl shadow-lg shadow-primary/20 hover:scale-105 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar -->
                <aside class="w-full lg:w-72 space-y-8">
                    <!-- Divisions Card -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-slate-100">
                        <div class="bg-primary px-5 py-3 flex items-center gap-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <h4 class="text-sm font-black text-white uppercase tracking-wider">Divisions</h4>
                        </div>
                        <div class="py-2">
                            <button onclick="setDivision('')"
                                class="division-btn w-full text-left px-5 py-3 text-sm font-bold text-slate-600 hover:bg-slate-50 hover:text-primary transition-all flex items-center gap-3 border-b border-slate-50"
                                data-id="">
                                <div class="h-2 w-2 rounded-full bg-slate-200"></div>
                                All Divisions
                            </button>
                            @foreach($divisions as $div)
                                <button onclick="setDivision({{ $div->id }})"
                                    class="division-btn w-full text-left px-5 py-3 text-sm font-bold text-slate-600 hover:bg-slate-50 hover:text-primary transition-all flex items-center gap-3 border-b border-slate-50 last:border-none"
                                    data-id="{{ $div->id }}">
                                    <div class="h-2 w-2 rounded-full bg-primary/20"></div>
                                    {{ $div->name }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Categories Card -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-slate-100">
                        <div class="bg-primary px-5 py-3 flex items-center gap-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            <h4 class="text-sm font-black text-white uppercase tracking-wider">Doctor's Category</h4>
                        </div>
                        <div class="py-2">
                            <button onclick="setDepartment('')"
                                class="dept-btn w-full text-left px-5 py-3 text-sm font-bold text-slate-600 hover:bg-slate-50 hover:text-primary transition-all flex items-center justify-between border-b border-slate-50"
                                data-id="">
                                <div class="flex items-center gap-3">
                                    <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                    All Categories
                                </div>
                            </button>
                            @foreach($departments as $dept)
                                <button onclick="setDepartment({{ $dept->id }})"
                                    class="dept-btn w-full text-left px-5 py-3 text-sm font-bold text-slate-600 hover:bg-slate-50 hover:text-primary transition-all flex items-center justify-between border-b border-slate-50 last:border-none"
                                    data-id="{{ $dept->id }}">
                                    <div class="flex items-center gap-3">
                                        <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                        {{ $dept->name }}
                                    </div>
                                    <span
                                        class="text-[10px] font-black bg-primary text-white px-2 py-0.5 rounded-full">{{ $dept->doctors_count ?? 0 }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Clear Filters -->
                    <button onclick="resetFilters()"
                        class="w-full py-3 bg-slate-100 text-slate-600 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-slate-200 transition-all flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Clear All Filters
                    </button>
                </aside>

                <!-- Results -->
                <div class="flex-1">
                    <!-- Results Header -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">
                            Showing <span id="results-count" class="text-slate-900">{{ $doctors->total() }}</span>
                            Results
                        </div>
                    </div>

                    <div id="doctors-list">
                        @include('frontend.doctors._list')
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        console.log("--- Doctor Index Script Final Clean Version ---");

        // 1. Utilities
        function debounce(func, wait) {
            let timeout;
            return function() {
                const context = this, args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }

        const debouncedApplyFilters = debounce(applyFilters, 500);

        // 2. Core Logic
        function applyFilters(skipFetch = false) {
            const filters = {
                search: document.getElementById('search-input')?.value || '',
                department_id: document.getElementById('dept-select')?.value || '',
                division_id: document.getElementById('division-select')?.value || '',
                district_id: document.getElementById('district-select')?.value || '',
                area_id: document.getElementById('area-select')?.value || '',
            };

            const queryString = new URLSearchParams(filters).toString();
            const baseUrl = "{{ route('doctors.index') }}";
            const fullUrl = queryString ? `${baseUrl}?${queryString}` : baseUrl;

            // Update URL in address bar without 'partial' param
            if (!skipFetch) {
                window.history.pushState(filters, '', fullUrl);
            }
            
            updateActiveStates(filters);

            if (skipFetch) return; // Stop here if we just want to sync UI

            const listContainer = document.getElementById('doctors-list');
            if (listContainer) listContainer.style.opacity = '0.5';

            // Fetch with partial=1 and custom header to be double safe
            const fetchUrl = fullUrl + (fullUrl.includes('?') ? '&' : '?') + 'partial=1';
            
            fetch(fetchUrl, {
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-Partial-Request": "true"
                }
            })
                .then(res => res.text())
                .then(html => {
                    if (listContainer) {
                        listContainer.innerHTML = html;
                        listContainer.style.opacity = '1';
                    }
                })
                .catch(err => {
                    console.error("Filter error:", err);
                    if (listContainer) listContainer.style.opacity = '1';
                });
        }

        function updateActiveStates(filters) {
            document.querySelectorAll('.division-btn').forEach(btn => {
                if (btn.getAttribute('data-id') == filters.division_id) {
                    btn.classList.add('bg-slate-50', 'text-primary');
                    btn.querySelector('.rounded-full')?.classList.replace('bg-slate-200', 'bg-primary');
                    btn.querySelector('.rounded-full')?.classList.replace('bg-primary/20', 'bg-primary');
                } else {
                    btn.classList.remove('bg-slate-50', 'text-primary');
                    btn.querySelector('.rounded-full')?.classList.replace('bg-primary', 'bg-primary/20');
                    if (btn.getAttribute('data-id') === '') {
                        btn.querySelector('.rounded-full')?.classList.add('bg-slate-200');
                    }
                }
            });

            document.querySelectorAll('.dept-btn').forEach(btn => {
                if (btn.getAttribute('data-id') == filters.department_id) {
                    btn.classList.add('bg-slate-50', 'text-primary');
                } else {
                    btn.classList.remove('bg-slate-50', 'text-primary');
                }
            });
        }

        function updateDistricts(forcedDivId = null, initialDistrictId = null) {
            const divSelect = document.getElementById('division-select');
            const distSelect = document.getElementById('district-select');
            const areaSelect = document.getElementById('area-select');
            
            if (!distSelect || !areaSelect) return;

            const divId = forcedDivId || divSelect?.value;
            distSelect.innerHTML = '<option value="">Select District</option>';
            areaSelect.innerHTML = '<option value="">Select Area</option>';

            if (!divId) return;

            fetch(`{{ url('/api/districts') }}?division_id=${divId}`)
                .then(res => res.json())
                .then(data => {
                    if (data && data.length > 0) {
                        data.forEach(dist => {
                            const option = document.createElement('option');
                            option.value = dist.id;
                            option.textContent = dist.name;
                            if (initialDistrictId && dist.id == initialDistrictId) {
                                option.selected = true;
                            }
                            distSelect.appendChild(option);
                        });

                        // If we had an initial district, now fetch its areas
                        if (initialDistrictId) {
                            const initialAreaId = "{{ $filters['area_id'] ?? '' }}";
                            updateAreas(initialDistrictId, initialAreaId);
                        }
                    }
                })
                .catch(err => console.error("District fetch error:", err));
        }

        function updateAreas(forcedDistId = null, initialAreaId = null) {
            const distSelect = document.getElementById('district-select');
            const areaSelect = document.getElementById('area-select');
            if (!distSelect || !areaSelect) return;

            const distId = forcedDistId || distSelect.value;
            areaSelect.innerHTML = '<option value="">Select Area</option>';
            if (!distId) return;

            fetch(`{{ url('/api/areas') }}?district_id=${distId}`)
                .then(res => res.json())
                .then(data => {
                    if (data && data.length > 0) {
                        data.forEach(area => {
                            const option = document.createElement('option');
                            option.value = area.id;
                            option.textContent = area.name;
                            if (initialAreaId && area.id == initialAreaId) {
                                option.selected = true;
                            }
                            areaSelect.appendChild(option);
                        });
                    }
                })
                .catch(err => console.error("Area fetch error:", err));
        }

        function resetFilters() {
            const elements = ['search-input', 'dept-select', 'division-select'];
            elements.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.value = '';
            });

            const distSelect = document.getElementById('district-select');
            if (distSelect) distSelect.innerHTML = '<option value="">Select District</option>';
            
            const areaSelect = document.getElementById('area-select');
            if (areaSelect) areaSelect.innerHTML = '<option value="">Select Area</option>';

            applyFilters();
        }

        function setDivision(id) {
            const divSelect = document.getElementById('division-select');
            if (divSelect) {
                divSelect.value = id;
                updateDistricts(id);
                applyFilters();
            }
        }

        function setDepartment(id) {
            const deptSelect = document.getElementById('dept-select');
            if (deptSelect) {
                deptSelect.value = id;
                applyFilters();
            }
        }

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

        window.addEventListener('DOMContentLoaded', () => {
            const divSelect = document.getElementById('division-select');
            const distSelect = document.getElementById('district-select');
            
            // Initial sync of UI states (colors, active buttons) based on current filters
            applyFilters(true);

            // If there's a pre-selected division, populate districts
            if (divSelect && divSelect.value) {
                const initialDistrictId = "{{ $filters['district_id'] ?? '' }}";
                updateDistricts(divSelect.value, initialDistrictId);
            }
        });
    </script>
    @endpush
</x-frontend-layout>