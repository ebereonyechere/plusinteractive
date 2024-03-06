<label for="">{{ $label }}</label>
<input type="email" class="bg-placeholder focus:outline-none focus:ring-o border-b-2" name="{{ $name }}" required
    value="{{ old($name, isset($value) ? $value : '') }}">
