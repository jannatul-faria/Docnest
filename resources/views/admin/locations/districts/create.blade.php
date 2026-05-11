<x-admin-layout>
    @section('header', 'Create District')

    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.districts.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-blue-600 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to List
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-lg font-medium text-slate-900">Add New District</h3>
                <p class="text-sm text-slate-500">Enter the details for the new location district.</p>
            </div>

            <form action="{{ route('admin.districts.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div>
                    <label for="division_id" class="block text-sm font-medium text-slate-700 mb-1">Division</label>
                    <select name="division_id" id="division_id" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-colors @error('division_id') border-rose-500 @enderror">
                        <option value="">Select Division</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                        @endforeach
                    </select>
                    @error('division_id')
                        <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1">District Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="e.g. Gazipur" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-colors @error('name') border-rose-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                    <select name="status" id="status" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-colors">
                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4 flex justify-end space-x-3">
                    <a href="{{ route('admin.districts.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-100 transition-all">
                        Create District
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
