<x-app-layout title="My registrations">
    <x-ui.page-heading title="My registrations" :subtitle="$registrations->count().' courses · '.$credits.' credit units · Semester I, 2026/27'" :crumbs="['Academics' => null, 'My registrations' => null]">
        <x-slot name="actions">
            <button onclick="window.print()" class="btn-ghost no-print"><i data-lucide="printer" class="w-4 h-4"></i>Print proof of registration</button>
            <a href="{{ route('student.courses.index') }}" class="btn-primary no-print"><i data-lucide="plus" class="w-4 h-4"></i>Add courses</a>
        </x-slot>
    </x-ui.page-heading>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px]">
                <thead><tr class="bg-slate-50"><th class="table-th">Code</th><th class="table-th">Course</th><th class="table-th">CU</th><th class="table-th">Lecturer</th><th class="table-th">Schedule</th><th class="table-th">Status</th><th class="table-th"></th></tr></thead>
                <tbody>
                    @forelse ($registrations as $registration)
                        <tr class="border-t border-slate-100">
                            <td class="table-td font-extrabold text-brand-700">{{ $registration->course->code }}</td>
                            <td class="table-td font-semibold">{{ $registration->course->title }}</td>
                            <td class="table-td">{{ $registration->course->credit_units }}</td>
                            <td class="table-td">{{ $registration->course->lecturer?->name ?? '—' }}</td>
                            <td class="table-td text-slate-500">{{ $registration->course->scheduleLabel() }}</td>
                            <td class="table-td"><x-ui.badge :value="$registration->status" /></td>
                            <td class="table-td text-right no-print">
                                @can('delete', $registration)
                                    <x-ui.delete-button :action="route('student.registrations.destroy', $registration)" icon="x" :confirm="'Drop '.$registration->course->code.'?'" />
                                @else
                                    <span class="text-[11px] text-slate-400">Graded</span>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7"><x-ui.empty icon="book-x" message="You have not registered for any course yet." /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
