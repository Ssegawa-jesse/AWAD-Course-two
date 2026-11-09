@props(['title', 'subtitle' => null, 'icon' => 'file-text'])
<div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
    <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center"><i data-lucide="{{ $icon }}" class="w-4 h-4 text-brand-600"></i></div>
    <div class="flex-1"><h2 class="font-bold">{{ $title }}</h2>@if ($subtitle)<p class="text-xs text-slate-500">{{ $subtitle }}</p>@endif</div>
    {{ $slot }}
</div>
