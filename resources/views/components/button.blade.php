@props(['variant' => 'primary'])

@php
$baseClasses = 'inline-flex items-center px-4 py-2 border border-transparent rounded-xl font-semibold text-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50';

$variants = [
    'primary' => 'bg-blue-600 text-white hover:bg-blue-700 shadow-md shadow-blue-200 focus:ring-blue-500',
    'secondary' => 'bg-slate-800 text-white hover:bg-slate-900 shadow-md shadow-slate-200 focus:ring-slate-500',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 shadow-md shadow-red-200 focus:ring-red-500',
    'white' => 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50 shadow-sm focus:ring-slate-500',
    'ghost' => 'bg-transparent text-slate-600 hover:bg-slate-100 focus:ring-slate-500',
];

$classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

<button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>
    {{ $slot }}
</button>
