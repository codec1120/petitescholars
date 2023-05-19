<div {{ $attributes }}>
    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-b border-gray-200">
        <p class="leading-5 font-medium text-gray-500  flex items-center">
            {{ $label }}
        </p>
        <div class="mt-1 sm:mt-0 sm:col-span-2 flex items-center justify-between flex-wrap">
            @isset($value)
                <p class="font-medium leading-5 text-gray-900"> {{ $value }} </p>
            @endisset
            <div>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
