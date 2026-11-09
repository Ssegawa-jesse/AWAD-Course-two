<x-app-layout :title="'Edit '.$programme->code">
    <x-ui.page-heading :title="'Edit '.$programme->code" :subtitle="$programme->name" :crumbs="['Programmes' => route('admin.programmes.index'), 'Edit' => null]" />
    <form method="POST" action="{{ route('admin.programmes.update', $programme) }}" class="space-y-6 max-w-3xl" novalidate>
        @csrf
        @method('PUT')
        @include('admin.programmes._form')
        <div class="flex justify-end gap-2"><a href="{{ route('admin.programmes.index') }}" class="btn-ghost">Cancel</a><button class="btn-primary"><i data-lucide="save" class="w-4 h-4"></i>Save changes</button></div>
    </form>
</x-app-layout>
