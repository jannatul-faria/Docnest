<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? get_setting('site_name', 'DocNest') . ' - ' . get_setting('site_title', 'Find the Best Doctors Near You') }}</title>

    <!-- Favicon -->
    @if(get_setting('favicon'))
        <link rel="icon" type="image/png" href="{{ asset('storage/' . get_setting('favicon')) }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    @php
        function hexToRgb($hex) {
            $hex = str_replace('#', '', $hex);
            if(strlen($hex) == 3) {
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
        $primaryColor = get_setting('primary_color', '#008947');
        $headingColor = get_setting('heading_color', '#0f172a');
        $primaryRgb = hexToRgb($primaryColor);
        $headingRgb = hexToRgb($headingColor);
    @endphp

    <style>
        :root {
            --primary-color: {{ $primaryColor }};
            --primary-rgb: {{ $primaryRgb }};
            --heading-color: {{ $headingColor }};
            --heading-rgb: {{ $headingRgb }};
            --bg-color: {{ get_setting('bg_color', '#f8fafc') }};
        }

        body { 
            font-family: 'Outfit', sans-serif; 
            background-color: var(--bg-color);
        }
        
        h1, h2, h3, h4, h5, h6 {
            color: var(--heading-color) !important;
        }

        .text-primary { color: var(--primary-color); }
        .bg-primary { background-color: var(--primary-color); }
        .border-primary { border-color: var(--primary-color); }

        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .hero-gradient {
            background: radial-gradient(circle at top right, rgba({{ $primaryRgb }}, 0.08), transparent 40%),
                        radial-gradient(circle at bottom left, rgba(59, 130, 246, 0.05), transparent 40%);
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        outfit: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            DEFAULT: 'var(--primary-color)',
                            light: 'rgba(var(--primary-rgb), 0.1)',
                            dark: 'rgba(var(--primary-rgb), 0.9)',
                        },
                        heading: 'var(--heading-color)',
                    }
                }
            }
        }
    </script>
</head>
<body class="antialiased text-slate-900">
    <x-frontend.header />

    <main>
        {{ $slot }}
    </main>

    <x-frontend.footer />

    @stack('scripts')
</body>
</html>
