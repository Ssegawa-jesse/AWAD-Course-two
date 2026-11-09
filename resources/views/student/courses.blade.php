<x-app-layout title="Course registration">
    <x-ui.page-heading title="Course registration" subtitle="Tick the courses you want for Semester I, 2026/27 and press Register. You cannot register the same course twice." :crumbs="['Academics' => null, 'Course registration' => null]" />

    {{-- Eligibility + credit load --}}
    <div class="card p-5 mb-6 flex flex-col md:flex-row md:items-center gap-5">
        <div class="flex items-center gap-4 flex-1">
            @if ($student->status === 'Active')
                <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center"><i data-lucide="badge-check" class="w-6 h-6 text-brand-600"></i></div>
                <div><p class="font-bold">You can register</p><p class="text-sm text-slate-500">{{ $student->programme?->name }} · Year {{ $student->year_of_study }}</p></div>
            @else
                <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center"><i data-lucide="ban" class="w-6 h-6 text-red-600"></i></div>
                <div><p class="font-bold">Registration blocked</p><p class="text-sm text-slate-500">Your status is {{ $student->status }}.</p></div>
            @endif
        </div>
        <div class="md:w-72">
            <div class="flex justify-between text-xs font-semibold mb-1.5"><span>Credit load</span><span class="text-brand-700">{{ $credits }} / {{ $maxCredits }} CU</span></div>
            <div class="progress {{ $credits > $maxCredits * 0.9 ? 'warn' : '' }}"><span style="width: {{ min(100, round($credits / $maxCredits * 100)) }}%"></span></div>
            <p class="text-[11px] text-slate-400 mt-1.5">Maximum {{ $maxCredits }} credit units per semester</p>
        </div>
    </div>

    <form method="POST" action="{{ route('student.courses.store') }}">
        @csrf
        <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
            <h2 class="font-bold">{{ $showAll ? 'All courses' : 'Courses for '.$student->programme?->code }}</h2>
            <a href="{{ route('student.courses.index', $showAll ? [] : ['all' => 1]) }}" class="text-sm font-semibold text-brand-700">{{ $showAll ? 'Show my programme only' : 'Show courses from all programmes' }}</a>
        </div>

        <div class="grid md:grid-cols-2 gap-4 mb-6">
            @forelse ($courses as $course)
                @php
                    $isRegistered = $registeredIds->contains($course->id);
                    $isFull = $course->registrations_count >= $course->capacity;
                @endphp
                <label class="pick-card card p-4 flex items-start gap-4 transition {{ $isRegistered || $isFull ? 'opacity-70 cursor-not-allowed' : 'cursor-pointer hover:border-brand-300' }}">
                    <input type="checkbox" name="course_ids[]" value="{{ $course->id }}" class="mt-1 w-5 h-5 rounded accent-brand-700"
                           @checked(in_array($course->id, old('course_ids', [])))
                           @disabled($isRegistered || $isFull || $student->status !== 'Active')>
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <span class="text-xs font-extrabold text-brand-700">{{ $course->code }}</span>
                            <x-ui.badge :value="$course->type" />
                            @if ($isRegistered)<x-ui.badge value="Registered">Registered</x-ui.badge>@elseif ($isFull)<x-ui.badge value="Full">Full</x-ui.badge>@endif
                        </div>
                        <p class="font-semibold">{{ $course->title }}</p>
                        <p class="text-xs text-slate-500 mt-1">{{ $course->lecturer?->name ?? 'Lecturer not assigned' }} · {{ $course->scheduleLabel() }}</p>
                        <p class="text-[11px] text-slate-400 mt-1">Year {{ $course->year_of_study }} · {{ $course->registrations_count }}/{{ $course->capacity }} places taken</p>
                    </div>
                    <div class="text-right shrink-0"><p class="text-xl font-extrabold">{{ $course->credit_units }}</p><p class="text-[10px] uppercase font-bold text-slate-400">CU</p></div>
                </label>
            @empty
                <div class="card md:col-span-2"><x-ui.empty icon="library" message="No courses are available for your programme yet." /></div>
            @endforelse
        </div>

        <x-ui.error field="course_ids" class="mb-3" />

        @if ($student->status === 'Active')
            <div class="flex justify-end gap-2">
                <a href="{{ route('student.registrations.index') }}" class="btn-ghost">My registrations</a>
                <button type="submit" class="btn-primary"><i data-lucide="check" class="w-4 h-4"></i>Register selected courses</button>
            </div>
        @endif
    </form>
</x-app-layout>
