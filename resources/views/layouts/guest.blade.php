{{-- Split-screen layout for sign in, register and password pages (used by <x-guest-layout>). --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
    @livewireStyles
</head>
<body class="bg-canvas text-slate-900 font-sans antialiased min-h-screen flex flex-col">
    <div class="flex-1 grid lg:grid-cols-[minmax(0,5fr)_minmax(0,7fr)]">
        {{-- Brand panel --}}
        <aside class="hidden lg:flex flex-col justify-between bg-brand-950 sidebar-pattern text-white p-12 relative overflow-hidden">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('assets/img/logo.svg') }}" alt="ScholarDesk" class="h-11 w-11">
                <div class="leading-tight"><p class="font-extrabold text-lg">ScholarDesk</p><p class="text-xs text-brand-300">Student Management System</p></div>
            </a>
            <div class="max-w-md">
                <h2 class="text-3xl font-extrabold leading-tight tracking-tight mb-4">One portal for students, lecturers and the registrar.</h2>
                <p class="text-brand-200 mb-8 leading-relaxed">Students register course units and see results. Lecturers see their classes and enter marks. The registrar approves new accounts and manages records.</p>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3"><span class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center shrink-0"><i data-lucide="graduation-cap" class="w-4 h-4 text-accent-400"></i></span><span class="text-sm text-brand-100 pt-1">Students: course registration, timetable, results</span></li>
                    <li class="flex items-start gap-3"><span class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center shrink-0"><i data-lucide="presentation" class="w-4 h-4 text-accent-400"></i></span><span class="text-sm text-brand-100 pt-1">Lecturers: assigned courses, class lists, marks</span></li>
                    <li class="flex items-start gap-3"><span class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center shrink-0"><i data-lucide="shield-check" class="w-4 h-4 text-accent-400"></i></span><span class="text-sm text-brand-100 pt-1">Registrar: approvals, records and user access</span></li>
                </ul>
            </div>
            <div class="flex items-center gap-3 p-4 rounded-2xl bg-white/5 border border-white/10 max-w-md">
                <div class="flex -space-x-2">
                    <div class="w-8 h-8 rounded-full bg-accent-500 border-2 border-brand-950 flex items-center justify-center text-[10px] font-bold">SN</div>
                    <div class="w-8 h-8 rounded-full bg-brand-500 border-2 border-brand-950 flex items-center justify-center text-[10px] font-bold">JO</div>
                    <div class="w-8 h-8 rounded-full bg-indigo-500 border-2 border-brand-950 flex items-center justify-center text-[10px] font-bold">AN</div>
                </div>
                <p class="text-xs text-brand-200"><span class="font-bold text-white">{{ \App\Models\Student::enrolled()->count() }} students</span> enrolled for Semester I, 2026/27</p>
            </div>
        </aside>

        {{-- Form panel --}}
        <div class="flex items-center justify-center p-5 sm:p-10">
            <div class="w-full {{ $attributes->get('wide') ? 'max-w-2xl' : 'max-w-md' }} animate-rise">
                <a href="{{ route('home') }}" class="lg:hidden flex items-center gap-3 mb-8">
                    <img src="{{ asset('assets/img/logo.svg') }}" alt="ScholarDesk" class="h-10 w-10">
                    <p class="font-extrabold text-brand-900">ScholarDesk</p>
                </a>
                {{ $slot }}
            </div>
        </div>
    </div>

    <footer class="bg-brand-950 text-brand-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col md:flex-row justify-between items-center gap-2 text-xs">
            <p>© {{ date('Y') }} <span class="font-bold text-white">ScholarDesk</span> · Student Management System</p>
            <p>Admissions · Registrar · Finance · ICT</p>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
