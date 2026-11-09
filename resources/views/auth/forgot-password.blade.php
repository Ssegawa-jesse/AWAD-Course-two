<x-guest-layout title="Forgot password">
    <div class="w-12 h-12 rounded-xl bg-accent-50 flex items-center justify-center mb-5"><i data-lucide="key-round" class="w-6 h-6 text-accent-600"></i></div>
    <h1 class="text-2xl font-extrabold tracking-tight">Forgot your password?</h1>
    <p class="text-sm text-slate-500 mt-1 mb-8">Enter the email you registered with and we will send you a link to choose a new password.</p>

    @session('status')
        <x-ui.alert type="success" class="mb-5">{{ $value }}</x-ui.alert>
    @endsession

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5" novalidate>
        @csrf
        <x-ui.input name="email" label="Email" type="email" required autofocus autocomplete="username" placeholder="you@example.com" />
        <button type="submit" class="btn-primary w-full justify-center py-3">Email reset link<i data-lucide="send" class="w-4 h-4"></i></button>
    </form>

    <p class="text-sm text-slate-500 mt-8 text-center"><a href="{{ route('login') }}" class="font-bold text-brand-700 inline-flex items-center gap-1"><i data-lucide="arrow-left" class="w-4 h-4"></i>Back to sign in</a></p>
</x-guest-layout>
