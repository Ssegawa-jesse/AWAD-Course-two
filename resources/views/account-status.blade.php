
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Approval Status</title>
</head>
<body>
    <h1>Account Approval Status</h1>

    <p>Hello, {{ auth()->user()->name }}.</p>

    @if(auth()->user()->status === 'pending')
        <p>Your account is awaiting approval from the registrar.</p>
    @elseif(auth()->user()->status === 'rejected')
        <p>Your account registration has been rejected. Please contact the registrar.</p>
    @else
        <p>Your account is not currently approved.</p>
    @endif

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
