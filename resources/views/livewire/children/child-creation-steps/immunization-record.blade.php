<div class="col-span-8 sm:col-span-6">
    <x-card>
        <x-slot name="header">
            <x-card-title> Immunization Record </x-card-title>
        </x-slot>
        <x-slot name="table">
            @foreach($immunizationFields  as $index => $field)                    
                <div class="bg-white grid grid-cols-2 p-5 mb-2">
                    {{__($field['label'])}}
                </div>
                <div class="bg-white grid grid-cols-1 p-5 mb-2">
                    @for($i=0; $i<($field['value']??1);$i++ )
                    <div class="w-full md:w-1/2  bg-white grid grid-cols-2 px-5 mb-2">
                        <x-jet-label for="dosagelabel{{$i}}" value="Dose {{intval($i)+1}}"/>
                        <x-pikaday
                            name="dosage{{$i}}"
                            format="MM-DD-YYYY" wire:model.lazy="immunizationFields.{{$index}}.dosages.{{$i}}.date"
                            class="form-input rounded-md shadow-sm w-full"
                            autocomplete="false"
                        />
                    </div>
                    @endfor
                </div>
            @endforeach
        </x-slot>
        <x-slot name="actions">
            <button type="button" 
                wire:click="saveImmunization()"
                @click="scrollTo({top: 0, behavior: 'smooth'})"
                class="inline-flex items-center justify-center p-2 rounded-md text-green-400 hover:text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 focus:text-green-500 transition duration-150 ease-in-out">
                Save
            </button>
        </x-slot>
    </x-card>
</div>