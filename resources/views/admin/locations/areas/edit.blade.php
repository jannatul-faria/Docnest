<x-admin-layout>
    @section('header', 'Edit Area')

    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.areas.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-blue-600 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to List
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-lg font-medium text-slate-900">Edit Area: {{ $area->name }}</h3>
                <p class="text-sm text-slate-500">Update the details for this area.</p>
            </div>

            <form action="{{ route('admin.areas.update', $area) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="division_id" class="block text-sm font-medium text-slate-700 mb-1">Division</label>
                        <select id="division_id" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-colors">
                            <option value="">Select Division</option>
                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}" {{ $area->district->division_id == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="district_id" class="block text-sm font-medium text-slate-700 mb-1">District</label>
                        <select name="district_id" id="district_id" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-colors @error('district_id') border-rose-500 @enderror">
                            <option value="">Select District</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}" {{ old('district_id', $area->district_id) == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                            @endforeach
                        </select>
                        @error('district_id')
                            <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Area Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $area->name) }}" placeholder="e.g. Dhanmondi" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-colors @error('name') border-rose-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                    <select name="status" id="status" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-colors">
                        <option value="1" {{ old('status', $area->status) == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $area->status) == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4 flex justify-end space-x-3">
                    <a href="{{ route('admin.areas.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-100 transition-all">
                        Update Area
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('division_id').addEventListener('change', function() {
            const divisionId = this.value;
            const districtSelect = document.getElementById('district_id');
            
            districtSelect.innerHTML = '<option value="">Loading...</option>';
            districtSelect.disabled = true;

            if (divisionId) {
                fetch(`{{ route('get-districts') }}?division_id=${divisionId}`)
                    .then(response => response.json())
                    .then(data => {
                        districtSelect.innerHTML = '<option value="">Select District</option>';
                        data.forEach(district => {
                            districtSelect.innerHTML += `<option value="${district.id}">${district.name}</option>`;
                        });
                        districtSelect.disabled = false;
                    });
            } else {
                districtSelect.innerHTML = '<option value="">Select District</option>';
            }
        });
    </script>
    @endpush
</x-admin-layout>
