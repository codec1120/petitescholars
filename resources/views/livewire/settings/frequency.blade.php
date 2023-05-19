<div>
    <x-header :title="'Frequency'"/>
    <x-notification />
    <x-content>
        <!-- Child Profile -->
        <x-card class="sm:rounded-3xl">
            <x-slot name="table">
            <div class="px-8 py-8">
                <div class="grid grid-cols-2 w-full">
                    <div class="flex justify-start font-bold">Child Profile</div>
                </div>
                <div>
                    <x-table>
                        <x-slot name="head">
                                <x-table.heading class="bg-[#b5d7a8] font-black"> Document Type </x-table.heading>
                                <x-table.heading class="bg-[#b5d7a8] font-black"> Activity </x-table.heading>
                                <x-table.heading class="bg-[#b5d7a8] font-black"> Frequency </x-table.heading>
                                <x-table.heading class="bg-[#b5d7a8] font-black"> Frequency Type</x-table.heading>
                                <x-table.heading class="bg-[#b5d7a8] font-black"> Action</x-table.heading>
                        </x-slot>
                        <x-slot name="body">
                            @forelse($frequencyChildProfileFields as $row)
                                    <x-table.row
                                        wire:loading.class.delay="opacity-50"
                                        wire:key="row-{{ $row['id'] }}"
                                    >
                                    <x-table.cell>
                                        {{ $row['doc_type'] }}
                                    </x-table.cell>
                                    <x-table.cell>
                                            {{ $row['activity']  }}
                                    </x-table.cell>
                                    <x-table.cell>
                                            {{ $row['frequency']  }}
                                    </x-table.cell>
                                    <x-table.cell>
                                            {{ $row['frequency_type']  }}
                                    </x-table.cell>
                                    <x-table.cell class="text-center">
                                        <button type="button"
                                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                                            wire:click="EditFrequencyMode({{$row}})"
                                        >
                                                Edit
                                        </button>
                                    </x-table.cell>
                                </x-table.row>
                            @empty
                            <x-table.row>
                                <x-table.cell colspan="5">
                                    <x-placeholder
                                        title="No records found."
                                        description="There are no user accounts."
                                    >
                                        @svg('heroicon-o-users', 'w-8 h-8 text-gray-500 mb-4')
                                    </x-placeholder>
                                </x-table.cell>
                            </x-table.row>
                            @endforelse 
                        </x-slot>
                    </x-table>
                </div>
            </div>
            </x-slot>
        </x-card>
    </x-content>
    <x-jet-modal :id="'frequency-modal'" wire:model="showFreqModal">
        <form wire:submit.prevent="submit">
            <div class="p-4 overflow-y-scroll h-96">
                <div class="text-lg font-semibold">
                    {{$selectedDocType}}
                </div>
                <div class="bg-white grid grid-cols-1 ml-5 mt-5">
                    <x-button.toggle wire:model="frequencyFormFields.activity" />
                </div>
                <div class="bg-white grid grid-cols-1 mt-5">
                    <x-list-data-input label="Interval: " >    
                    @if($frequencyFormFields['activity'])
                        <x-jet-input
                            id="frequency_interval"
                            type="number"
                            class="block w-full text-sm md:text-base"
                            wire:model="frequencyFormFields.frequency"
                            autocomplete="false"
                        />
                    @else
                        <x-jet-input
                            id="frequency_interval"
                            type="text"
                            class="block w-full text-sm md:text-base"
                            wire:model="frequencyFormFields.frequency"
                            autocomplete="false"
                            disabled
                        />
                    @endif
                    </x-list-data-input>
                </div>
                <div class="bg-white grid grid-cols-1 mt-5">
                    <x-list-data-input label="Select Frequency Date Type: " >
                    @if($frequencyFormFields['activity'])
                        @if($frequencyFormFields['frequency'] > 1)
                            <x-forms.select
                                label=""
                                id="frequency_type"
                                :options="$frequencyFormFields['frequency_date_type_options_plural']"
                                placeholder="Select Emergency Contact"
                                wire:model.defer="frequencyFormFields.frequency_date_type"
                            />
                        @else
                            <x-forms.select
                                label=""
                                id="frequency_type"
                                :options="$frequencyFormFields['frequency_date_type_options']"
                                placeholder="Select Emergency Contact"
                                wire:model.defer="frequencyFormFields.frequency_date_type"
                            />
                        @endif
                    @else
                    <x-forms.select
                            label=""
                            id="frequency_type"
                            :options="$frequencyFormFields['frequency_type_options']"
                            placeholder="Select Frequency Type"
                            wire:model.defer="frequencyFormFields.frequency_date_type"
                            :disabled="true"
                        />
                    @endif
                    </x-list-data-input>
                </div>
                <div class="bg-white grid grid-cols-1 mt-5">
                    <x-list-data-input label="Select Frequency Type: " >
                    @if($frequencyFormFields['activity'])
                    <x-forms.select
                            label=""
                            id="frequency_type"
                            :options="$frequencyFormFields['frequency_type_options']"
                            placeholder="Select Emergency Contact"
                            wire:model.defer="frequencyFormFields.frequency_type"
                        />
                    @else
                    <x-forms.select
                            label=""
                            id="frequency_type"
                            :options="$frequencyFormFields['frequency_type_options']"
                            placeholder="Select Frequency Type"
                            wire:model.defer="frequencyFormFields.frequency_type"
                            :disabled="true"
                        />
                    @endif
                    </x-list-data-input>
                </div>
            </div>
            <x-card-action>
                <div>
                    <x-jet-secondary-button wire:click="$set('showFreqModal', false)">
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