<x-app-layout title="Students">
    <x-ui.page-heading title="Students" subtitle="All approved student records. Search, filter, view or edit a student." :crumbs="['Records' => null, 'Students' => null]">
        <x-slot name="actions">
            @can('create', App\Models\Student::class)
                <a href="{{ route('admin.students.create') }}" class="btn-primary"><i data-lucide="user-plus" class="w-4 h-4"></i>Add student</a>
            @endcan
        </x-slot>
    </x-ui.page-heading>

    {{-- Filters --}}
    <form method="GET" class="card p-4 mb-5 grid sm:grid-cols-2 lg:grid-cols-6 gap-3">
        <div class="lg:col-span-2 relative">
            <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Name, number or email" class="input-field !pl-10">
        </div>
        <select name="programme" class="input-field">
            <option value="">All programmes</option>
            @foreach ($programmes as $id => $code)<option value="{{ $id }}" @selected(request('programme') == $id)>{{ $code }}</option>@endforeach
        </select>
        <select name="year" class="input-field">
            <option value="">All years</option>
            @foreach ([1, 2, 3, 4] as $y)<option value="{{ $y }}" @selected(request('year') == $y)>Year {{ $y }}</option>@endforeach
        </select>
        <select name="status" class="input-field">
            <option value="">All statuses</option>
            @foreach (App\Models\Student::STATUSES as $s)<option @selected(request('status') === $s)>{{ $s }}</option>@endforeach
        </select>
        <div class="flex gap-2">
            <button class="btn-primary flex-1 justify-center"><i data-lucide="filter" class="w-4 h-4"></i>Filter</button>
            @if (request()->hasAny(['search', 'programme', 'year', 'status']))
                <a href="{{ route('admin.students.index') }}" class="btn-ghost" title="Clear"><i data-lucide="x" class="w-4 h-4"></i></a>
            @endif
        </div>
    </form>

    @include('admin.students._table')

    <div class="mt-4">{{ $students->links() }}</div>
</x-app-layout>
