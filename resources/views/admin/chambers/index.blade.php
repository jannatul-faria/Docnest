<x-admin-layout>
    @section('header', 'Chambers')

    <div class="space-y-6">
        <div class="flex justify-between items-center px-2">
            <div>
                <h3 class="text-xl font-bold text-slate-900 tracking-tight">Chamber Directory</h3>
                <p class="text-sm text-slate-500 font-medium">Manage doctor chambers and visiting schedules.</p>
            </div>
            <a href="{{ route('admin.chambers.create') }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-100">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Create Chamber
            </a>
        </div>

        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-2xl bg-green-50 border border-green-100 flex items-center mx-2" role="alert">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-500">
                    <thead class="text-xs text-slate-400 uppercase bg-slate-50/50 border-b border-slate-100">
                        <tr>
                            <th scope="col" class="px-8 py-5 font-black tracking-widest uppercase">Chamber Info</th>
                            <th scope="col" class="px-8 py-5 font-black tracking-widest uppercase">Doctor</th>
                            <th scope="col" class="px-8 py-5 font-black tracking-widest uppercase">Location</th>
                            <th scope="col" class="px-8 py-5 font-black tracking-widest uppercase text-center">Status</th>
                            <th scope="col" class="px-8 py-5 font-black tracking-widest uppercase text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($chambers as $chamber)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="font-bold text-slate-900 group-hover:text-blue-600 transition-colors">{{ $chamber->name }}</div>
                                    <div class="text-xs text-slate-400 mt-1 font-medium">{{ $chamber->address }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 font-bold text-xs mr-3">
                                            {{ substr($chamber->doctor->user->name, 0, 1) }}
                                        </div>
                                        <div class="font-bold text-slate-700">{{ $chamber->doctor->user->name }}</div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    @if($chamber->area)
                                        <div class="text-slate-600 font-bold">{{ $chamber->area->name }}</div>
                                        <div class="text-[10px] text-slate-400 font-black uppercase tracking-wider mt-1">{{ $chamber->area->district->name }}, {{ $chamber->area->district->division->name }}</div>
                                    @elseif($chamber->division || $chamber->district)
                                        <div class="text-slate-600 font-bold italic text-xs">No specific area</div>
                                        <div class="text-[10px] text-slate-400 font-black uppercase tracking-wider mt-1">
                                            {{ $chamber->district->name ?? 'Unknown District' }}, {{ $chamber->division->name ?? 'Unknown Division' }}
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400 italic">No location assigned</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @if($chamber->status)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black bg-green-100 text-green-700 border border-green-200 uppercase tracking-widest">Open</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black bg-slate-100 text-slate-400 border border-slate-200 uppercase tracking-widest">Closed</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end space-x-2 transition-opacity">
                                        <a href="{{ route('admin.chambers.edit', $chamber) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-xl transition-all" title="Edit Chamber">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form id="delete-form-{{ $chamber->id }}" action="{{ route('admin.chambers.destroy', $chamber) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete('delete-form-{{ $chamber->id }}', 'Are you sure you want to delete this chamber? This will also remove all associated visiting schedules.')" class="p-2 text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Delete Chamber">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="h-16 w-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        </div>
                                        <p class="text-slate-400 font-bold">No chambers found. Start adding doctor chambers!</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($chambers->hasPages())
                <div class="px-8 py-6 border-t border-slate-50 bg-slate-50/30">
                    {{ $chambers->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
