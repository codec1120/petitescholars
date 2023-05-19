<div>
    <x-alert x-data="{ shown: true, timeout: null }"
    x-init="timeout = setTimeout(() => { shown = false }, 2000);"
    x-show.transition.opacity.out.duration.1500ms="shown"
    style="display: none;"
    type="success"
    class="w-full bg-green-100 text-green-700">
        <x-flex class="w-full p-4 container space-x-0 space-y-2 sm:space-x-2 sm:space-y-0 flex-col sm:flex-row">
            @svg('heroicon-o-check-circle','w-12 h-12 sm:w-6 sm:h-6')
            <p class="font-medium"> {{ $component->message() }} </p>
        </x-flex>
    </x-alert>
</div>