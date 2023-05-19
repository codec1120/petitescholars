<x-jet-dialog-modal :id="'view-modal'" wire:model="viewModal">
    <x-slot name="title">
        @if($view_modal_title)
            <div class="text-center text-sm md:text-base"> {{$view_modal_title}} </div>
        @endif
        @if($view_modal_description)
            <div class="text-center text-sm md:text-base">{{$view_modal_description}}</div>
        @endif
        
    </x-slot>

    <x-slot name="content">
        <div>
            <embed src= "{{ $view_modal_tempURL }}" class="overflow-y-scroll md:h-96 w-full"/>
        </div>
    </x-slot>
    <div>
    <x-slot name="footer">
        <x-jet-danger-button wire:click="$set('viewModal', false)">
            Close
        </x-jet-danger-button>
    </x-slot>
    </div>
</x-jet-dialog-modal>