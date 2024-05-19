<div class="form-group">
    <label for="{{ $id }}">{{ $slot }}</label>
    <select id="{{ $id }}" name="{{ $name }}" class="form-control">
        <option selected>{{ __('Pilih Jabatan') }}</option>
        @foreach ($options as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
    @error($name)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
