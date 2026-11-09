@php $user = auth()->user(); @endphp
<header class="sticky top-0 z-20 h-16 bg-white/85 backdrop-blur border-b border-slate-200/80">
    <div class="h-full px-4 sm:px-8 flex items-center justify-between gap-4">
        <div class="flex items-center gap-3 flex-1">
            <label for="sidebar-toggle" class="lg:hidden p-2 -ml-2 text-slate-600 rounded-lg hover:bg-slate-100 cursor-pointer"><span class="sr-only">Open menu</span><i data-lucide="menu" class="w-6 h-6"></i></label>

            @can('view students')
                {{-- Quick search goes straight to the students list --}}
                <form action="{{ route('admin.students.index') }}" method="GET" class="relative hidden md:block w-full max-w-sm">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Search students by name or number…" class="w-full pl-9 pr-3 py-2 rounded-xl bg-slate-100 border border-transparent text-sm focus:outline-none focus:bg-white focus:border-brand-400 focus:ring-0">
                </form>
            @endcan
        </div>

        <div class="flex items-center gap-2">
            <span class="hidden sm:inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full bg-brand-50 text-brand-700"><i data-lucide="calendar" class="w-3.5 h-3.5"></i>2026/27 · Semester I</span>

            @can('approve registrations')
                @php $pending = \App\Models\User::where('status', 'pending')->count(); @endphp
                <a href="{{ route('admin.approvals.index') }}" class="relative p-2 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-slate-900" title="{{ $pending }} waiting for approval">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                    @if ($pending)<span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-accent-500 ring-2 ring-white"></span>@endif
                </a>
            @endcan

            {{-- User menu --}}
            <details class="menu-dropdown relative">
                <summary class="flex items-center gap-2 p-1 pr-2 rounded-xl hover:bg-slate-100 cursor-pointer">
                    <div class="w-8 h-8 rounded-full bg-brand-700 text-white flex items-center justify-center text-xs font-bold">{{ $user->initials() }}</div>
                    <div class="hidden md:block leading-tight text-left">
                        <p class="text-xs font-bold">{{ $user->name }}</p>
                        <p class="text-[10px] text-slate-500">{{ $user->roleLabel() }}</p>
                    </div>
                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
                </summary>
                <div class="absolute right-0 mt-2 w-60 bg-white border border-slate-200 rounded-xl shadow-xl overflow-hidden z-50">
                    <div class="px-4 py-3 bg-slate-50 border-b border-slate-100"><p class="text-sm font-bold">{{ $user->name }}</p><p class="text-xs text-slate-500 truncate">{{ $user->email }}</p></div>
                    <a href="{{ route('profile.show') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50"><i data-lucide="user" class="w-4 h-4"></i>My profile &amp; password</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-accent-600 hover:bg-accent-50 border-t border-slate-100"><i data-lucide="log-out" class="w-4 h-4"></i>Sign out</button>
                    </form>
                </div>
            </details>
        </div>
    </div>
</header>
