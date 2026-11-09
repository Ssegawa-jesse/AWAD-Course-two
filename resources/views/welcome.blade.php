<x-public-layout title="Home">
    <!-- Start: Hero -->
    <section class="relative pt-[72px] overflow-hidden">
        <div class="absolute inset-0 hero-grid"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 grid lg:grid-cols-2 gap-14 items-center">
            <div class="text-center lg:text-left animate-rise">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-slate-200 text-xs font-semibold text-slate-600 mb-6"><span class="w-2 h-2 rounded-full bg-accent-500 animate-pulse"></span>Registration for Semester I 2026/27 is open</span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.05] mb-6">Manage every student,<br><span class="text-gradient">from admission to graduation.</span></h1>
                <p class="text-slate-500 text-base sm:text-lg max-w-xl mx-auto lg:mx-0 mb-8 leading-relaxed">ScholarDesk brings registration, course units, timetables, class lists and results into one simple portal for students, lecturers and the registrar.</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
                    <a href="{{ route('register') }}" class="btn-accent justify-center py-3.5 px-7 text-base">Register as student or lecturer<i data-lucide="arrow-right" class="w-5 h-5"></i></a>
                    <a href="{{ route('login') }}" class="btn-ghost justify-center py-3.5 px-7 text-base">Sign in</a>
                </div>
                <div class="flex items-center gap-6 justify-center lg:justify-start mt-10 text-sm text-slate-500">
                    <span class="flex items-center gap-2"><i data-lucide="shield-check" class="w-4 h-4 text-brand-600"></i>Secure records</span>
                    <span class="flex items-center gap-2"><i data-lucide="smartphone" class="w-4 h-4 text-brand-600"></i>Works on any phone</span>
                </div>
            </div>

            <!-- Start: Hero preview card -->
            <div class="relative">
                <div class="absolute -top-6 -right-6 w-40 h-40 rounded-full bg-accent-400/20 blur-3xl"></div>
                <div class="absolute -bottom-8 -left-8 w-48 h-48 rounded-full bg-brand-400/20 blur-3xl"></div>
                <div class="relative card p-6 shadow-2xl shadow-brand-900/10">
                    <div class="flex items-center gap-4 pb-5 border-b border-slate-100">
                        <div class="w-12 h-12 rounded-full bg-accent-100 text-accent-700 flex items-center justify-center text-xs font-bold shrink-0">SN</div>
                        <div class="flex-1"><p class="font-bold">Sarah Nakato</p><p class="text-xs text-slate-500">2400714521 · Bachelor of Business Computing</p></div>
                        <span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full bg-brand-50 text-brand-700">Active</span>
                    </div>
                    <div class="grid grid-cols-3 gap-3 py-5">
                        <div class="rounded-xl bg-brand-50 p-3"><p class="text-[11px] text-brand-700 font-semibold">CGPA</p><p class="text-2xl font-extrabold text-brand-900">4.21</p></div>
                        <div class="rounded-xl bg-accent-50 p-3"><p class="text-[11px] text-accent-700 font-semibold">Credits</p><p class="text-2xl font-extrabold text-accent-700">21</p></div>
                        <div class="rounded-xl bg-indigo-50 p-3"><p class="text-[11px] text-indigo-700 font-semibold">Courses</p><p class="text-2xl font-extrabold text-indigo-700">6</p></div>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Today's classes</p>
                    <div class="space-y-2">
                        <div class="flex items-center gap-3 p-3 rounded-xl border border-slate-100"><span class="text-xs font-bold text-brand-700 w-14">08:00</span><div class="flex-1"><p class="text-sm font-semibold">Advanced Web App Programming</p><p class="text-xs text-slate-500">Lab 3 · Dr. Moses Kato</p></div></div>
                        <div class="flex items-center gap-3 p-3 rounded-xl border border-slate-100"><span class="text-xs font-bold text-accent-600 w-14">11:00</span><div class="flex-1"><p class="text-sm font-semibold">Mobile Applications Development</p><p class="text-xs text-slate-500">Room B204 · Ms. Ruth Atim</p></div></div>
                    </div>
                </div>
                <div class="absolute -left-4 sm:-left-10 -bottom-8 card px-4 py-3 shadow-xl flex items-center gap-3 float">
                    <div class="w-9 h-9 rounded-lg bg-brand-600 flex items-center justify-center"><i data-lucide="check" class="w-5 h-5 text-white"></i></div>
                    <div><p class="text-xs font-bold">Results published</p><p class="text-[11px] text-slate-500">BBC2104 · Grade A</p></div>
                </div>
            </div>
            <!-- End: Hero preview card -->
        </div>

        <!-- Start: Numbers strip -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="card p-5 text-center"><p class="text-3xl font-extrabold text-brand-800">{{ number_format($stats['students']) }}</p><p class="text-sm text-slate-500">Active students</p></div>
                <div class="card p-5 text-center"><p class="text-3xl font-extrabold text-brand-800">{{ number_format($stats['lecturers']) }}</p><p class="text-sm text-slate-500">Lecturers</p></div>
                <div class="card p-5 text-center"><p class="text-3xl font-extrabold text-brand-800">{{ number_format($stats['programmes']) }}</p><p class="text-sm text-slate-500">Programmes</p></div>
                <div class="card p-5 text-center"><p class="text-3xl font-extrabold text-accent-600">~5 min</p><p class="text-sm text-slate-500">To register online</p></div>
            </div>
        </div>
        <!-- End: Numbers strip -->
    </section>
    <!-- End: Hero -->

    <!-- Start: Features -->
    <section id="features" class="py-24 bg-white border-y border-slate-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mb-14">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-accent-600 mb-3">Features</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-3">Everything a student record needs</h2>
                <p class="text-slate-500">Built around the semester: register courses, attend classes, get marks, see results — then do it again next semester.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="card p-6 hover:-translate-y-1 hover:shadow-lg transition">
                    <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center mb-5"><i data-lucide="user-plus" class="w-6 h-6 text-brand-600"></i></div>
                    <h3 class="font-bold text-lg mb-2">Online registration</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Students apply and register from their phone. No queues at the Registrar's office.</p>
                </div><div class="card p-6 hover:-translate-y-1 hover:shadow-lg transition">
                    <div class="w-12 h-12 rounded-xl bg-accent-50 flex items-center justify-center mb-5"><i data-lucide="book-open-check" class="w-6 h-6 text-accent-600"></i></div>
                    <h3 class="font-bold text-lg mb-2">Course unit registration</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Pick core and elective units each semester, within your credit limit.</p>
                </div><div class="card p-6 hover:-translate-y-1 hover:shadow-lg transition">
                    <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center mb-5"><i data-lucide="calendar-days" class="w-6 h-6 text-brand-600"></i></div>
                    <h3 class="font-bold text-lg mb-2">Timetables</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Your personal weekly timetable with rooms and lecturers.</p>
                </div><div class="card p-6 hover:-translate-y-1 hover:shadow-lg transition">
                    <div class="w-12 h-12 rounded-xl bg-accent-50 flex items-center justify-center mb-5"><i data-lucide="award" class="w-6 h-6 text-accent-600"></i></div>
                    <h3 class="font-bold text-lg mb-2">Results &amp; transcripts</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Lecturers enter marks; students see grades and GPA once published.</p>
                </div><div class="card p-6 hover:-translate-y-1 hover:shadow-lg transition">
                    <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center mb-5"><i data-lucide="wallet" class="w-6 h-6 text-brand-600"></i></div>
                    <h3 class="font-bold text-lg mb-2">Registrar approvals</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">New students and lecturers register online; the Registrar approves them and issues numbers.</p>
                </div><div class="card p-6 hover:-translate-y-1 hover:shadow-lg transition">
                    <div class="w-12 h-12 rounded-xl bg-accent-50 flex items-center justify-center mb-5"><i data-lucide="user-check" class="w-6 h-6 text-accent-600"></i></div>
                    <h3 class="font-bold text-lg mb-2">Roles &amp; permissions</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Admins, lecturers and students each see only the pages and records they are allowed to.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End: Features -->

    <!-- Start: How to apply -->
    <section id="how" class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-brand-600 mb-3">How to register</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Four steps to your account</h2>
            </div>
            <ol class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 relative">
                <li class="card p-6"><span class="w-10 h-10 rounded-full bg-brand-700 text-white font-extrabold flex items-center justify-center mb-5">1</span><h3 class="font-bold mb-2">Register</h3><p class="text-sm text-slate-500">Choose student or lecturer, then fill in your details.</p></li>
                <li class="card p-6"><span class="w-10 h-10 rounded-full bg-accent-500 text-white font-extrabold flex items-center justify-center mb-5">2</span><h3 class="font-bold mb-2">Registrar reviews</h3><p class="text-sm text-slate-500">The Registrar checks and approves your registration within 2 working days.</p></li>
                <li class="card p-6"><span class="w-10 h-10 rounded-full bg-brand-700 text-white font-extrabold flex items-center justify-center mb-5">3</span><h3 class="font-bold mb-2">Get your number</h3><p class="text-sm text-slate-500">Students get a student number, lecturers a staff number.</p></li>
                <li class="card p-6"><span class="w-10 h-10 rounded-full bg-accent-500 text-white font-extrabold flex items-center justify-center mb-5">4</span><h3 class="font-bold mb-2">Sign in</h3><p class="text-sm text-slate-500">Students register units; lecturers see class lists and enter marks.</p></li>
            </ol>
        </div>
    </section>
    <!-- End: How to apply -->

    <!-- Start: Programmes -->
    <section id="programmes" class="py-24 bg-brand-950 sidebar-pattern text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-[1fr_1.4fr] gap-14 items-center">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-accent-400 mb-3">Programmes</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-4">Choose your programme when you register</h2>
                <p class="text-brand-200 mb-8">Each programme comes with its own course units per semester. Electives open up from Year 2.</p>
                <a href="{{ route('register') }}" class="btn-accent">Start registration<i data-lucide="arrow-right" class="w-4 h-4"></i></a>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                @php($icons = ['monitor-smartphone','cpu','briefcase-business','truck','users-round','code-xml'])
                @foreach ($programmes as $programme)
                <div class="flex items-center gap-4 p-4 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 transition">
                    <div class="w-12 h-12 rounded-xl bg-accent-500/15 flex items-center justify-center shrink-0"><i data-lucide="{{ $icons[$loop->index % count($icons)] }}" class="w-6 h-6 text-accent-400"></i></div>
                    <div class="min-w-0"><p class="text-xs font-bold text-accent-400">{{ $programme->code }}</p><p class="font-semibold text-white leading-snug">{{ $programme->name }}</p><p class="text-xs text-brand-300">{{ $programme->duration_years }} years · {{ $programme->level }}</p></div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End: Programmes -->

    <!-- Start: Roles -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-accent-600 mb-3">Who uses it</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Three portals, one record</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-5">
                <a href="{{ route('login') }}" class="card p-7 group hover:border-brand-400 transition"><i data-lucide="graduation-cap" class="w-8 h-8 text-brand-600 mb-5"></i><h3 class="font-bold text-lg mb-2">Students</h3><p class="text-sm text-slate-500 mb-5">Register yourself, then register courses and see your timetable and results.</p><span class="text-sm font-bold text-brand-700 inline-flex items-center gap-1">Student sign in<i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition"></i></span></a>
                <a href="{{ route('login') }}" class="card p-7 group hover:border-accent-400 transition"><i data-lucide="presentation" class="w-8 h-8 text-accent-600 mb-5"></i><h3 class="font-bold text-lg mb-2">Lecturers</h3><p class="text-sm text-slate-500 mb-5">Register yourself, then view classes, see class lists and enter marks.</p><span class="text-sm font-bold text-accent-600 inline-flex items-center gap-1">Lecturer sign in<i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition"></i></span></a>
                <a href="{{ route('login') }}" class="card p-7 group hover:border-indigo-400 transition"><i data-lucide="shield-check" class="w-8 h-8 text-indigo-600 mb-5"></i><h3 class="font-bold text-lg mb-2">Registrar / Admin</h3><p class="text-sm text-slate-500 mb-5">Approves student and lecturer registrations, manages all records.</p><span class="text-sm font-bold text-indigo-600 inline-flex items-center gap-1">Registrar sign in<i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition"></i></span></a>
            </div>
        </div>
    </section>
    <!-- End: Roles -->

    <!-- Start: Call to action -->
    <section class="pb-24">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl bg-gradient-to-br from-brand-700 to-brand-900 p-10 sm:p-14 text-center text-white relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-52 h-52 rounded-full bg-accent-500/30 blur-3xl"></div>
                <h2 class="relative text-3xl sm:text-4xl font-extrabold tracking-tight mb-4">Ready for Semester I?</h2>
                <p class="relative text-brand-100 mb-8 max-w-xl mx-auto">Students and lecturers register online. The Registrar approves, then you sign in.</p>
                <div class="relative flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('register') }}" class="btn-accent justify-center py-3.5 px-7">Register now</a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center py-3.5 px-7 rounded-xl font-semibold text-sm border border-white/30 hover:bg-white/10">I already have an account</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End: Call to action -->
</x-public-layout>
