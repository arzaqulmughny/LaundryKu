@props(['label', 'name', 'required' => false, 'selected' => null, 'options' => [], 'showLabel' => true, 'showPlaceholder' => true])

<div class="flex flex-col gap-y-1">
    @if ($showLabel)
    <div class="flex items-center gap-x-1">
        <x-input-label :label="$label" :name="$name" :required="$required" />
    </div>
    @endif

    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes }}
        class="w-full text-xs px-3 py-2 focus:outline-blue-400 text-slate-800 rounded-md bg-white border border-gray-300">
        @if($showPlaceholder)
        <option value="">
            Pilih {{ $label }}
        </option>
        @endif
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