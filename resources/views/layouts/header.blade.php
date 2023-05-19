<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center w-full flex-wrap space-y-4 lg:space-y-0">
                <div class="w-full lg:w-1/2">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $title }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ $description }}
                    </p>
                </div>
                <div {{ $attributes->merge(['class' => 'w-full lg:w-1/2']) }}>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </header>
    <x-alert x-data="{ shown: true, timeout: null }"
    x-init="timeout = setTimeout(() => { shown = false }, 2000);"
    x-show.transition.opacity.out.duration.1500ms="shown" type="success" class="bg-green-100 text-green-700 p-4" />
    <x-alert x-data="{ shown: true, timeout: null }"
    x-init="timeout = setTimeout(() => { shown = false }, 3000);"
    x-show.transition.opacity.out.duration.1500ms="shown" type="warning" class="bg-yellow-100 text-yellow-700 p-4" />
    <x-alert x-data="{ shown: true, timeout: null }"
    x-init="timeout = setTimeout(() => { shown = false }, 3000);"
    x-show.transition.opacity.out.duration.1500ms="shown" type="danger" class="bg-red-100 text-red-700 p-4" />
</div>


