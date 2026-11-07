<!DOCTYPE html>
<html lang="en" data-root="../" data-role="admin">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard — ScholarDesk</title>
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
        <a href="../admin/dashboard.html" class="flex items-center gap-3 px-5 h-16 border-b border-white/10 shrink-0">
            <img src="../assets/img/logo.svg" alt="ScholarDesk" class="h-9 w-9">
            <div class="leading-tight">
                <p class="font-extrabold text-white tracking-tight">ScholarDesk</p>
                <p class="text-[11px] text-brand-300">Student Management System</p>
            </div>
        </a>
        <nav class="flex-1 px-3 py-6 overflow-y-auto sidebar-scrollbar">
            <div class="mb-6"><p class="nav-label">Overview</p><div class="space-y-1"><a href="../admin/dashboard.html" class="nav-item nav-item-active"><i data-lucide="layout-dashboard" class="w-[18px] h-[18px]"></i><span>Dashboard</span></a><a href="../admin/applications/index.html" class="nav-item"><i data-lucide="user-check" class="w-[18px] h-[18px]"></i><span>Approvals</span></a></div></div><div class="mb-6"><p class="nav-label">Records</p><div class="space-y-1"><a href="../admin/students/index.html" class="nav-item"><i data-lucide="graduation-cap" class="w-[18px] h-[18px]"></i><span>Students</span></a><a href="../admin/lecturers/index.html" class="nav-item"><i data-lucide="presentation" class="w-[18px] h-[18px]"></i><span>Lecturers</span></a></div></div><div class="mb-6"><p class="nav-label">Academics</p><div class="space-y-1"><a href="../admin/programmes/index.html" class="nav-item"><i data-lucide="layers" class="w-[18px] h-[18px]"></i><span>Programmes</span></a><a href="../admin/courses/index.html" class="nav-item"><i data-lucide="library" class="w-[18px] h-[18px]"></i><span>Course units</span></a><a href="../admin/reports.html" class="nav-item"><i data-lucide="bar-chart-3" class="w-[18px] h-[18px]"></i><span>Reports</span></a></div></div>
        </nav>
        <!-- Start: Sidebar user card -->
        <div class="p-3 border-t border-white/10">
            <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5">
                <div class="relative">
                    <div class="w-10 h-10 rounded-full bg-accent-500 text-white flex items-center justify-center text-sm font-bold" data-u="initials">RG</div>
                    <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-400 border-2 border-brand-950 rounded-full"></span>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-semibold text-white truncate" data-u="name">Registrar</p>
                    <p class="text-[11px] text-brand-300 truncate">Academic Registrar's Office</p>
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
                            <a href="../admin/applications/index.html" class="block px-4 py-3 hover:bg-slate-50 border-t border-slate-100"><p class="text-sm">New registrations waiting</p><p class="text-xs text-slate-500 mt-1">Students and lecturers to approve · 10 min ago</p></a><a href="../admin/reports.html" class="block px-4 py-3 hover:bg-slate-50 border-t border-slate-100"><p class="text-sm">Marks submitted for BBC2101</p><p class="text-xs text-slate-500 mt-1">Dr. Moses Kato · 1 hr ago</p></a>
                        </div>
                    </details>
                    <!-- End: Notifications -->
                    <!-- Start: User menu -->
                    <details class="menu-dropdown relative">
                        <summary class="flex items-center gap-2 p-1 pr-2 rounded-xl hover:bg-slate-100 cursor-pointer">
                            <div class="w-8 h-8 rounded-full bg-brand-700 text-white flex items-center justify-center text-xs font-bold" data-u="initials">RG</div>
                            <div class="hidden md:block leading-tight text-left">
                                <p class="text-xs font-bold" data-u="name">Registrar</p>
                                <p class="text-[10px] text-slate-500">Registrar</p>
                            </div>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
                        </summary>
                        <div class="absolute right-0 mt-2 w-60 bg-white border border-slate-200 rounded-xl shadow-xl overflow-hidden z-50">
                            <div class="px-4 py-3 bg-slate-50 border-b border-slate-100"><p class="text-sm font-bold" data-u="name">Registrar</p><p class="text-xs text-slate-500 truncate" data-u="email">2400725284@mubs.ac.ug</p></div>
                            <a href="#" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50"><i data-lucide="user" class="w-4 h-4"></i>My profile</a>
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
                    
                    <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Welcome, <span data-u="first">Registrar</span></h1>
                    <p class="text-slate-500 mt-1 text-sm">Semester I, 2026/27 · registration closes Friday, 6 November.</p>
                </div>
                <div class="flex flex-wrap gap-2"><a href="students/create.html" class="btn-primary"><i data-lucide="user-plus" class="w-4 h-4"></i>Add student</a><a href="applications/index.html" class="btn-accent"><i data-lucide="user-check" class="w-4 h-4"></i>Approve registrations</a></div>
            </div>
            <!-- End: Page heading -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
                <div class="card p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Active students</p>
                            <p class="text-3xl font-extrabold tracking-tight mt-1">4,812</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center"><i data-lucide="graduation-cap" class="w-5 h-5 text-brand-600"></i></div>
                    </div><p class="text-xs text-slate-400 mt-3">+318 this intake</p>
                </div>
                <div class="card p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Waiting for approval</p>
                            <p class="text-3xl font-extrabold tracking-tight mt-1"><span data-pending-count>0</span></p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-accent-50 flex items-center justify-center"><i data-lucide="user-check" class="w-5 h-5 text-accent-600"></i></div>
                    </div><p class="text-xs text-slate-400 mt-3">Students and lecturers</p>
                </div>
                <div class="card p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Course registration done</p>
                            <p class="text-3xl font-extrabold tracking-tight mt-1">91%</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center"><i data-lucide="book-open-check" class="w-5 h-5 text-indigo-600"></i></div>
                    </div><p class="text-xs text-slate-400 mt-3">4,379 of 4,812</p>
                </div>
                <div class="card p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Not yet registered</p>
                            <p class="text-3xl font-extrabold tracking-tight mt-1">433</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-red-50 flex items-center justify-center"><i data-lucide="triangle-alert" class="w-5 h-5 text-red-600"></i></div>
                    </div><p class="text-xs text-slate-400 mt-3">Send reminder</p>
                </div>
            </div>
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">
                <div class="xl:col-span-2 card p-6">
                    <div class="flex justify-between items-center mb-5"><h2 class="font-bold text-lg">Students by programme</h2><a href="reports.html" class="text-sm font-semibold text-brand-700">Reports</a></div>
                    <div class="space-y-3"><div class="flex items-center gap-3"><span class="w-12 text-xs font-bold text-slate-500">BBC</span><div class="flex-1 h-7 rounded-lg bg-slate-100 overflow-hidden"><div class="h-full rounded-lg bg-gradient-to-r from-brand-600 to-brand-400" style="width:100%"></div></div><span class="w-12 text-right text-sm font-bold">1,240</span></div><div class="flex items-center gap-3"><span class="w-12 text-xs font-bold text-slate-500">BIT</span><div class="flex-1 h-7 rounded-lg bg-slate-100 overflow-hidden"><div class="h-full rounded-lg bg-gradient-to-r from-brand-600 to-brand-400" style="width:79%"></div></div><span class="w-12 text-right text-sm font-bold">980</span></div><div class="flex items-center gap-3"><span class="w-12 text-xs font-bold text-slate-500">BCOM</span><div class="flex-1 h-7 rounded-lg bg-slate-100 overflow-hidden"><div class="h-full rounded-lg bg-gradient-to-r from-brand-600 to-brand-400" style="width:89%"></div></div><span class="w-12 text-right text-sm font-bold">1,105</span></div><div class="flex items-center gap-3"><span class="w-12 text-xs font-bold text-slate-500">BPLM</span><div class="flex-1 h-7 rounded-lg bg-slate-100 overflow-hidden"><div class="h-full rounded-lg bg-gradient-to-r from-brand-600 to-brand-400" style="width:49%"></div></div><span class="w-12 text-right text-sm font-bold">612</span></div><div class="flex items-center gap-3"><span class="w-12 text-xs font-bold text-slate-500">BHRM</span><div class="flex-1 h-7 rounded-lg bg-slate-100 overflow-hidden"><div class="h-full rounded-lg bg-gradient-to-r from-brand-600 to-brand-400" style="width:44%"></div></div><span class="w-12 text-right text-sm font-bold">540</span></div><div class="flex items-center gap-3"><span class="w-12 text-xs font-bold text-slate-500">DCS</span><div class="flex-1 h-7 rounded-lg bg-slate-100 overflow-hidden"><div class="h-full rounded-lg bg-gradient-to-r from-brand-600 to-brand-400" style="width:27%"></div></div><span class="w-12 text-right text-sm font-bold">335</span></div></div>
                </div>
                <div class="card p-6">
                    <div class="flex justify-between items-center mb-2"><h2 class="font-bold text-lg">Waiting for approval</h2><span class="text-xs font-bold px-2 py-1 rounded-full bg-accent-50 text-accent-700" data-pending-count>0</span></div>
                    <div id="dash-apps"></div>
                </div>
            </div>
            <div class="flex justify-between items-center mb-4"><h2 class="font-bold text-lg">Recently updated students</h2><a href="students/index.html" class="text-sm font-semibold text-brand-700">All students</a></div>
            <div class="card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[640px]">
                        <thead><tr class="bg-slate-50"><th class="py-3 px-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Student</th><th class="py-3 px-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Programme</th><th class="py-3 px-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Year</th><th class="py-3 px-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Mode</th><th class="py-3 px-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Status</th><th class="py-3 px-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500"></th></tr></thead>
                        <tbody>
                            <tr class="border-t border-slate-100 hover:bg-brand-50/40"><td class="py-3.5 px-4 text-sm text-left"><div class="flex items-center gap-3"><div class="w-9 h-9 rounded-full bg-accent-100 text-accent-700 flex items-center justify-center text-xs font-bold shrink-0">SN</div><div><p class="font-semibold">Sarah Nakato</p><p class="text-xs text-slate-500">2400714521</p></div></div></td><td class="py-3.5 px-4 text-sm text-left">BBC</td><td class="py-3.5 px-4 text-sm text-left">Year 2</td><td class="py-3.5 px-4 text-sm text-left">Evening</td><td class="py-3.5 px-4 text-sm text-left"><span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full bg-brand-50 text-brand-700">Active</span></td><td class="py-3.5 px-4 text-sm text-left"><div class="flex justify-end gap-1"><a href="students/show.html" class="p-2 rounded-lg text-slate-500 hover:bg-brand-50 hover:text-brand-700" title="View"><i data-lucide="eye" class="w-4 h-4"></i></a><a href="students/edit.html" class="p-2 rounded-lg text-slate-500 hover:bg-brand-50 hover:text-brand-700" title="Edit"><i data-lucide="pencil" class="w-4 h-4"></i></a></div></td></tr>
