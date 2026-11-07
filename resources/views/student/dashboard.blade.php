<!DOCTYPE html>
<html lang="en" data-root="../" data-role="student">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — ScholarDesk</title>
    <link rel="icon" type="image/svg+xml" href="../assets/img/logo.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { 50: '#effcf9', 100: '#c9f5ec', 200: '#95e9da', 300: '#5bd5c3', 400: '#2bb9a7', 500: '#14998b', 600: '#0d7a71', 700: '#0f625b', 800: '#114e4a', 900: '#0f3f3c', 950: '#062624' },
                        accent: { 50: '#fff6ed', 100: '#ffead4', 200: '#ffd0a8', 400: '#ff8a3d', 500: '#f76b15', 600: '#e5520b', 700: '#bd3d0b' },
                        canvas: '#f4f6f5'
                    },
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'] }
                }
            }
        };
    </script>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://unpkg.com/lucide@0.460.0/dist/umd/lucide.min.js"></script>
    <script src="../assets/js/app.js"></script>
</head>
<body class="bg-canvas text-slate-900 font-sans antialiased min-h-screen">
    <!-- Start: Sidebar toggle (checkbox, no JavaScript) -->
    <input type="checkbox" id="sidebar-toggle" class="peer hidden">
    <label for="sidebar-toggle" class="fixed inset-0 bg-slate-900/40 z-30 hidden peer-checked:block lg:!hidden"></label>
    <!-- End: Sidebar toggle -->

    <!-- Start: Sidebar -->
    <aside class="fixed top-0 left-0 z-40 w-[260px] h-screen -translate-x-full peer-checked:translate-x-0 lg:translate-x-0 transition-transform bg-brand-950 text-brand-100 flex flex-col sidebar-pattern">
        <a href="../student/dashboard.html" class="flex items-center gap-3 px-5 h-16 border-b border-white/10 shrink-0">
            <img src="../assets/img/logo.svg" alt="ScholarDesk" class="h-9 w-9">
            <div class="leading-tight">
                <p class="font-extrabold text-white tracking-tight">ScholarDesk</p>
                <p class="text-[11px] text-brand-300">Student Management System</p>
            </div>
        </a>
        <nav class="flex-1 px-3 py-6 overflow-y-auto sidebar-scrollbar">
            <div class="mb-6"><p class="nav-label">Overview</p><div class="space-y-1"><a href="../student/dashboard.html" class="nav-item nav-item-active"><i data-lucide="layout-dashboard" class="w-[18px] h-[18px]"></i><span>Dashboard</span></a><a href="../student/notifications.html" class="nav-item"><i data-lucide="bell" class="w-[18px] h-[18px]"></i><span>Notifications</span></a></div></div><div class="mb-6"><p class="nav-label">Academics</p><div class="space-y-1"><a href="../student/courses.html" class="nav-item"><i data-lucide="book-open-check" class="w-[18px] h-[18px]"></i><span>Course registration</span></a><a href="../student/timetable.html" class="nav-item"><i data-lucide="calendar-days" class="w-[18px] h-[18px]"></i><span>Timetable</span></a><a href="../student/attendance.html" class="nav-item"><i data-lucide="user-check" class="w-[18px] h-[18px]"></i><span>Attendance</span></a><a href="../student/results.html" class="nav-item"><i data-lucide="award" class="w-[18px] h-[18px]"></i><span>Results &amp; transcript</span></a></div></div><div class="mb-6"><p class="nav-label">Finance</p><div class="space-y-1"><a href="../student/fees.html" class="nav-item"><i data-lucide="wallet" class="w-[18px] h-[18px]"></i><span>Fees &amp; payments</span></a></div></div><div class="mb-6"><p class="nav-label">Account</p><div class="space-y-1"><a href="../student/profile.html" class="nav-item"><i data-lucide="user-round-cog" class="w-[18px] h-[18px]"></i><span>My profile</span></a></div></div>
        </nav>
        <!-- Start: Sidebar user card -->
        <div class="p-3 border-t border-white/10">
            <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5">
                <div class="relative">
                    <div class="w-10 h-10 rounded-full bg-accent-500 text-white flex items-center justify-center text-sm font-bold" data-u="initials">SN</div>
                    <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-400 border-2 border-brand-950 rounded-full"></span>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-semibold text-white truncate" data-u="name">Sarah Nakato</p>
                    <p class="text-[11px] text-brand-300 truncate">2400714521 · BBC Year 2</p>
                </div>
                <a href="../login.html" data-logout title="Sign out" class="p-1.5 rounded-lg text-brand-300 hover:text-white hover:bg-white/10"><i data-lucide="log-out" class="w-4 h-4"></i></a>
            </div>
        </div>
        <!-- End: Sidebar user card -->
    </aside>
    <!-- End: Sidebar -->

    <!-- Start: Main column -->
    <div class="lg:pl-[260px] min-h-screen flex flex-col">
        <!-- Start: Top bar -->
        <header class="sticky top-0 z-20 h-16 bg-white/85 backdrop-blur border-b border-slate-200/80">
            <div class="h-full px-4 sm:px-8 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3 flex-1">
                    <label for="sidebar-toggle" class="lg:hidden p-2 -ml-2 text-slate-600 rounded-lg hover:bg-slate-100 cursor-pointer"><span class="sr-only">Open menu</span><i data-lucide="menu" class="w-6 h-6"></i></label>
                    <div class="relative hidden md:block w-full max-w-sm">
                        <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                        <input type="search" placeholder="Search students, courses, programmes…" class="w-full pl-9 pr-3 py-2 rounded-xl bg-slate-100 border border-transparent text-sm focus:outline-none focus:bg-white focus:border-brand-400">
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="hidden sm:inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full bg-brand-50 text-brand-700"><i data-lucide="calendar" class="w-3.5 h-3.5"></i>2026/27 · Semester I</span>
                    <!-- Start: Notifications -->
                    <details class="menu-dropdown relative">
                        <summary class="relative p-2 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-slate-900 cursor-pointer">
                            <i data-lucide="bell" class="w-5 h-5"></i>
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-accent-500 ring-2 ring-white"></span>
                        </summary>
                        <div class="absolute right-0 mt-2 w-80 bg-white border border-slate-200 rounded-xl shadow-xl overflow-hidden z-50">
                            <div class="px-4 py-3 flex justify-between items-center"><p class="text-sm font-bold">Notifications</p><span class="text-xs text-accent-600 font-semibold">2 new</span></div>
                            <a href="../student/results.html" class="block px-4 py-3 hover:bg-slate-50 border-t border-slate-100"><p class="text-sm">Results for <b>BBC2104</b> are out</p><p class="text-xs text-slate-500 mt-1">Accounting Information Systems · 20 min ago</p></a><a href="../student/fees.html" class="block px-4 py-3 hover:bg-slate-50 border-t border-slate-100"><p class="text-sm">Fees balance reminder</p><p class="text-xs text-slate-500 mt-1">UGX 650,000 due before 15 Nov · 2 hrs ago</p></a>
                        </div>
                    </details>
                    <!-- End: Notifications -->
                    <!-- Start: User menu -->
                    <details class="menu-dropdown relative">
                        <summary class="flex items-center gap-2 p-1 pr-2 rounded-xl hover:bg-slate-100 cursor-pointer">
                            <div class="w-8 h-8 rounded-full bg-brand-700 text-white flex items-center justify-center text-xs font-bold" data-u="initials">SN</div>
                            <div class="hidden md:block leading-tight text-left">
                                <p class="text-xs font-bold" data-u="name">Sarah Nakato</p>
                                <p class="text-[10px] text-slate-500">Student</p>
                            </div>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
                        </summary>
                        <div class="absolute right-0 mt-2 w-60 bg-white border border-slate-200 rounded-xl shadow-xl overflow-hidden z-50">
                            <div class="px-4 py-3 bg-slate-50 border-b border-slate-100"><p class="text-sm font-bold" data-u="name">Sarah Nakato</p><p class="text-xs text-slate-500 truncate" data-u="email">sarah.nakato@students.campus.ac.ug</p></div>
                            <a href="../student/profile.html" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50"><i data-lucide="user" class="w-4 h-4"></i>My profile</a>
                            <a href="../reset-password.html" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50"><i data-lucide="key-round" class="w-4 h-4"></i>Change password</a>
                            <a href="../login.html" data-logout class="flex items-center gap-2 px-4 py-2.5 text-sm text-accent-600 hover:bg-accent-50 border-t border-slate-100"><i data-lucide="log-out" class="w-4 h-4"></i>Sign out</a>
                        </div>
                    </details>
                    <!-- End: User menu -->
                </div>
            </div>
        </header>
        <!-- End: Top bar -->

        <main class="flex-1 px-4 sm:px-8 py-8 animate-rise">
            <!-- Start: Page heading -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-7">
                <div>
                    
                    <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Good morning, <span data-u="first">Sarah</span> 👋</h1>
                    <p class="text-slate-500 mt-1 text-sm">Semester I is in week 9. You have 3 classes today and one fees reminder.</p>
                </div>
                <div class="flex flex-wrap gap-2"><a href="courses.html" class="btn-primary"><i data-lucide="book-open-check" class="w-4 h-4"></i>Register units</a><a href="fees.html" class="btn-ghost"><i data-lucide="wallet" class="w-4 h-4"></i>Pay fees</a></div>
            </div>
            <!-- End: Page heading -->

            <!-- Start: Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
                <div class="card p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Cumulative GPA</p>
                            <p class="text-3xl font-extrabold tracking-tight mt-1">4.21</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center"><i data-lucide="award" class="w-5 h-5 text-brand-600"></i></div>
                    </div><p class="text-xs text-slate-400 mt-3">Second Class Upper</p>
                </div>
                <div class="card p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Credit units this semester</p>
                            <p class="text-3xl font-extrabold tracking-tight mt-1">21</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center"><i data-lucide="book-open" class="w-5 h-5 text-indigo-600"></i></div>
                    </div><p class="text-xs text-slate-400 mt-3">6 course units registered</p>
                </div>
                <div class="card p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Attendance</p>
                            <p class="text-3xl font-extrabold tracking-tight mt-1">92%</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center"><i data-lucide="user-check" class="w-5 h-5 text-brand-600"></i></div>
                    </div><p class="text-xs text-slate-400 mt-3">Minimum required is 75%</p>
                </div>
                <div class="card p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Fees balance (UGX)</p>
                            <p class="text-3xl font-extrabold tracking-tight mt-1">650K</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-accent-50 flex items-center justify-center"><i data-lucide="wallet" class="w-5 h-5 text-accent-600"></i></div>
                    </div><p class="text-xs text-slate-400 mt-3">Due 15 Nov 2026</p>
                </div>
            </div>
            <!-- End: Stats -->

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                <!-- Start: Today's classes -->
                <div class="xl:col-span-2 card p-6">
                    <div class="flex justify-between items-center mb-5">
                        <div><h2 class="font-bold text-lg">Today's classes</h2><p class="text-xs text-slate-500">Monday, 2 November 2026</p></div>
                        <a href="timetable.html" class="text-sm font-semibold text-brand-700">Full timetable</a>
                    </div>
                    <div class="space-y-3"><div class="flex gap-4 p-4 rounded-xl border border-slate-100 hover:border-brand-200">
                            <div class="w-1 rounded-full bg-brand-500"></div>
                            <div class="flex-1 min-w-0"><p class="text-xs font-bold text-slate-400">08:00 – 10:00</p><p class="font-semibold truncate">BBC2101 · Advanced Web App Programming</p><p class="text-xs text-slate-500 mt-0.5 flex items-center gap-3"><span class="inline-flex items-center gap-1"><i data-lucide="map-pin" class="w-3 h-3"></i>Lab 3</span><span class="inline-flex items-center gap-1"><i data-lucide="user" class="w-3 h-3"></i>Dr. Moses Kato</span></p></div>
                        </div><div class="flex gap-4 p-4 rounded-xl border border-slate-100 hover:border-brand-200">
                            <div class="w-1 rounded-full bg-accent-500"></div>
                            <div class="flex-1 min-w-0"><p class="text-xs font-bold text-slate-400">11:00 – 13:00</p><p class="font-semibold truncate">BBC2102 · Mobile Applications Development</p><p class="text-xs text-slate-500 mt-0.5 flex items-center gap-3"><span class="inline-flex items-center gap-1"><i data-lucide="map-pin" class="w-3 h-3"></i>Room B204</span><span class="inline-flex items-center gap-1"><i data-lucide="user" class="w-3 h-3"></i>Ms. Ruth Atim</span></p></div>
                        </div><div class="flex gap-4 p-4 rounded-xl border border-slate-100 hover:border-brand-200">
                            <div class="w-1 rounded-full bg-indigo-500"></div>
                            <div class="flex-1 min-w-0"><p class="text-xs font-bold text-slate-400">14:00 – 16:00</p><p class="font-semibold truncate">BBC2106 · Research Methods</p><p class="text-xs text-slate-500 mt-0.5 flex items-center gap-3"><span class="inline-flex items-center gap-1"><i data-lucide="map-pin" class="w-3 h-3"></i>Hall A1</span><span class="inline-flex items-center gap-1"><i data-lucide="user" class="w-3 h-3"></i>Dr. Agnes Akello</span></p></div>
                        </div></div>
                </div>
                <!-- End: Today's classes -->

                <!-- Start: Student card -->
                <div class="card overflow-hidden">
                    <div class="bg-brand-900 sidebar-pattern p-6 text-white">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-accent-500 flex items-center justify-center text-lg font-extrabold">SN</div>
                            <div><p class="font-bold">Sarah Nakato</p><p class="text-xs text-brand-200">Reg. 24/U/14521/EVE</p></div>
                        </div>
                    </div>
                    <dl class="p-6 space-y-3 text-sm">
                        <div class="flex justify-between"><dt class="text-slate-500">Student no.</dt><dd class="font-semibold">2400714521</dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">Programme</dt><dd class="font-semibold">BBC</dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">Year / Semester</dt><dd class="font-semibold">Year 2 · Sem I</dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">Study mode</dt><dd class="font-semibold">Evening</dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">Status</dt><dd><span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full bg-brand-50 text-brand-700">Active</span></dd></div>
                    </dl>
                    <div class="px-6 pb-6"><a href="profile.html" class="btn-ghost w-full justify-center">View profile</a></div>
                </div>
                <!-- End: Student card -->
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mt-6">
                <!-- Start: Latest results -->
                <div class="xl:col-span-2">
                    <div class="flex justify-between items-center mb-4"><h2 class="font-bold text-lg">Latest results</h2><a href="results.html" class="text-sm font-semibold text-brand-700">All results</a></div>
                    <div class="card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[640px]">
                        <thead><tr class="bg-slate-50"><th class="py-3 px-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Code</th><th class="py-3 px-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Course unit</th><th class="py-3 px-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">CU</th><th class="py-3 px-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">Mark</th><th class="py-3 px-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">Grade</th></tr></thead>
                        <tbody>
                            <tr class="border-t border-slate-100 hover:bg-brand-50/40"><td class="py-3.5 px-4 text-sm text-left"><b>BBC1201</b></td><td class="py-3.5 px-4 text-sm text-left">Database Management Systems</td><td class="py-3.5 px-4 text-sm text-center">4</td><td class="py-3.5 px-4 text-sm text-center">84</td><td class="py-3.5 px-4 text-sm text-center"><span class="font-extrabold text-brand-700">A</span></td></tr>
