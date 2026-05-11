<x-admin-layout>
    @section('header', 'Create Chamber')

    <div class="max-w-4xl mx-auto pb-12">
        <div class="mb-8 flex items-center justify-between px-2">
            <div>
                <h3 class="text-2xl font-black text-slate-900 tracking-tight">New Chamber</h3>
                <p class="text-sm text-slate-500 font-medium">Add a new clinic or hospital chamber for a doctor.</p>
            </div>
            <a href="{{ route('admin.chambers.index') }}" class="text-sm font-bold text-slate-400 hover:text-blue-600 transition-colors flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Directory
            </a>
        </div>

        <form action="{{ route('admin.chambers.store') }}" method="POST" class="space-y-8">
            @csrf
            
            <!-- Basic Information Card -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Doctor Selection -->
                    <div class="space-y-2">
                        <label for="doctor_id" class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Select Doctor</label>
                        <select name="doctor_id" id="doctor_id" class="w-full rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-400 transition-all font-bold text-slate-700">
                            <option value="">Choose a doctor...</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>{{ $doctor->user->name }} ({{ $doctor->specialization }})</option>
                            @endforeach
                        </select>
                        @error('doctor_id') <p class="text-xs text-red-600 font-bold ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Chamber Name -->
                    <div class="space-y-2">
                        <label for="name" class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Chamber Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="e.g. Apollo Hospital, Dhaka" class="w-full rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-400 transition-all font-bold text-slate-700">
                        @error('name') <p class="text-xs text-red-600 font-bold ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Location Hierarchy -->
                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6 pt-4">
                        <div class="space-y-2">
                            <label for="division_id" class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Division</label>
                            <select id="division_id" class="w-full rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-blue-50 transition-all font-bold text-slate-700">
                                <option value="">Select Division</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label for="district_id" class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">District</label>
                            <select id="district_id" class="w-full rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-blue-50 transition-all font-bold text-slate-700" disabled>
                                <option value="">Select District</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label for="area_id" class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Area / Police Station</label>
                            <select name="area_id" id="area_id" class="w-full rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-400 transition-all font-bold text-slate-700" disabled>
                                <option value="">Select Area</option>
                            </select>
                            @error('area_id') <p class="text-xs text-red-600 font-bold ml-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Address & Phone -->
                    <div class="md:col-span-2 space-y-2">
                        <label for="address" class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Detailed Address</label>
                        <textarea name="address" id="address" rows="3" placeholder="Road, Block, Floor, Room No..." class="w-full rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-400 transition-all font-bold text-slate-700">{{ old('address') }}</textarea>
                        @error('address') <p class="text-xs text-red-600 font-bold ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="phone" class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Contact Number</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="+8801..." class="w-full rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-400 transition-all font-bold text-slate-700">
                        @error('phone') <p class="text-xs text-red-600 font-bold ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="status" class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Availability</label>
                        <select name="status" id="status" class="w-full rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-blue-50 focus:border-blue-400 transition-all font-bold text-slate-700">
                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Currently Open</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Temporarily Closed</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Schedule Management Card -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h4 class="text-xl font-black text-slate-900 tracking-tight">Visiting Schedules</h4>
                        <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest">Define days and times for this chamber</p>
                    </div>
                    <button type="button" id="add-schedule" class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-100 transition-all shadow-sm shadow-blue-50">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </div>

                <div id="schedule-container" class="space-y-4">
                    <div class="schedule-row grid grid-cols-1 md:grid-cols-4 gap-4 p-6 bg-slate-50 rounded-3xl border border-slate-100 relative">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Day</label>
                            <select name="schedules[0][day]" class="w-full rounded-xl border-slate-100 bg-white focus:ring-4 focus:ring-blue-50 transition-all font-bold text-slate-700">
                                @foreach(['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                                    <option value="{{ $day }}">{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Start Time</label>
                            <input type="time" name="schedules[0][start_time]" class="w-full rounded-xl border-slate-100 bg-white focus:ring-4 focus:ring-blue-50 transition-all font-bold text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">End Time</label>
                            <input type="time" name="schedules[0][end_time]" class="w-full rounded-xl border-slate-100 bg-white focus:ring-4 focus:ring-blue-50 transition-all font-bold text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Max Patients</label>
                            <input type="number" name="schedules[0][max_patients]" placeholder="e.g. 30" class="w-full rounded-xl border-slate-100 bg-white focus:ring-4 focus:ring-blue-50 transition-all font-bold text-slate-700">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="px-10 py-4 bg-blue-600 text-white rounded-[1.5rem] font-black text-lg hover:bg-blue-700 transition-all shadow-xl shadow-blue-200">
                    Create Chamber
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const divisionSelect = document.getElementById('division_id');
            const districtSelect = document.getElementById('district_id');
            const areaSelect = document.getElementById('area_id');
            const scheduleContainer = document.getElementById('schedule-container');
            const addScheduleBtn = document.getElementById('add-schedule');
            let scheduleIndex = 1;

            divisionSelect.addEventListener('change', function() {
                const divisionId = this.value;
                districtSelect.innerHTML = '<option value="">Select District</option>';
                districtSelect.disabled = true;
                areaSelect.innerHTML = '<option value="">Select Area</option>';
                areaSelect.disabled = true;
                if (divisionId) {
                    fetch(`{{ route('get-districts') }}?division_id=${divisionId}`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(district => { districtSelect.innerHTML += `<option value="${district.id}">${district.name}</option>`; });
                            districtSelect.disabled = false;
                        });
                }
            });

            districtSelect.addEventListener('change', function() {
                const districtId = this.value;
                areaSelect.innerHTML = '<option value="">Select Area</option>';
                areaSelect.disabled = true;
                if (districtId) {
                    fetch(`{{ route('get-areas') }}?district_id=${districtId}`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(area => { areaSelect.innerHTML += `<option value="${area.id}">${area.name}</option>`; });
                            areaSelect.disabled = false;
                        });
                }
            });

            addScheduleBtn.addEventListener('click', function() {
                const days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                let options = days.map(day => `<option value="${day}">${day}</option>`).join('');
                const row = document.createElement('div');
                row.className = 'schedule-row grid grid-cols-1 md:grid-cols-4 gap-4 p-6 bg-slate-50 rounded-3xl border border-slate-100 relative group animate-fade-in';
                row.innerHTML = `
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Day</label>
                        <select name="schedules[${scheduleIndex}][day]" class="w-full rounded-xl border-slate-100 bg-white focus:ring-4 focus:ring-blue-50 transition-all font-bold text-slate-700">${options}</select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Start Time</label>
                        <input type="time" name="schedules[${scheduleIndex}][start_time]" class="w-full rounded-xl border-slate-100 bg-white focus:ring-4 focus:ring-blue-50 transition-all font-bold text-slate-700">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">End Time</label>
                        <input type="time" name="schedules[${scheduleIndex}][end_time]" class="w-full rounded-xl border-slate-100 bg-white focus:ring-4 focus:ring-blue-50 transition-all font-bold text-slate-700">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Max Patients</label>
                        <input type="number" name="schedules[${scheduleIndex}][max_patients]" placeholder="e.g. 30" class="w-full rounded-xl border-slate-100 bg-white focus:ring-4 focus:ring-blue-50 transition-all font-bold text-slate-700">
                    </div>
                    <button type="button" class="remove-row absolute -top-2 -right-2 h-8 w-8 bg-rose-500 text-white rounded-full flex items-center justify-center shadow-lg opacity-0 group-hover:opacity-100 transition-all hover:scale-110">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                `;
                scheduleContainer.appendChild(row);
                scheduleIndex++;
            });

            scheduleContainer.addEventListener('click', function(e) {
                if (e.target.closest('.remove-row')) { e.target.closest('.schedule-row').remove(); }
            });
        });
    </script>
    <style>
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.3s ease-out forwards; }
    </style>
    @endpush
</x-admin-layout>
