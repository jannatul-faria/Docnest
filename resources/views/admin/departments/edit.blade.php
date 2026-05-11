<x-admin-layout>
    @section('header', 'Edit Department')

    <div class="max-w-2xl mx-auto">
        <x-card>
            <x-slot name="header">Edit Department: {{ $department->name }}</x-slot>

            <form action="{{ route('admin.departments.update', $department) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Department Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $department->name) }}" 
                           class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-200"
                           required>
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="4" 
                              class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-200">{{ old('description', $department->description) }}</textarea>
                    @error('description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                    <select name="status" id="status" 
                            class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-200">
                        <option value="1" {{ old('status', $department->status) == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $department->status) == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4">
                    <a href="{{ route('admin.departments.index') }}">
                        <x-button variant="white" type="button">Cancel</x-button>
                    </a>
                    <x-button variant="primary">Update Department</x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-admin-layout>
