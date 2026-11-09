<x-app-layout title="Reports">
    <x-ui.page-heading title="Reports" subtitle="Numbers for the Registrar, straight from the database." :crumbs="['Academics' => null, 'Reports' => null]">
        <x-slot name="actions"><button onclick="window.print()" class="btn-ghost no-print"><i data-lucide="printer" class="w-4 h-4"></i>Print</button></x-slot>
    </x-ui.page-heading>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        @foreach (App\Models\Student::STATUSES as $s)
            <x-ui.stat :label="$s.' students'" :value="$statusCounts[$s] ?? 0" :icon="['Active' => 'user-check', 'Suspended' => 'user-x', 'Inactive' => 'user-minus', 'Graduated' => 'graduation-cap'][$s]" :tone="['Active' => 'brand', 'Suspended' => 'red', 'Inactive' => 'accent', 'Graduated' => 'indigo'][$s]" />
        @endforeach
    </div>

    <div class="grid xl:grid-cols-2 gap-6 mb-6">
        <div class="card overflow-hidden">
            <x-ui.card-header title="Programmes" subtitle="Students and courses per programme" icon="layers" />
            <table class="w-full">
                <thead><tr class="bg-slate-50"><th class="table-th">Programme</th><th class="table-th">Students</th><th class="table-th">Courses</th></tr></thead>
                <tbody>
                    @foreach ($programmes as $p)
                        <tr class="border-t border-slate-100"><td class="table-td"><b class="text-brand-700">{{ $p->code }}</b> {{ $p->name }}</td><td class="table-td">{{ $p->students_count }}</td><td class="table-td">{{ $p->courses_count }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card p-6">
            <h2 class="font-bold mb-4">Grade distribution</h2>
            @php $maxGrade = max(1, $gradeCounts->max() ?? 1); @endphp
            <div class="space-y-3">
                @foreach (['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F'] as $g)
                    <div class="flex items-center gap-3">
                        <span class="w-8 text-sm font-bold text-slate-600">{{ $g }}</span>
                        <div class="flex-1 h-6 rounded-lg bg-slate-100 overflow-hidden"><div class="h-full rounded-lg {{ $g === 'F' ? 'bg-red-400' : 'bg-gradient-to-r from-brand-600 to-brand-400' }}" style="width: {{ round(($gradeCounts[$g] ?? 0) / $maxGrade * 100) }}%"></div></div>
                        <span class="w-8 text-right text-sm font-bold">{{ $gradeCounts[$g] ?? 0 }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card overflow-hidden">
        <x-ui.card-header title="Course registration numbers" icon="library" />
        <div class="overflow-x-auto">
            <table class="w-full min-w-[640px]">
                <thead><tr class="bg-slate-50"><th class="table-th">Course</th><th class="table-th">Lecturer</th><th class="table-th">Registered</th><th class="table-th">Capacity used</th></tr></thead>
                <tbody>
                    @foreach ($courses as $c)
                        <tr class="border-t border-slate-100">
                            <td class="table-td"><b class="text-brand-700">{{ $c->code }}</b> {{ $c->title }}</td>
                            <td class="table-td">{{ $c->lecturer?->name ?? '—' }}</td>
                            <td class="table-td">{{ $c->registrations_count }} / {{ $c->capacity }}</td>
                            <td class="table-td w-48"><div class="progress"><span style="width: {{ min(100, round($c->registrations_count / max(1, $c->capacity) * 100)) }}%"></span></div></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
