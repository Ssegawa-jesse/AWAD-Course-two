<x-app-layout title="Add student">
    <x-ui.page-heading title="Add student" subtitle="Use this for walk-in registrations. Online registrations appear under Approvals." :crumbs="['Students' => route('admin.students.index'), 'Add student' => null]" />

    <form method="POST" action="{{ route('admin.students.store') }}" class="space-y-6 max-w-4xl" novalidate>
        @csrf
        @include('admin.students._form')

        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.students.index') }}" class="btn-ghost">Cancel</a>
            <button type="submit" class="btn-primary"><i data-lucide="save" class="w-4 h-4"></i>Save student</button>
        </div>
    </form>
</x-app-layout>
