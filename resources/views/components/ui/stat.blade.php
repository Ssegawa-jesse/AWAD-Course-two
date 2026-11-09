@props(['label', 'value', 'icon' => 'activity', 'tone' => 'brand', 'note' => null])
@php
    $tones = ['brand' => ['bg-brand-50', 'text-brand-600'], 'accent' => ['bg-accent-50', 'text-accent-600'], 'indigo' => ['bg-indigo-50', 'text-indigo-600'], 'red' => ['bg-red-50', 'text-red-600']][$tone];
@endphp
<div class="card p-5">
    <div class="flex items-start justify-between">
        <div>
            <p class="text-sm text-slate-500">{{ $label }}</p>
            <p class="text-3xl font-extrabold tracking-tight mt-1">{{ $value }}</p>
        </div>
        <div class="w-11 h-11 rounded-xl {{ $tones[0] }} flex items-center justify-center"><i data-lucide="{{ $icon }}" class="w-5 h-5 {{ $tones[1] }}"></i></div>
    </div>
    @if ($note)<p class="text-xs text-slate-400 mt-3">{{ $note }}</p>@endif
</div>
