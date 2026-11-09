<x-guest-layout title="Sign in">
    <h1 class="text-2xl font-extrabold tracking-tight">Welcome back</h1>
    <p class="text-sm text-slate-500 mt-1 mb-8">Sign in with your email and password. You will go straight to your own dashboard.</p>

    @session('status')
        <x-ui.alert type="success" class="mb-5">{{ $value }}</x-ui.alert>
    @endsession

    <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
        @csrf

        <div>
            <label for="email" class="field-label">Email</label>
            <div class="relative">
                <i data-lucide="at-sign" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="you@example.com" class="input-field !pl-10" @error('email') aria-invalid="true" @enderror>
            </div>
        </div>

        <div>
            <div class="flex justify-between items-center">
                <label for="password" class="field-label">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-semibold text-brand-700 hover:text-brand-900 mb-1.5">Forgot password?</a>
                @endif
            </div>
            <div class="relative">
                <i data-lucide="lock" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="••••••••" class="input-field !pl-10">
            </div>
        </div>

        <label for="remember_me" class="flex items-center gap-2 text-sm text-slate-600">
            <input id="remember_me" type="checkbox" name="remember" class="rounded border-slate-300 text-brand-700 focus:ring-brand-500">
            Keep me signed in
        </label>

        @if ($errors->any())
            <x-ui.alert type="error">{{ $errors->first() }}</x-ui.alert>
        @endif

        <button type="submit" class="btn-primary w-full justify-center py-3">Sign in<i data-lucide="arrow-right" class="w-4 h-4"></i></button>
    </form>

    <div class="mt-8 p-4 rounded-xl bg-white border border-slate-200 text-sm text-slate-600 flex gap-3">
        <i data-lucide="info" class="w-5 h-5 text-brand-600 shrink-0"></i>
        <p>New students and lecturers must <a href="{{ route('register') }}" class="font-bold text-brand-700">register first</a>. You can sign in once the Registrar approves your registration.</p>
    </div>
</x-guest-layout>
