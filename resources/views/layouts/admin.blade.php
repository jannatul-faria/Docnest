<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ get_setting('site_name', config('app.name', 'DocNest')) }} - Admin</title>

    <!-- Favicon -->
    @if(get_setting('favicon'))
        <link rel="icon" type="image/png" href="{{ asset('storage/' . get_setting('favicon')) }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- jQuery & DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.datatables.net/2.0.7/css/dataTables.tailwind.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.tailwind.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>

    @php
        if (!function_exists('hexToRgb')) {
            function hexToRgb($hex)
            {
                $hex = str_replace('#', '', $hex);
                if (strlen($hex) == 3) {
                    $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
                    $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
                    $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
                } else {
                    $r = hexdec(substr($hex, 0, 2));
                    $g = hexdec(substr($hex, 2, 2));
                    $b = hexdec(substr($hex, 4, 2));
                }
                return "$r, $g, $b";
            }
        }
        $primaryColor = get_setting('primary_color', '#008947');
        $primaryRgb = hexToRgb($primaryColor);
        $headingColor = get_setting('heading_color', '#0f172a');
    @endphp

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '{{ $primaryColor }}',
                            light: 'rgba({{ $primaryRgb }}, 0.1)',
                            dark: 'rgba({{ $primaryRgb }}, 0.9)',
                        },
                        heading: '{{ $headingColor }}',
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        :root {
            --primary-color: {{ $primaryColor }};
            --primary-rgb: {{ $primaryRgb }};
        }

        /* Global Input Field Custom Premium Padding & Styling */
        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="password"],
        input[type="url"],
        input[type="tel"],
        input[type="date"],
        input[type="time"],
        select,
        textarea {
            @apply px-4 py-2.5 border border-slate-200 rounded-xl bg-slate-50/50 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all !important;
        }

        /* DataTables Custom Premium Styling */
        .dt-container .dt-search input {
            @apply pl-10 pr-3 py-2 border border-slate-200 rounded-lg leading-5 bg-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition-all;
            margin-left: 0.5rem;
        }
        .dt-container .dt-paging .dt-paging-button {
            @apply px-3 py-1 mx-1 rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition-all !important;
        }
        .dt-container .dt-paging .dt-paging-button.current {
            @apply bg-primary text-white border-primary hover:bg-primary/90 !important;
        }
        .dt-container .dt-length select {
            @apply py-1 pl-2 pr-8 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary sm:text-sm;
        }
        .dt-container .dt-info {
            @apply text-sm text-slate-500 font-medium;
        }

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
            background: linear-gradient(90deg, rgba({{ $primaryRgb }}, 0.1) 0%, rgba({{ $primaryRgb }}, 0) 100%);
            border-left: 4px solid var(--primary-color);
        }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
    </style>
</head>

