@props(['icon' => 'inbox', 'message' => 'Nothing to show yet.'])
<div class="py-14 text-center">
    <div class="w-12 h-12 mx-auto rounded-xl bg-slate-100 flex items-center justify-center mb-3"><i data-lucide="{{ $icon }}" class="w-6 h-6 text-slate-400"></i></div>
    <p class="text-sm text-slate-500">{{ $message }}</p>
    {{ $slot }}
</div>
