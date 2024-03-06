<label for="">{{ $label }}</label>
<input type="password" class="bg-placeholder focus:outline-none focus:ring-o border-b-2" name="{{ $name }}"
    @if ($required) required @endif minlength="6">
