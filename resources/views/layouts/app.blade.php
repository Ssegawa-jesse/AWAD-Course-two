{{--
    Main portal layout (used by <x-app-layout>).
    Header (top bar), navigation (sidebar), content section and footer
    are split into partials so every page re-uses them.
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
    @livewireStyles
</head>
<body class="bg-canvas text-slate-900 font-sans antialiased min-h-screen">
    <x-banner />

    {{-- Sidebar toggle for small screens (checkbox, no JavaScript) --}}
    <input type="checkbox" id="sidebar-toggle" class="peer hidden">
    <label for="sidebar-toggle" class="fixed inset-0 bg-slate-900/40 z-30 hidden peer-checked:block lg:!hidden"></label>

    {{-- Navigation --}}
    @include('partials.sidebar')

    <div class="lg:pl-[260px] min-h-screen flex flex-col">
        {{-- Header --}}
        @include('partials.topbar')

        {{-- Content --}}
        <main class="flex-1 px-4 sm:px-8 py-8 animate-rise">
            @include('partials.flash')

            @isset($header)
                {{-- Jetstream pages (profile, API tokens) pass a header slot --}}
                <div class="mb-6 [&_h2]:text-2xl [&_h2]:font-extrabold [&_h2]:tracking-tight [&_h2]:text-slate-900">{{ $header }}</div>
            @endisset

            {{ $slot }}
        </main>

        {{-- Footer --}}
        @include('partials.footer')
    </div>

    @stack('modals')
    @livewireScripts
    @stack('scripts')
</body>
</html>
