<x-admin-layout>
    @section('header', 'Doctor Profile')

    <div class="max-w-6xl mx-auto p-4 md:p-8">
        <!-- Top Navigation & Actions -->
        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('admin.doctors.index') }}"
                class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-primary transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Directory
            </a>
            <div class="flex items-center">
                <a href="{{ route('admin.doctors.edit', $doctor) }}"
                    class="inline-flex items-center px-6 py-2.5 bg-slate-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-100">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Edit Profile
                </a>
            </div>
        </div>

        <!-- Main Info Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden mb-8">
            <div class="h-32 md:h-48 bg-gradient-to-r from-slate-600 to-green-600"></div>
            <div class="p-6 md:p-10 pb-10">
                <div class="relative flex flex-col md:flex-row items-start md:items-end -mt-12 md:-mt-16 gap-6 mb-10">
                    <div class="relative">
                        <div
                            class="h-32 w-32 md:h-40 md:w-40 rounded-3xl border-4 border-white bg-white overflow-hidden shadow-xl">
                            @if($doctor->hasMedia('profile_image'))
                                <img src="{{ $doctor->getFirstMediaUrl('profile_image') }}"
                                    class="h-full w-full object-cover">
                            @else
                                <div
                                    class="h-full w-full bg-primary flex items-center justify-center text-primary text-4xl font-black">
                                    {{ substr($doctor->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 space-y-3">
                        <div class="flex flex-wrap items-center gap-3">
                            <h1 class="text-3xl font-black text-slate-900 tracking-tight">{{ $doctor->name }}</h1>
                            <div class="flex gap-2">
                                @if($doctor->status)
                                    <span
                                        class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-black rounded-full uppercase tracking-wider">Active</span>
                                @else
                                    <span
                                        class="px-3 py-1 bg-slate-100 text-slate-700 text-[10px] font-black rounded-full uppercase tracking-wider">Inactive</span>
                                @endif
                                @if($doctor->is_featured)
                                    <span
                                        class="px-3 py-1 bg-amber-100 text-amber-700 text-[10px] font-black rounded-full uppercase tracking-wider">Featured</span>
                                @endif
                            </div>
                        </div>
                        <p class="text-xl text-primary font-bold">{{ $doctor->specialization }}</p>
                        <div class="flex flex-wrap gap-6 text-sm text-slate-500 font-medium">
                            <span class="flex items-center"><svg class="w-4 h-4 mr-2 text-slate-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>{{ $doctor->department->name }}</span>
                            <span class="flex items-center"><svg class="w-4 h-4 mr-2 text-slate-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>{{ $doctor->hospital_name }}</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    <div class="lg:col-span-2 space-y-6">
                        <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest">Professional Biography
                        </h4>
                        <p
                            class="text-slate-600 leading-relaxed text-lg font-medium italic border-l-4 border-blue-50 pl-6">
                            "{{ $doctor->bio ?? 'No biography provided yet.' }}"
                        </p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-8 space-y-6 border border-slate-100">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Consultation
                                Fee</p>
                            <p class="text-2xl font-black text-slate-900">
                                ${{ number_format($doctor->consultation_fee, 2) }} <span
                                    class="text-xs font-bold text-slate-400 ml-1">/ visit</span></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Experience
                            </p>
                            <p class="text-xl font-bold text-slate-900">{{ $doctor->experience_years }} Years Clinical
                            </p>
                        </div>
                        <div class="pt-4 border-t border-slate-200">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Account
                                Email</p>
                            <p class="text-sm font-bold text-slate-600 break-all">{{ $doctor->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Education -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 md:p-10">
                <div class="flex items-center mb-8">
                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900">Education Details</h3>
                </div>
                <div class="space-y-8">
                    @forelse($doctor->educations as $edu)
                        <div class="flex items-start gap-4">
                            <div class="h-2 w-2 rounded-full bg-primary0 mt-2 flex-shrink-0"></div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-lg leading-tight">{{ $edu->degree }}</h4>
                                <p class="text-sm font-medium text-slate-500 mt-1">{{ $edu->institution }}</p>
                                <span
                                    class="inline-block mt-2 px-2.5 py-1 bg-primary text-white text-[10px] font-black rounded-lg uppercase tracking-wider">Class
                                    of {{ $edu->passing_year }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-400 text-sm italic">No records available.</p>
                    @endforelse
                </div>
            </div>

            <!-- Experience -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 md:p-10">
                <div class="flex items-center mb-8">
                    <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900">Work History</h3>
                </div>
                <div class="space-y-8">
                    @forelse($doctor->experiences as $exp)
                        <div class="flex items-start gap-4">
                            <div class="h-2 w-2 rounded-full bg-purple-500 mt-2 flex-shrink-0"></div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-lg leading-tight">{{ $exp->designation }}</h4>
                                <p class="text-sm font-medium text-slate-500 mt-1">{{ $exp->institution }}</p>
                                <p class="text-[10px] font-black text-purple-600 uppercase tracking-widest mt-2">
                                    {{ $exp->start_date->format('M Y') }} —
                                    {{ $exp->is_current ? 'Present' : ($exp->end_date ? $exp->end_date->format('M Y') : 'N/A') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-400 text-sm italic">No records available.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>