<div class="col-span-8 sm:col-span-6 p-5">
<x-table>
    <x-slot name="head">
            <x-table.heading> Immunization </x-table.heading>
            <x-table.heading> Number of Doses </x-table.heading>
            <x-table.heading> Settings </x-table.heading>
    </x-slot>
    <x-slot name="body">
        @foreach($immunizationFields as $row)
                <x-table.row
                    wire:loading.class.delay="opacity-50"
                    wire:key="row-{{ $row['id'] }}"
                >
                <x-table.cell>
                    {{ $row['label'] }}
                </x-table.cell>
                <x-table.cell class="text-center">
                        {{ $row['value'] ?? 0 }}
                </x-table.cell>
                <x-table.cell class="text-center">
                    <button type="button"
                        wire:click="enableImmunizationModal({{$row['id']}})"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <x-heroicon-s-cog class="w-4 h-4" />
                    </button>
                </x-table.cell>
            </x-table.row>
        @endforeach
    </x-slot>
</x-table>

<x-jet-modal :id="'immunization-modal'" wire:model="editImmunization">
    <form wire:submit.prevent="submitImmunization">
        <div class="px-6 py-4 overflow-y-scroll h-96">
            <div class="text-lg font-semibold mt-5">
                {{$immunizationFields[$selectedImmunizationFields['immunization_index']]['label']??'Selected Immunization'}}
            </div>
            <div class="bg-white grid grid-cols-1 mt-5">
                <x-forms.select
                    label="Select number of doses"
                    id="immunization_dosage_opt"
                    :options="$selectedImmunizationFields['immunization_dosage_opt']"
                    placeholder="Select number of doses"
                    wire:model="selectedImmunizationFields.selected_immunization_dosage"
                />
            </div>
            @if($selectedImmunizationFields['selected_immunization_dosage'])
                @for($i = 0; $i < $selectedImmunizationFields['selected_immunization_dosage']; $i++)
                <div class="bg-white grid grid-cols-3 mt-5">
                    <label class="inline-flex items-center">
                        Dose {{intval($i)+1}} Age <span class="text-red-500">*</span>
                    </label>
                    
                    <div class="bg-white grid grid-cols-1">
                        <x-list-data-input-label-left label="Months" >
                            <x-jet-input
                                id="dose_age_month_{{$i}}"
                                type="text"
                                class="block w-full"
                                wire:model.defer="immunizationFields.{{$selectedImmunizationFields['immunization_index']}}.dosages.{{$i}}.dose_age_month"
                                autocomplete="false"
                            />
                        </x-list-data-input>
                    </div>
                    <div class="bg-white grid grid-cols-1">
                        <x-list-data-input-label-left label="Years" >
                            <x-jet-input
                                id="dose_age_year_{{$i}}"
                                type="text"
                                class="block w-full"
                                wire:model.defer.defer="immunizationFields.{{$selectedImmunizationFields['immunization_index']}}.dosages.{{$i}}.dose_age_year"
                                autocomplete="false"
                            />
                        </x-list-data-input>
                    </div>
                </div>
                @endfor
            @endif
        </div>
        <x-card-action>
            <div>
                <x-jet-secondary-button wire:click="$set('editImmunization', false)">
                    Close
                </x-jet-secondary-button>
                <x-jet-button>
                    Save
                </x-jet-button>
            </div>
        </x-card-action>
    </form>
</x-jet-modal>
</div>
