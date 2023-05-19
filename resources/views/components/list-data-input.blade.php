<div {{ $attributes }}>
    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <p class="leading-5 text-sm md:text-base text-gray-500  flex items-center">
            {{ $label }}
        </p>
        <div class="text-sm md:text-base mt-1 sm:mt-0 sm:col-span-2 flex items-center">
            <div class="w-full">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
