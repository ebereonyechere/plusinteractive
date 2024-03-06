@if ($errors->any())
    <div class="mt-6 bg-red-500 p-5 rounded">
        <ul class="list-disc">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
