<x-admin-layout>
    @section('header', 'Edit User')

    <div class="max-w-2xl mx-auto animate-fade-in">
        <div class="mb-6">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-primary transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Users List
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-lg font-black text-heading leading-tight">Edit User Details</h3>
                <p class="text-xs font-medium text-slate-500 mt-1">Update name, email address, or update their access role on the platform.</p>
            </div>

            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="w-full rounded-xl border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all text-sm @error('name') border-rose-500 @enderror">
                    @error('name')
                        <p class="mt-1.5 text-xs font-bold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                        class="w-full rounded-xl border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all text-sm @error('email') border-rose-500 @enderror">
                    @error('email')
                        <p class="mt-1.5 text-xs font-bold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="role" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Access Role</label>
                    <select name="role" id="role" 
                        class="w-full rounded-xl border-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all text-sm font-bold text-slate-700">
                        @foreach($roles as $role)
                            <option value="{{ $role->value }}" {{ old('role', $user->roles->first()?->name ?? 'patient') == $role->value ? 'selected' : '' }}>
                                {{ $role->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <p class="mt-1.5 text-xs font-bold text-rose-500">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-[11px] text-slate-400 font-medium leading-normal">
                        * Note: Changing a user's role to 'Doctor' does not automatically create a complete doctor profile. Their specialty profile should still be set up separately in the Doctors section if they need to appear in the public directory.
                    </p>
                </div>

                <div class="pt-4 flex justify-end space-x-3 border-t border-slate-100">
                    <a href="{{ route('admin.users.index') }}" 
                        class="px-5 py-2.5 text-sm font-bold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-all shadow-sm">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="px-5 py-2.5 text-sm font-bold text-white bg-primary rounded-xl hover:bg-primary/90 focus:ring-4 focus:ring-primary/10 transition-all shadow-md shadow-primary/10">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