<body class="antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 sidebar-gradient text-white flex-shrink-0 flex flex-col hidden md:flex">
            <div class="p-6 flex justify-center">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center {{ (get_setting('logo_white') || get_setting('logo')) ? 'justify-center w-full' : 'space-x-2' }}">
                    @if(get_setting('logo_white'))
                        <img src="{{ asset('storage/' . get_setting('logo_white')) }}"
                            alt="{{ get_setting('site_name', 'DocNest') }}" class="h-11 w-auto object-contain mx-auto">
                    @elseif(get_setting('logo'))
                        <img src="{{ asset('storage/' . get_setting('logo')) }}"
                            alt="{{ get_setting('site_name', 'DocNest') }}" class="h-11 w-auto object-contain mx-auto">
                    @else
                        <div
                            class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center font-bold text-xl text-white">
                            {{ substr(get_setting('site_name', 'DocNest'), 0, 1) }}
                        </div>
                        <span class="text-xl font-bold tracking-tight">{{ get_setting('site_name', 'DocNest') }}</span>
                    @endif
                </a>
            </div>

            <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                <x-admin-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Dashboard
                </x-admin-nav-link>

                <!-- Core Management Dropdown -->
                @php
                    $isCoreActive = request()->routeIs('admin.departments.*') || request()->routeIs('admin.users.*');
                @endphp
                <div x-data="{ open: {{ $isCoreActive ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="open = !open" 
                        class="w-full flex items-center justify-between px-4 py-3 text-left text-sm font-medium rounded-xl transition-all duration-200 group {{ $isCoreActive ? 'text-white bg-slate-800/60' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 {{ $isCoreActive ? 'text-primary' : 'text-slate-400 group-hover:text-white' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            <span>Core</span>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="mt-1 space-y-1 ml-4 pl-3 border-l border-slate-700/60"
                         style="display: none;">
                         
                        <a href="{{ route('admin.departments.index') }}" 
                           class="flex items-center justify-between py-2 px-3 text-xs font-medium rounded-lg transition-all {{ request()->routeIs('admin.departments.*') ? 'text-primary font-bold' : 'text-slate-400 hover:text-white' }}">
                            <span>Departments</span>
                            @if(request()->routeIs('admin.departments.*'))
                                <span class="h-1.5 w-1.5 rounded-full bg-primary shadow-sm shadow-primary"></span>
                            @endif
                        </a>
                        
                        <a href="{{ route('admin.users.index') }}" 
                           class="flex items-center justify-between py-2 px-3 text-xs font-medium rounded-lg transition-all {{ request()->routeIs('admin.users.*') ? 'text-primary font-bold' : 'text-slate-400 hover:text-white' }}">
                            <span>Users</span>
                            @if(request()->routeIs('admin.users.*'))
                                <span class="h-1.5 w-1.5 rounded-full bg-primary shadow-sm shadow-primary"></span>
                            @endif
                        </a>
                    </div>
                </div>

                <!-- Location Management Dropdown -->
                @php
                    $isLocationActive = request()->routeIs('admin.divisions.*') || request()->routeIs('admin.districts.*') || request()->routeIs('admin.areas.*');
                @endphp
                <div x-data="{ open: {{ $isLocationActive ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="open = !open" 
                        class="w-full flex items-center justify-between px-4 py-3 text-left text-sm font-medium rounded-xl transition-all duration-200 group {{ $isLocationActive ? 'text-white bg-slate-800/60' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 {{ $isLocationActive ? 'text-primary' : 'text-slate-400 group-hover:text-white' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Locations</span>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="mt-1 space-y-1 ml-4 pl-3 border-l border-slate-700/60"
                         style="display: none;">
                         
                        <a href="{{ route('admin.divisions.index') }}" 
                           class="flex items-center justify-between py-2 px-3 text-xs font-medium rounded-lg transition-all {{ request()->routeIs('admin.divisions.*') ? 'text-primary font-bold' : 'text-slate-400 hover:text-white' }}">
                            <span>Divisions</span>
                            @if(request()->routeIs('admin.divisions.*'))
                                <span class="h-1.5 w-1.5 rounded-full bg-primary shadow-sm shadow-primary"></span>
                            @endif
                        </a>
                        
                        <a href="{{ route('admin.districts.index') }}" 
                           class="flex items-center justify-between py-2 px-3 text-xs font-medium rounded-lg transition-all {{ request()->routeIs('admin.districts.*') ? 'text-primary font-bold' : 'text-slate-400 hover:text-white' }}">
                            <span>Districts</span>
                            @if(request()->routeIs('admin.districts.*'))
                                <span class="h-1.5 w-1.5 rounded-full bg-primary shadow-sm shadow-primary"></span>
                            @endif
                        </a>
                        
                        <a href="{{ route('admin.areas.index') }}" 
                           class="flex items-center justify-between py-2 px-3 text-xs font-medium rounded-lg transition-all {{ request()->routeIs('admin.areas.*') ? 'text-primary font-bold' : 'text-slate-400 hover:text-white' }}">
                            <span>Areas</span>
                            @if(request()->routeIs('admin.areas.*'))
                                <span class="h-1.5 w-1.5 rounded-full bg-primary shadow-sm shadow-primary"></span>
                            @endif
                        </a>
                    </div>
                </div>

                <!-- Doctor Management Dropdown -->
                @php
                    $isDoctorActive = request()->routeIs('admin.doctors.*') || request()->routeIs('admin.chambers.*');
                @endphp
                <div x-data="{ open: {{ $isDoctorActive ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="open = !open" 
                        class="w-full flex items-center justify-between px-4 py-3 text-left text-sm font-medium rounded-xl transition-all duration-200 group {{ $isDoctorActive ? 'text-white bg-slate-800/60' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 {{ $isDoctorActive ? 'text-primary' : 'text-slate-400 group-hover:text-white' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Doctors</span>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="mt-1 space-y-1 ml-4 pl-3 border-l border-slate-700/60"
                         style="display: none;">
                         
                        <a href="{{ route('admin.doctors.index') }}" 
                           class="flex items-center justify-between py-2 px-3 text-xs font-medium rounded-lg transition-all {{ request()->routeIs('admin.doctors.*') ? 'text-primary font-bold' : 'text-slate-400 hover:text-white' }}">
                            <span>Doctors</span>
                            @if(request()->routeIs('admin.doctors.*'))
                                <span class="h-1.5 w-1.5 rounded-full bg-primary shadow-sm shadow-primary"></span>
                            @endif
                        </a>
                        
                        <a href="{{ route('admin.chambers.index') }}" 
                           class="flex items-center justify-between py-2 px-3 text-xs font-medium rounded-lg transition-all {{ request()->routeIs('admin.chambers.*') ? 'text-primary font-bold' : 'text-slate-400 hover:text-white' }}">
                            <span>Chambers</span>
                            @if(request()->routeIs('admin.chambers.*'))
                                <span class="h-1.5 w-1.5 rounded-full bg-primary shadow-sm shadow-primary"></span>
                            @endif
                        </a>
                    </div>
                </div>

                <!-- Community & Feedback Dropdown -->
                @php
                    $isCommunityActive = request()->routeIs('admin.reviews.*') || request()->routeIs('admin.activity-logs.*');
                @endphp
                <div x-data="{ open: {{ $isCommunityActive ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="open = !open" 
                        class="w-full flex items-center justify-between px-4 py-3 text-left text-sm font-medium rounded-xl transition-all duration-200 group {{ $isCommunityActive ? 'text-white bg-slate-800/60' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 {{ $isCommunityActive ? 'text-primary' : 'text-slate-400 group-hover:text-white' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                            </svg>
                            <span>Feedback</span>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="mt-1 space-y-1 ml-4 pl-3 border-l border-slate-700/60"
                         style="display: none;">
                         
                        <a href="{{ route('admin.reviews.index') }}" 
                           class="flex items-center justify-between py-2 px-3 text-xs font-medium rounded-lg transition-all {{ request()->routeIs('admin.reviews.*') ? 'text-primary font-bold' : 'text-slate-400 hover:text-white' }}">
                            <span>Reviews</span>
                            @if(request()->routeIs('admin.reviews.*'))
                                <span class="h-1.5 w-1.5 rounded-full bg-primary shadow-sm shadow-primary"></span>
                            @endif
                        </a>
                        
                        <a href="{{ route('admin.activity-logs.index') }}" 
                           class="flex items-center justify-between py-2 px-3 text-xs font-medium rounded-lg transition-all {{ request()->routeIs('admin.activity-logs.*') ? 'text-primary font-bold' : 'text-slate-400 hover:text-white' }}">
                            <span>Activity Logs</span>
                            @if(request()->routeIs('admin.activity-logs.*'))
                                <span class="h-1.5 w-1.5 rounded-full bg-primary shadow-sm shadow-primary"></span>
                            @endif
                        </a>
                    </div>
                </div>

                <div class="pt-4 pb-2 px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                    Settings
                </div>

                <x-admin-nav-link href="{{ route('admin.settings.index') }}"
                    :active="request()->routeIs('admin.settings.*')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Site Settings
                </x-admin-nav-link>
            </nav>

            <div class="p-4 border-t border-slate-700">
                <a href="{{ route('home') }}" target="_blank"
                    class="flex items-center w-full px-4 py-2 text-sm text-slate-300 hover:text-white hover:bg-slate-800 rounded-lg transition-colors group">
                    <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-white transition-colors" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    Visit Site
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-y-auto">
            <!-- Topbar -->
            <header class="glass-effect sticky top-0 z-10 h-16 flex items-center justify-between px-8 py-6">
                <div class="flex items-center">
                    <h2 class="text-xl font-semibold text-heading">
                        @yield('header', 'Dashboard')
                    </h2>
                </div>

                <div class="flex items-center space-x-4">

                    <!-- Profile Dropdown -->
                    <div class="relative animate-fade-in" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="flex items-center focus:outline-none group">
                            <div
                                class="h-8 w-8 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold hover:bg-primary/20 transition-all border border-primary/20 group-hover:scale-105">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-slate-100 py-1 z-50 overflow-hidden"
                            style="display: none;">
                            <div class="px-4 py-2 border-b border-slate-100 bg-slate-50/50">
                                <div class="text-xs font-black text-slate-900 truncate">{{ Auth::user()->name }}</div>
                                <div class="text-[10px] font-bold text-slate-400 truncate mt-0.5">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>

                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center px-4 py-2.5 text-xs font-bold text-slate-700 hover:bg-slate-50 hover:text-primary transition-colors">
                                <svg class="w-4 h-4 mr-2 text-slate-400 group-hover:text-primary" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Edit Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center w-full text-left px-4 py-2.5 text-xs font-bold text-rose-600 hover:bg-rose-50 transition-colors">
                                    <svg class="w-4 h-4 mr-2 text-rose-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-8">
                @if(session('success'))
                    <div class="p-4 mb-6 text-sm text-green-800 rounded-2xl bg-green-50 border border-green-100 flex items-center animate-fade-in shadow-sm shadow-green-100"
                        role="alert">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-bold">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="p-4 mb-6 text-sm text-rose-800 rounded-2xl bg-rose-50 border border-rose-100 flex items-center animate-fade-in shadow-sm shadow-rose-100"
                        role="alert">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-bold">{{ session('error') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="p-4 mb-6 text-sm text-rose-800 rounded-2xl bg-rose-50 border border-rose-100 animate-fade-in shadow-sm shadow-rose-100"
                        role="alert">
                        <div class="flex items-center mb-2">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-black uppercase tracking-widest text-[10px]">Please correct the following
                                errors:</span>
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
    <div id="delete-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div id="delete-modal-overlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"
                aria-hidden="true"></div>

            <!-- Modal panel -->
            <div
                class="inline-block align-bottom bg-white rounded-[2.5rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full animate-fade-in">
                <div class="bg-white px-8 pt-10 pb-8">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-3xl bg-rose-50 sm:mx-0 sm:h-14 sm:w-14 border border-rose-100">
                            <svg class="h-8 w-8 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-6 sm:text-left">
                            <h3 class="text-2xl font-black text-heading leading-6 tracking-tight" id="modal-title">
                                Confirm Deletion</h3>
                            <div class="mt-4">
                                <p class="text-sm font-bold text-slate-500 leading-relaxed" id="delete-modal-message">
                                    Are you sure you want to delete this? This action cannot be undone and all
                                    associated data will be removed permanently.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50/50 px-8 py-6 sm:flex sm:flex-row-reverse gap-3">
                    <button type="button" id="confirm-delete-btn"
                        class="w-full inline-flex justify-center rounded-2xl border border-transparent shadow-lg shadow-rose-100 px-6 py-3 bg-rose-600 text-base font-black text-white hover:bg-rose-700 transition-all sm:w-auto sm:text-sm">
                        Yes, Delete Permanently
                    </button>
                    <button type="button" id="close-delete-modal"
                        class="mt-3 w-full inline-flex justify-center rounded-2xl border border-slate-200 shadow-sm px-6 py-3 bg-white text-base font-black text-slate-700 hover:bg-slate-50 transition-all sm:mt-0 sm:w-auto sm:text-sm">
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