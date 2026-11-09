<x-app-layout title="Users & roles">
    <x-ui.page-heading title="Users & roles" subtitle="Control who can access the system. Roles and permissions come from spatie/laravel-permission." :crumbs="['Records' => null, 'Users & roles' => null]" />

    {{-- Roles and their permissions --}}
    <div class="grid md:grid-cols-3 gap-5 mb-8">
        @foreach ($roles as $role)
            <div class="card p-5">
                <div class="flex items-center justify-between mb-3"><x-ui.badge :value="$role->name">{{ $role->name === 'admin' ? 'Administrator' : ucfirst($role->name) }}</x-ui.badge><span class="text-xs text-slate-400">{{ $role->permissions->count() }} permissions</span></div>
                <div class="flex flex-wrap gap-1.5">
                    @foreach ($role->permissions as $permission)
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-slate-100 text-slate-600">{{ $permission->name }}</span>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <form method="GET" class="card p-4 mb-5 grid sm:grid-cols-4 gap-3">
        <div class="sm:col-span-2 relative">
            <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Name or email" class="input-field !pl-10">
        </div>
        <select name="role" class="input-field">
            <option value="">All roles</option>
            @foreach ($roles as $role)<option value="{{ $role->name }}" @selected(request('role') === $role->name)>{{ ucfirst($role->name) }}</option>@endforeach
        </select>
        <button class="btn-primary justify-center"><i data-lucide="filter" class="w-4 h-4"></i>Filter</button>
    </form>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[820px]">
                <thead><tr class="bg-slate-50"><th class="table-th">User</th><th class="table-th">Current role</th><th class="table-th">Status</th><th class="table-th">Change access</th></tr></thead>
                <tbody>
                    @foreach ($users as $account)
                        <tr class="border-t border-slate-100">
                            <td class="table-td"><div class="flex items-center gap-3"><x-ui.avatar :initials="$account->initials()" /><div><p class="font-semibold">{{ $account->name }}</p><p class="text-xs text-slate-500">{{ $account->email }}</p></div></div></td>
                            <td class="table-td">@foreach ($account->roles as $role)<x-ui.badge :value="$role->name" />@endforeach</td>
                            <td class="table-td"><x-ui.badge :value="$account->status" /></td>
                            <td class="table-td">
                                <form method="POST" action="{{ route('admin.users.update', $account) }}" class="flex flex-wrap gap-2 items-center">
                                    @csrf
                                    @method('PUT')
                                    <select name="role" class="input-field !w-36 !py-1.5">
                                        @foreach ($roles as $role)<option value="{{ $role->name }}" @selected($account->hasRole($role->name))>{{ ucfirst($role->name) }}</option>@endforeach
                                    </select>
                                    <select name="status" class="input-field !w-32 !py-1.5">
                                        @foreach (['approved', 'pending', 'rejected'] as $s)<option value="{{ $s }}" @selected($account->status === $s)>{{ ucfirst($s) }}</option>@endforeach
                                    </select>
                                    <button class="btn-ghost !py-1.5 !px-3"><i data-lucide="save" class="w-4 h-4"></i>Save</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">{{ $users->links() }}</div>
</x-app-layout>
