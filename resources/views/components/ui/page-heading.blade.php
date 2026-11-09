@props(['title', 'subtitle' => null, 'crumbs' => []])
{{-- crumbs: ['Label' => url-or-null, ...] --}}
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-7">
    <div>
        @if (count($crumbs))
            <nav class="flex items-center gap-2 text-xs text-slate-400 mb-2">
                @foreach ($crumbs as $label => $url)
                    @if ($url)
                        <a href="{{ $url }}" class="hover:text-brand-700">{{ $label }}</a>
                    @else
                        <span class="text-slate-700">{{ $label }}</span>
                    @endif
                    @unless ($loop->last)<i data-lucide="chevron-right" class="w-3 h-3"></i>@endunless
                @endforeach
            </nav>
        @endif
        <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">{{ $title }}</h1>
        @if ($subtitle)
            <p class="text-slate-500 mt-1 text-sm">{{ $subtitle }}</p>
        @endif
    </div>
    @isset($actions)
        <div class="flex flex-wrap gap-2">{{ $actions }}</div>
    @endisset
</div>
