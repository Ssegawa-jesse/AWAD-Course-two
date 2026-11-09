<x-app-layout title="Timetable">
    <x-ui.page-heading title="My timetable" subtitle="Weekly classes for the courses you registered." :crumbs="['Academics' => null, 'Timetable' => null]" />

    @if ($courses->isEmpty())
        <div class="card"><x-ui.empty icon="calendar-x" message="Register for courses to see your timetable." /></div>
    @else
        <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach ($days as $day => $classes)
                <div class="card p-5 {{ $day === now()->format('l') ? 'ring-2 ring-brand-400' : '' }}">
                    <div class="flex items-center justify-between mb-4"><h2 class="font-bold">{{ $day }}</h2>@if ($day === now()->format('l'))<x-ui.badge value="Active">Today</x-ui.badge>@endif</div>
                    @forelse ($classes as $class)
                        <div class="flex gap-3 p-3 rounded-xl bg-slate-50 mb-2">
                            <div class="text-xs font-bold text-brand-700 w-12 shrink-0">{{ substr($class->start_time, 0, 5) }}<br><span class="text-slate-400 font-medium">{{ substr($class->end_time, 0, 5) }}</span></div>
                            <div class="min-w-0"><p class="text-xs font-extrabold text-brand-700">{{ $class->code }}</p><p class="text-sm font-semibold">{{ $class->title }}</p><p class="text-xs text-slate-500">{{ $class->room }} · {{ $class->lecturer?->name }}</p></div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-400">No classes</p>
                    @endforelse
                </div>
            @endforeach
        </div>
    @endif
</x-app-layout>
