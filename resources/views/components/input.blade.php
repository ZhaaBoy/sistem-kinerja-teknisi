@props([
    'label' => null,
    'name',
    'type' => 'text',
    'value' => '',
    'required' => false,
    'min' => null,
    'max' => null,
    'step' => null,
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="block mb-1 font-medium">{{ $label }}</label>
    @endif

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
        @if ($required) required @endif
        @if ($min) min="{{ $min }}" @endif
        @if ($max) max="{{ $max }}" @endif
        @if ($step) step="{{ $step }}" @endif
        class="input w-full border-gray-300 rounded-lg" />

    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
