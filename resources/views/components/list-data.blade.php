@props(['label','value', 'message'])

<div {{ $attributes->merge(['class' => 'px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6']) }}">
    <dt class="leading-5 text-sm md:text-base text-gray-500">
        {{ $label }}
    </dt>
    <x-flex class="mt-1 sm:mt-0 sm:col-span-2 justify-between">
        <p class="break-all text-sm md:text-base leading-6 text-gray-900">
            {{ $value }}
            @isset($message)
                {{ $message }}
            @endisset
        </p>
        {{ $slot }}
    </x-flex>
</div>
