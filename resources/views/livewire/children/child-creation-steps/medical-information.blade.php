<div class="col-span-8 sm:col-span-6">
    <x-card>
        <x-slot name="header">
            <x-card-title> Medical Information </x-card-title>
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
                        />
                        @if($errors->has('physician_name')) <span class="error" style="color:red">{{ $errors->first('physician_name') }}</span> @endif
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
                        />
                        @if($errors->has('physician_number')) <span class="error" style="color:red">{{ $errors->first('physician_number') }}</span> @endif
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
                        />
                        @if($errors->has('physician_address')) <span class="error" style="color:red">{{ $errors->first('physician_address') }}</span> @endif
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
                        />
                        @if($errors->has('physician_city')) <span class="error" style="color:red">{{ $errors->first('physician_city') }}</span> @endif
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
                        />
                        @if($errors->has('physician_state')) <span class="error" style="color:red">{{ $errors->first('physician_state') }}</span> @endif
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
                        />
                        @if($errors->has('physician_zip')) <span class="error" style="color:red">{{ $errors->first('physician_zip') }}</span> @endif
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
                        />
                        @if($errors->has('child_held_insurance_provider')) <span class="error" style="color:red">{{ $errors->first('child_held_insurance_provider') }}</span> @endif
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
                        />
                        @if($errors->has('insurance_policy_number')) <span class="error" style="color:red">{{ $errors->first('insurance_policy_number') }}</span> @endif
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
                />
            @if($errors->has('selected_option_allergy')) <span class="error" style="color:red">{{ $errors->first('selected_option_allergy') }}</span> @endif
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
                />
            </div>
            @if($errors->has('selected_option_prescribe_medication')) <span class="error" style="color:red">{{ $errors->first('first_name') }}</span> @endif
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
                    placeholder="All">
                   @foreach ( $medicalInformation['list_of_allergies'] as $option)
                    <option value="{{ $option['value'] }}" >
                            {{ $option['label'] }}
                        </option>
                   @endforeach
                </x-forms.multiselect>
            </div>
        </x-slot>
        <x-slot name="actions">
            <button type="button"
                wire:click="saveMedicalInfo()"
                @click="scrollTo({top: 0, behavior: 'smooth'})"
                class="inline-flex items-center justify-center p-2 rounded-md text-green-400 hover:text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 focus:text-green-500 transition duration-150 ease-in-out">
                Save
            </button>
        </x-slot>
    </x-card>
</div>
<script>
window.scrollTo({ top: 15, left: 15, behaviour: 'smooth' })
</script>
