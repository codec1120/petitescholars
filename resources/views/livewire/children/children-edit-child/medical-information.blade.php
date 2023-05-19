<div>
    <x-notification />
    <x-content>
        <div class="col-span-8 sm:col-span-6">
            <form wire:submit.prevent="submit">
                <x-card>
                    <x-slot name="header">
                        <div class="flex justify-between w-full">
                            <div>
                                <x-card-title> Medical Information </x-card-title>
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
                        <div class="bg-white grid grid-cols-2">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Child Physician Name: " >
                                    <x-jet-input
                                        id="physician_name"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="medicalInformation.physician_name"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('medicalInformation.physician_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Child Physician Number: " >
                                    <x-jet-input
                                        id="physician_number"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="medicalInformation.physician_number"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('medicalInformation.physician_number') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-2">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Child Physician Address: " >
                                    <x-jet-input
                                        id="physician_address"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="medicalInformation.physician_address"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('medicalInformation.physician_address') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Child Physician City: " >
                                    <x-jet-input
                                        id="physician_city"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="medicalInformation.physician_city"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('medicalInformation.physician_city') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-2">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Child Physician State: " >
                                    <x-jet-input
                                        id="physician_state"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="medicalInformation.physician_state"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('medicalInformation.physician_state') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Child Physician Zip: " >
                                    <x-jet-input
                                        id="physician_zip"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="medicalInformation.physician_zip"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('medicalInformation.physician_zip') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-2">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Child Held Insurance Provider: " >
                                    <x-jet-input
                                        id="child_held_insurance_provider"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="medicalInformation.child_held_insurance_provider"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('medicalInformation.child_held_insurance_provider') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Insurance Policy Number: " >
                                    <x-jet-input
                                        id="insurance_policy_number"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="medicalInformation.insurance_policy_number"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('medicalInformation.insurance_policy_number') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="font-bold text-gray-500"> Allergies & Medication. </span>
                        </div>
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="font-bold text-gray-500"> Does the child have any allergies or special conditions? </span>
                        </div>
                    <div class="p-5">
                        <x-forms.select
                                id="allergy_option"
                                label=""
                                :options="$medicalInformation['option']"
                                placeholder="Please select..."
                                error="medicalInformation.selected_option_allergy"
                                wire:model="medicalInformation.selected_option_allergy"
                                :disabled="$disableInputs"
                            />
                    </div>
                    <div>
                        @if ( $medicalInformation['selected_option_allergy'] )
                                <div class="bg-white grid grid-cols-1 p-5">
                                    <span class="font-bold text-gray-500"> Please provide a description of the child's allergies or special conditions. </span>
                                </div>
                                <div class="bg-white grid grid-cols-1">
                                    <div class="bg-white grid grid-cols-1 p-5">
                                        <textarea 
                                            placeholder="Description" 
                                            name="allergies-textArea"
                                            class="rounded-md shadow-sm block w-full" 
                                            id="allergies-textArea" 
                                            wire:model.defer="medicalInformation.allergies"
                                            disabled={{$disableInputs}}
                                            ></textarea>
                                    </div>
                                </div>
                            @endif
                    </div>
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="font-bold text-gray-500"> Does your child take presribed medication? </span>
                        </div>
                        <div class="p-5">
                            <x-forms.select
                                id="prescribe_option"
                                label=""
                                :options="$medicalInformation['option1']"
                                placeholder="Please select..."
                                error="medicalInformation.selected_option_prescribe_medication"
                                wire:model="medicalInformation.selected_option_prescribe_medication"
                                disabled={{$disableInputs}}
                            />
                        </div>
                    <div>
                    @if ( $medicalInformation['selected_option_prescribe_medication'] ) 
                            <div class="bg-white grid grid-cols-1 p-5">
                                <span class="font-bold text-gray-500"> Please provide a description of the child's medication, dosage and times. </span>
                            </div>
                            <div class="bg-white grid grid-cols-1">
                                <div class="bg-white grid grid-cols-1 p-5">
                                    <textarea 
                                        placeholder="Description" 
                                        name="prescribe_medication-textArea"
                                        class="rounded-md shadow-sm block w-full" 
                                        id="prescribe_medication-textArea" 
                                        wire:model.defer="medicalInformation.prescribe_medication"
                                        disabled={{$disableInputs}}
                                        ></textarea>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="bg-white grid grid-cols-1 p-5">
                            <span class="font-bold text-gray-500"> Does your child have any special needs, vision or hearing problems? </span>
                        </div>
                        <div class="p-5">
                            <x-forms.select
                                id="selected_option_special_needs"
                                label=""
                                :options="$medicalInformation['option2']"
                                placeholder="Please select..."
                                error="medicalInformation.selected_option_special_needs"
                                wire:model="medicalInformation.selected_option_special_needs"
                                disabled={{$disableInputs}}
                            />
                        </div>
                    <div>
                    @if ( $medicalInformation['selected_option_special_needs'] )
                            <div class="bg-white grid grid-cols-1 p-5">
                                <span class="font-bold text-gray-500"> Please provide details. </span>
                            </div>
                            <div class="bg-white grid grid-cols-1">
                                <div class="bg-white grid grid-cols-1 p-5">
                                    <textarea 
                                        placeholder="Description" 
                                        name="special_needs-textArea"
                                        class="rounded-md shadow-sm block w-full" 
                                        id="special_needs-textArea" 
                                        wire:model.defer="medicalInformation.special_needs"
                                        disabled={{$disableInputs}}
                                        ></textarea>
                                </div>
                            </div>
                        @endif
                    </div>
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="font-bold text-gray-500"> Does you child suffer frequently from any of the following? </span>
                        </div>
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="font-bold text-gray-400"> Select all that apply </span>
                        </div>
                        <div class="p-5 test">
                            <x-forms.multiselect 
                                wire:key="suffer_from"  
                                id="suffer_from" 
                                :values="$medicalInformation['suffer_from']"
                                wire:model="medicalInformation.suffer_from" 
                                multiple 
                                class="py-2" 
                                placeholder="All"
                                disabled={{$disableInputs}}
                            >
                            @foreach ( $medicalInformation['list_of_allergies'] as $option)
                                <option value="{{ $option['value'] }}" disabled={{$disableInputs}}>
                                        {{ $option['label'] }}
                                    </option>
                            @endforeach
                            </x-forms.multiselect>
                        </div>
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
