<x-admin-layout>
    <x-slot name="header">Activity Logs</x-slot>

    <div class="space-y-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-heading tracking-tight">System Activity Logs</h1>
                <p class="text-sm text-slate-500 font-medium">Monitor all system actions and data changes</p>
            </div>
        </div>

        <!-- Search Area -->
        <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="relative flex-1 max-w-md">
                <form action="{{ route('admin.activity-logs.index') }}" method="GET" class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="block w-full pl-9 pr-10 py-2 border border-slate-200 rounded-lg text-sm bg-slate-50/50 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all" 
                        placeholder="Search action or model...">
                </form>
            </div>
            
            <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                Total: {{ $activities->total() }} Records
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-500">
                    <thead class="text-[11px] text-slate-400 uppercase tracking-widest bg-slate-50/50 border-b border-slate-100 font-bold">
                        <tr>
                            <th class="px-6 py-4 text-slate-600">Time</th>
                            <th class="px-4 py-4 text-slate-600">User</th>
                            <th class="px-4 py-4 text-slate-600">Action</th>
                            <th class="px-4 py-4 text-slate-600">Model</th>
                            <th class="px-6 py-4 text-right text-slate-600">Details</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($activities as $activity)
                            <tr class="hover:bg-slate-50/30 transition-all duration-200">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900 leading-tight">{{ $activity->created_at->format('M d, Y') }}</div>
                                    <div class="text-[10px] font-medium text-slate-400 mt-0.5">{{ $activity->created_at->format('H:i:s') }}</div>
                                </td>
                                <td class="px-4 py-4">
                                    @if($activity->causer)
                                        <div class="font-bold text-slate-900 leading-tight text-xs">{{ $activity->causer->name }}</div>
                                        <div class="text-[10px] font-medium text-slate-400">{{ $activity->causer->email }}</div>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest bg-slate-100 text-slate-500 border border-slate-200">
                                            System
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest 
                                        {{ $activity->description === 'created' ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : '' }}
                                        {{ $activity->description === 'updated' ? 'bg-primary/10 text-primary border border-primary/20' : '' }}
                                        {{ $activity->description === 'deleted' ? 'bg-rose-100 text-rose-800 border border-rose-200' : '' }}
                                    ">
                                        {{ $activity->description }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="text-slate-700 font-bold text-xs">{{ class_basename($activity->subject_type) }}</div>
                                    <div class="text-[10px] font-medium text-slate-400 mt-0.5">ID: {{ $activity->subject_id }}</div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if($activity->changes)
                                        <button @click="$dispatch('open-modal', 'activity-details-{{ $activity->id }}')" class="p-1.5 text-primary hover:bg-primary/10 rounded-lg transition-all text-xs font-bold">
                                            View Changes
                                        </button>
                                    @else
                                        <span class="text-slate-300 text-xs">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-medium italic">
                                    No activity logs found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($activities->hasPages())
                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                    {{ $activities->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
