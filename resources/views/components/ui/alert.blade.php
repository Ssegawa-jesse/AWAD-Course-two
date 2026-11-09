@props(['type' => 'success'])
@php
    $styles = [
        'success' => ['bg-brand-50 border-brand-200 text-brand-800', 'circle-check'],
        'error' => ['bg-red-50 border-red-100 text-red-700', 'circle-alert'],
        'warning' => ['bg-accent-50 border-accent-200 text-accent-700', 'triangle-alert'],
        'info' => ['bg-white border-slate-200 text-slate-600', 'info'],
    ][$type] ?? ['bg-white border-slate-200 text-slate-600', 'info'];
@endphp
<div {{ $attributes->merge(['class' => "flex items-start gap-2 p-3 rounded-xl border text-sm {$styles[0]}"]) }} role="alert">
    <i data-lucide="{{ $styles[1] }}" class="w-4 h-4 mt-0.5 shrink-0"></i>
    <div class="flex-1">{{ $slot }}</div>
</div>
