@props(['name', 'label', 'type' => 'text', 'value' => null, 'required' => false, 'hint' => null])
@php $id = $attributes->get('id', str_replace(['[', ']'], '_', $name)); @endphp
<div {{ $attributes->only('class') }}>
    <label for="{{ $id }}" class="field-label">{{ $label }} @if ($required)<span class="text-accent-600">*</span>@endif</label>
    <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}"
           @if ($type !== 'password') value="{{ old($name, $value) }}" @endif
           @required($required)
           {{ $attributes->except(['class', 'id'])->merge(['class' => 'input-field']) }}
           @error($name) aria-invalid="true" @enderror>
    @if ($hint)<p class="mt-1 text-[11px] text-slate-400">{{ $hint }}</p>@endif
    <x-ui.error :field="$name" />
</div>
