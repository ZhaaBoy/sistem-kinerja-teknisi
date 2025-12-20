@props([
    'label' => null,
    'name' => null,
    'type' => 'text',
    'value' => '',
    'required' => false,
    'readonly' => false,
    'disabled' => false,
    'min' => null,
    'max' => null,
    'step' => null,
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="block mb-1 font-medium">{{ $label }}</label>
    @endif

    <input type="{{ $type }}"
        @if ($name) name="{{ $name }}" id="{{ $name }}" @endif
        value="{{ $name ? old($name, $value) : $value }}" @if ($required) required @endif
        @if ($readonly) readonly @endif @if ($disabled) disabled @endif
        @if ($min) min="{{ $min }}" @endif
        @if ($max) max="{{ $max }}" @endif
        @if ($step) step="{{ $step }}" @endif
        class="input w-full border-gray-300 rounded-lg" />


    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
