<div>
    <x-notification />
    <x-content>
        <div class="col-span-8 sm:col-span-6">
            <form wire:submit.prevent="submit">
            <x-card>
                <x-slot name="header">
                <div class="flex justify-between w-full">
                            <div>
                                <x-card-title> Immunization Record </x-card-title>
                            </div> 
                            <div class="">
                                @if(!$disableInputs)
                                    <x-jet-secondary-button wire:click.prevent="$set('disableInputs', true)"  class="w-full">
                                        Cancel
                                    </x-jet-secondary-button> 
                                @else
                                    <x-jet-button wire:click.prevent="$set('disableInputs', false)"  class="w-full">
                                        <x-heroicon-o-pencil class="w-4 h-4" />
                                            Edit
                                    </x-jet-button> 
                                @endif
                            </div>    
                        </div>
                </x-slot>
                <x-slot name="table">
                    @foreach($immunizationFields  as $index => $field)                    
                        <div class="bg-white grid grid-cols-2 p-5 mb-2">
                            {{__($field['label'])}}
                        </div>
                        <div class="bg-white grid grid-cols-1 p-5 mb-2">
                            @for($i=0; $i<($field['value'] ?? 1);$i++ )
                            <div class="w-1/2 bg-white grid grid-cols-3 px-5 mb-2">
                                <x-jet-label for="dosagelabel{{$i}}" value="Dose {{intval($i)+1}}"/>
                                @if($disableInputs)
                                    <x-pikaday
                                        name="dosage{{$index}}"
                                        format="YYYY-MM-DD" wire:model="immunizationFields.{{$index}}.dose{{$i}}"
                                        class="form-input rounded-md shadow-sm w-full"
                                        disabled
                                    />
                                @else
                                    <x-pikaday
                                        name="dosage{{$index}}"
                                        format="YYYY-MM-DD" wire:model="immunizationFields.{{$index}}.dose{{$i}}"
                                        class="form-input rounded-md shadow-sm w-full"
                                    />
                                @endif

                            </div>
                            @endfor
                        </div>
                    @endforeach
                </x-slot>
            </x-card>
            <x-card-action>
                <div>
                @if($disableInputs) 
                    <x-jet-button disabled>
                        Update
                    </x-jet-button> 
                @else 
                    <x-jet-button>
                        Update
                    </x-jet-button> 
                @endif   
                </div>
            </x-card-action>
            </form>
        </div> 
    </x-content>
</div>
