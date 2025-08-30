@props(['label', 'name', 'type' => 'text', 'placeholder' => '', 'value' => old($name)])

<div class="flex flex-col gap-y-1">
    <label for="{{ $name }}" class="text-sm font-medium text-gray-700">{{ $label }}</label>

    <div class="relative flex items-center">
        <input type="{{ $name }}" autocomplete="off" id="{{ $name }}" name="{{ $name }}" class="w-full text-sm px-3 py-2 focus:outline-blue-400 text-slate-800 border-gray-300 border rounded-md" placeholder="{{ $placeholder }}" value="{{ $value }}">

        @if($type == 'password')
        <button type="button" class="absolute right-4 w-4 flex cursor-pointer" onclick="toggleInputPasswordVisibility(event)">
            <svg xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="w-6 h-6 text-slate-800">
                <path d="M1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12ZM12.0003 17C14.7617 17 17.0003 14.7614 17.0003 12C17.0003 9.23858 14.7617 7 12.0003 7C9.23884 7 7.00026 9.23858 7.00026 12C7.00026 14.7614 9.23884 17 12.0003 17ZM12.0003 15C10.3434 15 9.00026 13.6569 9.00026 12C9.00026 10.3431 10.3434 9 12.0003 9C13.6571 9 15.0003 10.3431 15.0003 12C15.0003 13.6569 13.6571 15 12.0003 15Z"></path>
            </svg>
        </button>
        @endif
    </div>

    @error($name)
    <p class="text-red-500 text-xs">{{ \Illuminate\Support\Str::ucfirst($message) }}</p>
    @enderror
</div>

@once
<script>
    const toggleInputPasswordVisibility = (event) => {
        const button = event.currentTarget;
        const input = button.previousElementSibling;

        console.log(input)

        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>
@endonce