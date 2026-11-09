<x-app-layout title="Student dashboard">
    <x-ui.page-heading :title="'Welcome, '.$student->first_name" :subtitle="($student->programme?->name ?? 'No programme').' · Year '.$student->year_of_study.' · '.$student->study_mode">
        <x-slot name="actions">
            @can('register courses')
                <a href="{{ route('student.courses.index') }}" class="btn-accent"><i data-lucide="book-open-check" class="w-4 h-4"></i>Register courses</a>
            @endcan
        </x-slot>
    </x-ui.page-heading>

    @if ($student->status !== 'Active')
        <x-ui.alert type="warning" class="mb-6">Your status is <b>{{ $student->status }}</b>. You cannot register for new courses. Please contact the Registrar.</x-ui.alert>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
        <x-ui.stat label="Student number" :value="$student->student_number" icon="id-card" />
        <x-ui.stat label="Registered courses" :value="$courses->count()" icon="book-open-check" tone="indigo" :note="$availableCount.' more available in your programme'" />
        <x-ui.stat label="Credit units" :value="$credits" icon="layers" tone="accent" note="Maximum 27 CU per semester" />
        <x-ui.stat label="CGPA" :value="$gpa !== null ? number_format($gpa, 2) : '—'" icon="award" :note="$gpa !== null ? 'From graded courses' : 'No results yet'" />
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-2 card overflow-hidden">
            <x-ui.card-header title="My registered courses" :subtitle="'Semester I, 2026/27'" icon="book-open-check">
                <a href="{{ route('student.registrations.index') }}" class="text-sm font-semibold text-brand-700">Manage</a>
            </x-ui.card-header>
            <div class="divide-y divide-slate-100">
                @forelse ($courses as $course)
                    <div class="px-6 py-4 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 flex flex-col items-center justify-center shrink-0"><span class="text-lg font-extrabold text-brand-700 leading-none">{{ $course->credit_units }}</span><span class="text-[9px] font-bold text-brand-600">CU</span></div>
                        <div class="flex-1 min-w-0"><p class="text-xs font-extrabold text-brand-700">{{ $course->code }}</p><p class="font-semibold truncate">{{ $course->title }}</p><p class="text-xs text-slate-500">{{ $course->lecturer?->name ?? 'Lecturer not assigned' }}</p></div>
                        <div class="text-right text-xs text-slate-500 hidden sm:block">{{ $course->scheduleLabel() }}<br>{{ $course->room }}</div>
                    </div>
                @empty
                    <x-ui.empty icon="book-x" message="You have not registered for any course yet.">
                        <a href="{{ route('student.courses.index') }}" class="btn-primary mt-4">Register now</a>
                    </x-ui.empty>
                @endforelse
            </div>
        </div>

        <div class="card p-6 h-fit">
            <h2 class="font-bold text-lg mb-1">Today's classes</h2>
            <p class="text-xs text-slate-500 mb-4">{{ $today }}</p>
            @forelse ($todayClasses as $class)
                <div class="flex items-center gap-3 p-3 rounded-xl border border-slate-100 mb-2">
                    <span class="text-xs font-bold text-brand-700 w-12">{{ substr($class->start_time, 0, 5) }}</span>
                    <div class="flex-1 min-w-0"><p class="text-sm font-semibold truncate">{{ $class->title }}</p><p class="text-xs text-slate-500">{{ $class->room }} · {{ $class->lecturer?->name }}</p></div>
                </div>
            @empty
                <x-ui.empty icon="coffee" message="No classes today." />
            @endforelse
            <a href="{{ route('student.timetable') }}" class="btn-ghost w-full justify-center mt-3"><i data-lucide="calendar-days" class="w-4 h-4"></i>Full timetable</a>
        </div>
    </div>
</x-app-layout>
