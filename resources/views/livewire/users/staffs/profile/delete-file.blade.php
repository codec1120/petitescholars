<div wire:loading.class.delay="opacity-50">
    <x-button.link
        class="text-red-500"
        key="{{$media->id}}"
        wire:click.prevent="ask">
        <x-heroicon-o-trash class="w-4 h-4 mr-1" />
        Delete
    </x-button.link>
</div>
