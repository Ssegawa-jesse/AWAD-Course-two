<!DOCTYPE html>
<html lang="en" data-root="../" data-role="student">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance — ScholarDesk</title>
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
            <div class="mb-6"><p class="nav-label">Overview</p><div class="space-y-1"><a href="../student/dashboard.html" class="nav-item"><i data-lucide="layout-dashboard" class="w-[18px] h-[18px]"></i><span>Dashboard</span></a><a href="../student/notifications.html" class="nav-item"><i data-lucide="bell" class="w-[18px] h-[18px]"></i><span>Notifications</span></a></div></div><div class="mb-6"><p class="nav-label">Academics</p><div class="space-y-1"><a href="../student/courses.html" class="nav-item"><i data-lucide="book-open-check" class="w-[18px] h-[18px]"></i><span>Course registration</span></a><a href="../student/timetable.html" class="nav-item"><i data-lucide="calendar-days" class="w-[18px] h-[18px]"></i><span>Timetable</span></a><a href="../student/attendance.html" class="nav-item nav-item-active"><i data-lucide="user-check" class="w-[18px] h-[18px]"></i><span>Attendance</span></a><a href="../student/results.html" class="nav-item"><i data-lucide="award" class="w-[18px] h-[18px]"></i><span>Results &amp; transcript</span></a></div></div><div class="mb-6"><p class="nav-label">Finance</p><div class="space-y-1"><a href="../student/fees.html" class="nav-item"><i data-lucide="wallet" class="w-[18px] h-[18px]"></i><span>Fees &amp; payments</span></a></div></div><div class="mb-6"><p class="nav-label">Account</p><div class="space-y-1"><a href="../student/profile.html" class="nav-item"><i data-lucide="user-round-cog" class="w-[18px] h-[18px]"></i><span>My profile</span></a></div></div>
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
                    
                    <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Attendance</h1>
                    <p class="text-slate-500 mt-1 text-sm">You need at least 75% attendance in each unit to sit the final exam.</p>
                </div>
                
            </div>
            <!-- End: Page heading -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
                <div class="card p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Overall attendance</p>
                            <p class="text-3xl font-extrabold tracking-tight mt-1">88%</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center"><i data-lucide="user-check" class="w-5 h-5 text-brand-600"></i></div>
                    </div>
                </div>
                <div class="card p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Classes attended</p>
                            <p class="text-3xl font-extrabold tracking-tight mt-1">78</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center"><i data-lucide="calendar-check" class="w-5 h-5 text-indigo-600"></i></div>
                    </div><p class="text-xs text-slate-400 mt-3">of 88 held so far</p>
                </div>
                <div class="card p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Unit at risk</p>
                            <p class="text-3xl font-extrabold tracking-tight mt-1">1</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-accent-50 flex items-center justify-center"><i data-lucide="triangle-alert" class="w-5 h-5 text-accent-600"></i></div>
                    </div><p class="text-xs text-slate-400 mt-3">BBC2106 · Research Methods</p>
                </div>
            </div>
            <div class="card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[640px]">
                        <thead><tr class="bg-slate-50"><th class="py-3 px-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Code</th><th class="py-3 px-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Course unit</th><th class="py-3 px-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">Held</th><th class="py-3 px-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">Attended</th><th class="py-3 px-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Rate</th><th class="py-3 px-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Standing</th></tr></thead>
                        <tbody>
                            <tr class="border-t border-slate-100 hover:bg-brand-50/40"><td class="py-3.5 px-4 text-sm text-left"><b>BBC2101</b></td><td class="py-3.5 px-4 text-sm text-left">Advanced Web Application Programming</td><td class="py-3.5 px-4 text-sm text-center">18</td><td class="py-3.5 px-4 text-sm text-center">17</td><td class="py-3.5 px-4 text-sm text-left"><div class="flex items-center gap-3 min-w-[140px]"><div class="progress flex-1"><span style="width:94%"></span></div><span class="text-xs font-bold w-9">94%</span></div></td><td class="py-3.5 px-4 text-sm text-left">Good standing</td></tr>
<tr class="border-t border-slate-100 hover:bg-brand-50/40"><td class="py-3.5 px-4 text-sm text-left"><b>BBC2102</b></td><td class="py-3.5 px-4 text-sm text-left">Mobile Applications Development</td><td class="py-3.5 px-4 text-sm text-center">18</td><td class="py-3.5 px-4 text-sm text-center">16</td><td class="py-3.5 px-4 text-sm text-left"><div class="flex items-center gap-3 min-w-[140px]"><div class="progress flex-1"><span style="width:89%"></span></div><span class="text-xs font-bold w-9">89%</span></div></td><td class="py-3.5 px-4 text-sm text-left">Good standing</td></tr>
<tr class="border-t border-slate-100 hover:bg-brand-50/40"><td class="py-3.5 px-4 text-sm text-left"><b>BBC2103</b></td><td class="py-3.5 px-4 text-sm text-left">Information Security &amp; Auditing</td><td class="py-3.5 px-4 text-sm text-center">12</td><td class="py-3.5 px-4 text-sm text-center">12</td><td class="py-3.5 px-4 text-sm text-left"><div class="flex items-center gap-3 min-w-[140px]"><div class="progress flex-1"><span style="width:100%"></span></div><span class="text-xs font-bold w-9">100%</span></div></td><td class="py-3.5 px-4 text-sm text-left">Good standing</td></tr>
<tr class="border-t border-slate-100 hover:bg-brand-50/40"><td class="py-3.5 px-4 text-sm text-left"><b>BBC2104</b></td><td class="py-3.5 px-4 text-sm text-left">Accounting Information Systems</td><td class="py-3.5 px-4 text-sm text-center">12</td><td class="py-3.5 px-4 text-sm text-center">10</td><td class="py-3.5 px-4 text-sm text-left"><div class="flex items-center gap-3 min-w-[140px]"><div class="progress flex-1"><span style="width:83%"></span></div><span class="text-xs font-bold w-9">83%</span></div></td><td class="py-3.5 px-4 text-sm text-left">Good standing</td></tr>
<tr class="border-t border-slate-100 hover:bg-brand-50/40"><td class="py-3.5 px-4 text-sm text-left"><b>BBC2105</b></td><td class="py-3.5 px-4 text-sm text-left">IT Project Development</td><td class="py-3.5 px-4 text-sm text-center">16</td><td class="py-3.5 px-4 text-sm text-center">15</td><td class="py-3.5 px-4 text-sm text-left"><div class="flex items-center gap-3 min-w-[140px]"><div class="progress flex-1"><span style="width:94%"></span></div><span class="text-xs font-bold w-9">94%</span></div></td><td class="py-3.5 px-4 text-sm text-left">Good standing</td></tr>
<tr class="border-t border-slate-100 hover:bg-brand-50/40"><td class="py-3.5 px-4 text-sm text-left"><b>BBC2106</b></td><td class="py-3.5 px-4 text-sm text-left">Research Methods</td><td class="py-3.5 px-4 text-sm text-center">12</td><td class="py-3.5 px-4 text-sm text-center">8</td><td class="py-3.5 px-4 text-sm text-left"><div class="flex items-center gap-3 min-w-[140px]"><div class="progress warn flex-1"><span style="width:67%"></span></div><span class="text-xs font-bold w-9">67%</span></div></td><td class="py-3.5 px-4 text-sm text-left"><span class="text-accent-600 font-semibold">At risk</span></td></tr>
                        </tbody>
                    </table>
                </div>
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
