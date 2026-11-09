<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head', ['title' => 'Access denied'])
</head>
<body class="bg-canvas text-slate-900 font-sans antialiased min-h-screen flex items-center justify-center p-6">
    <div class="card p-8 sm:p-10 max-w-md w-full text-center">
        <div class="w-16 h-16 mx-auto rounded-2xl bg-red-50 flex items-center justify-center mb-6"><i data-lucide="shield-x" class="w-8 h-8 text-red-600"></i></div>
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-red-600 mb-2">Error 403</p>
        <h1 class="text-2xl font-extrabold tracking-tight mb-2">You can't open this page</h1>
        <p class="text-sm text-slate-500 mb-8">Your role does not have permission for this page or record. If you think this is wrong, contact the Registrar's office.</p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-primary justify-center">Back to my dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-primary justify-center">Sign in</a>
            @endauth
            <a href="{{ url()->previous() }}" class="btn-ghost justify-center">Go back</a>
        </div>
    </div>
</body>
</html>
