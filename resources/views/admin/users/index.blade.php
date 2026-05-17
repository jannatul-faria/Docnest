<x-admin-layout>
    <x-slot name="header">Users</x-slot>

    <div class="space-y-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-heading tracking-tight">Users Management</h1>
                <p class="text-sm text-slate-500 font-medium">View, edit, and manage all registered users and their platform roles</p>
            </div>
            <div>
                <a href="{{ route('admin.users.create') }}">
                    <x-button variant="primary" class="shadow-lg shadow-primary/20">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add New User
                    </x-button>
                </a>
            </div>
        </div>

        <!-- Search & Filter Area -->
        <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-sm">
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 flex-1 max-w-2xl">
                    <!-- Search Input -->
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" 
                            class="block w-full pl-9 pr-4 py-2 border border-slate-200 rounded-lg text-sm bg-slate-50/50 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all" 
                            placeholder="Search by name or email...">
                    </div>

                    <!-- Role Filter -->
                    <div class="w-full sm:w-48">
                        <select name="role" onchange="this.form.submit()"
                            class="block w-full px-3 py-2 border border-slate-200 rounded-lg text-sm bg-slate-50/50 text-slate-600 focus:outline-none focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all font-bold">
                            <option value="">All Roles</option>
                            @foreach(App\Enums\UserRoleEnum::cases() as $role)
                                <option value="{{ $role->value }}" {{ request('role') == $role->value ? 'selected' : '' }}>
                                    {{ $role->label() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @if(request()->anyFilled(['search', 'role']))
                        <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-rose-500 hover:text-rose-600 flex items-center px-2">
                            Clear Filters
                        </a>
                    @endif
                </div>
                
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                    Total: {{ $users->total() }} Users
                </div>
            </form>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-500">
                    <thead class="text-[11px] text-slate-400 uppercase tracking-widest bg-slate-50/50 border-b border-slate-100 font-bold">
                        <tr>
                            <th class="px-6 py-4 text-slate-600">User Profile</th>
                            <th class="px-4 py-4 text-slate-600">Email Address</th>
                            <th class="px-4 py-4 text-slate-600">Role</th>
                            <th class="px-4 py-4 text-slate-600">Joined Date</th>
                            <th class="px-6 py-4 text-right text-slate-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($users as $user)
                            <tr class="hover:bg-slate-50/30 transition-all duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <div class="h-10 w-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary font-bold border border-primary/20 text-sm">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <div class="font-bold text-slate-900 leading-tight">
                                                {{ $user->name }}
                                                @if(auth()->id() === $user->id)
                                                    <span class="ml-1.5 inline-flex items-center px-1.5 py-0.2 rounded text-[9px] font-black uppercase bg-slate-100 text-slate-500 border border-slate-200">You</span>
                                                @endif
                                            </div>
                                            <div class="text-[11px] font-medium text-slate-400 mt-0.5">Joined via web</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 font-medium text-slate-700">
                                    {{ $user->email }}
                                </td>
                                <td class="px-4 py-4">
                                    @php
                                        $userRole = $user->roles->first()?->name;
                                        $roleBadgeClasses = match($userRole) {
                                            'super-admin' => 'bg-purple-100 text-purple-800 border-purple-200',
                                            'admin' => 'bg-blue-100 text-blue-800 border-blue-200',
                                            'doctor' => 'bg-indigo-100 text-indigo-800 border-indigo-200',
                                            default => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                        };
                                        $roleLabel = match($userRole) {
                                            'super-admin' => 'Super Admin',
                                            'admin' => 'Admin',
                                            'doctor' => 'Doctor',
                                            default => 'Patient/User',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $roleBadgeClasses }}">
                                        {{ $roleLabel }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-xs font-bold text-slate-400">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end space-x-1">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="p-1.5 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition-all" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        
                                        @if(auth()->id() !== $user->id)
                                            <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete('delete-form-{{ $user->id }}', 'Are you sure you want to delete this user? This will also remove any wishlists, and if the user is a doctor, their doctor profile will be deleted.')" 
                                                    class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Delete">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            <span class="p-1.5 text-slate-300 cursor-not-allowed" title="You cannot delete yourself">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-medium italic">
                                    No users found matching your search or filters.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($users->hasPages())
                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
