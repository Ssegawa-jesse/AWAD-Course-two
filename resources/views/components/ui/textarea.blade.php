@props(['name', 'label', 'value' => null, 'required' => false, 'rows' => 4])
<div {{ $attributes->only('class') }}>
    <label for="{{ $name }}" class="field-label">{{ $label }} @if ($required)<span class="text-accent-600">*</span>@endif</label>
    <textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}" @required($required) {{ $attributes->except('class')->merge(['class' => 'input-field']) }}>{{ old($name, $value) }}</textarea>
    <x-ui.error :field="$name" />
</div>
