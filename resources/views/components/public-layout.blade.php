@props(['title' => null])
{{-- Layout for the public website pages (home, contact). --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="bg-canvas text-slate-900 font-sans antialiased">
    <!-- Start: Header -->
    <header class="fixed top-0 inset-x-0 z-50 bg-white/85 backdrop-blur border-b border-slate-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-[72px]">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <img src="{{ asset('assets/img/logo.svg') }}" alt="ScholarDesk" class="h-10 w-10">
                    <div class="leading-tight"><p class="font-extrabold tracking-tight text-brand-900">ScholarDesk</p><p class="text-[11px] text-slate-500 hidden sm:block">Student Management System</p></div>
                </a>
                <nav class="hidden md:flex items-center gap-7">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-brand-800 font-bold' : 'text-slate-500 hover:text-brand-800' }} text-sm font-medium transition-colors">Home</a><a href="{{ route('home') }}#features" class="text-slate-500 hover:text-brand-800 text-sm font-medium transition-colors">Features</a><a href="{{ route('home') }}#how" class="text-slate-500 hover:text-brand-800 text-sm font-medium transition-colors">How to apply</a><a href="{{ route('home') }}#programmes" class="text-slate-500 hover:text-brand-800 text-sm font-medium transition-colors">Programmes</a><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-brand-800 font-bold' : 'text-slate-500 hover:text-brand-800' }} text-sm font-medium transition-colors">Contact</a>
                </nav>
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">Go to dashboard<i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                    @else
                        <a href="{{ route('login') }}" class="btn-ghost">Sign in</a>
                        <a href="{{ route('register') }}" class="btn-primary">Register now<i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                    @endauth
                </div>
                <label for="mobile-nav" class="md:hidden p-2 cursor-pointer"><i data-lucide="menu" class="w-6 h-6"></i></label>
            </div>
            <input type="checkbox" id="mobile-nav" class="peer hidden">
            <div class="hidden peer-checked:flex md:!hidden flex-col gap-4 py-4 border-t border-slate-200">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-brand-800 font-bold' : 'text-slate-500 hover:text-brand-800' }} text-sm font-medium transition-colors">Home</a><a href="{{ route('home') }}#features" class="text-slate-500 hover:text-brand-800 text-sm font-medium transition-colors">Features</a><a href="{{ route('home') }}#how" class="text-slate-500 hover:text-brand-800 text-sm font-medium transition-colors">How to apply</a><a href="{{ route('home') }}#programmes" class="text-slate-500 hover:text-brand-800 text-sm font-medium transition-colors">Programmes</a><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-brand-800 font-bold' : 'text-slate-500 hover:text-brand-800' }} text-sm font-medium transition-colors">Contact</a>
                <a href="{{ route('login') }}" class="btn-ghost justify-center">Sign in</a>
                <a href="{{ route('register') }}" class="btn-primary justify-center">Register now</a>
            </div>
        </div>
    </header>
    <!-- End: Header -->

    {{ $slot }}

    <!-- Start: Footer -->
    <footer class="bg-brand-950 text-brand-100 sidebar-pattern">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <img src="{{ asset('assets/img/logo.svg') }}" alt="" class="h-11 w-11">
                        <div><p class="font-extrabold text-white">ScholarDesk</p><p class="text-xs text-brand-300">Student Management System</p></div>
                    </div>
                    <p class="text-sm text-brand-200 leading-relaxed max-w-xs">One place for admissions, course registration, results, timetables and fees — for students, lecturers and the registrar.</p>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-5">Quick links</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('register') }}" class="hover:text-white">Apply / register</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white">Sign in</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white">Lecturer registration</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white">Contact us</a></li>
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
                <p>© {{ date('Y') }} ScholarDesk. All rights reserved.</p>
                <p>Privacy · Terms of use · Academic policy</p>
            </div>
        </div>
    </footer>
    <!-- End: Footer -->
</body>
</html>
