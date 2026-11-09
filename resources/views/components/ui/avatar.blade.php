@props(['initials' => '?', 'tone' => 'brand', 'size' => 'w-9 h-9'])
@php
    $tones = ['brand' => 'bg-brand-100 text-brand-800', 'accent' => 'bg-accent-100 text-accent-700', 'slate' => 'bg-slate-200 text-slate-700', 'indigo' => 'bg-indigo-100 text-indigo-700'];
@endphp
<div {{ $attributes->merge(['class' => "$size rounded-full {$tones[$tone]} flex items-center justify-center text-xs font-bold shrink-0"]) }}>{{ $initials }}</div>
