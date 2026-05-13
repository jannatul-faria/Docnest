<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DocNest') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
        }
        .sidebar-gradient {
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            box-shadow: 4px 0 24px rgba(0,0,0,0.1);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        .premium-card {
            background: white;
            border-radius: 1.25rem;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }
        .premium-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .active-nav-link {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0) 100%);
            border-left: 4px solid #3b82f6;
        }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
    </style>
</head>
<body class="antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 sidebar-gradient text-white flex-shrink-0 flex flex-col hidden md:flex">
            <div class="p-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center font-bold text-xl">D</div>
                    <span class="text-xl font-bold tracking-tight">DocNest</span>
                </a>
            </div>

            <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                <x-admin-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </x-admin-nav-link>

                <div class="pt-4 pb-2 px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                    Core Management
                </div>

                <x-admin-nav-link href="{{ route('admin.departments.index') }}" :active="request()->routeIs('admin.departments.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Departments
                </x-admin-nav-link>

                <div class="pt-4 pb-2 px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                    Location Management
                </div>

                <x-admin-nav-link href="{{ route('admin.divisions.index') }}" :active="request()->routeIs('admin.divisions.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Divisions
                </x-admin-nav-link>

                <x-admin-nav-link href="{{ route('admin.districts.index') }}" :active="request()->routeIs('admin.districts.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Districts
                </x-admin-nav-link>

                <x-admin-nav-link href="{{ route('admin.areas.index') }}" :active="request()->routeIs('admin.areas.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Areas
                </x-admin-nav-link>

                <div class="pt-4 pb-2 px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                    Doctor Management
                </div>

                <x-admin-nav-link href="{{ route('admin.doctors.index') }}" :active="request()->routeIs('admin.doctors.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Doctors
                </x-admin-nav-link>

                <x-admin-nav-link href="{{ route('admin.chambers.index') }}" :active="request()->routeIs('admin.chambers.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Chambers
                </x-admin-nav-link>

                <div class="pt-4 pb-2 px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                    Community & Feedback
                </div>

                <x-admin-nav-link href="{{ route('admin.reviews.index') }}" :active="request()->routeIs('admin.reviews.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.921-.755 1.688-1.54 1.118l-3.976-2.888a1 1 0 00-1.175 0l-3.976 2.888c-.784.57-1.838-.197-1.539-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                    Reviews
                </x-admin-nav-link>

                <x-admin-nav-link href="{{ route('admin.activity-logs.index') }}" :active="request()->routeIs('admin.activity-logs.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Activity Logs
                </x-admin-nav-link>
            </nav>

            <div class="p-4 border-t border-slate-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-slate-300 hover:text-white hover:bg-slate-800 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-y-auto">
            <!-- Topbar -->
            <header class="glass-effect sticky top-0 z-10 h-16 flex items-center justify-between px-8">
                <div class="flex items-center">
                    <h2 class="text-xl font-semibold text-slate-800">
                        @yield('header', 'Dashboard')
                    </h2>
                </div>

                <div class="flex items-center space-x-4">
                    <button class="p-2 text-slate-500 hover:text-slate-800 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </button>
                    <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-8">
                @if(session('success'))
                    <div class="p-4 mb-6 text-sm text-green-800 rounded-2xl bg-green-50 border border-green-100 flex items-center animate-fade-in shadow-sm shadow-green-100" role="alert">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span class="font-bold">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="p-4 mb-6 text-sm text-rose-800 rounded-2xl bg-rose-50 border border-rose-100 flex items-center animate-fade-in shadow-sm shadow-rose-100" role="alert">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span class="font-bold">{{ session('error') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="p-4 mb-6 text-sm text-rose-800 rounded-2xl bg-rose-50 border border-rose-100 animate-fade-in shadow-sm shadow-rose-100" role="alert">
                        <div class="flex items-center mb-2">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                            <span class="font-black uppercase tracking-widest text-[10px]">Please correct the following errors:</span>
                        </div>
                        <ul class="mt-1.5 list-disc list-inside text-xs font-bold space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>
    </div>
    @stack('scripts')

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div id="delete-modal-overlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-[2.5rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full animate-fade-in">
                <div class="bg-white px-8 pt-10 pb-8">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-3xl bg-rose-50 sm:mx-0 sm:h-14 sm:w-14 border border-rose-100">
                            <svg class="h-8 w-8 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-6 sm:text-left">
                            <h3 class="text-2xl font-black text-slate-900 leading-6 tracking-tight" id="modal-title">Confirm Deletion</h3>
                            <div class="mt-4">
                                <p class="text-sm font-bold text-slate-500 leading-relaxed" id="delete-modal-message">
                                    Are you sure you want to delete this? This action cannot be undone and all associated data will be removed permanently.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50/50 px-8 py-6 sm:flex sm:flex-row-reverse gap-3">
                    <button type="button" id="confirm-delete-btn" class="w-full inline-flex justify-center rounded-2xl border border-transparent shadow-lg shadow-rose-100 px-6 py-3 bg-rose-600 text-base font-black text-white hover:bg-rose-700 transition-all sm:w-auto sm:text-sm">
                        Yes, Delete Permanently
                    </button>
                    <button type="button" id="close-delete-modal" class="mt-3 w-full inline-flex justify-center rounded-2xl border border-slate-200 shadow-sm px-6 py-3 bg-white text-base font-black text-slate-700 hover:bg-slate-50 transition-all sm:mt-0 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(formId, message = null) {
            const modal = document.getElementById('delete-modal');
            const overlay = document.getElementById('delete-modal-overlay');
            const closeBtn = document.getElementById('close-delete-modal');
            const confirmBtn = document.getElementById('confirm-delete-btn');
            const messageEl = document.getElementById('delete-modal-message');

            if (message) {
                messageEl.textContent = message;
            }

            modal.classList.remove('hidden');

            const closeModal = () => {
                modal.classList.add('hidden');
            };

            closeBtn.onclick = closeModal;
            overlay.onclick = closeModal;

            confirmBtn.onclick = () => {
                document.getElementById(formId).submit();
            };
        }
    </script>
</body>
</html>
