<!DOCTYPE html>
<html lang="en" data-root="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us — ScholarDesk</title>
    <link rel="icon" type="image/svg+xml" href="assets/img/logo.svg">
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
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="https://unpkg.com/lucide@0.460.0/dist/umd/lucide.min.js"></script>
    <script src="assets/js/app.js"></script>
</head>
<body class="bg-canvas text-slate-900 font-sans antialiased">
    <!-- Start: Header -->
    <header class="fixed top-0 inset-x-0 z-50 bg-white/85 backdrop-blur border-b border-slate-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-[72px]">
                <a href="index.html" class="flex items-center gap-3">
                    <img src="assets/img/logo.svg" alt="ScholarDesk" class="h-10 w-10">
                    <div class="leading-tight"><p class="font-extrabold tracking-tight text-brand-900">ScholarDesk</p><p class="text-[11px] text-slate-500 hidden sm:block">Student Management System</p></div>
                </a>
                <nav class="hidden md:flex items-center gap-7">
                    <a href="index.html" class="text-slate-500 hover:text-brand-800 text-sm font-medium transition-colors">Home</a><a href="index.html#features" class="text-slate-500 hover:text-brand-800 text-sm font-medium transition-colors">Features</a><a href="index.html#how" class="text-slate-500 hover:text-brand-800 text-sm font-medium transition-colors">How to apply</a><a href="index.html#programmes" class="text-slate-500 hover:text-brand-800 text-sm font-medium transition-colors">Programmes</a><a href="contact.html" class="text-brand-800 font-bold text-sm font-medium transition-colors">Contact</a>
                </nav>
                <div class="hidden md:flex items-center gap-3">
                    <a href="login.html" class="btn-ghost">Sign in</a>
                    <a href="register.html" class="btn-primary">Register now<i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                </div>
                <label for="mobile-nav" class="md:hidden p-2 cursor-pointer"><i data-lucide="menu" class="w-6 h-6"></i></label>
            </div>
            <input type="checkbox" id="mobile-nav" class="peer hidden">
            <div class="hidden peer-checked:flex md:!hidden flex-col gap-4 py-4 border-t border-slate-200">
                <a href="index.html" class="text-slate-500 hover:text-brand-800 text-sm font-medium transition-colors">Home</a><a href="index.html#features" class="text-slate-500 hover:text-brand-800 text-sm font-medium transition-colors">Features</a><a href="index.html#how" class="text-slate-500 hover:text-brand-800 text-sm font-medium transition-colors">How to apply</a><a href="index.html#programmes" class="text-slate-500 hover:text-brand-800 text-sm font-medium transition-colors">Programmes</a><a href="contact.html" class="text-brand-800 font-bold text-sm font-medium transition-colors">Contact</a>
                <a href="login.html" class="btn-ghost justify-center">Sign in</a>
                <a href="register.html" class="btn-primary justify-center">Register now</a>
            </div>
        </div>
    </header>
    <!-- End: Header -->

    <!-- Start: Contact -->
    <section class="pt-[72px]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="max-w-2xl mb-12">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-accent-600 mb-3">Contact</p>
                <h1 class="text-4xl font-extrabold tracking-tight mb-3">Talk to the Registrar's office</h1>
                <p class="text-slate-500">Questions about registration, results, transcripts or your student number. We reply within one working day.</p>
            </div>
            <div class="grid lg:grid-cols-[1fr_1.3fr] gap-8">
                <div class="space-y-4">
                    <div class="card p-6 flex gap-4"><div class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center shrink-0"><i data-lucide="map-pin" class="w-5 h-5 text-brand-600"></i></div><div><p class="font-bold">Academic Registrar</p><p class="text-sm text-slate-500">Block B, ground floor · Main campus</p></div></div>
                    <div class="card p-6 flex gap-4"><div class="w-11 h-11 rounded-xl bg-accent-50 flex items-center justify-center shrink-0"><i data-lucide="phone" class="w-5 h-5 text-accent-600"></i></div><div><p class="font-bold">Phone</p><p class="text-sm text-slate-500">Registrar: +256 414 000 300<br>Finance: +256 414 000 301</p></div></div>
                    <div class="card p-6 flex gap-4"><div class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center shrink-0"><i data-lucide="mail" class="w-5 h-5 text-brand-600"></i></div><div><p class="font-bold">Email</p><p class="text-sm text-slate-500">registrar@campus.ac.ug<br>admissions@campus.ac.ug</p></div></div>
                    <div class="card p-6 flex gap-4"><div class="w-11 h-11 rounded-xl bg-accent-50 flex items-center justify-center shrink-0"><i data-lucide="clock" class="w-5 h-5 text-accent-600"></i></div><div><p class="font-bold">Office hours</p><p class="text-sm text-slate-500">Monday – Friday, 8:00am – 5:00pm</p></div></div>
                </div>
                <form action="contact.html" method="get" class="card p-6 sm:p-8 grid sm:grid-cols-2 gap-5">
                    <div class="">
                            <label for="name" class="field-label">Full name <span class="text-accent-600">*</span></label>
                            <input type="text" id="name" name="name" placeholder="Your name" required class="input-field">
                        </div>
                    <div class="">
                            <label for="email" class="field-label">Email <span class="text-accent-600">*</span></label>
                            <input type="email" id="email" name="email" placeholder="you@example.com" required class="input-field">
                        </div>
                    <div class="">
                            <label for="student_no" class="field-label">Student number</label>
                            <input type="text" id="student_no" name="student_no" placeholder="If you have one" class="input-field">
                        </div>
                    <div class="">
                            <label for="topic" class="field-label">Topic <span class="text-accent-600">*</span></label>
                            <select id="topic" name="topic" required class="input-field"><option value="" disabled selected>Choose…</option><option>Registration</option><option>Course units</option><option>Results / transcript</option><option>Fees</option><option>Account / password</option><option>Other</option></select>
                        </div>
                    <div class="sm:col-span-2">
                            <label for="message" class="field-label">Message <span class="text-accent-600">*</span></label>
                            <textarea id="message" name="message" rows="6" placeholder="How can we help?" required class="input-field"></textarea>
                        </div>
                    <div class="sm:col-span-2"><button class="btn-primary">Send message<i data-lucide="send" class="w-4 h-4"></i></button></div>
                </form>
            </div>
        </div>
    </section>
    <!-- End: Contact -->

    <!-- Start: Footer -->
    <footer class="bg-brand-950 text-brand-100 sidebar-pattern">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <img src="assets/img/logo.svg" alt="" class="h-11 w-11">
                        <div><p class="font-extrabold text-white">ScholarDesk</p><p class="text-xs text-brand-300">Student Management System</p></div>
                    </div>
                    <p class="text-sm text-brand-200 leading-relaxed max-w-xs">One place for admissions, course registration, results, timetables and fees — for students, lecturers and the registrar.</p>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-5">Quick links</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="register.html" class="hover:text-white">Apply / register</a></li>
                        <li><a href="login.html" class="hover:text-white">Sign in</a></li>
                        <li><a href="register.html" class="hover:text-white">Lecturer registration</a></li>
                        <li><a href="contact.html" class="hover:text-white">Contact us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-5">Offices</h4>
                    <ul class="space-y-3 text-sm text-brand-200">
                        <li>Admissions — Main Building, Room 4</li>
                        <li>Academic Registrar — Block B</li>
                        <li>Finance / Bursar — Block A</li>
                        <li>ICT Helpdesk — Library, 1st floor</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-5">Contact</h4>
                    <ul class="space-y-2 text-sm text-brand-200">
                        <li>registrar@campus.ac.ug</li>
                        <li>+256 414 000 300</li>
                        <li class="text-accent-400 font-semibold pt-2">Mon–Fri, 8:00am – 5:00pm</li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-white/10 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-brand-300">
                <p>© 2026 ScholarDesk. All rights reserved.</p>
                <p>Privacy · Terms of use · Academic policy</p>
            </div>
        </div>
    </footer>
    <!-- End: Footer -->
    <script>lucide.createIcons();</script>
</body>
</html>
