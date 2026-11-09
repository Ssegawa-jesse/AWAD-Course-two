@props(['action', 'confirm' => 'Are you sure? This cannot be undone.', 'label' => null, 'icon' => 'trash-2'])
<form method="POST" action="{{ $action }}" onsubmit="return confirm(@js($confirm))" class="inline">
    @csrf
    @method('DELETE')
    @if ($label)
        <button type="submit" {{ $attributes->merge(['class' => 'btn-danger']) }}><i data-lucide="{{ $icon }}" class="w-4 h-4"></i>{{ $label }}</button>
    @else
        <button type="submit" class="icon-btn icon-btn-danger" title="Delete"><i data-lucide="{{ $icon }}" class="w-4 h-4"></i></button>
    @endif
</form>
