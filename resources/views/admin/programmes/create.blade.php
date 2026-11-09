<x-app-layout title="Add programme">
    <x-ui.page-heading title="Add programme" :crumbs="['Programmes' => route('admin.programmes.index'), 'Add' => null]" />
    <form method="POST" action="{{ route('admin.programmes.store') }}" class="space-y-6 max-w-3xl" novalidate>
        @csrf
        @include('admin.programmes._form')
        <div class="flex justify-end gap-2"><a href="{{ route('admin.programmes.index') }}" class="btn-ghost">Cancel</a><button class="btn-primary"><i data-lucide="save" class="w-4 h-4"></i>Save programme</button></div>
    </form>
</x-app-layout>
