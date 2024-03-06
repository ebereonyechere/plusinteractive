<x-layouts.admin>
    <div class="px-5">
        <div class="flex justify-between">
            <h1 class="text-3xl font-bold">Users</h1>
            <a class="bg-accent text-black p-3 font-bold" href="{{ route('users.create') }}">Create New
                User</a>
        </div>

        <p class="font-semibold mb-1 text-sm mt-8">User name</p>
        <div class="flex">
            <input type="text" class="bg-placeholder border-none focus:border-none p-2 focus:outline-none"
                placeholder="Search for users">
            <button class="bg-placeholder p-4 ml-1"><img src="/images/Search.png" /></button>
        </div>

        <x-admin.users.table :users="$users" />
        {{ $users->links() }}
    </div>

</x-layouts.admin>
