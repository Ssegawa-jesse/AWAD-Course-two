<x-app-layout :title="'Edit '.$student->full_name">
    <x-ui.page-heading :title="'Edit '.$student->full_name" :subtitle="'Student number '.$student->student_number" :crumbs="['Students' => route('admin.students.index'), $student->full_name => route('admin.students.show', $student), 'Edit' => null]" />

    <form method="POST" action="{{ route('admin.students.update', $student) }}" class="space-y-6 max-w-4xl" novalidate>
        @csrf
        @method('PUT')
        @include('admin.students._form')

        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.students.show', $student) }}" class="btn-ghost">Cancel</a>
            <button type="submit" class="btn-primary"><i data-lucide="save" class="w-4 h-4"></i>Save changes</button>
        </div>
    </form>
</x-app-layout>
