<x-app-layout title="Register a student">
    <x-ui.page-heading title="Register a student for a course" subtitle="Duplicate registrations, full courses and credit loads above the limit are rejected." :crumbs="['Registrations' => route('admin.registrations.index'), 'New' => null]" />

    <form method="POST" action="{{ route('admin.registrations.store') }}" class="card max-w-3xl" novalidate>
        @csrf
        <x-ui.card-header title="Registration" icon="book-open-check" />
        <div class="p-6 grid gap-5">
            <x-ui.select name="student_id" label="Student" :options="$students" :value="$selectedStudent" required />
            <x-ui.select name="course_id" label="Course" :options="$courses" :value="$selectedCourse" required />
        </div>
        <div class="px-6 pb-6 flex justify-end gap-2">
            <a href="{{ route('admin.registrations.index') }}" class="btn-ghost">Cancel</a>
            <button class="btn-primary"><i data-lucide="check" class="w-4 h-4"></i>Register</button>
        </div>
    </form>
</x-app-layout>
