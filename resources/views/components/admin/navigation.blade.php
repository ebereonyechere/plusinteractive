<div class="flex flex-col w-1/4 bg-navbar p-5 min-h-screen text-gray-200">
    <img src="/images/logo.png" width="300" />
    <nav class="mt-5">
        <ul>
            <li class="mb-5 p-2 bg-accent text-black">
                <a href="{{ route('users.index') }}" class="flex align-items-center">
                    <img src="/images/icon_users.png" class="mr-3" />
                    <span class="font-bold">Users</span>
                </a>
            </li>
            <li class="mb-5 p-2 text-gray-200 flex align-items-center cursor-pointer">
                <img src="/images/vector.png" class="mr-3" />
                <span class="font-bold">Pages</span>
            </li>
        </ul>
    </nav>
</div>
