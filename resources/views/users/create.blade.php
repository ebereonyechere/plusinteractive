<x-layouts.admin>
    <div class="p-8">

        <a href="{{ route('users.index') }}" class="text-sm">Back to Users</a>
        <h1 class="font-bold text-3xl">Create New User</h1>

        <x-admin.form.wrapper action="{{ route('users.store') }}" method="post">
            <div class="flex mt-6">
                <div class="flex flex-col mr-5 w-full">
                    <x-admin.form.text label="First Name" name="first_name" />
                </div>
                <div class="flex flex-col w-full">
                    <x-admin.form.text label="Last Name" name="last_name" />
                </div>
            </div>

            <div class="flex flex-col mt-6">
                <x-admin.form.email label="Email Address" name="email" />
            </div>

            <div class="flex flex-col mt-6">
                <label for="">Roles</label>
                @foreach ($roles as $role)
                    <div class="flex">
                        <input type="checkbox" name="roles[]" id="" value="{{ $role->id }}" class="mr-2"
                            @if (old('roles') && in_array($role->id, old('roles'))) checked @endif>
                        <span>{{ $role->name }}</span>
                    </div>
                @endforeach
            </div>

            <div class="flex mt-6">
                <div class="flex flex-col mr-5 w-full">
                    <x-admin.form.password label="Password" name="password" :required="true" />
                </div>
                <div class="flex flex-col w-full">
                    <x-admin.form.password label="Confirm Password" name="password_confirmation" :required="true" />
                </div>
            </div>

            <div class="mt-6">
                <button class="bg-placeholder border-link text-link border rounded-full p-3">Save User</button>
            </div>
        </x-admin.form.wrapper>

    </div>


</x-layouts.admin>
