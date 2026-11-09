@php
    $user = auth()->user();

    /*
     | Menu groups. Each link is only shown if the signed-in user has the
     | permission named in 'can' (Spatie permissions via @can / Gate).
     */
    $menu = [];

    if ($user->hasRole('admin')) {
        $menu = [
            'Overview' => [
                ['Dashboard', 'admin.dashboard', 'layout-dashboard', 'admin.dashboard', null],
                ['Approvals', 'admin.approvals.index', 'user-check', 'admin.approvals.*', 'approve registrations'],
            ],
            'Records' => [
                ['Students', 'admin.students.index', 'graduation-cap', 'admin.students.*', 'view students'],
                ['Lecturers', 'admin.lecturers.index', 'presentation', 'admin.lecturers.*', 'manage lecturers'],
                ['Users & roles', 'admin.users.index', 'shield-check', 'admin.users.*', 'manage users'],
            ],
            'Academics' => [
                ['Programmes', 'admin.programmes.index', 'layers', 'admin.programmes.*', 'manage programmes'],
                ['Course units', 'admin.courses.index', 'library', 'admin.courses.*', 'view courses'],
                ['Registrations', 'admin.registrations.index', 'book-open-check', 'admin.registrations.*', 'view registrations'],
                ['Reports', 'admin.reports', 'bar-chart-3', 'admin.reports', 'view reports'],
            ],
        ];
        $subtitle = "Academic Registrar's Office";
    } elseif ($user->hasRole('lecturer')) {
        $menu = [
            'Overview' => [
                ['Dashboard', 'lecturer.dashboard', 'layout-dashboard', 'lecturer.dashboard', null],
            ],
            'Teaching' => [
                ['My courses', 'lecturer.courses.index', 'users-round', 'lecturer.courses.*', 'view assigned courses'],
            ],
        ];
        $subtitle = $user->lecturer?->department ?? 'Lecturer';
    } elseif ($user->hasRole('student')) {
        $menu = [
            'Overview' => [
                ['Dashboard', 'student.dashboard', 'layout-dashboard', 'student.dashboard', null],
            ],
            'Academics' => [
                ['Course registration', 'student.courses.index', 'book-open-check', 'student.courses.*', 'view available courses'],
                ['My registrations', 'student.registrations.index', 'list-checks', 'student.registrations.*', 'view own registrations'],
                ['Timetable', 'student.timetable', 'calendar-days', 'student.timetable', 'view own registrations'],
                ['Results', 'student.results', 'award', 'student.results', 'view own results'],
            ],
        ];
        $subtitle = $user->student?->student_number ?? 'Student';
    }

    $menu['Account'] = [['My profile', 'profile.show', 'user-round-cog', 'profile.show', null]];
@endphp

<aside class="fixed top-0 left-0 z-40 w-[260px] h-screen -translate-x-full peer-checked:translate-x-0 lg:translate-x-0 transition-transform bg-brand-950 text-brand-100 flex flex-col sidebar-pattern">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-5 h-16 border-b border-white/10 shrink-0">
        <img src="{{ asset('assets/img/logo.svg') }}" alt="ScholarDesk" class="h-9 w-9">
        <div class="leading-tight">
            <p class="font-extrabold text-white tracking-tight">ScholarDesk</p>
            <p class="text-[11px] text-brand-300">Student Management System</p>
        </div>
    </a>

    <nav class="flex-1 px-3 py-6 overflow-y-auto sidebar-scrollbar">
        @foreach ($menu as $group => $links)
            @php $visible = collect($links)->filter(fn ($l) => $l[4] === null || $user->can($l[4])); @endphp
            @if ($visible->isNotEmpty())
                <div class="mb-6">
                    <p class="nav-label">{{ $group }}</p>
                    <div class="space-y-1">
                        @foreach ($visible as [$label, $route, $icon, $pattern])
                            <a href="{{ route($route) }}" class="nav-item {{ request()->routeIs($pattern) ? 'nav-item-active' : '' }}">
                                <i data-lucide="{{ $icon }}" class="w-[18px] h-[18px]"></i><span>{{ $label }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </nav>

    {{-- Signed-in user card --}}
    <div class="p-3 border-t border-white/10">
        <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5">
            <div class="relative">
                <div class="w-10 h-10 rounded-full bg-accent-500 text-white flex items-center justify-center text-sm font-bold">{{ $user->initials() }}</div>
                <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-400 border-2 border-brand-950 rounded-full"></span>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-semibold text-white truncate">{{ $user->name }}</p>
                <p class="text-[11px] text-brand-300 truncate">{{ $subtitle ?? $user->roleLabel() }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" title="Sign out" class="p-1.5 rounded-lg text-brand-300 hover:text-white hover:bg-white/10"><i data-lucide="log-out" class="w-4 h-4"></i></button>
            </form>
        </div>
    </div>
</aside>
