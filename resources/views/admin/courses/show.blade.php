<x-app-layout :title="$course->code">
    <x-ui.page-heading :title="$course->code.' · '.$course->title" :subtitle="($course->programme?->name ?? 'No programme').' · Year '.$course->year_of_study.', Semester '.$course->semester" :crumbs="['Course units' => route('admin.courses.index'), $course->code => null]">
        <x-slot name="actions">
            @can('update', $course)<a href="{{ route('admin.courses.edit', $course) }}" class="btn-ghost"><i data-lucide="pencil" class="w-4 h-4"></i>Edit</a>@endcan
            @can('delete', $course)<x-ui.delete-button :action="route('admin.courses.destroy', $course)" label="Delete" :confirm="'Delete course '.$course->code.'?'" />@endcan
        </x-slot>
    </x-ui.page-heading>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">
        <x-ui.stat label="Registered students" :value="$course->students->count().' / '.$course->capacity" icon="users-round" />
        <x-ui.stat label="Credit units" :value="$course->credit_units" icon="layers" tone="indigo" :note="$course->type" />
        <x-ui.stat label="Lecturer" :value="$course->lecturer ? Str::of($course->lecturer->name)->limit(18) : '—'" icon="presentation" tone="accent" :note="$course->lecturer?->department" />
        <x-ui.stat label="Timetable" :value="$course->day ?? '—'" icon="calendar-days" :note="$course->scheduleLabel().($course->room ? ' · '.$course->room : '')" />
    </div>

    {{-- Eloquent: $course->students (belongsToMany through course_registrations) --}}
    <div class="card overflow-hidden mb-6">
        <x-ui.card-header title="Students registered for this course" :subtitle="$course->students->count().' students'" icon="users-round" />
        <div class="overflow-x-auto">
            <table class="w-full min-w-[640px]">
                <thead><tr class="bg-slate-50"><th class="table-th">Student</th><th class="table-th">Programme</th><th class="table-th">Registered on</th><th class="table-th">Marks</th><th class="table-th">Grade</th><th class="table-th"></th></tr></thead>
                <tbody>
                    @forelse ($course->students as $student)
                        <tr class="border-t border-slate-100">
                            <td class="table-td"><a href="{{ route('admin.students.show', $student) }}" class="flex items-center gap-3"><x-ui.avatar :initials="$student->initials" /><div><p class="font-semibold">{{ $student->full_name }}</p><p class="text-xs text-slate-500">{{ $student->student_number }}</p></div></a></td>
                            <td class="table-td">{{ $student->programme?->code }}</td>
                            <td class="table-td">{{ $student->pivot->created_at?->format('d M Y') }}</td>
                            <td class="table-td">{{ $student->pivot->coursework_mark !== null ? $student->pivot->coursework_mark.' + '.$student->pivot->exam_mark : '—' }}</td>
                            <td class="table-td font-bold">{{ $student->pivot->grade ?? '—' }}</td>
                            <td class="table-td text-right">
                                @can('manage registrations')
                                    <x-ui.delete-button :action="route('admin.registrations.destroy', $student->pivot->id)" icon="x" :confirm="'Remove '.$student->full_name.' from '.$course->code.'?'" />
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><x-ui.empty icon="users-round" message="No students have registered for this course yet." /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @can('manage registrations')
        <form method="POST" action="{{ route('admin.registrations.store') }}" class="card p-5 flex flex-col sm:flex-row sm:items-end gap-3 max-w-3xl">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <input type="hidden" name="redirect_to" value="{{ route('admin.courses.show', $course) }}">
            <x-ui.select class="flex-1" name="student_id" label="Add a student to this course" :options="$available" required />
            <button class="btn-primary justify-center"><i data-lucide="plus" class="w-4 h-4"></i>Register</button>
        </form>
    @endcan
</x-app-layout>
