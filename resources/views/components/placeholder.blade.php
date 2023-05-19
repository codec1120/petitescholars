@props(['title', 'description' => null])
<div {{ $attributes }}>
    <x-flex class="flex-col px-4 sm:px-0">
        {{ $slot }}
        <h3 class="font-medium text-gray-900 text-center leading-none">{{ $title }}</h3>
        @if ($description)
            <p class="mt-1 text-sm text-gray-600 text-center">
                {{ $description }}
            </p>
        @endif
    </x-flex>
</div>
