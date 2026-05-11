<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden']) }}>
    @if(isset($header))
        <div class="px-6 py-4 border-b border-slate-50 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-slate-800">{{ $header }}</h3>
            @if(isset($action))
                <div>{{ $action }}</div>
            @endif
        </div>
    @endif
    
    <div class="p-6">
        {{ $slot }}
    </div>

    @if(isset($footer))
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
            {{ $footer }}
        </div>
    @endif
</div>
