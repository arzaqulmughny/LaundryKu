@props(['label', 'name', 'required' => false, 'selected' => null, 'options' => [], 'showLabel' => true])

<div class="flex flex-col gap-y-1">
    @if ($showLabel)
        <x-input-label :label="$label" :name="$name" :required="$required" />
    @endif

    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes }}
            class="w-full text-xs px-3 py-2 shadow-md focus:outline-blue-400 text-slate-800 rounded-md bg-white">
            <option value="">
                Pilih {{ $label }}
            </option>
        @foreach ($options as $value => $option)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-red-500 text-xs">{{ \Illuminate\Support\Str::ucfirst($message) }}</p>
    @enderror
</div>