<x-app-layout title="Results">
    <x-ui.page-heading title="Results" subtitle="Marks entered by your lecturers. Coursework /30 + Exam /70." :crumbs="['Academics' => null, 'Results' => null]">
        <x-slot name="actions"><button onclick="window.print()" class="btn-ghost no-print"><i data-lucide="printer" class="w-4 h-4"></i>Print</button></x-slot>
    </x-ui.page-heading>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
        <x-ui.stat label="CGPA" :value="$gpa !== null ? number_format($gpa, 2) : '—'" icon="award" note="5-point scale" />
        <x-ui.stat label="Graded courses" :value="$registrations->whereNotNull('grade')->count()" icon="check-check" tone="indigo" />
        <x-ui.stat label="Waiting for results" :value="$registrations->whereNull('grade')->count()" icon="hourglass" tone="accent" />
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px]">
                <thead><tr class="bg-slate-50"><th class="table-th">Code</th><th class="table-th">Course</th><th class="table-th">CU</th><th class="table-th">Coursework</th><th class="table-th">Exam</th><th class="table-th">Total</th><th class="table-th">Grade</th></tr></thead>
                <tbody>
                    @forelse ($registrations as $r)
                        <tr class="border-t border-slate-100">
                            <td class="table-td font-extrabold text-brand-700">{{ $r->course->code }}</td>
                            <td class="table-td font-semibold">{{ $r->course->title }}</td>
                            <td class="table-td">{{ $r->course->credit_units }}</td>
                            <td class="table-td">{{ $r->coursework_mark ?? '—' }}</td>
                            <td class="table-td">{{ $r->exam_mark ?? '—' }}</td>
                            <td class="table-td font-semibold">{{ $r->total() ?? '—' }}</td>
                            <td class="table-td"><span class="text-base font-extrabold {{ $r->grade === 'F' ? 'text-red-600' : 'text-brand-700' }}">{{ $r->grade ?? 'Pending' }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="7"><x-ui.empty icon="award" message="No results yet." /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