<tr class="border-t border-slate-100 hover:bg-brand-50/40"><td class="py-3.5 px-4 text-sm text-left"><div class="flex items-center gap-3"><div class="w-9 h-9 rounded-full bg-accent-100 text-accent-700 flex items-center justify-center text-xs font-bold shrink-0">JO</div><div><p class="font-semibold">John Okello</p><p class="text-xs text-slate-500">2400711873</p></div></div></td><td class="py-3.5 px-4 text-sm text-left">BBC</td><td class="py-3.5 px-4 text-sm text-left">Year 2</td><td class="py-3.5 px-4 text-sm text-left">Day</td><td class="py-3.5 px-4 text-sm text-left"><span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full bg-brand-50 text-brand-700">Active</span></td><td class="py-3.5 px-4 text-sm text-left"><div class="flex justify-end gap-1"><a href="students/show.html" class="p-2 rounded-lg text-slate-500 hover:bg-brand-50 hover:text-brand-700" title="View"><i data-lucide="eye" class="w-4 h-4"></i></a><a href="students/edit.html" class="p-2 rounded-lg text-slate-500 hover:bg-brand-50 hover:text-brand-700" title="Edit"><i data-lucide="pencil" class="w-4 h-4"></i></a></div></td></tr>
<tr class="border-t border-slate-100 hover:bg-brand-50/40"><td class="py-3.5 px-4 text-sm text-left"><div class="flex items-center gap-3"><div class="w-9 h-9 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center text-xs font-bold shrink-0">AN</div><div><p class="font-semibold">Aisha Namuli</p><p class="text-xs text-slate-500">2400716204</p></div></div></td><td class="py-3.5 px-4 text-sm text-left">BIT</td><td class="py-3.5 px-4 text-sm text-left">Year 1</td><td class="py-3.5 px-4 text-sm text-left">Day</td><td class="py-3.5 px-4 text-sm text-left"><span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full bg-brand-50 text-brand-700">Active</span></td><td class="py-3.5 px-4 text-sm text-left"><div class="flex justify-end gap-1"><a href="students/show.html" class="p-2 rounded-lg text-slate-500 hover:bg-brand-50 hover:text-brand-700" title="View"><i data-lucide="eye" class="w-4 h-4"></i></a><a href="students/edit.html" class="p-2 rounded-lg text-slate-500 hover:bg-brand-50 hover:text-brand-700" title="Edit"><i data-lucide="pencil" class="w-4 h-4"></i></a></div></td></tr>
<tr class="border-t border-slate-100 hover:bg-brand-50/40"><td class="py-3.5 px-4 text-sm text-left"><div class="flex items-center gap-3"><div class="w-9 h-9 rounded-full bg-brand-100 text-brand-800 flex items-center justify-center text-xs font-bold shrink-0">KM</div><div><p class="font-semibold">Kevin Mugabi</p><p class="text-xs text-slate-500">2300709945</p></div></div></td><td class="py-3.5 px-4 text-sm text-left">BCOM</td><td class="py-3.5 px-4 text-sm text-left">Year 3</td><td class="py-3.5 px-4 text-sm text-left">Evening</td><td class="py-3.5 px-4 text-sm text-left"><span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full bg-red-50 text-red-600">Suspended</span></td><td class="py-3.5 px-4 text-sm text-left"><div class="flex justify-end gap-1"><a href="students/show.html" class="p-2 rounded-lg text-slate-500 hover:bg-brand-50 hover:text-brand-700" title="View"><i data-lucide="eye" class="w-4 h-4"></i></a><a href="students/edit.html" class="p-2 rounded-lg text-slate-500 hover:bg-brand-50 hover:text-brand-700" title="Edit"><i data-lucide="pencil" class="w-4 h-4"></i></a></div></td></tr>
<tr class="border-t border-slate-100 hover:bg-brand-50/40"><td class="py-3.5 px-4 text-sm text-left"><div class="flex items-center gap-3"><div class="w-9 h-9 rounded-full bg-accent-100 text-accent-700 flex items-center justify-center text-xs font-bold shrink-0">PA</div><div><p class="font-semibold">Patience Achan</p><p class="text-xs text-slate-500">2400718830</p></div></div></td><td class="py-3.5 px-4 text-sm text-left">BPLM</td><td class="py-3.5 px-4 text-sm text-left">Year 1</td><td class="py-3.5 px-4 text-sm text-left">Weekend</td><td class="py-3.5 px-4 text-sm text-left"><span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full bg-brand-50 text-brand-700">Active</span></td><td class="py-3.5 px-4 text-sm text-left"><div class="flex justify-end gap-1"><a href="students/show.html" class="p-2 rounded-lg text-slate-500 hover:bg-brand-50 hover:text-brand-700" title="View"><i data-lucide="eye" class="w-4 h-4"></i></a><a href="students/edit.html" class="p-2 rounded-lg text-slate-500 hover:bg-brand-50 hover:text-brand-700" title="Edit"><i data-lucide="pencil" class="w-4 h-4"></i></a></div></td></tr>
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
