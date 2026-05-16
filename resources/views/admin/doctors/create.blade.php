<x-admin-layout>
    @section('header', 'Register Doctor')

    <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl mx-auto space-y-8">
        @csrf

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
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Dr. John Doe" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-600 @enderror">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="john@example.com" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-600 @enderror">
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
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
                            <option value="">Select Department</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                            @endforeach
                        </select>
                        @error('department_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="specialization" class="block text-sm font-medium text-slate-700 mb-1">Specialization</label>
                        <input type="text" name="specialization" id="specialization" value="{{ old('specialization') }}" placeholder="e.g. Heart Surgeon" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500 @error('specialization') border-red-600 @enderror">
                        @error('specialization') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="experience_years" class="block text-sm font-medium text-slate-700 mb-1">Experience (Years)</label>
                        <input type="number" name="experience_years" id="experience_years" value="{{ old('experience_years') }}" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="consultation_fee" class="block text-sm font-medium text-slate-700 mb-1">Consultation Fee ($)</label>
                        <input type="number" step="0.01" name="consultation_fee" id="consultation_fee" value="{{ old('consultation_fee') }}" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <label for="hospital_name" class="block text-sm font-medium text-slate-700 mb-1">Hospital/Clinic Name</label>
                    <input type="text" name="hospital_name" id="hospital_name" value="{{ old('hospital_name') }}" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="bio" class="block text-sm font-medium text-slate-700 mb-1">Biography</label>
                    <textarea name="bio" id="bio" rows="4" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">{{ old('bio') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="profile_image" class="block text-sm font-medium text-slate-700 mb-1">Profile Image</label>
                        <input type="file" name="profile_image" id="profile_image" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
                        @error('profile_image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                        <select name="status" id="status" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div>
                        <label for="is_featured" class="block text-sm font-medium text-slate-700 mb-1">Is Featured?</label>
                        <select name="is_featured" id="is_featured" class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                            <option value="0" {{ old('is_featured', '0') == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('is_featured') == '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Education & Experience (Dynamic) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Educations -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                    <h3 class="font-medium text-slate-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                        Education
                    </h3>
                    <button type="button" onclick="addEducationRow()" class="text-blue-600 hover:text-blue-700 text-xs font-bold uppercase tracking-wider">+ Add More</button>
                </div>
                <div id="education-container" class="p-4 space-y-4">
                    <div class="education-row p-3 bg-slate-50 rounded-lg border border-slate-100 relative">
                        <div class="space-y-3">
                            <input type="text" name="educations[0][degree]" placeholder="Degree (e.g. MBBS)" class="w-full text-sm rounded-lg border-slate-200">
                            <input type="text" name="educations[0][institution]" placeholder="Institution" class="w-full text-sm rounded-lg border-slate-200">
                            <input type="text" name="educations[0][passing_year]" placeholder="Year" class="w-full text-sm rounded-lg border-slate-200">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Experiences -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                    <h3 class="font-medium text-slate-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Experience
                    </h3>
                    <button type="button" onclick="addExperienceRow()" class="text-blue-600 hover:text-blue-700 text-xs font-bold uppercase tracking-wider">+ Add More</button>
                </div>
                <div id="experience-container" class="p-4 space-y-4">
                    <div class="experience-row p-3 bg-slate-50 rounded-lg border border-slate-100">
                        <div class="space-y-3">
                            <input type="text" name="experiences[0][designation]" placeholder="Designation" class="w-full text-sm rounded-lg border-slate-200">
                            <input type="text" name="experiences[0][institution]" placeholder="Institution" class="w-full text-sm rounded-lg border-slate-200">
                            <div class="grid grid-cols-2 gap-2">
                                <input type="date" name="experiences[0][start_date]" class="w-full text-sm rounded-lg border-slate-200">
                                <input type="date" name="experiences[0][end_date]" class="w-full text-sm rounded-lg border-slate-200">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-6 flex justify-end">
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 hover:-translate-y-0.5 transition-all duration-200">
                Register Doctor Profile
            </button>
        </div>
    </form>

    @push('scripts')
    <script>
        let eduCount = 1;
        function addEducationRow() {
            const container = document.getElementById('education-container');
            const row = `
                <div class="education-row p-3 bg-slate-50 rounded-lg border border-slate-100 relative">
                    <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 bg-rose-500 text-white rounded-full p-1 shadow-sm">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                    <div class="space-y-3">
                        <input type="text" name="educations[${eduCount}][degree]" placeholder="Degree" class="w-full text-sm rounded-lg border-slate-200">
                        <input type="text" name="educations[${eduCount}][institution]" placeholder="Institution" class="w-full text-sm rounded-lg border-slate-200">
                        <input type="text" name="educations[${eduCount}][passing_year]" placeholder="Year" class="w-full text-sm rounded-lg border-slate-200">
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', row);
            eduCount++;
        }

        let expCount = 1;
        function addExperienceRow() {
            const container = document.getElementById('experience-container');
            const row = `
                <div class="experience-row p-3 bg-slate-50 rounded-lg border border-slate-100 relative">
                    <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 bg-rose-500 text-white rounded-full p-1 shadow-sm">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                    <div class="space-y-3">
                        <input type="text" name="experiences[${expCount}][designation]" placeholder="Designation" class="w-full text-sm rounded-lg border-slate-200">
                        <input type="text" name="experiences[${expCount}][institution]" placeholder="Institution" class="w-full text-sm rounded-lg border-slate-200">
                        <div class="grid grid-cols-2 gap-2">
                            <input type="date" name="experiences[${expCount}][start_date]" class="w-full text-sm rounded-lg border-slate-200">
                            <input type="date" name="experiences[${expCount}][end_date]" class="w-full text-sm rounded-lg border-slate-200">
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', row);
            expCount++;
        }
    </script>
    @endpush
</x-admin-layout>
