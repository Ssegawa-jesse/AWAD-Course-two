<x-app-layout title="Course units">
    <x-ui.page-heading title="Course units" subtitle="Every course on offer, who teaches it and how many students registered." :crumbs="['Academics' => null, 'Course units' => null]">
        <x-slot name="actions">
            @can('create', App\Models\Course::class)
                <a href="{{ route('admin.courses.create') }}" class="btn-primary"><i data-lucide="plus" class="w-4 h-4"></i>Add course</a>
            @endcan
        </x-slot>
    </x-ui.page-heading>

    <form method="GET" class="card p-4 mb-5 grid sm:grid-cols-2 lg:grid-cols-5 gap-3">
        <div class="lg:col-span-2 relative">
            <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Code or title" class="input-field !pl-10">
        </div>
        <select name="programme" class="input-field">
            <option value="">All programmes</option>
            @foreach ($programmes as $id => $code)<option value="{{ $id }}" @selected(request('programme') == $id)>{{ $code }}</option>@endforeach
        </select>
        <select name="year" class="input-field">
            <option value="">All years</option>
            @foreach ([1, 2, 3, 4] as $y)<option value="{{ $y }}" @selected(request('year') == $y)>Year {{ $y }}</option>@endforeach
        </select>
        <button class="btn-primary justify-center"><i data-lucide="filter" class="w-4 h-4"></i>Filter</button>
    </form>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[820px]">
                <thead><tr class="bg-slate-50"><th class="table-th">Code</th><th class="table-th">Course</th><th class="table-th">Programme</th><th class="table-th">CU</th><th class="table-th">Lecturer</th><th class="table-th">Registered</th><th class="table-th"></th></tr></thead>
                <tbody>
                    @forelse ($courses as $course)
                        <tr class="border-t border-slate-100 hover:bg-brand-50/40">
                            <td class="table-td font-extrabold text-brand-700">{{ $course->code }}</td>
                            <td class="table-td"><p class="font-semibold">{{ $course->title }}</p><p class="text-xs text-slate-500">Year {{ $course->year_of_study }} · Sem {{ $course->semester }} · <x-ui.badge :value="$course->type" class="!py-0" /></p></td>
                            <td class="table-td">{{ $course->programme?->code ?? '—' }}</td>
                            <td class="table-td">{{ $course->credit_units }}</td>
                            <td class="table-td">{{ $course->lecturer?->name ?? 'Not assigned' }}</td>
                            <td class="table-td">
                                <div class="w-28">
                                    <div class="flex justify-between text-xs mb-1"><span class="font-bold">{{ $course->registrations_count }}</span><span class="text-slate-400">/ {{ $course->capacity }}</span></div>
                                    <div class="progress {{ $course->registrations_count >= $course->capacity ? 'warn' : '' }}"><span style="width: {{ min(100, round($course->registrations_count / max(1, $course->capacity) * 100)) }}%"></span></div>
                                </div>
                            </td>
                            <td class="table-td">
                                <div class="flex justify-end gap-1">
                                    <a href="{{ route('admin.courses.show', $course) }}" class="icon-btn" title="View students"><i data-lucide="eye" class="w-4 h-4"></i></a>
                                    @can('update', $course)<a href="{{ route('admin.courses.edit', $course) }}" class="icon-btn" title="Edit"><i data-lucide="pencil" class="w-4 h-4"></i></a>@endcan
                                    @can('delete', $course)<x-ui.delete-button :action="route('admin.courses.destroy', $course)" :confirm="'Delete course '.$course->code.'?'" />@endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7"><x-ui.empty icon="library" message="No courses found." /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">{{ $courses->links() }}</div>
</x-app-layout>
