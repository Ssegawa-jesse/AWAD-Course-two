<x-app-layout title="Registrar dashboard">
    <x-ui.page-heading :title="'Welcome, '.auth()->user()->name" subtitle="Semester I, 2026/27 · overview of students, courses and registrations.">
        <x-slot name="actions">
            @can('create students')
                <a href="{{ route('admin.students.create') }}" class="btn-primary"><i data-lucide="user-plus" class="w-4 h-4"></i>Add student</a>
            @endcan
            @can('approve registrations')
                <a href="{{ route('admin.approvals.index') }}" class="btn-accent"><i data-lucide="user-check" class="w-4 h-4"></i>Approve registrations</a>
            @endcan
        </x-slot>
    </x-ui.page-heading>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
        <x-ui.stat label="Active students" :value="number_format($stats['active'])" icon="graduation-cap" :note="$stats['courses'].' course units on offer'" />
        <x-ui.stat label="Waiting for approval" :value="$stats['pending']" icon="user-check" tone="accent" note="Students and lecturers" />
        <x-ui.stat label="Course registration done" :value="$stats['registered_pct'].'%'" icon="book-open-check" tone="indigo" :note="$stats['registrations'].' registrations in total'" />
        <x-ui.stat label="Not yet registered" :value="$stats['not_registered']" icon="triangle-alert" tone="red" note="Active students with no courses" />
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">
        <div class="xl:col-span-2 card p-6">
            <div class="flex justify-between items-center mb-5">
                <h2 class="font-bold text-lg">Students by programme</h2>
                @can('view reports')<a href="{{ route('admin.reports') }}" class="text-sm font-semibold text-brand-700">Reports</a>@endcan
            </div>
            @php $max = max(1, $byProgramme->max('students_count')); @endphp
            <div class="space-y-3">
                @foreach ($byProgramme as $programme)
                    <div class="flex items-center gap-3">
                        <span class="w-12 text-xs font-bold text-slate-500">{{ $programme->code }}</span>
                        <div class="flex-1 h-7 rounded-lg bg-slate-100 overflow-hidden"><div class="h-full rounded-lg bg-gradient-to-r from-brand-600 to-brand-400" style="width: {{ round($programme->students_count / $max * 100) }}%"></div></div>
                        <span class="w-12 text-right text-sm font-bold">{{ $programme->students_count }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="card p-6">
            <div class="flex justify-between items-center mb-2">
                <h2 class="font-bold text-lg">Waiting for approval</h2>
                <span class="text-xs font-bold px-2 py-1 rounded-full bg-accent-50 text-accent-700">{{ $stats['pending'] }}</span>
            </div>
            @forelse ($pendingUsers as $pending)
                <div class="flex items-center gap-3 py-3 border-t border-slate-100 first:border-0">
                    <x-ui.avatar :initials="$pending->initials()" :tone="$pending->account_type === 'lecturer' ? 'accent' : 'brand'" />
                    <div class="flex-1 min-w-0"><p class="text-sm font-semibold truncate">{{ $pending->name }}</p><p class="text-xs text-slate-500">{{ ucfirst($pending->account_type) }} · {{ $pending->created_at->diffForHumans() }}</p></div>
                </div>
            @empty
                <x-ui.empty icon="check-check" message="No registrations are waiting." />
            @endforelse
            @if ($stats['pending'])
                <a href="{{ route('admin.approvals.index') }}" class="btn-ghost w-full justify-center mt-3">Review all</a>
            @endif
        </div>
    </div>

    <div class="flex justify-between items-center mb-4">
        <h2 class="font-bold text-lg">Recently updated students</h2>
        <a href="{{ route('admin.students.index') }}" class="text-sm font-semibold text-brand-700">All students</a>
    </div>
    @include('admin.students._table', ['students' => $recentStudents])
</x-app-layout>
