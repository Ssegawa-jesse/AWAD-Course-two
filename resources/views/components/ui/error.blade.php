@props(['field'])
@error($field)
    <p {{ $attributes->merge(['class' => 'mt-1.5 text-xs font-medium text-red-600']) }}>{{ $message }}</p>
@enderror
