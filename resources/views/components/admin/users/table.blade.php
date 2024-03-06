<table class="w-full mt-5 table-auto border-spacing-y-3 border-separate text-left">
    <thead>
        <tr>
            <th class="px-3">First Name</th>
            <th class="px-3">Last Name</th>
            <th class="px-3">Email Address</th>
            <th class="px-3">Role</th>
            <th class="px-3">Member Since</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr class="bg-placeholder">
                <td class="p-3 text-left"><a href="{{ route('users.edit', $user->id) }}"
                        class="text-link underline">{{ $user->first_name }}</a>
                </td>
                <td class="p-3 text-left">{{ $user->last_name }}</td>
                <td class="p-3 text-left">{{ $user->email }}</td>
                <td class="p-3 text-left">
                    @foreach ($user->roles as $role)
                        {{ $role->name }}@if ($loop->count > 1 && !$loop->last)
                            ,
                        @endif
                    @endforeach
                </td>
                <td class="p-3 text-left">{{ $user->created_at->day }}
                    {{ $user->created_at->shortEnglishMonth }} {{ $user->created_at->year }}</td>
            </tr>
        @endforeach

    </tbody>
</table>
