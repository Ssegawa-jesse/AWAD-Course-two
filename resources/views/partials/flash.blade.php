{{-- Success and error messages (set with ->with('success', ...) / ->with('error', ...)) --}}
@if (session('success'))
    <x-ui.alert type="success" class="mb-6" data-flash>{{ session('success') }}</x-ui.alert>
@endif

@if (session('error'))
    <x-ui.alert type="error" class="mb-6" data-flash>{{ session('error') }}</x-ui.alert>
@endif

@if ($errors->any())
    <x-ui.alert type="error" class="mb-6">
        <p class="font-semibold">Please fix the following:</p>
        <ul class="list-disc ml-4 mt-1 space-y-0.5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-ui.alert>
@endif
