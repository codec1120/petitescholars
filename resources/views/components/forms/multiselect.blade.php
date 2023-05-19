@props(['values' => [] ])
<div
    x-data='Select.data({
        model: "{!! $attributes["wire:model"] !!}",
        placeholder: "{!! $attributes["placeholder"] !!}",
        values: {!! json_encode( $values )  !!}
    })'
    x-init="onInit()"
    wire:ignore
> 
    <select
        id="{{ $attributes['id'] }}"
        x-ref="{{ $attributes['wire:model'] }}"
        {{ $attributes->except('wire:model') }}
    >
        {{ $slot }}
    </select>
</div>