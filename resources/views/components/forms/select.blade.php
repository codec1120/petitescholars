@props([
    'id' => '',
    'label' => null,
    'placeholder' => 'Select',
    'error' => null,
    'icon' => 'menu-alt-2',
    'options' => [],
    'disabled' => 'false'
])
<div {{ $attributes->whereStartsWith('class') }}>
    @isset($label)
        <x-jet-label :for="$id" :value="$label" class="mb-1" />
    @endisset
    <div class="relative text-gray-600 w-full">
        <select
            class="form-select block w-full pl-10"
            :disabled="{{ $disabled }}"
            {{ $attributes->filter(fn ($value, $key) => $key == 'wire:model.defer' || $key == 'wire:model') }}
        >
            <option value="" selected> {{ $placeholder }} </option>
            @foreach ($options as $option)
                <option value="{{ $option['value'] }}"> {{ $option['label'] }}</option>
            @endforeach
        </select>
        <p class="flex cursor-pointer items-center absolute top-0 bottom-0 left-0 ml-2 text-gray-600">
            @svg("heroicon-o-{$icon}", 'w-5 h-5')
        </a>
    </div>
    @error($error)
        <x-jet-input-error :for="$message" class="mt-2" />
    @enderror
</div>