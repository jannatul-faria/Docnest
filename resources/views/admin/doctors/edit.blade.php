<x-admin-layout>
    @section('header', 'Edit Doctor Profile')

    <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST" enctype="multipart/form-data" class="max-w-4xl mx-auto space-y-8">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <a href="{{ route('admin.doctors.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-blue-600 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to List
            </a>
        </div>

        <!-- Section: Account Information -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-lg font-medium text-slate-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Account Information
                </h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $doctor->user->name) }}" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-600 @enderror">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $doctor->user->email) }}" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-600 @enderror">
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password (Leave blank to keep current)</label>
                    <input type="password" name="password" id="password" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500 @error('password') border-red-600 @enderror">
                    @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Section: Professional Profile -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-lg font-medium text-slate-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Professional Profile
                </h3>
            </div>
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="department_id" class="block text-sm font-medium text-slate-700 mb-1">Department</label>
                        <select name="department_id" id="department_id" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500 @error('department_id') border-red-600 @enderror">
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id', $doctor->department_id) == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                            @endforeach
                        </select>
                        @error('department_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="specialization" class="block text-sm font-medium text-slate-700 mb-1">Specialization</label>
                        <input type="text" name="specialization" id="specialization" value="{{ old('specialization', $doctor->specialization) }}" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500 @error('specialization') border-red-600 @enderror">
                        @error('specialization') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="experience_years" class="block text-sm font-medium text-slate-700 mb-1">Experience (Years)</label>
                        <input type="number" name="experience_years" id="experience_years" value="{{ old('experience_years', $doctor->experience_years) }}" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="consultation_fee" class="block text-sm font-medium text-slate-700 mb-1">Consultation Fee ($)</label>
                        <input type="number" step="0.01" name="consultation_fee" id="consultation_fee" value="{{ old('consultation_fee', $doctor->consultation_fee) }}" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <label for="hospital_name" class="block text-sm font-medium text-slate-700 mb-1">Hospital/Clinic Name</label>
                    <input type="text" name="hospital_name" id="hospital_name" value="{{ old('hospital_name', $doctor->hospital_name) }}" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="bio" class="block text-sm font-medium text-slate-700 mb-1">Biography</label>
                    <textarea name="bio" id="bio" rows="4" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">{{ old('bio', $doctor->bio) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="profile_image" class="block text-sm font-medium text-slate-700 mb-1">Profile Image</label>
                        @if($doctor->hasMedia('profile_image'))
                            <div class="mb-2">
                                <img src="{{ $doctor->getFirstMediaUrl('profile_image') }}" class="h-16 w-16 rounded-lg object-cover border">
                            </div>
                        @endif
                        <input type="file" name="profile_image" id="profile_image" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                        <select name="status" id="status" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                            <option value="1" {{ old('status', $doctor->status) == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $doctor->status) == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div>
                        <label for="is_featured" class="block text-sm font-medium text-slate-700 mb-1">Is Featured?</label>
                        <select name="is_featured" id="is_featured" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                            <option value="0" {{ old('is_featured', $doctor->is_featured) == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('is_featured', $doctor->is_featured) == '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-6 flex justify-end">
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 hover:-translate-y-0.5 transition-all duration-200">
                Update Doctor Profile
            </button>
        </div>
    </form>
</x-admin-layout>
