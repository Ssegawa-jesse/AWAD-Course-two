<x-app-layout :title="$course->code.' class list'">
    <x-ui.page-heading :title="$course->code.' · '.$course->title" :subtitle="$students->count().' registered students · '.$course->scheduleLabel().($course->room ? ' · '.$course->room : '')" :crumbs="['My courses' => route('lecturer.courses.index'), $course->code => null]">
        <x-slot name="actions">
            <button onclick="window.print()" class="btn-ghost no-print"><i data-lucide="printer" class="w-4 h-4"></i>Print list</button>
            @can('enterMarks', $course)
                <a href="{{ route('lecturer.courses.marks.edit', $course) }}" class="btn-primary"><i data-lucide="pen-line" class="w-4 h-4"></i>Enter marks</a>
            @endcan
        </x-slot>
    </x-ui.page-heading>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[640px]">
                <thead><tr class="bg-slate-50"><th class="table-th">#</th><th class="table-th">Student</th><th class="table-th">Student number</th><th class="table-th">Programme</th><th class="table-th">Email</th><th class="table-th">Grade</th></tr></thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr class="border-t border-slate-100">
                            <td class="table-td text-slate-400">{{ $loop->iteration }}</td>
                            <td class="table-td"><div class="flex items-center gap-3"><x-ui.avatar :initials="$student->initials" /><span class="font-semibold">{{ $student->full_name }}</span></div></td>
                            <td class="table-td">{{ $student->student_number }}</td>
                            <td class="table-td">{{ $student->programme?->code }} · Year {{ $student->year_of_study }}</td>
                            <td class="table-td text-slate-500">{{ $student->email }}</td>
                            <td class="table-td font-bold">{{ $student->pivot->grade ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><x-ui.empty icon="users-round" message="No students have registered for this course yet." /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
