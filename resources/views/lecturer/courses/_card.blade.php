<div class="card p-5 flex flex-col">
    <div class="flex items-start justify-between gap-3 mb-3">
        <div>
            <p class="text-xs font-extrabold text-brand-700">{{ $course->code }}</p>
            <p class="font-bold leading-snug">{{ $course->title }}</p>
        </div>
        <x-ui.badge :value="$course->type" />
    </div>
    <div class="text-sm text-slate-500 space-y-1.5 mb-4">
        <p class="flex items-center gap-2"><i data-lucide="calendar-days" class="w-4 h-4"></i>{{ $course->scheduleLabel() }}{{ $course->room ? ' · '.$course->room : '' }}</p>
        <p class="flex items-center gap-2"><i data-lucide="layers" class="w-4 h-4"></i>{{ $course->programme?->code }} · Year {{ $course->year_of_study }} · {{ $course->credit_units }} CU</p>
        <p class="flex items-center gap-2"><i data-lucide="users-round" class="w-4 h-4"></i>{{ $course->registrations_count }} of {{ $course->capacity }} students</p>
    </div>
    <div class="mt-auto flex gap-2">
        @can('viewStudents', $course)
            <a href="{{ route('lecturer.courses.show', $course) }}" class="btn-ghost flex-1 justify-center"><i data-lucide="users-round" class="w-4 h-4"></i>Class list</a>
        @endcan
        @can('enterMarks', $course)
            <a href="{{ route('lecturer.courses.marks.edit', $course) }}" class="btn-primary flex-1 justify-center"><i data-lucide="pen-line" class="w-4 h-4"></i>Marks</a>
        @endcan
    </div>
</div>
