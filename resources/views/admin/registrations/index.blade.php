<x-app-layout title="Course registrations">
    <x-ui.page-heading title="Course registrations" subtitle="Which student is registered for which course (the course_registrations table)." :crumbs="['Academics' => null, 'Registrations' => null]">
        <x-slot name="actions">
            @can('manage registrations')
                <a href="{{ route('admin.registrations.create') }}" class="btn-primary"><i data-lucide="plus" class="w-4 h-4"></i>Register a student</a>
            @endcan
        </x-slot>
    </x-ui.page-heading>

    <form method="GET" class="card p-4 mb-5 grid sm:grid-cols-2 lg:grid-cols-4 gap-3">
        <div class="lg:col-span-2 relative">
            <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Student name or number" class="input-field !pl-10">
        </div>
        <select name="course" class="input-field">
            <option value="">All courses</option>
            @foreach ($courses as $id => $code)<option value="{{ $id }}" @selected(request('course') == $id)>{{ $code }}</option>@endforeach
        </select>
        <button class="btn-primary justify-center"><i data-lucide="filter" class="w-4 h-4"></i>Filter</button>
    </form>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[820px]">
                <thead><tr class="bg-slate-50"><th class="table-th">Student</th><th class="table-th">Course</th><th class="table-th">Lecturer</th><th class="table-th">Year / Sem</th><th class="table-th">Grade</th><th class="table-th">Registered</th><th class="table-th"></th></tr></thead>
                <tbody>
                    @forelse ($registrations as $registration)
                        <tr class="border-t border-slate-100 hover:bg-brand-50/40">
                            <td class="table-td"><a href="{{ route('admin.students.show', $registration->student) }}" class="font-semibold hover:text-brand-700">{{ $registration->student->full_name }}</a><p class="text-xs text-slate-500">{{ $registration->student->student_number }} · {{ $registration->student->programme?->code }}</p></td>
                            <td class="table-td"><a href="{{ route('admin.courses.show', $registration->course) }}" class="font-bold text-brand-700">{{ $registration->course->code }}</a><p class="text-xs text-slate-500">{{ $registration->course->title }}</p></td>
                            <td class="table-td">{{ $registration->course->lecturer?->name ?? '—' }}</td>
                            <td class="table-td">{{ $registration->academic_year }} · {{ $registration->semester }}</td>
                            <td class="table-td font-bold">{{ $registration->grade ?? '—' }}</td>
                            <td class="table-td text-slate-500">{{ $registration->created_at?->format('d M Y') }}</td>
                            <td class="table-td text-right">
                                @can('delete', $registration)
                                    <x-ui.delete-button :action="route('admin.registrations.destroy', $registration)" icon="x" :confirm="'Remove this registration?'" />
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7"><x-ui.empty icon="book-open-check" message="No registrations found." /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">{{ $registrations->links() }}</div>
</x-app-layout>
