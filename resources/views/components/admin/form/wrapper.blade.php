<div class="bg-placeholder mt-5 p-8">

    <div class="w-1/2">
        <h3 class="font-semibold text-lg">User Details</h3>

        <form action="{{ $action }}" method="post">
            @method($method)

            @csrf

            <x-admin.form.errors :errors="$errors" />

            {{ $slot }}

        </form>

    </div>

</div>