<tr class="border-t border-slate-100 hover:bg-brand-50/40"><td class="py-3.5 px-4 text-sm text-left"><b>BBC1202</b></td><td class="py-3.5 px-4 text-sm text-left">Object Oriented Programming</td><td class="py-3.5 px-4 text-sm text-center">4</td><td class="py-3.5 px-4 text-sm text-center">77</td><td class="py-3.5 px-4 text-sm text-center"><span class="font-extrabold text-brand-700">B+</span></td></tr>
<tr class="border-t border-slate-100 hover:bg-brand-50/40"><td class="py-3.5 px-4 text-sm text-left"><b>BBC1203</b></td><td class="py-3.5 px-4 text-sm text-left">Business Statistics</td><td class="py-3.5 px-4 text-sm text-center">3</td><td class="py-3.5 px-4 text-sm text-center">68</td><td class="py-3.5 px-4 text-sm text-center"><span class="font-extrabold text-accent-600">C+</span></td></tr>
<tr class="border-t border-slate-100 hover:bg-brand-50/40"><td class="py-3.5 px-4 text-sm text-left"><b>BBC1204</b></td><td class="py-3.5 px-4 text-sm text-left">Systems Analysis &amp; Design</td><td class="py-3.5 px-4 text-sm text-center">3</td><td class="py-3.5 px-4 text-sm text-center">81</td><td class="py-3.5 px-4 text-sm text-center"><span class="font-extrabold text-brand-700">A</span></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
                </div>
                <!-- End: Latest results -->

                <!-- Start: Announcements -->
                <div class="card p-6">
                    <h2 class="font-bold text-lg mb-4">Announcements</h2>
                    <div class="space-y-4">
                        <div class="flex gap-3"><div class="w-9 h-9 rounded-lg bg-accent-50 flex items-center justify-center shrink-0"><i data-lucide="megaphone" class="w-4 h-4 text-accent-600"></i></div><div><p class="text-sm font-semibold">Exams start 30 November</p><p class="text-xs text-slate-500">Clear fees to get your exam permit.</p></div></div>
                        <div class="flex gap-3"><div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center shrink-0"><i data-lucide="calendar-plus" class="w-4 h-4 text-brand-600"></i></div><div><p class="text-sm font-semibold">Late registration closes Friday</p><p class="text-xs text-slate-500">A penalty of UGX 50,000 applies after.</p></div></div>
                        <div class="flex gap-3"><div class="w-9 h-9 rounded-lg bg-indigo-50 flex items-center justify-center shrink-0"><i data-lucide="library" class="w-4 h-4 text-indigo-600"></i></div><div><p class="text-sm font-semibold">Library open till 10pm</p><p class="text-xs text-slate-500">Extended hours during revision weeks.</p></div></div>
                    </div>
                </div>
                <!-- End: Announcements -->
            </div>
        </main>

        <!-- Start: Footer -->
        <footer class="border-t border-slate-200 bg-white">
            <div class="px-4 sm:px-8 py-4 flex flex-col md:flex-row justify-between items-center gap-2 text-xs text-slate-500">
                <p>© 2026 <span class="font-bold text-brand-800">ScholarDesk</span> · Student Management System</p>
                <p>Academic Registrar · Finance · Faculties · ICT</p>
            </div>
        </footer>
        <!-- End: Footer -->
    </div>
    <!-- End: Main column -->

    <script>lucide.createIcons();</script>
</body>
</html>
