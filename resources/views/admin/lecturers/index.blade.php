<x-app-layout title="Lecturers">
    <x-ui.page-heading title="Lecturers" subtitle="Approved teaching staff and the courses assigned to them." :crumbs="['Records' => null, 'Lecturers' => null]">
        <x-slot name="actions"><a href="{{ route('admin.lecturers.create') }}" class="btn-primary"><i data-lucide="user-plus" class="w-4 h-4"></i>Add lecturer</a></x-slot>
    </x-ui.page-heading>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px]">
                <thead><tr class="bg-slate-50"><th class="table-th">Lecturer</th><th class="table-th">Staff no.</th><th class="table-th">Department</th><th class="table-th">Qualification</th><th class="table-th">Courses</th><th class="table-th"></th></tr></thead>
                <tbody>
                    @forelse ($lecturers as $lecturer)
                        <tr class="border-t border-slate-100 hover:bg-brand-50/40">
                            <td class="table-td"><div class="flex items-center gap-3"><x-ui.avatar :initials="$lecturer->user->initials()" tone="accent" /><div><p class="font-semibold">{{ $lecturer->name }}</p><p class="text-xs text-slate-500">{{ $lecturer->user->email }}</p></div></div></td>
                            <td class="table-td">{{ $lecturer->staff_number }}</td>
                            <td class="table-td">{{ $lecturer->department }}</td>
                            <td class="table-td">{{ $lecturer->qualification ?? '—' }} · {{ $lecturer->employment_type }}</td>
                            <td class="table-td">{{ $lecturer->courses_count }}</td>
                            <td class="table-td">
                                <div class="flex justify-end gap-1">
                                    <a href="{{ route('admin.lecturers.edit', $lecturer) }}" class="icon-btn" title="Edit"><i data-lucide="pencil" class="w-4 h-4"></i></a>
                                    <x-ui.delete-button :action="route('admin.lecturers.destroy', $lecturer)" :confirm="'Remove '.$lecturer->name.'? Their courses will become unassigned.'" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><x-ui.empty icon="presentation" message="No lecturers yet." /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
