@props(['value'])
@php
    $map = [
        'Active' => 'bg-brand-50 text-brand-700', 'Approved' => 'bg-brand-50 text-brand-700', 'approved' => 'bg-brand-50 text-brand-700',
        'Registered' => 'bg-brand-50 text-brand-700', 'Core' => 'bg-slate-100 text-slate-600',
        'Elective' => 'bg-indigo-50 text-indigo-600', 'Graduated' => 'bg-indigo-50 text-indigo-600',
        'Pending' => 'bg-accent-50 text-accent-700', 'pending' => 'bg-accent-50 text-accent-700',
        'Suspended' => 'bg-red-50 text-red-600', 'Rejected' => 'bg-red-50 text-red-600', 'rejected' => 'bg-red-50 text-red-600',
        'Inactive' => 'bg-slate-100 text-slate-500', 'Full' => 'bg-red-50 text-red-600',
        'admin' => 'bg-accent-50 text-accent-700', 'lecturer' => 'bg-indigo-50 text-indigo-600', 'student' => 'bg-brand-50 text-brand-700',
    ];
@endphp
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full '.($map[$value] ?? 'bg-slate-100 text-slate-600')]) }}>{{ $slot->isEmpty() ? ucfirst($value) : $slot }}</span>
