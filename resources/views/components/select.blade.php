@props(['label', 'name', 'required' => false, 'value' => true, 'options' => []])

<div class="flex flex-col gap-y-1">
    <x-input-label :label="$label" :name="$name" :required="$required" />

    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes }} class="w-full text-sm px-3 py-2.5 focus:outline-blue-400 text-slate-800 border-gray-300 border rounded-md">
        @foreach ($options as $option)
        <option value="{{ $option }}">{{ $option }}</option>
        @endforeach
    </select>

    @error($name)
    <p class="text-red-500 text-xs">{{ \Illuminate\Support\Str::ucfirst($message) }}</p>
    @enderror
</div>