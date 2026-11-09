@props(['name', 'label', 'options' => [], 'value' => null, 'required' => false, 'placeholder' => 'Choose…'])
{{-- options: either a list ['Day','Evening'] or a map [id => label] --}}
@php
    $id = str_replace(['[', ']'], '_', $name);
    $selected = (string) old($name, $value);
    $isList = array_is_list(is_array($options) ? $options : $options->all());
@endphp
<div {{ $attributes->only('class') }}>
    <label for="{{ $id }}" class="field-label">{{ $label }} @if ($required)<span class="text-accent-600">*</span>@endif</label>
    <select id="{{ $id }}" name="{{ $name }}" @required($required) {{ $attributes->except('class')->merge(['class' => 'input-field']) }} @error($name) aria-invalid="true" @enderror>
        @if ($placeholder !== false)<option value="">{{ $placeholder }}</option>@endif
        @foreach ($options as $key => $text)
            @php $optValue = $isList ? $text : $key; @endphp
            <option value="{{ $optValue }}" @selected($selected !== '' && $selected === (string) $optValue)>{{ $text }}</option>
        @endforeach
    </select>
    <x-ui.error :field="$name" />
</div>
