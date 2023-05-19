@props(['id' => '', 'label' => null, 'error' => null])
<div class="flex items-center">
    <input
        id="{{ $id }}" type="checkbox"
        {{ $attributes }}
        class="form-checkbox w-4 h-4 text-teal-500 transition duration-150 ease-in-out"
     />
     @if ($label)
        <label for="{{ $id }}" class="block ml-2 text-sm text-gray-900 leading-5">
            {{ $label }}
        </label>
     @endif
</div>