<x-admin-layout>
    <x-slot name="header">Departments</x-slot>

    <div class="space-y-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-heading tracking-tight">Departments Management</h1>
                <p class="text-sm text-slate-500 font-medium">Add, edit or remove medical departments</p>
            </div>
            <a href="{{ route('admin.departments.create') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-xl text-sm font-bold hover:bg-primary/90 transition-all shadow-md shadow-primary/10">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add Department
            </a>
        </div>

        <!-- Search Area -->
        <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="relative flex-1 max-w-md">
                <form action="{{ route('admin.departments.index') }}" method="GET" class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="block w-full pl-9 pr-10 py-2 border border-slate-200 rounded-lg text-sm bg-slate-50/50 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all" 
                        placeholder="Search departments...">
                </form>
            </div>
            
            <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                Total: {{ $departments->total() }} Departments
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-500">
                    <thead class="text-[11px] text-slate-400 uppercase tracking-widest bg-slate-50/50 border-b border-slate-100 font-bold">
                        <tr>
                            <th class="px-6 py-4 text-slate-600">Department Name</th>
                            <th class="px-4 py-4 text-slate-600">Slug</th>
                            <th class="px-4 py-4 text-center text-slate-600">Status</th>
                            <th class="px-6 py-4 text-right text-slate-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($departments as $department)
                            <tr class="hover:bg-slate-50/30 transition-all duration-200">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900 leading-tight group-hover:text-primary transition-colors">{{ $department->name }}</div>
                                    <div class="text-[11px] font-medium text-slate-400 mt-0.5">{{ Str::limit($department->description, 60) }}</div>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-100 text-slate-500 border border-slate-200 uppercase tracking-tight">
                                        {{ $department->slug }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    @if($department->status)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest bg-emerald-100 text-emerald-800 border border-emerald-200">
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest bg-slate-100 text-slate-800 border border-slate-200">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end space-x-1">
                                        <a href="{{ route('admin.departments.edit', $department) }}" class="p-1.5 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition-all" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form id="delete-form-{{ $department->id }}" action="{{ route('admin.departments.destroy', $department) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete('delete-form-{{ $department->id }}')" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-400 font-medium italic">
                                    No departments found matching your search.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($departments->hasPages())
                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                    {{ $departments->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>