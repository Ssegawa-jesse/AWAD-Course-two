<x-app-layout title="Add course">
    <x-ui.page-heading title="Add course unit" subtitle="Create a course and assign a lecturer." :crumbs="['Course units' => route('admin.courses.index'), 'Add course' => null]" />

    <form method="POST" action="{{ route('admin.courses.store') }}" class="space-y-6 max-w-4xl" novalidate>
        @csrf
        @include('admin.courses._form')
        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.courses.index') }}" class="btn-ghost">Cancel</a>
            <button type="submit" class="btn-primary"><i data-lucide="save" class="w-4 h-4"></i>Save course</button>
        </div>
    </form>
</x-app-layout>
