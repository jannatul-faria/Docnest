<x-admin-layout>
    <div class="py-10 space-y-10">
        <!-- Welcome Header -->
        <div class="relative overflow-hidden rounded-[3rem] bg-slate-900 p-12 text-white shadow-2xl shadow-slate-200">
            <div class="relative z-10">
                <h1 class="text-4xl font-black mb-2 tracking-tight">Welcome back, {{ Auth::user()->name }}!</h1>
                <p class="text-slate-400 font-bold max-w-lg leading-relaxed">Here's what's happening with DocNest today. Your medical platform is growing steadily.</p>
                <div class="mt-8 flex gap-4">
                    <a href="{{ route('admin.doctors.create') }}" class="px-6 py-3 bg-blue-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-500 transition-all">Add New Doctor</a>
                    <a href="{{ route('home') }}" target="_blank" class="px-6 py-3 bg-slate-800 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-700 transition-all">View Site</a>
                </div>
            </div>
            <!-- Decorative circle -->
            <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-blue-600/20 blur-3xl"></div>
            <div class="absolute -left-20 -bottom-20 h-64 w-64 rounded-full bg-indigo-600/10 blur-3xl"></div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
            @php
                $statCards = [
                    ['label' => 'Total Users', 'value' => $stats['total_users'], 'icon' => 'users', 'bg' => 'bg-indigo-50', 'text' => 'text-indigo-600'],
                    ['label' => 'Total Doctors', 'value' => $stats['total_doctors'], 'icon' => 'user-md', 'bg' => 'bg-rose-50', 'text' => 'text-rose-600'],
                    ['label' => 'Departments', 'value' => $stats['total_departments'], 'icon' => 'building', 'bg' => 'bg-amber-50', 'text' => 'text-amber-600'],
                    ['label' => 'Total Reviews', 'value' => $stats['total_reviews'], 'icon' => 'star', 'bg' => 'bg-emerald-50', 'text' => 'text-emerald-600'],
                    ['label' => 'Service Areas', 'value' => $stats['total_locations'], 'icon' => 'map-marker', 'bg' => 'bg-sky-50', 'text' => 'text-sky-600'],
                ];
            @endphp

            @foreach($statCards as $card)
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-shadow group">
                    <div class="flex items-center justify-between mb-6">
                        <div class="h-12 w-12 {{ $card['bg'] }} {{ $card['text'] }} rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            @if($card['icon'] === 'users')
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            @elseif($card['icon'] === 'user-md')
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            @elseif($card['icon'] === 'building')
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            @elseif($card['icon'] === 'star')
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.921-.755 1.688-1.54 1.118l-3.976-2.888a1 1 0 00-1.175 0l-3.976 2.888c-.784.57-1.838-.197-1.539-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                            @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            @endif
                        </div>
                        <div class="h-10 w-20 bg-slate-50 rounded-full flex items-center justify-center text-[10px] font-black text-slate-400 uppercase tracking-widest">+12%</div>
                    </div>
                    <div class="text-4xl font-black text-slate-900 mb-1">{{ $card['value'] }}</div>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $card['label'] }}</div>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Doctors -->
            <div class="lg:col-span-1 bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm">
                <div class="flex justify-between items-center mb-10">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">New Specialists</h3>
                    <a href="{{ route('admin.doctors.index') }}" class="h-10 w-10 bg-slate-50 rounded-full flex items-center justify-center text-slate-400 hover:text-indigo-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
                <div class="space-y-6">
                    @foreach($recent_doctors as $doctor)
                        <div class="flex items-center group cursor-pointer">
                            <div class="h-14 w-14 bg-slate-50 rounded-2xl overflow-hidden border border-slate-100 mr-5 group-hover:scale-105 transition-transform shadow-sm">
                                @if($doctor->hasMedia('profile_image'))
                                    <img src="{{ $doctor->getFirstMediaUrl('profile_image') }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-200">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="font-black text-slate-900 text-sm truncate">{{ $doctor->user->name }}</div>
                                <div class="text-xs font-bold text-slate-400 truncate">{{ $doctor->department->name }}</div>
                            </div>
                            <div class="text-[10px] font-black text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full ml-2">Active</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Activity Log -->
            <div class="lg:col-span-1 bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm">
                <div class="flex justify-between items-center mb-10">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">System Logs</h3>
                    <a href="{{ route('admin.activity-logs.index') }}" class="h-10 w-10 bg-slate-50 rounded-full flex items-center justify-center text-slate-400 hover:text-indigo-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </a>
                </div>
                <div class="space-y-8 relative before:absolute before:left-3.5 before:top-2 before:bottom-2 before:w-[2px] before:bg-slate-100">
                    @foreach($recent_activities as $activity)
                        <div class="relative pl-10">
                            <div class="absolute left-0 top-1.5 h-7 w-7 rounded-full bg-white border-4 border-slate-50 flex items-center justify-center z-10 shadow-sm">
                                <div class="h-2 w-2 rounded-full 
                                    {{ $activity->description === 'created' ? 'bg-green-500' : '' }}
                                    {{ $activity->description === 'updated' ? 'bg-blue-500' : '' }}
                                    {{ $activity->description === 'deleted' ? 'bg-red-500' : '' }}
                                "></div>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-1">{{ $activity->created_at->diffForHumans() }}</span>
                                <p class="text-xs font-bold text-slate-700 leading-relaxed">
                                    <span class="text-slate-900">{{ $activity->causer ? $activity->causer->name : 'System' }}</span> 
                                    {{ $activity->description }} a 
                                    <span class="text-indigo-600">{{ class_basename($activity->subject_type) }}</span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Reviews -->
            <div class="lg:col-span-1 bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm">
                <div class="flex justify-between items-center mb-10">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Patient Feedback</h3>
                    <a href="{{ route('admin.reviews.index') }}" class="h-10 w-10 bg-slate-50 rounded-full flex items-center justify-center text-slate-400 hover:text-indigo-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    </a>
                </div>
                <div class="space-y-8">
                    @foreach($recent_reviews as $review)
                        <div class="group">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 bg-slate-100 rounded-full flex items-center justify-center text-xs font-black text-slate-400 mr-3">
                                        {{ substr($review->user->name, 0, 1) }}
                                    </div>
                                    <div class="text-sm font-black text-slate-900">{{ $review->user->name }}</div>
                                </div>
                                <div class="flex text-amber-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-3 h-3 {{ $i <= $review->rating ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-[11px] font-bold text-slate-400 italic leading-relaxed group-hover:text-slate-600 transition-colors">"{{ Str::limit($review->comment, 80) }}"</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
