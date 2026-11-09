<x-app-layout title="Add lecturer">
    <x-ui.page-heading title="Add lecturer" subtitle="Creates a login account with the lecturer role." :crumbs="['Lecturers' => route('admin.lecturers.index'), 'Add' => null]" />
    <form method="POST" action="{{ route('admin.lecturers.store') }}" class="space-y-6 max-w-3xl" novalidate>
        @csrf
        @include('admin.lecturers._form')
        <div class="flex justify-end gap-2"><a href="{{ route('admin.lecturers.index') }}" class="btn-ghost">Cancel</a><button class="btn-primary"><i data-lucide="save" class="w-4 h-4"></i>Save lecturer</button></div>
    </form>
</x-app-layout>
