<x-app-layout title="Programmes">
    <x-ui.page-heading title="Programmes" subtitle="Degree and diploma programmes. Each programme has many students and many course units." :crumbs="['Academics' => null, 'Programmes' => null]">
        <x-slot name="actions"><a href="{{ route('admin.programmes.create') }}" class="btn-primary"><i data-lucide="plus" class="w-4 h-4"></i>Add programme</a></x-slot>
    </x-ui.page-heading>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px]">
                <thead><tr class="bg-slate-50"><th class="table-th">Code</th><th class="table-th">Programme</th><th class="table-th">Faculty</th><th class="table-th">Level</th><th class="table-th">Students</th><th class="table-th">Courses</th><th class="table-th"></th></tr></thead>
                <tbody>
                    @forelse ($programmes as $programme)
                        <tr class="border-t border-slate-100 hover:bg-brand-50/40">
                            <td class="table-td font-extrabold text-brand-700">{{ $programme->code }}</td>
                            <td class="table-td font-semibold">{{ $programme->name }}</td>
                            <td class="table-td">{{ $programme->faculty ?? '—' }}</td>
                            <td class="table-td">{{ $programme->level }} · {{ $programme->duration_years }} yrs</td>
                            <td class="table-td"><a class="font-semibold text-brand-700" href="{{ route('admin.students.index', ['programme' => $programme->id]) }}">{{ $programme->students_count }}</a></td>
                            <td class="table-td"><a class="font-semibold text-brand-700" href="{{ route('admin.courses.index', ['programme' => $programme->id]) }}">{{ $programme->courses_count }}</a></td>
                            <td class="table-td">
                                <div class="flex justify-end gap-1">
                                    <a href="{{ route('admin.programmes.edit', $programme) }}" class="icon-btn" title="Edit"><i data-lucide="pencil" class="w-4 h-4"></i></a>
                                    <x-ui.delete-button :action="route('admin.programmes.destroy', $programme)" :confirm="'Delete programme '.$programme->code.'?'" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7"><x-ui.empty icon="layers" message="No programmes yet." /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
