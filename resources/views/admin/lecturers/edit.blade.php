<x-app-layout :title="'Edit '.$lecturer->name">
    <x-ui.page-heading :title="'Edit '.$lecturer->name" :subtitle="$lecturer->staff_number" :crumbs="['Lecturers' => route('admin.lecturers.index'), 'Edit' => null]" />
    <form method="POST" action="{{ route('admin.lecturers.update', $lecturer) }}" class="space-y-6 max-w-3xl" novalidate>
        @csrf
        @method('PUT')
        @include('admin.lecturers._form')
        <div class="flex justify-end gap-2"><a href="{{ route('admin.lecturers.index') }}" class="btn-ghost">Cancel</a><button class="btn-primary"><i data-lucide="save" class="w-4 h-4"></i>Save changes</button></div>
    </form>
</x-app-layout>
