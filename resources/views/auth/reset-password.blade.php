<x-guest-layout title="Reset password">
    <h1 class="text-2xl font-extrabold tracking-tight">Choose a new password</h1>
    <p class="text-sm text-slate-500 mt-1 mb-8">Use at least 8 characters.</p>

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5" novalidate>
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <x-ui.input name="email" label="Email" type="email" :value="$request->email" required autocomplete="username" />
        <x-ui.input name="password" label="New password" type="password" required autocomplete="new-password" />
        <x-ui.input name="password_confirmation" label="Confirm new password" type="password" required autocomplete="new-password" />

        <button type="submit" class="btn-primary w-full justify-center py-3">Reset password<i data-lucide="check" class="w-4 h-4"></i></button>
    </form>
</x-guest-layout>
